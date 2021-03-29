<?php

require_once '../model/DB.php';

    //Inscription
    $ok = 0;
    if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['sexe'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['date'];
        $lieu = $_POST['lieu'];
        $sexe = $_POST['sexe'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_autocommit($con, false);

        $anneeAcad = getAnneeEnCours();

        $d = date("Y");
        $car = substr($nom, 0, 1);

        $nb = "SELECT COUNT(*) FROM eleve";
        $res = mysqli_fetch_row(mysqli_query($con, $nb));
        $increment = $res[0]+1;
        $mat = 'mat_'.$d.$increment.$car; // mat_20205h ou mat_202017b
        $nomComplet = $prenom. ' ' . $nom;

        $sql1 = "INSERT INTO eleve VALUES ('$mat','$nomComplet','$dateNaiss','$lieu','$sexe')";
        $ok1 = mysqli_query($con, $sql1);

        $dateIns = date("Y-m-d");
        $classe = $_POST['classe'];

        $sql2 = "INSERT INTO inscription VALUES (NULL, '$dateIns', '$anneeAcad', '$mat', '$classe')";
        $ok2 = mysqli_query($con, $sql2);

        if($ok1 && $ok2){
            $ok = 1;
            mysqli_commit($con);
        }
        else{
            mysqli_rollback($con);
        }
        mysqli_close($con);
    }

    //ReInscription
    $res = 0;
    if(isset($_POST['mat']) && isset($_POST['classe'])){
        $mat= $_POST['mat'];
        $classe= $_POST['classe'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_autocommit($con, false);

        $anneeAcad = getAnneeEnCours();

        $dateIns = date("Y-m-d");

        $sql = "INSERT INTO inscription VALUES (NULL, '$dateIns', '$anneeAcad', '$mat', '$classe')";
        $ok = mysqli_query($con, $sql);

        if($ok){
            $res = 1;
            mysqli_commit($con);
        }
        else{
            mysqli_rollback($con);
        }
        mysqli_close($con);
    }

    if(isset($_POST['search'])){
        $conn = getConnection();
        $search = $_POST['search'];

        $query = "SELECT * FROM classe WHERE libelle like '%".$search."%'";
        $result = mysqli_query($conn,$query);

        $response = array();
        while($row = mysqli_fetch_array($result) ){
            $response[] = array("value"=>$row['id'],"label"=>$row['libelle']);
        }

        echo json_encode($response);
    }

    if(isset($_GET['an']) && isset($_GET['cla']))
    {
        $conn = getConnection();
        $annee = $_GET['an'];
        $classe = $_GET['cla'];

        $query = "SELECT * FROM eleve e, classe c, inscription i 
                  WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$annee' AND c.libelle='$classe'";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].' '.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[6].'</td>';
            $output .= '<td style="text-align:center;">'.$res[5].'</td>';
            $output .= '<td style="text-align:center;">'.$res[7].'</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    if(isset($_GET['anf']) && isset($_GET['classef']))
    {
        $conn = getConnection();
        $classe = $_GET['classef'];
        $annee = $_GET['anf'];

        $query ="SELECT COUNT(mat) FROM eleve e, inscription i, classe c 
        WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$annee' AND e.genre ='f' AND c.libelle='$classe'";

        $result = mysqli_query($conn,$query);
        $response = mysqli_fetch_row($result);

        echo json_encode($response);
    }

    if(isset($_GET['aneg']) && isset($_GET['classeg']))
    {
        $conn = getConnection();
        $classe = $_GET['classeg'];
        $annee = $_GET['aneg'];

        $query ="SELECT COUNT(mat) FROM eleve e, inscription i, classe c 
            WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$annee' AND e.genre ='m' AND c.libelle='$classe'";

        $result = mysqli_query($conn,$query);
        $response = mysqli_fetch_row($result);

        echo json_encode($response);
    }

    if(isset($_GET['classeeff']) && isset($_GET['aneff']))
    {
        $conn = getConnection();
        $classe = $_GET['classeeff'];
        $annee = $_GET['aneff'];

        $query ="SELECT COUNT(mat) FROM eleve e, inscription i, classe c 
        WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$annee' AND c.libelle='$classe'";

        $result = mysqli_query($conn,$query);
        $response = mysqli_fetch_row($result);

        echo json_encode($response);
    }