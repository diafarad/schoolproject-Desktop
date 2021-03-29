<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 16/11/2020
 * Time: 12:10
 */

require_once '../model/DB.php';

if(isset($_POST['ann']))
{
    $dataRes1= array();
    $conn = getConnection();
    $an = $_POST['ann'];

    $sql = "SELECT COUNT(i.id), c.libelle FROM inscription i, classe c WHERE i.classe=c.id AND i.anneeAcad='$an' GROUP BY c.id,c.libelle";
    $result1 = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result1)){
        $nbre = $row[0];
        $niveau = $row[1];
        //var_dump($row);
        $dataRes1[] = array("label" => $niveau, "y" => $nbre);
    }
    echo json_encode($dataRes1, JSON_NUMERIC_CHECK);
}

if(isset($_POST['annSer']))
{
    $dataRes1= array();
    $conn = getConnection();
    $an = $_POST['annSer'];

    $sql = "SELECT COUNT(i.id), c.serie FROM inscription i, classe c WHERE i.classe=c.id AND i.anneeAcad='$an' GROUP BY c.serie";

    $result1 = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result1)){
        $nbre = $row[0];
        $serie = $row[1];
        //var_dump($row);
        $dataRes1[] = array("y" => $nbre, "label" => $serie);
    }
    echo json_encode($dataRes1, JSON_NUMERIC_CHECK);
}