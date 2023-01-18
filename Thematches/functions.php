<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function getTheOposite( $array , $firstteam ){
    $arrayData = $array ;
     unset($arrayData[$firstteam]);
     unset($arrayData["Status"]);
foreach ($arrayData as $key => $value) {
    return $key ;
}
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// resultCouter  is a function it s ROLE is to recieve the  matches array DATA and extract all the teams inside and then put them in one array 
// after extracting the teams from the array it will loop forEach team and calculate all the points for every team
// at the end it will return one array containing all the teams with there data PONITS GOALS DIFF ... LIKE
    // "MOROCCO" => array("POINTS" => 0 , "GAMES_PLAYED" => 0 , "GAMES_WON" => 0  , "GAMES_EQUAL" => 0  , "GAME_LOSTS" => 0  , "GOALS_SCORED" => 0  , "GOALS_RECEIVED" => 0  , "DIFF" => 0 ) ,
// SO ITS AN ARRAY OF ALL THE TeamS WITH THIERE DATA
/// I WILL USE THE SAME FUNCTION LATER
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function resultCouter($resultsArray){
    $Teams = [];
    // this codes used to get the available teams from the resultsArray ;
    $TheTeamsKeys = array();
    foreach($resultsArray as $key => $val) {
        $contries = array();
        $values = array();
     foreach($val as $valkey => $miniVAL){
         array_push($contries, $valkey);
         array_push($values, $miniVAL);
         array_push($TheTeamsKeys, $valkey);
     }
    }
    foreach ($TheTeamsKeys as $key => $value) {
        if($value == "Status"){
            unset($TheTeamsKeys[$key]);
        }
    }
    $TheTeamsKeys = array_values(array_unique($TheTeamsKeys));
    foreach($TheTeamsKeys as $value){
     $Teams += [$value => array("POINTS" => 0 , "GAMES_PLAYED" => 0 , "GAMES_WON" => 0  , "GAMES_EQUAL" => 0  , "GAME_LOSTS" => 0  , "GOALS_SCORED" => 0  , "GOALS_RECEIVED" => 0  , "DIFF" => 0 )];
    }
    foreach ($Teams as $key => $value) {
        $GAMES_PLAYED = 0 ;
        $GAMES_WON = 0 ;
        $GAMES_EQUAL = 0 ;
        $GAME_LOSTS = 0 ;
        $POINTS = ( $GAMES_WON * 3 ) + ( $GAMES_EQUAL * 1 ) ;
        $GOALS_SCORED = 0 ;
        $GOALS_RECEIVED = 0 ;
        $DIFF = $GOALS_SCORED - $GOALS_RECEIVED ;
        foreach ($resultsArray as $DataKey => $DataValue) {
            if(isset($DataValue[$key])){
                $GOALS_SCORED += $DataValue[$key] ;
                $GOALS_RECEIVED += $DataValue[getTheOposite( $DataValue , $key )] ;
                if($DataValue["Status"] == true){
                    $GAMES_PLAYED += 1 ;
                }
    if( $DataValue[$key] > $DataValue[getTheOposite( $DataValue , $key )] ){
        $GAMES_WON += 1;
    } elseif( $DataValue[$key] < $DataValue[getTheOposite( $DataValue , $key )] ){
        $GAME_LOSTS += 1;
    } elseif( $DataValue[$key] == $DataValue[getTheOposite( $DataValue , $key )] ){
        $GAMES_EQUAL += 1;
    } 
            }
        }
        $Teams[$key]["GOALS_SCORED"] = $GOALS_SCORED ; 
        $Teams[$key]["GOALS_RECEIVED"] = $GOALS_RECEIVED ; 
        $Teams[$key]["DIFF"] = $GOALS_SCORED - $GOALS_RECEIVED ; 
        $Teams[$key]["GAMES_PLAYED"] = $GAMES_PLAYED ; 
        $Teams[$key]["GAMES_WON"] = $GAMES_WON ; 
        $Teams[$key]["GAME_LOSTS"] = $GAME_LOSTS ; 
        $Teams[$key]["GAMES_EQUAL"] = $GAMES_EQUAL ; 
        $Teams[$key]["POINTS"] = ( $GAMES_WON * 3 ) + ( $GAMES_EQUAL * 1 ) ; 
    }
    return dataFormChanger($Teams);
    };
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////// END END END END END END END END END END END END END END END 
    // resultCouter  is a function it s ROLE is to recieve the  matches array DATA and extract all the teams inside and then put them in one array 
    // after extracting the teams from the array it will loop forEach team and calculate all the points for every team
    // at the end it will return one array containing all the teams with there data PONITS GOALS DIFF ... LIKE
        // "MOROCCO" => array("POINTS" => 0 , "GAMES_PLAYED" => 0 , "GAMES_WON" => 0  , "GAMES_EQUAL" => 0  , "GAME_LOSTS" => 0  , "GOALS_SCORED" => 0  , "GOALS_RECEIVED" => 0  , "DIFF" => 0 ) ,
    // SO ITS AN ARRAY OF ALL THE TeamS WITH THIERE DATA
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function dataFormChanger($data) {
        foreach($data as $key => $value) {
            foreach ($value as $xkey => $xvalue) {
                $data[$key]["Team"] = $key ;
            }
        }
        $bestArrayForm = [];
        foreach($data as $key => $value) {
          array_push($bestArrayForm , $value );
        }
        return $bestArrayForm;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function sortByTwoEquals($data){
    global $matches;
    usort($data, function ($x, $y) {
        global $matches;
        if ($x["POINTS"] === $y["POINTS"]) {
            if ($x["DIFF"] === $y["DIFF"]) {
                if ($x["GOALS_SCORED"] === $y["GOALS_SCORED"]) {
                    foreach ( $matches as $matcheKey => $matcheValue) {
                        if(isset($matcheValue[$x["Team"]])  && isset( $matcheValue[$y["Team"]] )){
                            if ( $matcheValue[$x["Team"]] === $matcheValue[$y["Team"]]) {
                        return 0;
                    } else if ( $matcheValue[$x["Team"]] < $matcheValue[$y["Team"]] ) {
                        return 1 ;
                    } else if ( $matcheValue[$x["Team"]] > $matcheValue[$y["Team"]] ) {
                        return -1 ;
                    }
                        }
                }
                } else if ( $x["GOALS_SCORED"] < $y["GOALS_SCORED"] ) {
                    return 1 ;
                } else if ( $x["GOALS_SCORED"] > $y["GOALS_SCORED"] ) {
                    return -1 ;
                }
            } else if ( $x["DIFF"] < $y["DIFF"] ) {
                return 1 ;
            } else if ( $x["DIFF"] > $y["DIFF"] ) {
                return -1 ;
            }
        } else if ( $x["POINTS"] < $y["POINTS"] ) {
            return 1 ;
        } else if ( $x["POINTS"] > $y["POINTS"] ) {
            return -1 ;
        }
    });
    return $data;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function SortWithoutComparingtwoTeams($data){
    usort($data, function ($x, $y) {
        if ($x["POINTS"] === $y["POINTS"]) {
            if ($x["DIFF"] === $y["DIFF"]) {
                if ($x["GOALS_SCORED"] === $y["GOALS_SCORED"]) {
                        return 0;
                } else if ( $x["GOALS_SCORED"] < $y["GOALS_SCORED"] ) {
                    return 1 ;
                } else if ( $x["GOALS_SCORED"] > $y["GOALS_SCORED"] ) {
                    return -1 ;
                }
            } else if ( $x["DIFF"] < $y["DIFF"] ) {
                return 1 ;
            } else if ( $x["DIFF"] > $y["DIFF"] ) {
                return -1 ;
            }
        } else if ( $x["POINTS"] < $y["POINTS"] ) {
            return 1 ;
        } else if ( $x["POINTS"] > $y["POINTS"] ) {
            return -1 ;
        }
    });
    return $data;
}
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// a function to GET THE COMMON ITEMS IF EXIST IF NOT ARRAY OF 0 LENGTH WILL BE RETURNED
function GETCOMMONS($data){
    $common = array() ;
    $catch = array();
    foreach ($data as $key => $value) {
        $commonportion = array() ;
        $i = 1;
        foreach ($data as $xkey => $xvalue) {
            if($value["POINTS"] === $xvalue["POINTS"] &&  $value["DIFF"] === $xvalue["DIFF"] &&  $value["GOALS_SCORED"] === $xvalue["GOALS_SCORED"] && $value["Team"] != $xvalue["Team"] && !in_array($xvalue["Team"], $catch)  && !in_array($value["Team"], $catch)  ){
                if ($i === 1 ){
                    array_push( $commonportion ,  $value );
                    $i++;
                }
                array_push( $commonportion ,  $xvalue );
                array_push( $catch ,  $xvalue["Team"] );
                   }
                }
                if( ! count($commonportion) == 0){
                    array_push( $common ,  $commonportion );
                }
    }
     return $common ;
}
// END OF function to GET THE COMMON ITEMS IF EXIST IF NOT ARRAY OF 0 LENGTH WILL BE RETURNED
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function GetTheDiffTeams($array){
    $countriesOfTeams = array("MOROCCO","BRASIL","CANADA","SPAIN");
        $availableTeams = array();
        foreach ( $array as $key => $value) {
            array_push( $availableTeams , $value["Team"]); 
        }
        $resultDIFF = array_values(array_diff($countriesOfTeams,$availableTeams));
        return $resultDIFF;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getTheMAtchesResultsWithoutTheNotConcernedTeams(  $addedItems , $MatchesArray  ){
    $ThematchesArray = $MatchesArray ;
    foreach($ThematchesArray as $ykey => $yval) {
        foreach($yval as $gkey => $gval) {
    foreach ( $addedItems  as $xkey => $xvalue) {
    if( $gkey == $xvalue ){
            unset($ThematchesArray[$ykey]);
        }
    }
    }
    }
    return $ThematchesArray;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function ArrayRightSort($Bigarray , $PortionArray){
$data = $Bigarray ;
        $CountriesInThePortionArray = array();
        foreach ($PortionArray as $PortionKey => $PortionValue) {
          array_push($CountriesInThePortionArray ,  $PortionValue["Team"]  ) ; 
        }
        for ($i=0; $i < count($data) ; $i++) { 
            if( in_array( $data[$i]["Team"] , $CountriesInThePortionArray  ) ) {
                $data[$i] = $PortionArray[0];
                $data[$i+1] = $PortionArray[1];
                $data[$i+2] = $PortionArray[2];
                break;
            } 
        }
        foreach ( $data as $key => $value) {
            foreach ( $Bigarray as $xkey => $xvalue) {
            if($value["Team"] == $xvalue["Team"]  )
            $data[$key] = $xvalue ;
            }
        }
        return $data ;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
