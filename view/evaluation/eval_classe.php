<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/EvaluationDB.php';
$anneeencours = getAnneeEnCours();
$semestreencours = '';
if(isset($_GET['sem'])){
    $semestreencours = $_GET['sem'];
}
else{
    $semestreencours = getSemestreEnCours();
}
$classe = $_GET['idcl'];
$evaluations = getEvaluationByClasse($classe,$anneeencours,$semestreencours);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evaluation</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.css"/>
    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/dataTables.semanticui.min.js"></script>
    <script src="../../public/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "language": {
                    "lengthMenu": "Afficher _MENU_ lignes",
                    "zeroRecords": "Pas de correspondance",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun enregistrement disponible",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Suiv.",
                        "previous":   "Préc."
                    },
                    "search":         "Rechercher:"
                },
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Tout"]]
            } );
        } );
    </script>
    <style>
        .ui.stackable.grid{
            margin-left: 15px !important;
        }
    </style>
</head>
<body>

<div>
    <div class="modal-dialog" style="width: 900px">
        <div class="modal-content" style="width: 900px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><center> Liste des évaluations</center></h4>
            </div>
            <form class="form-inline" style="margin-top: 15px; margin-bottom: 15px">
                <center>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>Année académique</label>
                        </div>
                        <div class="form-group">
                            <input style="width: 100px" class="form-control" type="text" id="anneeAc" name="anneeAc" value="<?php echo $anneeencours;?>" >
                            <input style="width: 100px" class="form-control" type="hidden" id="classe" name="classe" value="<?php echo $classe;?>" >
                        </div>

                        <div class="form-group">
                            <label>Semestre</label>
                        </div>
                        <div class="form-group">
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="semestre" id="semestre">
                                <option value="" ></option>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                            </select>
                        </div>
                    </div>
                </center>
            </form>
            <center>
                <table id="resultEval" class="table table-bordered table-striped" style="width:auto; margin-bottom: 10px">
                    <thead>
                    <tr>
                        <th style='text-align:center;'>Libellé</th>
                        <th style='text-align:center;'>Type</th>
                        <th style='text-align:center;'>Matière</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div id="action_alert"></div>
                    <div id="alarmmsg"></div>
                    <?php                  
                    if(isset($_GET['resultA']))
                    {
                        if($_GET['resultA'] == 1)
                        {
                    ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-success'> Données ajoutées</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                        else
                        {
                        ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-warning'> Une petite erreur s'est produite</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                    }

                    if(isset($_GET['resultE']))
                    {
                        if($_GET['resultE'] == 1)
                        {
                            ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-success'> Données modifiées</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                        else
                        {
                            ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-warning'> Erreur de code</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                    }

                    if(isset($_GET['resultS']))
                    {
                        if($_GET['resultS'] == 1)
                        {
                            ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-success'> Données supprimées</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                        else
                        {
                            ?>
                        <script>
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-warning'> Erreur de code</div>";

                            setTimeout(function(){
                                document.getElementById("alarmmsg").innerHTML = '';
                            }, 3000);
                        </script>
                        <?php
                        }
                    }

                    while($result=mysqli_fetch_row($evaluations))
                    {
                        $col = 'text-align:center;';
                        $statut = '';
                        if($result[7]==0){
                            $statut = 'non-corrigée';
                        }else{
                            $statut = 'corrigée';
                        }
                        if ($statut=='non-corrigée'){
                            $col = 'text-align:center; background: #f17421; color:#fff';
                        }
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td style='text-align:center;'>$result[2]</td>
                                <td style='text-align:center;'>$result[13]</td>
                                <td><center><button type='button' class='btn btn-info btn-xs edit_button' 
                                        data-toggle='modal' data-target='#myeditModal'
                                        data-lib='$result[1]'
                                        data-typeeval='$result[2]'
                                        data-idmat='$result[6]'
                                        data-libmat='$result[13]'
                                        data-sem='$result[3]'
                                        data-classe='$result[5]'
                                        data-annee='$result[4]'
                                        data-id='$result[0]'>
                                        Éditer
                                    </button>
                                    </center>
                                </td> 
                                <td><center><button type='button' class='btn btn-success btn-xs addnote_button' 
                                        data-toggle='modal' data-target='#mynoteModal'
                                        data-lib='$result[1]'
                                        data-typeeval='$result[2]'
                                        data-idmat='$result[6]'
                                        data-libmat='$result[13]'
                                        data-sem='$result[3]'
                                        data-classe='$result[5]'
                                        data-annee='$result[4]'
                                        data-id='$result[0]'>
                                        Noter évaluation
                                    </button>
                                    </center>
                                </td> 
                                <td><center><button type='button' class='btn btn-warning btn-xs lesnotes_button' 
                                        data-toggle='modal' data-target='#lesnotesModal'
                                        data-semnote='$result[3]'
                                        data-classenote='$result[5]'
                                        data-anneenote='$result[4]'
                                        data-ideval='$result[0]'>
                                        Voir notes
                                    </button>
                                    </center>
                                </td> 
                                <td><center><button type='button' class='btn btn-danger btn-xs del_button' 
                                        data-toggle='modal' data-target='#mydelModal'
                                        data-id='$result[0]'>
                                        Supprimer
                                    </button>
                                    </center>
                                </td>
                                <td style='$col'>$statut</td>
                            </tr>
                            ";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style='text-align:center;'>Libellé</th>
                        <th style='text-align:center;'>Type</th>
                        <th style='text-align:center;'>Matière</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Action</th>
                        <th style='text-align:center;'>Statut</th>
                    </tr>
                    </tfoot>
                </table>
            </center>
        </div>
    </div>
</div>

<div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Édition évaluation</h4>
            </div>
            <form method="post" action="../../controller/EvaluationController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control eval_id" type="hidden" name="id" required>
                        <input class="form-control eval_classe" type="hidden" name="classe" required>
                        <input class="form-control eval_annee" type="hidden" name="annee" required>
                        <label class="control-label">Libellé</label>
                        <input class="form-control eval_libelle" name="libelle" placeholder="Entrer le libellé" required>
                    </div>
                    <div class="form-group">
                        <label for="heading">Matière</label>
                        <select class="form-control eval_mat" id="matiereEval" name="matiereEval">
                            <option value="" > <?php echo "Sélectionner la matière";?> </option>
                            <?php
                            include_once "../../model/DB.php";
                            include_once "../../model/MatiereDB.php";
                            $list = listeMatiere();
                            while($row = mysqli_fetch_row($list)){
                                ?>
                                <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                            <?php } ?>
                        </select>
                        <span id="err_matiere" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="heading">Type</label>
                        <select class='selectpicker show-menu-arrow form-control eval_type' type="text" name="typeeval" id="typeeval">
                            <option value="devoir">Devoir</option>
                            <option value="examen">Examen</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semestre</label>
                        <select class='selectpicker show-menu-arrow form-control eval_sem' type="text" name="semEval" id="semEval">
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mynoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1005px;">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Noter évaluation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="list_notes">
                    <div title="Liste élèves">
                        <div class="panel-heading" align="center"><h5><b>Liste des élèves</b></h5></div>
                        <div id="action_alert"></div>
                        <table class="table table-bordered table-striped" id="lesnotes">
                            <thead>
                            <tr>
                                <th style="text-align: center">Matricule</th>
                                <th style="text-align: center">Nom</th>
                                <th style="text-align: center">Date Naiss</th>
                                <th style="text-align: center">Lieu</th>
                                <th style="text-align: center">Genre</th>
                                <th style="text-align: center">Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" name="valider" value="Valider"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lesnotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1005px;">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Notes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="list_notes">
                    <div title="Liste élèves">
                        <div class="panel-heading" align="center"><h5><b>Liste des notes</b></h5></div>
                        <div id="action_alert"></div>
                        <table class="table table-bordered table-striped" id="listnotes">
                            <thead>
                            <tr>
                                <th style="text-align: center">Matricule</th>
                                <th style="text-align: center">Nom</th>
                                <th style="text-align: center">Date Naiss</th>
                                <th style="text-align: center">Lieu Naiss</th>
                                <th style="text-align: center">Genre</th>
                                <th style="text-align: center">Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mydelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Suppression évaluation</h4>
            </div>
            <form method="post" action="../../controller/EvaluationController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <h3>Voulez-vous vraiment supprimer?</h3>
                        <input class="form-control del_id" type="hidden" name="id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="supprimer">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#list_notes').on('submit', function () {
            event.preventDefault();
            var count_data = 0;
            $('.eleve').each(function () {
                count_data = count_data + 1;
            });
            if(count_data > 0){
                var form_data = $(this).serialize();
                $.ajax({
                    url: "../../controller/NoteController.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#mynoteModal').modal().hide();
                        $('.modal-backdrop').remove();
                        $('#action_alert').html('<center><p style="color: green">Notes enregistrées avec succés</p></center>');
                        $('#action_alert').dialog({
                            modal: true,
                            title: "Attribution de notes",
                            width: 300,
                            height: 100
                        });
                    }
                });
            }
        });
    });

    $(document).on( "click", '.addnote_button',function(e) {
        var id = $(this).data('classe');
        var anneeEncours = $(this).data('annee');
        var idEv = $(this).data('id');
        var sem = $(this).data('sem');
        //alert('ID_CLASSE : '+id+' ANN : '+ anneeEncours+ ' SEM : '+semestreEncours);
        $('#lesnotes > tbody').empty();
        $.ajax({
            url: "../../controller/EvaluationController.php?idcl_note="+id+"&anneeAc_note="+anneeEncours+"&idEval="+idEv+"&sem="+sem,
            dataType: "text",
            success: function (data) {
                $('#lesnotes > tbody').empty();
                if(data){
                    $('#lesnotes').append(data);
                }
                else {
                    $('#lesnotes').append("<tr><td colspan='6'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                showModalDialog("PAS BON");
            }
        });
    });

    $(document).on( "click", '.lesnotes_button',function(e) {
        var idev = $(this).data('ideval');
        var cl = $(this).data('classenote');
        var anEncours = $(this).data('anneenote');
        var sem = $(this).data('semnote');
        //alert('ID_CLASSE : '+id+' ANN : '+ anneeEncours+ ' SEM : '+semestreEncours);
        $('#listnotes > tbody').empty();
        $.ajax({
            url: "../../controller/EvaluationController.php?ideval_note="+idev+"&anneeAcad_note="+anEncours+"&sem_note="+sem+"&idcl_note="+cl,
            dataType: "text",
            success: function (data) {
                $('#listnotes > tbody').empty();
                if(data){
                    $('#listnotes').append(data);
                }
                else {
                    $('#listnotes').append("<tr><td colspan='6'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                showModalDialog("PAS BON");
            }
        });
    });

    $(document).on( "click", '.edit_button',function(e) {

        var id = $(this).data('id');
        var lib = $(this).data('lib');
        var typeeval = $(this).data('typeeval');
        var matiereid = $(this).data('idmat');
        var sem = $(this).data('sem');
        var classe = $(this).data('classe');
        var annee = $(this).data('annee');

        $(".eval_id").val(id);
        $(".eval_libelle").val(lib);
        $(".eval_mat").val(matiereid);
        $(".eval_type").val(typeeval);
        $(".eval_sem").val(sem);
        $(".eval_classe").val(classe);
        $(".eval_annee").val(annee);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

    $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
    });

    $(document).on( "change", '#semestre',function(e) {
        var id = $('#classe').val();
        var anneeAc = $('#anneeAc').val();
        var semestre = $('#semestre').val();
        //alert('ID_CLASSE : '+id+' ANN : '+ anneeAc+ ' SEM : '+semestre);
        $('#classe').val(id);
        var lib = $(this).data('lib');
        $("#libcl").text(lib);
        $('#resultEval > tbody').empty();
        $.ajax({
            url: "../../controller/EvaluationController.php?classe_id="+id+"&anneeAc="+anneeAc+"&sem="+semestre,
            dataType: "text",
            success: function (data) {
                $('#resultEval > tbody').empty();
                if(data){
                    $('#resultEval').append(data);
                }
                else {
                    $('#resultEval').append("<tr><td colspan='6'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                showModalDialog("PAS BON");
            }
        });
    });

</script>

</body>
</html>