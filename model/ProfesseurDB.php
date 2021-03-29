<?php

    function addProfesseur($nom,$date,$lieu,$genre)
    {
        $nb = "SELECT COUNT(*) FROM professeur";
        $nb = @executeSQL($nb);
        $res = mysqli_fetch_row($nb);
        
        $increment = $res[0]+1;
        $year=date('Y').'0';
        $mat = 'pf_'.$year.$increment; // pf_19865
        $sql = "INSERT INTO professeur VALUES ('$mat', '$nom' , '$date', '$lieu', '$genre')";
        return @executeSQL($sql);
    }

    function listeProfesseur()
    {
        $sql = "SELECT * FROM professeur";
        return executeSQL($sql);
    }

    function updateProfesseur($mat,$nom,$date,$lieu,$sexe)
    {
        $sql = "UPDATE professeur p SET p.nom = '$nom',
                                      p.date = '$date',
                                      p.lieu = '$lieu',
                                      p.genre = '$sexe'
                                      WHERE p.mat = '$mat'";
        return executeSQL($sql);
    }

    function deleteProfesseur($id)
    {
        $sql = "DELETE FROM professeur WHERE mat = '$id'";
        return executeSQL($sql);
    }
