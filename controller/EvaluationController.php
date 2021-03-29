<?php

require_once '../model/DB.php';
require_once '../model/EvaluationDB.php';
require_once "../public/web/rooting.php";

    if(isset($_POST['valider']))
    {
        $ok = addEvaluation($_POST['libelleEval'],$_POST['typeEval'],$_POST['semEval'],$_POST['anAc'],$_POST['idCl'],$_POST['matiereEval']);
        $classe = $_POST['idCl'];
        $sem = $_POST['semEval'];
        header("location:../../view/evaluation/eval_classe.php?idcl=$classe&sem=$sem&resultA=$ok");
    }

    if(isset($_POST['enregistrer']))
    {
        $ok = updateEvalution($_POST['id'],$_POST['libelle'],$_POST['typeeval'],$_POST['semEval'],$_POST['annee'],$_POST['classe'],$_POST['matiereEval']);
        $classe = $_POST['classe'];
        $sem = $_POST['semEval'];
        header("location:../../view/evaluation/eval_classe.php?idcl=$classe&sem=$sem&resultE=$ok");
    }

    if(isset($_POST['supprimer']))
    {
        $ok = deleteClasse($_POST['id']);
        header("location:..?page=classe&resultS=$ok");
    }

    if(isset($_GET['idc']))
    {
        $ok = getClasseById($_GET['idc']);
        $ok = mysqli_fetch_row($ok);
        echo json_encode($ok);
    }

    if(isset($_POST['supprimer']))
    {
        $ok = deleteEvaluation($_POST['id']);
        header("location:..?page=evalclasse&resultS=$ok");
    }

    if(isset($_GET['classe_id']) && isset($_GET['anneeAc']) && isset($_GET['sem']))
    {
        $conn = getConnection();
        $idcl = $_GET['classe_id'];
        $ann = $_GET['anneeAc'];
        $sem = $_GET['sem'];

        $query = "SELECT * FROM evaluation e, classe c, matiere m
                  WHERE e.classe=c.id AND c.id='$idcl' AND e.semestre='$sem' AND e.idMatiere=m.id AND e.anneeAcad='$ann'
                  ORDER BY e.libelleEv ASC";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $col = 'text-align:center;';
            $statut = '';
            if($res[7]==0){
                $statut = 'non-corrigée';
            }else{
                $statut = 'corrigée';
            }
            if ($statut=='non-corrigée'){
                $col = 'text-align:center; background: #f17421; color:#fff';
            }
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '<td style="text-align:center;">'.$res[13].'</td>';
            $output .= '<td><center><button type="button" class="btn btn-info btn-xs edit_button" 
                                        data-toggle="modal" data-target="#myeditModal"
                                        data-lib="'.$res[1].'"
                                        data-typeeval="'.$res[2].'"
                                        data-idmat="'.$res[6].'"
                                        data-libmat="'.$res[13].'"
                                        data-sem="'.$res[3].'"
                                        data-classe="'.$res[5].'"
                                        data-annee="'.$res[4].'"
                                        data-id="'.$res[0].'">
                                        Éditer
                                    </button>
                                    </center>
                                </td>';
            $output .= '<td><center><button type="button" class="btn btn-success btn-xs del_button" 
                                        data-toggle="modal" data-target="#mynoteModal"
                                        data-lib="'.$res[1].'"
                                        data-typeeval="'.$res[2].'"
                                        data-idmat="'.$res[6].'"
                                        data-libmat="'.$res[13].'"
                                        data-sem="'.$res[3].'"
                                        data-classe="'.$res[5].'"
                                        data-annee="'.$res[4].'"
                                        data-id="'.$res[0].'">
                                        Noter évaluation
                                    </button>
                                    </center>
                                </td>';
            $output .= '<td><center><button type="button" class="btn btn-warning btn-xs lesnotes_button" 
                                        data-toggle="modal" data-target="#lesnotesModal"
                                        data-semnote="'.$res[3].'"
                                        data-classenote="'.$res[5].'"
                                        data-anneenote="'.$res[4].'"
                                        data-ideval="'.$res[0].'">
                                            Voir notes
                                    </button>
                                    </center>
                                </td>';
            $output .= '<td><center><button type="button" class="btn btn-danger btn-xs del_button" 
                                        data-toggle="modal" data-target="#mydelModal"
                                        data-id="'.$res[0].'">
                                        Supprimer
                                    </button>
                                    </center>
                                </td>';
            $output .= '<td style="'.$col.'">'.$statut.'</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    if(isset($_GET['idcl_note']) && isset($_GET['anneeAc_note']) && isset($_GET['idEval']) && isset($_GET['sem']))
    {
        $conn = getConnection();
        $idcl = $_GET['idcl_note'];
        $ann = $_GET['anneeAc_note'];
        $eval = $_GET['idEval'];
        $sem = $_GET['sem'];

        $query = "SELECT * FROM eleve e, classe c, inscription i
                      WHERE e.mat=i.eleve AND i.classe=c.id AND c.id='$idcl' AND i.anneeAcad='$ann'
                      ORDER BY e.nom ASC";

        $result = mysqli_query($conn,$query);
        $count = 0;
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $count=$count+1;
            $output .= '<tr id="row_'.$count.'">';
            $output .= '<td style="text-align:center;">'.$res[0].'<input type="hidden" name="hidden_eleve[]" id="eleve'.$count.'" class="eleve" value="'.$res[0].'"/></td>';
            $output .= '<td style="text-align:center;">'.$res[1].'<input type="hidden" name="hidden_nom[]" id="nom'.$count.'" value="'.$res[1].'"/><input type="hidden" name="hidden_annee[]" id="annee'.$count.'" value="'.$ann.'"/><input type="hidden" name="hidden_sem[]" id="sem'.$count.'" value="'.$sem.'"/><input type="hidden" name="hidden_eval[]" id="eval'.$count.'" value="'.$eval.'"/></td>';
            $output .= '<td style="text-align:center;">'.$res[2].'<input type="hidden" name="hidden_prenom[]" id="prenom'.$count.'" value="'.$res[2].'"/></td>';
            $output .= '<td style="text-align:center;">'.$res[3].'<input type="hidden" name="hidden_datenaiss[]" id="datenaiss'.$count.'" value="'.$res[3].'"/></td>';
            $output .= '<td style="text-align:center;">'.$res[4].'<input type="hidden" name="hidden_genre[]" id="genre'.$count.'" value="'.$res[7].'"/></td>';
            $output .= '<td><center><input class="form-control" name="hidden_note[]" id="note'.$count.'" style="max-width: 90px;" type="text"></center></td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    if(isset($_GET['ideval_note']) && isset($_GET['anneeAcad_note']) && isset($_GET['sem_note']) && isset($_GET['idcl_note']))
    {
        $conn = getConnection();
        $ideval = $_GET['ideval_note'];
        $idcl = $_GET['idcl_note'];
        $ann = $_GET['anneeAcad_note'];
        $sem = $_GET['sem_note'];

        $query = "SELECT * 
                  FROM eleve e, evaluation ev, note n
                  WHERE e.mat=n.eleve AND n.evaluation=ev.idEv 
                                      AND ev.idEv='$ideval' AND n.anneeAcad='$ann' AND n.semestre='$sem'
                  ORDER BY e.nom ASC";

        $result = mysqli_query($conn,$query);
        $count = 0;
        $output = '';
        while($res=mysqli_fetch_row($result))
        {
            $count=$count+1;
            $output .= '<tr id="row_'.$count.'">';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '<td style="text-align:center;">'.$res[3].'</td>';
            $output .= '<td style="text-align:center;">'.$res[4].'</td>';
            $output .= '<td style="text-align:center;">'.$res[14].'</td>';
            $output .= '</tr>';
        }
        echo $output;
    }


if(isset($_POST['annee']) && isset($_POST['classe'])){
        $conn = getConnection();
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
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[3].'</td>';
            $output .= '<td style="text-align:center;">'.$res[4].'</td>';
            $output .= '<td style="text-align:center;">'.$res[7].'</td>';
            $output .= '</tr>';
        }
        echo $output;
    }