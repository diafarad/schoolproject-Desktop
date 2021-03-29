<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/ClasseDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classe</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
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

<div class="container" style="margin-top: 50px">
    <div class="panel panel-info ">
        <div class="panel-heading" align="center"><h2>Liste des classes</h2></div>
        <div class="panel-body">
            <table id="example" class="ui celled table" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Classe</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </thead>
                <tbody>
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
                    $anneeencours = getAnneeEnCours();
                    $semestreencours = getSemestreEnCours();
                    $classes = listeClasse();
                    while($result=mysqli_fetch_row($classes))
                    {
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td><center><button type='button' class='btn btn-info btn-xs addeval_button' 
                                        data-toggle='modal' data-target='#myaddEvModal'
                                        data-anneeencours='$anneeencours'
                                        data-id='$result[0]'>
                                        Ajouter évaluation
                                    </button>
                                    </center>
                                </td>
                                <td><center><a href='./eval_classe.php?idcl=".$result[0]."' class='btn btn-warning btn-xs'>
                                        Voir les évaluations
                                    </a></center>
                                </td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Edit button -->
<div class="modal fade" id="myaddEvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout Évalution</h4>
            </div>
            <form method="post" action="../../controller/EvaluationController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Libellé</label>
                        <input class="form-control" name="libelleEval" placeholder="Entrer le libellé" required>
                        <input class="form-control classe_eval" type="hidden" name="idCl" required>
                        <input class="form-control annee_eval" type="hidden" name="anAc" required>
                    </div>
                    <div class="form-group">
                        <label for="heading">Matière</label>
                        <select class="form-control" id="matiereEval" name="matiereEval">
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
                        
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Type Évaluation</label>
                                <select class='selectpicker show-menu-arrow form-control' type="text" name="typeEval" id="typeEval">
                                    <option value="devoir">Devoir</option>
                                    <option value="examen">Examen</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Semestre</label>
                                <select class='selectpicker show-menu-arrow form-control' type="text" name="semEval" id="semEval">
                                    <option value="" >Sélectionner le semestre</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="valider">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->


<script>

    $(document).on( "click", '.addeval_button',function(e) {
        var id = $(this).data('id');
        var anneeAc = $(this).data('anneeencours');

        $(".classe_eval").val(id);
        $(".annee_eval").val(anneeAc);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

</script>


</body>
</html>
