<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 02/06/2020
 * Time: 16:12
 */

    function addEleve($nom,$prenom,$date,$lieu,$mail,$tel,$genre)
    {
        $d = date("Y"); // on recupere l'année en cours
        $car = substr($nom, 0, 1); // premier caractere du nom

        $nb = "SELECT COUNT(*) FROM eleve";
        $res = mysqli_fetch_row(mysqli_query(getConnection(), $nb));
        $increment = $res[0]+1;
        $mat = 'mat_'.$d.$increment.$car; // mat_20205h ou mat_202017b

        $sql = "INSERT INTO eleve VALUES ('$mat', '$nom', '$prenom', '$date', '$lieu', '$mail', '$tel', '$genre')";
        return executeSQL($sql);
    }

    function getEleveByMat($mat)
    {
        $sql = "SELECT * FROM eleve WHERE mat= '$mat'";
        return executeSQL($sql);
    }

    function updateEleve($mat,$nom,$date,$lieu,$sexe)
    {
        $sql = "UPDATE eleve e SET e.nom = '$nom',
                                  e.date = '$date',
                                  e.lieu = '$lieu',
                                  e.genre = '$sexe'
                                  WHERE e.mat = '$mat'";
        return executeSQL($sql);
    }