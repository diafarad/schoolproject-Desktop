<?php

require_once '../model/DB.php';
require_once '../model/ClasseDB.php';


    if(isset($_POST['valider']))
    {
        $ok = addClasse($_POST['lib'],$_POST['mont'],$_POST['mens']);
        header("location:../../view/classe/index.php?resultA=$ok");
    }

    if(isset($_POST['enregistrer']))
    {
        $ok = updateClasse($_POST['edit_id'],$_POST['edit_libelle'],$_POST['edit_montantIns'],$_POST['edit_montantMens']);
        header("location:../../view/classe/index.php?resultE=$ok");
    }

    if(isset($_POST['supprimer']))
    {
        $ok = deleteClasse($_POST['id_del']);
        header("location:../../view/classe/index.php?resultS=$ok");
    }

    if(isset($_GET['idc']))
    {
        $ok = getClasseById($_GET['idc']);
        $ok = mysqli_fetch_row($ok);
        echo json_encode($ok);
    }

    if(isset($_GET['classe_id']))
    {
        $conn = getConnection();
        $idcl = $_GET['classe_id'];
        $anneeAc = getAnEnCours();

        $query = "SELECT * FROM eleve e, classe c, inscription i 
                  WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$anneeAc' AND c.id='$idcl'
                  ORDER BY e.nom ASC";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '<td style="text-align:center;">'.$res[3].'</td>';
            $output .= '<td style="text-align:center;">'.$res[4].'</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    if(isset($_POST['annee']) && isset($_POST['classe'])){
        echo "YES WORKS";
        /*$conn = getConnection();
        $annee = $_POST['annee'];
        $classe = $_POST['classe'];

        $query = "SELECT * FROM eleve e, classe c, inscription i
                  WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$annee' AND c.id='$classe'
                  ORDER BY e.nom ASC";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '<td style="text-align:center;">'.$res[3].'</td>';
            $output .= '<td style="text-align:center;">'.$res[4].'</td>';
            $output .= '</tr>';
        }
        echo $output;*/
    }