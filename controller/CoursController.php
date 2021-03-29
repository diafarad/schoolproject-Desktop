<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 11/11/2020
 * Time: 14:39
 */

require_once '../model/DB.php';
require_once '../model/CoursDB.php';

if(isset($_POST['addcours'])){
    $an = getAnneeEnCours();
    $ok = addCours($_POST['coef'],$_POST['matiere'],$_POST['professeur'],$_POST['classeid'],$an);
    header("location:../../view/cours/index.php?resultA=$ok");
}

if(isset($_GET['classe_id']))
{
    $conn = getConnection();
    $idcl = $_GET['classe_id'];
    $anneeAc = getAnneeEnCours();

    $query = "SELECT m.libelle,cr.coef,p.nom FROM cours cr, classe c, professeur p, matiere m
                  WHERE cr.classe=c.id AND cr.professeur=p.mat AND m.id=cr.matiere AND cr.anneeAcad='$anneeAc' AND c.id='$idcl'";

    $result = mysqli_query($conn,$query);
    $output = '';
    while($res=mysqli_fetch_row($result))
    {
        $output .= '<tr>';
        $output .= '<td style="text-align:center;">'.$res[0].'</td>';
        $output .= '<td style="text-align:center;">'.$res[1].'</td>';
        $output .= '<td style="text-align:center;">'.$res[2].'</td>';
        $output .= '</tr>';
    }
    echo $output;
}

if(isset($_POST['classe']) && isset($_POST['annee']))
{
    $conn = getConnection();
    $idcl = $_POST['classe'];
    $anneeAc = $_POST['annee'];

    $query = "SELECT m.libelle,cr.coef,p.nom FROM cours cr, classe c, professeur p, matiere m
                  WHERE cr.classe=c.id AND cr.professeur=p.mat AND m.id=cr.matiere AND cr.anneeAcad='$anneeAc' AND c.id='$idcl'";

    $result = mysqli_query($conn,$query);
    $output = '';
    while($res=mysqli_fetch_row($result))
    {
        $output .= '<tr>';
        $output .= '<td style="text-align:center;">'.$res[0].'</td>';
        $output .= '<td style="text-align:center;">'.$res[1].'</td>';
        $output .= '<td style="text-align:center;">'.$res[2].'</td>';
        $output .= '</tr>';
    }
    echo $output;
}


if (isset($_GET['idp']) && isset($_GET['an'])){
    $conn = getConnection();
    $prof = $_GET['idp'];
    $an = $_GET['an'];

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