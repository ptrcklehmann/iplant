<?php 
// creates login
function getLoginForm(){
    $htmlOutput = "";
    $htmlOutput .= "<div class=\"login shadow\">
    <a class=\"logo-main\" href=\"index.php\">iPlant</a>
  <form method=\"post\" action=\"index.php?flag=checklogin\">
    <h1>Sign In</h1>
    <input type=\"email\" placeholder=\"E-mail\" name=\"email\">
    <input type=\"password\" placeholder=\"Password\" name=\"password\">
    <button type=\"submit\" value=\"Submit\">Sign in</button>
  </form><br>
<p>New here? <a class=\"rb\" href=\"index.php?flag=register\">Register</a></p>
</div>";

return $htmlOutput;
}
function getRegisterForm(){
    $htmlOutput = "";
    $htmlOutput .= "<div class=\"login shadow\">
  <form method=\"post\" action=\"index.php?flag=checkregister\">
    <h1>Sign In</h1>
    <input type=\"name\" placeholder=\"Name\" name=\"name\">
    <input type=\"email\" placeholder=\"E-mail\" name=\"email\">
    <input type=\"password\" placeholder=\"Password\" name=\"passcode\">
    <button type=\"submit\" value=\"Submit\">Register</button>
  </form>
</div>";

return $htmlOutput;
}

function getUserMenu($arr){
  $htmlOutput = "";
  $htmlOutput .= "
   <div class=\"usermenu\" >
   <p>Hello, ".$arr['name']."! <br>You have ".count(getPlantData())." plants in your garden.</>
   </div>";
  return $htmlOutput;
}

function getMenuView($arr){

  $htmlOutput = "";

  for ($i=0;$i<count($arr);$i++){
      $htmlOutput .= getUserMenu($arr[$i]);
  }
  return $htmlOutput;
}


function getPlantBox($allPlants){
    $htmlOutput = "";
    
  //  for ($i=0;$i<count($allPlants);$i++){
     $htmlOutput .= 
    "<div class=\"plantbox shadow\">
    <img class=\"plant--".$allPlants['status']."\" src=\"img/stage-".$allPlants['stage']."-".$allPlants['status'].".png\">
    <form method=\"post\" action=\"index.php?flag=delete\">
    <input data-tooltip=\"DELETE PLANT\" data-tooltip-position=\"top\" type=\"text\" value=\"".$allPlants['id']."\"  placeholder=\"".$allPlants['id']."\" name=\"id\" style=\"display: none; \">
    <button data-tooltip=\"DELETE PLANT\" data-tooltip-position=\"top\" class=\"delete--".$allPlants['status']."\" type=\"submit\" value=\"Submit\">&times;</button></form>
    <form method=\"post\" action=\"index.php?flag=water\">
    <input type=\"text\" value=\"".$allPlants['id']."\"  placeholder=\"".$allPlants['id']."\" name=\"id\" style=\"display: none; \">
    <span id=\"surround\"><span id=\"initial\"><input type=\"image\" value=\"Submit\" src=\"img/watering-can.png\" onmouseover=\"img/Pwatering can.png\" class=\"regador--".$allPlants['status']."\" /></span>
    <span id=\"onhover\"><input <input  type=\"image\" value=\"Submit\" src=\"img/Pwatering can.png\" onmouseover=\"img/Pwatering can.png\" class=\"regador--".$allPlants['status']."\" /></span></span>
    </form>
    <div class=\"text-block\">
    <h4>Plant Name: ".$allPlants['name']."</h4>
    <p>Stage: ".$allPlants['stage']." | Status: <span class=\"status--".$allPlants['status']."\"> ".$allPlants['status']."</spann></p>
    </div>
  </div>";
    //$htmlOutput .= getPlantData($arr[$i]);
   
     
    return $htmlOutput;
}
function getPlantsView($arr){

  $htmlOutput = "";

  for ($i=0;$i<count($arr);$i++){
      $htmlOutput .= getPlantBox($arr[$i]);
  }
  return $htmlOutput;
}
?>