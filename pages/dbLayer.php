<?php

    function countRow(){
        require ('data.php');
        $query = "SELECT count(*) as n FROM employees";
        $result = mysqli_query($connessione, $query)
            or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $row = mysqli_fetch_array ($result);
        return $row[0];
    }

    function countRowSearch($string){
        require ('data.php');
        $query = "SELECT count(*) as n FROM employees WHERE (last_name LIKE '%$string%' OR id  LIKE '%$string%' OR birth_date LIKE '%$string%' OR first_name LIKE '%$string%')";
        $result = mysqli_query($connessione, $query)
            or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $row = mysqli_fetch_array ($result);
        return $row[0];
    }

    function getPage($first, $lenght, $order){
        require ('data.php');

        if($order[0]['column'] == 0){
            $colonna = "id";
        }else if($order[0]['column'] == 1){
            $colonna = "birth_date";
        }else if($order[0]['column'] == 2){
            $colonna = "first_name";
        }else if($order[0]['column'] == 3){
            $colonna = "last_name";
        }else if($order[0]['column'] == 4){
            $colonna = "gender";
        }

        if($order[0]['dir'] == 'asc'){
            $verso = "ASC";
        }else{
            $verso = "DESC";
        }

            $query = "SELECT * FROM employees ORDER BY $colonna $verso LIMIT $first, $lenght";
            $result = mysqli_query($connessione, $query)
                or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
            $rows = array();
            while ($row = $result -> fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
    }

    function search($first, $lenght, $string, $order){
        require ('data.php');

        if($order[0]['column'] == 0){
            $colonna = "id";
        }else if($order[0]['column'] == 1){
            $colonna = "birth_date";
        }else if($order[0]['column'] == 2){
            $colonna = "first_name";
        }else if($order[0]['column'] == 3){
            $colonna = "last_name";
        }else if($order[0]['column'] == 4){
            $colonna = "gender";
        }

        if($order[0]['dir'] == 'asc'){
            $verso = "ASC";
        }else{
            $verso = "DESC";
        }

        $query = "SELECT * FROM employees WHERE (last_name LIKE '%$string%' OR id  LIKE '%$string%' OR birth_date LIKE '%$string%' OR first_name LIKE '%$string%') ORDER BY $colonna $verso LIMIT $first, $lenght";
        $result = mysqli_query($connessione, $query)
            or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $rows = array();
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

?>