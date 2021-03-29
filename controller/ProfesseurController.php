<?php

require_once '../model/DB.php';
require_once '../model/ProfesseurDB.php';

    $ok = 0;
    if(isset($_POST['validerp'])){
        $nom = $_POST['nomp'];
        $dateNaiss = $_POST['datep'];
        $lieu = $_POST['lieup'];
        $sexe = $_POST['sexep'];

        $ok = addProfesseur($nom,$dateNaiss,$lieu,$sexe);
        header("location:../../view/professeur/index.php?resultA=$ok");
    }

    if(isset($_POST['enregistrerp'])){
        $nom = $_POST['nomp'];
        $dateNaiss = $_POST['datep'];
        $lieu = $_POST['lieup'];
        $sexe = $_POST['sexep'];
        $mat = $_POST['matp'];

        $ok = updateProfesseur($mat,$nom,$dateNaiss,$lieu,$sexe);
        header("location:../../view/professeur/index.php?resultE=$ok");
    }

    if(isset($_POST['supprimerp']))
    {
        $ok = deleteProfesseur($_POST['idp_del']);
        header("location:../../view/professeur/index.php?resultS=$ok");
    }

    if (isset($_GET['profid'])){
        $conn = getConnection();
        $an = getAnneeEnCours();
        $prof = $_GET['profid'];

        $query ="SELECT m.libelle,c.coef,cl.libelle FROM cours c, matiere m, classe cl
                        WHERE c.matiere=m.id AND c.classe=cl.id AND c.anneeAcad='$an' AND c.professeur='$prof'";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res = mysqli_fetch_array($result)){
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '</tr>';
        }

        echo $output;
    }