<?php
require 'functions.php';
if(isset($_COOKIE["matches"])){
    $matches = json_decode($_COOKIE['matches'] , true );
} else {
    $matches = array( 
        "morrocoVSBrasil" => array("MOROCCO" => 0 , "BRASIL" => 0 , "Status" => false  ) ,
        "morrocoVSSpain" => array("MOROCCO" => 0 , "SPAIN" => 0   , "Status" => false )    ,
        "morrocoVSCanada" => array("MOROCCO" => 0 , "CANADA" => 0   , "Status" => false ) ,
        "BrasilVSCanada" => array("BRASIL" => 0 , "CANADA" => 0   , "Status" => false ) ,
        "BrasilVSSpain" => array("BRASIL" => 0 , "SPAIN" => 0   , "Status" => false ) ,
        "CanadaVSSpain" => array("CANADA" => 0 , "SPAIN" => 0   , "Status" => false ) ,
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Matches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<header>
<h1 class="py-5 text-center text-success " > MATCHES XD </h1>
    <?php
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['MatchName']) && isset($_POST['TeamOne'])  && isset($_POST['TeamTwo']) ){

 $matches[$_POST['MatchName']][$_POST['TeamOne'][0]] = $_POST['TeamOne'][1] ;
 $matches[$_POST['MatchName']][$_POST['TeamTwo'][0]] = $_POST['TeamTwo'][1] ;
 $matches[$_POST['MatchName']]['Status'] = true ;
 setcookie('matches', json_encode($matches));

} elseif($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['reset'])){
    echo "reset done successfully";
    $matches = array( 
        "morrocoVSBrasil" => array("MOROCCO" => 0 , "BRASIL" => 0 , "Status" => false  ) ,
        "morrocoVSSpain" => array("MOROCCO" => 0 , "SPAIN" => 0   , "Status" => false )    ,
        "morrocoVSCanada" => array("MOROCCO" => 0 , "CANADA" => 0   , "Status" => false ) ,
        "BrasilVSCanada" => array("BRASIL" => 0 , "CANADA" => 0   , "Status" => false ) ,
        "BrasilVSSpain" => array("BRASIL" => 0 , "SPAIN" => 0   , "Status" => false ) ,
        "CanadaVSSpain" => array("CANADA" => 0 , "SPAIN" => 0   , "Status" => false ) ,
    );
 setcookie('matches', json_encode($matches));
}
?>
</header>
<section  class="row "  > 
<div class="col-md-6  px-3 py-4">
<h2 class="  py-2 text-center text-danger  "  > Matches </h2>
<?php
foreach($matches as $key => $val) {
   $contries = array();
   $values = array();
foreach($val as $valkey => $miniVAL){
    array_push($contries, $valkey);
    array_push($values, $miniVAL);
}
    ?>
<div class="row px-3 my-2">
<div class="col-md-4  bg-warning p-4 px-2">
<h3 class="text-center text-light "  >  <?php echo  $contries[0] ?>  </h3>
</div>
<div class="col-md-4    bg-info p-4 px-2">
    <form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>" class="text-center" >
        <div class="d-flex">
            <input type="hidden"   name="TeamOne[]"  value="<?php echo $contries[0] ?>" >
    <input type="number"  min="0"   <?php if( $val["Status"] == true ){echo "readonly";} ?>  class="w-25 mx-auto " name="TeamOne[]"  value="<?php echo $values[0] ?>" >
    <h4 class="text-center text-light "  >VS</h4>
    <input type="hidden"  class="w-25 mx-auto " name="TeamTwo[]" value="<?php echo $contries[1] ?>" >
    <input type="number" min="0"  <?php if( $val["Status"] == true ){echo "readonly";} ?>  class="w-25 mx-auto " name="TeamTwo[]" value="<?php echo $values[1] ?>" >
    </div>
    <input type="hidden"  class="w-25 mx-auto " name="MatchName" value="<?php echo $key ?>" >
    <input  type="submit" <?php if( $val["Status"] == true ){echo "disabled";} ?> value="SHOOT" class="mx-auto  text-light text-center mt-2 btn btn-warning " > 
    </form>
</div>
<div class="col-md-4  bg-warning p-4 px-2">
<h3 class="text-center text-light " >  <?php echo $contries[1] ?>   </h3>
</div>
</div>
<?php 
}
?>
<div class="text-center" >
    <form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="reset" value="reset">
<input type="submit"  class="btn text-center mx-auto btn-danger"  value="RESET ALL VALUES">
</form>
</div>
</div>
<div class="col-md-6 px-3 py-4">
<h2 class="  py-2 text-center text-danger  "  > results Table </h2>
<div class="table-responsive">
<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>TEAM</th>
        <th>POINTS</th>
        <th>GAMES PLAYED</th>
        <th>GAMES WON</th>
        <th>GAMES EQUAL</th>
        <th>GAME LOSTS</th>
        <th>Goals Scored</th>
        <th>Goals Recieved</th>
        <th>DIFF</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if( isset($_REQUEST['_method']) &&  $_REQUEST['_method'] == "PUT") {
if(count(GETCOMMONS(resultCouter($matches))) === 0 ){
    echo "there is no common items";
    foreach (  sortByTwoEquals(resultCouter($matches))  as $key => $value) {
        ?>
        <tr>
        <td> <?php echo $key + 1 ; ?> </td>
        <td><?php  echo $value["Team"];  ?></td>
        <td><?php  echo $value["POINTS"];  ?></td>
        <td><?php  echo $value["GAMES_PLAYED"];  ?></td>
        <td><?php echo  $value["GAMES_WON"];  ?></td>
        <td><?php echo  $value["GAMES_EQUAL"];  ?></td>
        <td><?php echo  $value["GAME_LOSTS"];  ?></td>
        <td><?php echo  $value["GOALS_SCORED"];  ?></td>
        <td><?php  echo $value["GOALS_RECEIVED"];  ?></td>
        <td><?php  echo $value["DIFF"];  ?></td>
      </tr>
       <?php 
    }
} else {

    if(count(GETCOMMONS(resultCouter($matches))) == 1){
        if(count(GETCOMMONS(resultCouter($matches))[0]) == 2){
        foreach ( sortByTwoEquals(resultCouter($matches) )  as $key => $value) {
            ?>
            <tr>
            <td> <?php echo $key + 1 ; ?> </td>
            <td><?php  echo $value["Team"];  ?></td>
            <td><?php  echo $value["POINTS"];  ?></td>
            <td><?php  echo $value["GAMES_PLAYED"];  ?></td>
            <td><?php echo  $value["GAMES_WON"];  ?></td>
            <td><?php echo  $value["GAMES_EQUAL"];  ?></td>
            <td><?php echo  $value["GAME_LOSTS"];  ?></td>
            <td><?php echo  $value["GOALS_SCORED"];  ?></td>
            <td><?php  echo $value["GOALS_RECEIVED"];  ?></td>
            <td><?php  echo $value["DIFF"];  ?></td>
          </tr>
           <?php 
        }
    } elseif ( count(GETCOMMONS(resultCouter($matches))[0]) > 2) {
       $theCommonItems =  GETCOMMONS(resultCouter($matches))[0];
$rightsortedData = ArrayRightSort( SortWithoutComparingtwoTeams(resultCouter($matches)) , sortByTwoEquals(resultCouter(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches )))) ;
        foreach ( $rightsortedData   as $key => $value) {
            ?>
            <tr>
            <td> <?php echo $key + 1 ; ?> </td>
            <td><?php  echo $value["Team"];  ?></td>
            <td><?php  echo $value["POINTS"];  ?></td>
            <td><?php  echo $value["GAMES_PLAYED"];  ?></td>
            <td><?php echo  $value["GAMES_WON"];  ?></td>
            <td><?php echo  $value["GAMES_EQUAL"];  ?></td>
            <td><?php echo  $value["GAME_LOSTS"];  ?></td>
            <td><?php echo  $value["GOALS_SCORED"];  ?></td>
            <td><?php  echo $value["GOALS_RECEIVED"];  ?></td>
            <td><?php  echo $value["DIFF"];  ?></td>
          </tr>
           <?php 
        }
}
    } elseif ( count(GETCOMMONS(resultCouter($matches)))  == 2) {
        // here is very easy becase if there is just two elements then i will see the match of both of them and extract the winner 
        // the winner is up morocco 5 vs 6 canada then canada is the top in order
        foreach ( sortByTwoEquals(resultCouter($matches))  as $key => $value) {
            ?>
            <tr>
            <td> <?php echo $key + 1 ; ?> </td>
            <td><?php  echo $value["Team"];  ?></td>
            <td><?php  echo $value["POINTS"];  ?></td>
            <td><?php  echo $value["GAMES_PLAYED"];  ?></td>
            <td><?php echo  $value["GAMES_WON"];  ?></td>
            <td><?php echo  $value["GAMES_EQUAL"];  ?></td>
            <td><?php echo  $value["GAME_LOSTS"];  ?></td>
            <td><?php echo  $value["GOALS_SCORED"];  ?></td>
            <td><?php  echo $value["GOALS_RECEIVED"];  ?></td>
            <td><?php  echo $value["DIFF"];  ?></td>
          </tr>
           <?php 
        }
    }
}
} else {
    echo "
<tr>
    <td>1</td>
    <td>MOROCCO</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
      <td>2</td>
      <td>CANADA</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
      <td>3</td>
      <td>FRANCE</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
      <td>4</td>
      <td>BRASIL</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr> 
    ";
}
    ?>
    </tbody>
  </table>
</div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="text-center" >
<input type="hidden" name="_method" value="PUT">
<input type="submit"  class="btn text-center mx-auto btn-info text-light"  value="COUNT IT">
</form>
</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
