<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
$link = mysqli_connect("localhost", "root", "", "oas_db");

if(!$link){
    echo "Error";
}

else {

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM announcements";
$result = mysqli_query($link,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM announcements ORDER BY id desc LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($link,$sql);

    ?>
    <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
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

      .test {
        border: 2px solid red;
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
        <h1 style="display: inline-block">
          Local Government Authorities Announcement System
        </h1>
        <div style="display: inline-block">
          <a
            href="login.html"
            style="
              color: black;
              text-decoration: none;
              margin-left: 5px;
              padding: 5px;
              border-bottom: 2px solid black;
              font-size: 20px;
              font-weight: bold;
            "
            >Login</a
          ><a
            href="registration.html"
            style="
              cursor: pointer;
              color: black;
              text-decoration: none;
              margin-left: 25px;
              padding: 5px;
              border-bottom: 2px solid black;
              font-size: 20px;
              font-weight: bold;
            "
            ><i class="fa-solid fa-user-plus"></i> Register</a
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
      <div style="width: 100%; height: 150px; border-radius: 8px; border: 4px solid black; display: flex; justify-content: center; align-items: center;">
      <form style="width: 90%;" action="search_results.php" method="POST">
        <input type="text" placeholder="search by village/street" name="keyword" style="border: 3px solid black; height: 40px; border-radius: 8px; width: 60%; padding-left: 15px;font-size: 20px" />
        <button type="submit" style="border: 3px solid black; height: 40px; border-radius: 8px; width: 30%; background-color: white; cursor:pointer;">Search</button>
      </form>
    </div>
        
        <div class=""
          style="
            width: 100%;
          "
        >
          <h3 style="text-align: justify; font-size: 45px;">Announcement List</h3>
        </div>

        <?php 
          while($row = mysqli_fetch_array($res_data)){
            $title=$row['title'];
            $content=$row['content'];
            $time=$row['time'];
            $region=$row['region'];
            $district=$row['district'];
            $ward=$row['ward'];
            $village=$row['village'];
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
              justify-content: flex-end;
            "
          >
          <span><i class="fa-solid fa-location-dot"></i> <?php echo $village ?></span>  
          </div>
        </div>
            <?php
          }
        
        
            ?>
      </div>
      <ul class="pagination" style="list-style-type: none">
        <span style="font-weight: bold; font-size:20px">Pagination</span>
        <li><a  href="?pageno=1" style="text-decoration: none; color: black; font-weight: bold;">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a style="text-decoration: none; color: black; font-weight: bold;" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a style="text-decoration: none; color: black; font-weight: bold;" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a style="text-decoration: none; color: black; font-weight: bold;" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
    </div>
  </body>
</html>

<?php
}


?>