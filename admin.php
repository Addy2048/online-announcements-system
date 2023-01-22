<?php

session_start();
error_reporting (E_ALL ^ E_NOTICE);
include 'user_data.php';
$link=mysqli_connect("localhost","root", "", "oas_db");

if(!$link){
    echo "Error";
}

else {
    if (!isset($_SESSION['phone'])) {
        header("Location: login.html", TRUE, 301);
        exit();
      }

      else { ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <style>
      html,
      body {
        box-sizing: border-box;
        padding: 0px;
        margin: 0px;
        height: 100%;
        width: 100%;
        font-family: "Nunito Sans", sans-serif;
      }
      *::after,
      *::before {
        box-sizing: inherit;
      }
      /* Add your own styles here */
      body {
        /* set the theme color to light blue */
        background-color: white;
      }
      table {
        /* style the table */
        border-collapse: collapse;
        width: 45%;
      }
      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: lightgrey;
      }
      tr:nth-child(even) {
        background-color: white;
      }
      .details-button {
        /* style the details button */
        background-color: lightgrey;
        border: none;
        cursor: pointer;
        padding: 8px;
      }
      .details-button:hover {
        /* highlight the button on hover */
        background-color: grey;
      }
      .modal {
        /* style the modal */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .modal-content {
        /* style the modal content */
        background-color: white;
        margin: auto;
        padding: 20px;
        border: 1px solid black;
        width: 80%;
      }
      .close-button {
        /* style the close button */
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close-button:hover {
        /* highlight the close button on hover */
        color: grey;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div
      style="
        width: 100%;
        display: flex;
        height: 50px;
        justify-content: center;
        align-items: center;
        padding-top:2rem;
      "
    >
      <div
        style="
          width: 90%;
          padding-top: 5px;
          display: flex;
          justify-content: space-between;
          height: 100%;
          align-items: center;
        "
      >
        <h1 style="display: inline-block"> <?php echo $username; ?></h1>
        <div style="display: inline-block">
          <a
            href="new.html"
            style="
              color: black;
              text-decoration: none;
              margin-left: 5px;
              padding: 5px;
              border-bottom: 2px solid black;
              font-size: 20px;
              font-weight: bold;
            "
            ><i class="fa-solid fa-square-plus"></i> New Announcement</a
          >
          <a
          href="logout.php"
            style="
              cursor: pointer;
              color: black;
              text-decoration: none;
              margin-left: 15px;
              padding: 5px;
              border-bottom: 2px solid black;
              font-size: 20px;
              font-weight: bold;
            "
            ><i class="fa-solid fa-right-from-bracket"></i> Logout</a
          >
        </div>
      </div>
    </div>

    <div
      style="
        width: 100%;
        display: flex;
        justify-content: space-around;
        margin-top: 2rem;
        /* padding-left: 5%;
        padding-right: 5%; */
      "
    >
    <div class="" style="width: 60%; ">
        
        <div class=""
          style="
            width: 100%;
          "
        >
          <h3 style="text-align: justify; font-size: 45px;">Announcement List</h3>
        </div>

        <?php include 'admin_announcements.php';
        if ($result !== false && $result->num_rows>0) {
          while ($row=$result->fetch_assoc()) {
            $title=$row['title'];
            $content=$row['content'];
            $time=$row['time'];
            $region=$row['region'];
            $district=$row['district'];
            $ward=$row['ward'];
            $village=$row['village'];
            $id=$row['id']
            ?>
            <div class="test" style="width: 100%; min-height: 100px; padding: 1rem; border-radius: 8px; border: 4px solid black; margin-bottom: 3rem;">
          <div
            style="
              width: 100%;   
              padding: 4px;
              text-align: justify;
              font-size: 20px;
              display: flex;
              justify-content: space-between;
              margin-bottom: 1rem;
            "
          >
          <span style="font-weight: 600; font-size: 30px;"><i class="fa-solid fa-scroll"></i> <?php echo $title ?></span><span><i class="fa-solid fa-calendar-days"></i> <?php echo $time ?></span>
          </div>
          <div
            style="
              width: 100%;   
              padding: 4px;
              text-align: justify;
              font-size: 18px;
              margin-top:5px;
              margin-bottom: 5px;
            "
          >
          <p><?php echo $content ?></p>
          </div>
          <div
            style="
              width: 100%;   
              padding: 4px;
              text-align: justify;
              font-size: 20px;
              display: flex;
              justify-content: space-between;
            "
          >
         
          <span><form action="delete.php" method="POST">
            <input style="display:none" type="text" name="id" value="<?php echo $id; ?>" /><button style="border: none; disply: block; font-size: 20px;" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
          </form></span><span><i class="fa-solid fa-location-dot"></i> <?php echo $village ?></span> 
          
          </div>
        </div>
            <?php
          }
        }
        
            ?>
      </div>
      
    </div>
  </body>
</html>


<?php
      }
}


?>