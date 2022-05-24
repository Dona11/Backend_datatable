<?php

    require "pages/dbLayer.php";
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    $ar = array();
    $page = $_POST['start'];
    $size = $_POST['length'];
    $search = $_POST['search'];
    $order = $_POST['order'];
    $tot = countRow();
    $URL = "http://127.0.0.1:8080/";
    $method = $_SERVER['REQUEST_METHOD'];
    $last = floor($tot / $size);

    if($method == "POST"){
        if($search['value'] == ""){
            $ar['data'] = getPage($page, $size, $order);
            $ar['recordsFiltered'] = $tot;
            $ar['recordsTotal'] = $tot;
            echo json_encode($ar);
        }else{
            $totSearch = countRowSearch($search['value']);
            $ar['data'] = search($page, $size, $search['value'], $order);
            $ar['recordsFiltered'] = $totSearch;
            $ar['recordsTotal'] = $totSearch;
            echo json_encode($ar);
        }
    }

?>

