<?php
// Start the session
session_start();
?>
  <!DOCTYPE html>
  <html lang="de">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    </style>
    <title>iPlant</title>
  </head>

  <body>
    <?php 

// ±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±± //
include_once "php/graphic-elements.php";
include_once "php/dbconnect.php";
// ±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±±± //

  if((!isset($_GET['flag'])) || ($_GET['flag']) == "login" ) {

    echo getLoginForm();

    
  }
  if(($_GET['flag']) == "checklogin"){
   
                      if (checkLogin($_POST['email'],$_POST['password'])){
                         echo("<script>location.href = '/index.php?flag=play';</script>");
                      }else{
                       
                        echo "Login invalid <br> <a href=\"index.php\">try again</a>";
                      }

  }
  if(($_GET['flag']) == "register"){
   
                      echo getRegisterForm();


  }
   if(($_GET['flag']) == "checkregister"){
   
                      echo register($_POST['name'],$_POST['email'],$_POST['passcode']);
                      echo("<script>location.href = '/index.php';</script>");
                      



  }
  if(($_GET['flag']) == "play"){
     echo "
     <div class=\"header\">
      <a class=\"logo\" href=\"index.php?flag=play\">iPlant</a>
      ";
      $userArr = getUserInfo($_SESSION["uid"]);
      echo getMenuView($userArr);
      
      echo "<button id=\"myBtn\">+ Plant</button>
      
      </div><div class=\"container\">";
      //var_dump($userArr);
      $plantsArr = getPlantData();
      echo getPlantsView($plantsArr);
     

  }
  if(($_GET['flag']) == "newplant"){
    echo insertNewPlant($_POST["plantname"]);
    echo("<script>location.href = '/index.php?flag=play';</script>");
  }
  if(($_GET['flag']) == "water"){
   
    echo waterPlant($_POST["id"]);
    echo("<script>location.href = '/index.php?flag=play';</script>");
  }
  if(($_GET['flag']) == "delete"){
   
    echo deletePlant($_POST["id"]);
    echo("<script>location.href = '/index.php?flag=play';</script>");
  }
?>
    </div>

    <div id="myModal" class="modal">
      <!-- Modal Box to add new plant -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>Create new plant</p>
        <form action="index.php?flag=newplant" method="POST" name="newplant" accept-charset="utf-8">
          <input type="text" name="plantname" placeholder="Plant Name">
          <!-- <select name="color" id="">
        <option value="red">red</option>
        <option value="yellow">yellow</option>
        <option value="blue">blue</option>
        
      </select> -->
          <button type="submit" value="Submit">+ NEW PLANT</button>
        </form>
      </div>
    </div>
    <div id="myModalRegister" class="modal">
      <!-- Modal Box to add new plant -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>Register</p>
        <form action="index.php?flag=register" method="POST" name="register" accept-charset="utf-8">
          <div class="login shadow">
          <input type="name" placeholder="Name" name="name">
          <input type="email" placeholder="E-mail" name="email">
          <input type="password" placeholder="Password" name="passcode">
          <button type=\"submit\" value=\"Submit\">Register</button>
          
        </form>
      </div>
    </div>

  </body>
  <script type="text/javascript" src="js/src/script.js">
  </script>

  </html>
