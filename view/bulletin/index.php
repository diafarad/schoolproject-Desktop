<?php

require_once 'PDF_MySQL_Table.php';
require_once '../../model/DB.php';

// Connexion à la base
$conn = getConnection();
$an = $_POST['anNote'];
$cl = $_POST['classNote'];
$sem = $_POST['semNote'];
$mat = $_POST['matEl'];

$pdf = new PDF_MySQL_Table();
$pdf->setMatricule(strtoupper($mat));
$pdf->setAnneeAcad($an);
$pdf->setSemestre($sem);

$infoEleve = "SELECT e.nom, e.date, e.lieu, e.genre, c.libelle, COUNT(i.eleve)
                FROM eleve e, classe c, inscription i
                WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$an' AND e.mat='$mat'
                GROUP BY e.nom, e.date, e.lieu, e.genre, c.libelle";

$result = mysqli_query($conn,$infoEleve);

while($row = mysqli_fetch_array($result)){
    $pdf->setNom(strtoupper($row['nom']));
    $pdf->setDate($row['date']);
    $pdf->setLieu($row['lieu']);
    $pdf->setClasse(strtoupper($row['libelle']));
    $pdf->setGenre(strtoupper($row['genre']));
    $pdf->setEffectif($row[5]);
}

$infoEff = "SELECT COUNT(i.eleve)
                FROM eleve e, classe c, inscription i
                WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$an' AND c.id='$cl'";
$resultE = mysqli_query($conn,$infoEff);

while($row = mysqli_fetch_array($resultE)){
    $pdf->setEffectif(strtoupper($row[0]));
}

$sommeCoef = 0;

$sumCoef = "SELECT SUM(cr.coef)
                FROM cours cr
                WHERE cr.classe='$cl' AND cr.anneeAcad='$an'";
$resultCoef = mysqli_query($conn,$sumCoef);

while($row = mysqli_fetch_array($resultCoef)){
    $sommeCoef = $row[0];
}

$sommeMoyxCoef = 0;
$sumMoyxCoef = "SELECT SUM(t.moy)
                    FROM (SELECT CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2))*cr.coef AS moy                                    
                                        FROM note nd, evaluation ed, note ne, evaluation ee, matiere m, classe c, cours cr
                                        WHERE ed.idEv=nd.evaluation AND ee.idEv=ne.evaluation 
                                        AND c.id=ed.classe AND c.id=ee.classe AND c.id='$cl'
                                        AND cr.classe=c.id AND cr.matiere=ee.idMatiere AND cr.matiere=ed.idMatiere
                                        AND m.id=ed.idMatiere AND m.id=ee.idMatiere 
                                        AND nd.evaluation=ed.idEv AND ne.evaluation=ee.idEv 
                                        AND nd.semestre='$sem' AND ne.semestre='$sem' 
                                        AND nd.eleve='$mat' AND ne.eleve='$mat' 
                                        AND nd.anneeAcad='$an' AND ne.anneeAcad='$an' 
                                        AND ed.typeEv='devoir' AND ee.typeEv='examen' 
                                      GROUP BY m.libelle
                                      ORDER BY m.id ASC) t";

$resultMoyxCoef = mysqli_query($conn,$sumMoyxCoef);

while($row = mysqli_fetch_array($resultMoyxCoef)){
    $sommeMoyxCoef = $row[0];
}

$moy = $sommeMoyxCoef/$sommeCoef;
$appreciation = '';
if($moy<7.00){
    $appreciation = 'Très Faible';
}
if($moy>=7.00 && $moy<9.85){
    $appreciation = 'Insuffisant';
}
if($moy>=9.85 && $moy<11.85){
    $appreciation = 'Passable';
}
if($moy>=11.85 && $moy<13.85){
    $appreciation = 'Assez Bien';
}
if($moy>=13.85 && $moy<15.85){
    $appreciation = 'Bien';
}
if($moy>=15.85 && $moy<17.85){
    $appreciation = 'Très Bien';
}
if($moy>=17.85 && $moy<20.00){
    $appreciation = 'Excellent';
}


$pdf->AddPage();



$pdf->Table($conn,"SELECT m.libelle AS Disciplines , 
                                        CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2)) AS 'NCD.',
                                        ne.valeur AS 'Compo.', 
                                        CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) AS 'Moy.',
                                        cr.coef AS 'Coef.',
                                        CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2))*cr.coef AS 'MxC.',
                                        CASE
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) > 6 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 8 THEN 'Faible'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=8 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 10 THEN 'Insuffisant'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=10 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 11.75 THEN 'Passable'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=11.75 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 13.75 THEN 'Assez Bien'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=13.75 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 15.75 THEN 'Bien'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=15.75 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 17.75 THEN 'Très Bien'
                                            WHEN CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) >=17.75 AND CAST((CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2))+ne.valeur)/2 AS DECIMAL(18,2)) < 20.00 THEN 'Excellent'
                                            ELSE 'Très Faible'
                                        END AS 'Appreciation'
                                        FROM note nd, evaluation ed, note ne, evaluation ee, matiere m, classe c, cours cr
                                        WHERE ed.idEv=nd.evaluation AND ee.idEv=ne.evaluation 
                                        AND c.id=ed.classe AND c.id=ee.classe AND c.id='$cl'
                                        AND cr.classe=c.id AND cr.matiere=ee.idMatiere AND cr.matiere=ed.idMatiere
                                        AND m.id=ed.idMatiere AND m.id=ee.idMatiere 
                                        AND nd.evaluation=ed.idEv AND ne.evaluation=ee.idEv 
                                        AND nd.semestre='$sem' AND ne.semestre='$sem' 
                                        AND nd.eleve='$mat' AND ne.eleve='$mat' 
                                        AND nd.anneeAcad='$an' AND ne.anneeAcad='$an' 
                                        AND ed.typeEv='devoir' AND ee.typeEv='examen' 
                                      GROUP BY m.libelle
                                      ORDER BY m.id ASC");

$pdf->Ln(1);
$pdf->SetFont('Times','B',12);
$pdf->SetX(9); // abscissa or Horizontal position
$pdf->Cell(55,10,'Total Général :',1,1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(55,10,'','L',1,'C',false);
 // abscissa or Horizontal position
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(115);
$pdf->Cell(15,10,$sommeCoef,'RL',1,'C',false);
$pdf->Ln(-10);
$pdf->SetX(130);
$pdf->Cell(17,10,$sommeMoyxCoef,'R',1,'C',false);


$pdf->Ln(1);
$pdf->SetFont('Times','B',12);
$pdf->SetX(9); // abscissa or Horizontal position
$pdf->Cell(55,10,'Moyenne semestrielle :',1,1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(55,10,'','L',1,'C',false);
// abscissa or Horizontal position
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(9);
$pdf->Cell(193,10,'','RTB',1,'C',false);
//$pdf->SetY(-90);
$pdf->Ln(-10);
$pdf->SetX(120);
$pdf->Cell(20,10,number_format ( $moy,2 ),'',1,'C',false);
$pdf->Ln(-10);
$pdf->SetX(152);
$pdf->Cell(45,10,$appreciation,'',1,'C',false);

$pdf->SetY(-60); // Line gap
$pdf->SetFont('Times','B',10);
$pdf->SetX(12); // abscissa of Horizontal position
$pdf->SetFillColor(167,170,170);
$pdf->Cell(45,8,'Absence(s) = 0 heure(s)','LRTB','R',false, true);
$pdf->Ln(8);
$pdf->SetX(12);
$pdf->SetFillColor(167,170,170);
$pdf->Cell(45,8,'Retard(s) = 0 heure(s)','LRTB','R',false,true);

$pdf->Output();

?>