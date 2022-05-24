<?php

    require "pages/dbLayer.php";
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    $ar = array();
    $page = @$_POST['start'] ?? 0;
    $size = @$_POST['length'] ?? 10;
    $search = $_POST['search'];
    $tot = countRow();
    $URL = "http://127.0.0.1:8080/";
    $method = $_SERVER['REQUEST_METHOD'];
    $last = floor($tot / $size);

    

    

    if($method == "POST"){
        //var_dump($search);
        if($search ){
            $ar['data'] = getPage($page, $size);
            $ar['recordsFiltered'] = $tot;
            $ar['recordsTotal'] = $tot;
            echo json_encode($ar);
        }
        
    }/*else if($method == "POST"){
        $data = json_decode(file_get_contents('php://input'), true);
        postEmployee($data["birth_date"], $data['first_name'], $data['last_name'], $data['gender']);
        echo json_encode($data);
    }*/else if($method == "DELETE"){
        deleteEmployee($_GET['id']);
        echo json_encode($ar);
    }else if($method == "PUT"){
        $data = json_decode(file_get_contents('php://input'), true);
        editEmployee($_GET['id'], $data["birth_date"], $data['first_name'], $data['last_name'], $data['gender']);
        echo json_encode($data);
    }

    function href($url, $page, $size){

        $href = $url . "?page=" . $page . "&size=" . $size;
        return $href;
    }

    function links($page, $size, $last, $URL){
        $links = array();
        $links['first']['href'] = href($URL, 0, $size);

        if($page > 0){
            $links['prev']['href'] = href($URL, ($page - 1), $size);
        }
        if($page < $last){

            $links['next']['href'] = href($URL, ($page + 1), $size);
        }
        $links['last']['href'] = href($URL, $last, $size);

        return $links;
    }

?>

