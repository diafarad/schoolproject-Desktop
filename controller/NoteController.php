<?php

$connect = new PDO("mysql:host=sql11.freemysqlhosting.net;dbname=sql11398690;charset=utf8","sql11398690","naaYPZQ5uv");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dt = new DateTime();
$la_time = new DateTimeZone('Africa/Dakar');
$dt->setTimezone($la_time);
$dt = $dt->format('Y-m-d H:i:s');

try{
    $connect->beginTransaction();

    $semestre = $_POST['hidden_sem'][0];
    $annee = $_POST['hidden_annee'][0];
    $eval = $_POST['hidden_eval'][0];


    $sql = "INSERT INTO note (idN, valeur, semestre, anneeAcad, eleve, evaluation)
              VALUES (:idn,:val,:sem,:an,:el,:eval)";

    for($count = 0; $count < count($_POST['hidden_eleve']);$count++){
        $data = array(
            ':idn'   =>  NULL,
            ':val'  =>  $_POST['hidden_note'][$count],
            ':sem' =>  $semestre,
            ':an'  =>  $annee,
            ':el' =>  $_POST['hidden_eleve'][$count],
            ':eval' =>  $eval
        );

        $statement = $connect->prepare($sql);
        $statement->execute($data);
    }

    $sqlverif = "SELECT el.mat, el.nom,n.valeur FROM note n, evaluation e, eleve el, classe c
                  WHERE n.evaluation=e.idEv AND n.eleve=el.mat AND e.classe=c.id AND n.valeur=0 
                  AND e.idEv=?";

    $statement = $connect->prepare($sqlverif);
    $statement->execute([$eval]);
    $result = $statement->fetch();
    if (!$result) {
        // le nom d'utilisateur existe déjà
        $updatestatuteval = "UPDATE evaluation e
                                SET e.statut=1
                                WHERE e.idEv='$eval'";

        $connect->exec($updatestatuteval);
    }
    $connect->commit();
}catch (PDOException $e ) {
    // Failed to insert the order into the database so we rollback any changes
    $connect->rollback();
    throw $e;
}

?>
