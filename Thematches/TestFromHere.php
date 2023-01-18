<?php




require 'functions.php';





/// you can use this two arrays to maniplate and test easily


$matches = array( 
    "morrocoVSBrasil" => array("MOROCCO" => 4 , "BRASIL" => 8 , "Status" => false  ) ,
    "morrocoVSSpain" => array("MOROCCO" => 6 , "SPAIN" => 0   , "Status" => false )    ,
    "morrocoVSCanada" => array("MOROCCO" => 5 , "CANADA" => 9   , "Status" => false ) ,
    "BrasilVSCanada" => array("BRASIL" => 2 , "CANADA" => 4   , "Status" => false ) ,
    "BrasilVSSpain" => array("BRASIL" => 3 , "SPAIN" => 6   , "Status" => false ) ,
    "CanadaVSSpain" => array("CANADA" => 6 , "SPAIN" => 4   , "Status" => false ) ,


);




$thecountedData = Array (
    
    array( "Team" => "MOROCCO"  ,"POINTS" => 3 , "GAMES_PLAYED" => 0 , "GAMES_WON" => 0  , "GAMES_EQUAL" => 0  , "GAME_LOSTS" => 0  , "GOALS_SCORED" => 4  , "GOALS_RECEIVED" => 0  , "DIFF" => 4 ) ,
    array( "Team" => "BRASIL", "POINTS" => 4 , "GAMES_PLAYED" => 4 , "GAMES_WON" => 1  , "GAMES_EQUAL" => 1  , "GAME_LOSTS" => 1  , "GOALS_SCORED" => 4  , "GOALS_RECEIVED" => 1  , "DIFF" => 4 ) ,
    array( "Team" => "CANADA", "POINTS" => 4 , "GAMES_PLAYED" => 9 , "GAMES_WON" => 9  , "GAMES_EQUAL" => 9  , "GAME_LOSTS" => 9  , "GOALS_SCORED" => 4  , "GOALS_RECEIVED" => 9  , "DIFF" => 4 ) ,
    array( "Team" => "SPAIN", "POINTS" => 4 , "GAMES_PLAYED" => 0 , "GAMES_WON" => 0  , "GAMES_EQUAL" => 0  , "GAME_LOSTS" => 0  , "GOALS_SCORED" => 4  , "GOALS_RECEIVED" => 0  , "DIFF" => 4 ) 

);







?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<style>
    pre {

  font-size: 16px !important;
}
</style>

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



    if(count(GETCOMMONS($thecountedData)) === 0 ){
        echo "<h1 style='color:green'> there is no common items </h1> ";
    
  
    
    
        foreach (  sortByTwoEquals($thecountedData)  as $key => $value) {
            
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



      
    
        echo "<h1 style='color:green'> there is a common items </h1> ";
    
    
        echo ' <h5 style="color:red"> the counted data without sorting </h5>';
        echo '<pre>' ;
        print_r($thecountedData);  
        echo '</pre>' ;
        
        
        
        echo ' <h5 style="color:red"> the common items in the sorted data </h5>';
        echo '<pre>' ; 
        print_r(GETCOMMONS($thecountedData));
        echo '</pre>' ;
    
    
    
    
    
    
    
    
    
    
    
    
        if(count(GETCOMMONS($thecountedData)) == 1){
    
    
            
    
            
    
    
    
    
    
    
    
            if(count(GETCOMMONS($thecountedData)[0]) == 2){
    
             // here is ver easy becase if there is just two elements then i will see the match of both of them and extract the winner    
            // the winner is up morocco 5 vs 6 canada then canada is the top in order 
    
            echo ' <h5 style="color:red"> the common items number is 2 </h5>';
    
            foreach ( sortByTwoEquals($thecountedData )  as $key => $value) {
            
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
    
    
       
    
    
    
    
        
        
        } elseif ( count(GETCOMMONS($thecountedData)[0]) > 2) {
               
            
            echo ' <h5 style="color:red"> the common items number is 3 or more </h5>';
    
    
            
           $theCommonItems =  GETCOMMONS($thecountedData)[0];
    
    
    
    
           echo ' <h5 style="color:red"> this is the not concerned countries / these teams have to be out of the calculation </h5>';
            echo " <pre> <i style='color:brown;' >";
            print_r(GetTheDiffTeams($theCommonItems));
            echo "<pre> </i>";
           
            
            echo ' <h5 style="color:red"> these are the matches between the teams concerned </h5>';
            echo " <pre> <i style='color:blue;' >";
            print_r(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches ));
            echo "<pre> </i>";
            


            echo ' <h5 style="color:red"> i use the resultCouter function  to calculate the result just between the teams  concerned </h5>';
            
            echo " <pre> <i style='color:orange;' >";
            print_r(resultCouter(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches )));
            echo "<pre> </i>";
            
            
            
            
            echo ' <h5 style="color:red"> then i sort this result  </h5>';
   
                    
            echo " <pre> <i style='color:aqua;' >";
            print_r(sortByTwoEquals(resultCouter(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches ))));
            echo "<pre> </i>";
            
            





            echo ' <h5 style="color:red"> this is the first data sorted without comparing the teams  </h5>';

            echo " <pre> <i style='color:red;background-color:black;' >";
            
            print_r(SortWithoutComparingtwoTeams($thecountedData) );
            echo "<pre> </i>";
            
         
    
     
    
            echo ' <h5 style="color:red"> i use this function ArrayRightSort to perform the right sort / put the sorted data from resultCouter in the right indexes then change the values to the first values   </h5>';
    
            echo " <pre> <i style='color:white;background-color:green;' >";
            
            print_r(ArrayRightSort( SortWithoutComparingtwoTeams($thecountedData) , sortByTwoEquals(resultCouter(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches ))))  );
            echo "<pre> </i>";


            
    
    
    
    
    
$rightsortedData = ArrayRightSort( SortWithoutComparingtwoTeams($thecountedData) , sortByTwoEquals(resultCouter(getTheMAtchesResultsWithoutTheNotConcernedTeams( GetTheDiffTeams($theCommonItems) , $matches )))) ;



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
    
        } elseif ( count(GETCOMMONS($thecountedData))  == 2) {
    
            // here is ver easy becase if there is just two elements then i will see the match of both of them and extract the winner 
            // the winner is up morocco 5 vs 6 canada then canada is the top in order
    
    
            echo ' <h5 style="color:red"> using the function GETCOMMONS i detect that the result counter have 2 groups of two commons   / sort them with sortByTwoEquals  </h5>';
            
    
            foreach ( sortByTwoEquals($thecountedData)  as $key => $value) {
            
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
    
    
    
    
    
        
    ?>
    



 
    </tbody>
  </table>



</div>




    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    













