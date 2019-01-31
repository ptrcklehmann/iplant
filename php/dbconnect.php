<?php 

/* --------------------------------------------------------------------- */
    $servername = "192.168.64.2";      $username = "ptrck";
    $password = "ponyo2121";           $dbname = "virtualplant";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
/* --------------------------------------------------------------------- */

date_default_timezone_set('Europe/Berlin');

// USER FUNCTIONS ___________________________________________________________
function getUserData($email){

  $conn = $GLOBALS['conn'];
  $arrayOutput = [];
  $sql = "SELECT id,name,email,passcode FROM user WHERE email='".$email."'";
  

  $result = $conn->query($sql);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             $arrayOutput[]=$row;
         }
    }
    return $arrayOutput;
}

function getUserInfo($uid){

  $conn = $GLOBALS['conn'];
  $arrayOutput = [];
  $sql = "SELECT * FROM `user` WHERE user.id = ".$uid."";
  $result = $conn->query($sql);

    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             $arrayOutput[]=$row;
         }
    }

    return $arrayOutput;
}

// this one takes care if the user inserted the correct info
function checkLogin($e,$p){

    $boolOutput = false;

      $row = array_pop(getUserData($e));
      $id = $row['id'];

      $_SESSION["uid"]= $id;
      echo $_SESSION["uid"];
      $passFormDB = $row['passcode'];

      if( $passFormDB == $p){

        $boolOutput = true;
      }

    return $boolOutput;

}
function register ($name, $email, $passcode){
   $conn = $GLOBALS['conn'];
    $output = "";
    $uid = $_SESSION["uid"];

    $sql = "INSERT INTO `user` (`id`, `name`, `email`, `passcode`) VALUES (NULL, '".$name."', '".$email."', '".$passcode."');";
    $result = $conn->query($sql);
    if ($result) {
        echo "Registration sucessful, please log in";
    } else {
        echo "Registration failed! Try again.";
    }
    $output = $result;
}
// PLANTS DATABASE FUNCTIONS ___________________________________________________________
// get plant data from the database
function getPlantData(){

  $conn = $GLOBALS['conn'];
  $arrayOutput = [];
  
  $sql = "SELECT user.name, user.id, plants.id, plants.name, plants.created, plants.lastfed, plants.stage, plants.status FROM plants
          INNER JOIN user ON user.id = plants.uid WHERE user.id = ".$_SESSION["uid"]." ORDER BY plants.lastfed";

  $result = $conn->query($sql);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             $arrayOutput[]=$row;

         }
    }
    return $arrayOutput;
}

/*  this checks how old is the plant in minutes comparing the dateOfSow, 
aka 'created' in the database, with the actual system date */
function checkPlantAge(){
    $allPlants = getPlantData();
    foreach ($allPlants as $plants){
        $dateOfSow = new DateTime($plants['created']);
        $actualTime = new DateTime(date("Y-m-d H:i:s"));
        $interval = $dateOfSow->diff($actualTime); 
        $minutes = $interval->days * 24 * 60;
        $minutes += $interval->h * 60;
        $minutes += $interval->i;
       // then, accordingly to the minutes, it determines which stage the plant is 
       // the plant evolves at every 12 hours. 
       if ($dateOfSow) {
                $stage = 1;
                if ($minutes > 0720)
                    $stage = 2; 
                if ($minutes > 1440) $stage = 3;
                if ($minutes > 2160) $stage = 4;
                if ($minutes > 2880) $stage = 5;                
                if ($minutes > 3600) $stage = 6;
                if ($minutes > 4320) $stage = 7;
       } else {
           $stage = 0;
       }
       //finally, it updates the datbase with the correct stage. this happens at every page reload
        $conn = $GLOBALS['conn'];
        $sql = "UPDATE `plants` SET `stage` = ".$stage." WHERE `plants`.`id` = ".$plants['id']."";   
        $result = $conn->query($sql); 
    }
}


//Function checks how long has it been since the plant was watered 
function checkMoistness(){
    $allPlants = getPlantData();
    foreach ($allPlants as $plants){
    $row = array_pop(getPlantData());
    $lastfed = new DateTime($plants['lastfed']);
    $actualTime = new DateTime(date("Y-m-d H:i:s"));
    $interval = $lastfed->diff($actualTime);
    $minutes = $interval->days * 24 * 60;
    $minutes += $interval->h * 60;
    $minutes += $interval->i;
    $status = "";
    // as the previous function, this one determines either the plant is dry or wet, or too bad, dead.
    //the plant dies after 12 hours without watering. 
    // if ($lastfed == '0000-00-00 00:00:00.000000') { // this is the default value for just born plants, therefore they are still dry
    //    $status = "dry"; }  
    
    if ($minutes > 360) {
      $status = "dry";

    } 
    if ($minutes < 360) {
    $status = "moist"; 
    }  
    if ($minutes > 760) {
           $status = "dead";
    }
    
    //    if ($minutes > 760) {
    //    $status = "dead";
    // } 
    
    $conn = $GLOBALS['conn'];
    $sql = "UPDATE `plants` SET `status` = '".$status."' WHERE `plants`.`id` = ".$plants['id']."";   
    $result = $conn->query($sql); 
    }
}

    
// calling the functions
checkPlantAge();
checkMoistness();


//GAME ACTIONS FUNCTIONS _______________________________________________________________

//inserts a new plant on the game
function insertNewPlant ($n){
   $conn = $GLOBALS['conn'];
    $output = "";
    $uid = $_SESSION["uid"];

    $sql = "INSERT INTO `plants` (`id`, `name`, `created`, `lastfed`, `stage`, `status`, `uid`) VALUES (NULL, '".$n."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0', 'dry', '".$uid."');";
    $result = $conn->query($sql);
    $output = $result;
}
//water the thirst plant
function waterPlant($id){
    $conn = $GLOBALS['conn'];
    $timestamp = date("Y-m-d H:i:s");
    $output = "";
    $sql = "UPDATE `plants` SET `lastfed` = '".$timestamp."' WHERE `plants`.`id` = ".$id.""; 
    $result = $conn->query($sql);
    $output = $result;
}

function deletePlant($id){
    $conn = $GLOBALS['conn'];
    $output = "";
    $sql = "DELETE FROM `plants` WHERE `plants`.`id` = ".$id."";
    $result = $conn->query($sql);
    $output = $result;
}
?>


