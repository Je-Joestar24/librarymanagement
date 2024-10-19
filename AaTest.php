<?php 
    //include ('DBconnect.php');

    $array = array(
        'Book_ID' => 2208,
        'Title' => "The Humannoid"
    );


    function InsertVs($array, $table, $ncluded = ""){

        //include($ncluded);
        $query = "INSERT INTO ".$table." (";
        $arrks = array();
        $arrvs = array();

        foreach($array as $k => $v){
            if(!is_array($v)){
            array_push($arrks, $k);
            array_push($arrvs, $v);
            } else {

            }
        } 
        $arrks = implode("`, `", $arrks);
        $arrvs = implode("', '", $arrvs);
        $query .= "`".$arrks. "`) VALUES ('". $arrvs. "') ";
        //mysqli_query($connect, $query);
        echo "\n\n\n".$query. "\n\n\n";
    }
?>