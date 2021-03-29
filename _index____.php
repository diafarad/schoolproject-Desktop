<?php

require_once "public/web/rooting.php";
require_once "public/web/menu.php";

require_once "model/DB.php";
require_once "model/ClasseDB.php";
require_once "model/ProfesseurDB.php";
require_once "model/MatiereDB.php";
require_once "model/EvaluationDB.php";
require_once "model/StatsDB.php";


if(isset($_GET['page']))
{
    switch ($_GET['page'])
    {
        case 'accueil':
            $nbreClasses = @getNombreClasse();
            $nbreEleves = @getNombreEleve();
            $nbreProfs = @getNombreProf();
            $nbreGarcons = @getNombreGarcon();
            $nbreFilles = @getNombreFille();
            $revenu = @getRevenu();
            $nbreClasses = mysqli_fetch_row($nbreClasses);
            $nbreEleves = mysqli_fetch_row($nbreEleves);
            $nbreProfs = mysqli_fetch_row($nbreProfs);
            $nbreGarcons = mysqli_fetch_row($nbreGarcons);
            $nbreFilles = mysqli_fetch_row($nbreFilles);
            $revenu = mysqli_fetch_row($revenu);
            require_once "view/accueil/index.php";
            break;
        case 'classe':
            $classes = listeClasse();
            require_once "view/classe/index.php";
            break;
        case 'inscription':
            require_once "view/inscription/index.php";
            break;
        case 'reinscription':
            require_once "view/inscription/reinscription.php";
            break;
        case 'eleve':
            require_once "view/eleve/index.php";
            break;
        case 'professeur':
            $professeurs = listeProfesseur();
            require_once "view/professeur/index.php";
            break;
        case 'cours':
            $classes = listeClasse();
            require_once "view/cours/index.php";
            break;
        case 'matiere':
            $matieres = listeMatiere();
            require_once "view/matiere/index.php";
            break;
        case 'note':
            require_once "view/note/index.php";
            break;
        case 'statistique':
            require_once "view/statistique/index.php";
            break;
        case 'evaluation':
            $anneeencours = getAnneeEnCours();
            $semestreencours = getSemestreEnCours();
            $classes = listeClasse();
            require_once "view/evaluation/index.php";
            break;
        case 'evalclasse':
            $anneeencours = getAnneeEnCours();
            $semestreencours = getSemestreEnCours();
            $classe = $_GET['idcl'];
            $evaluations = getEvaluationByClasse($classe,$anneeencours,$semestreencours);
            require_once "view/evaluation/eval_classe.php";
            break;
        default:
            header("location:".base_url());
            break;
    }
}
?>
