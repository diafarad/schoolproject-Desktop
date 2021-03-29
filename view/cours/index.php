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

<div class="container" style="margin-top: 50px; max-width: 750px">
    <div id="action_alert" title="Message"></div>
    <div class="panel panel-info ">
        <div class="panel-heading" align="center"><h2>Classes</h2></div>
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
                            document.getElementById("alarmmsg").innerHTML = "<div class='alert alert-success'> Cour ajouté</div>";

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
                $classes = listeClasse();
                while($result=mysqli_fetch_row($classes))
                {
                    echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td><center><button type='button' class='btn btn-primary btn-xs add_cours_classe' 
                                        data-toggle='modal' data-target='#myaddModal'
                                        data-idcl='$result[0]'
                                        data-libcl='$result[1]'>
                                        Ajouter
                                    </button></center>
                                </td>
                                <td><center><button type='button' class='btn btn-success btn-xs details_classe' 
                                        data-toggle='modal' data-target='#mydetailModal'
                                        data-id='$result[0]'
                                        data-lib='$result[1]'>
                                        Détails
                                    </button></center>
                                </td>
                            </tr>
                            ";
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Classe</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myaddModal" tabindex="-1" role="dialog" aria-labelledby="myaddModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouveau cours
                    <center><label class="control-label" style="font-style: oblique">Classe : <label class="badge" id="reslibCl"></label> </label></center>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/CoursController.php">
                        <div class="form-group">
                            <label class="control-label">Matière</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="matiere" id="matiere">
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
                            <label class="control-label">Professeur</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="professeur" id="professeur">
                                <option value="" > <?php echo "Sélectionner le professeur";?> </option>
                                <?php
                                include_once "../../model/DB.php";
                                include_once "../../model/ProfesseurDB.php";
                                $list = listeProfesseur();
                                while($row = mysqli_fetch_row($list)){
                                    ?>
                                    <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                                <?php } ?>
                            </select>
                            <span id="err_prof" class="text-danger"></span>
                        </div>

                        <div class="form-group ">
                            <label class="control-label">Coefficient</label>
                            <input class="form-control" type="hidden" name="classeid" id="classeid" />
                            <input class="form-control" type="text" name="coef" id="coef" placeholder="Entrer le coefficient"/>
                            <span id="err_coef" class="text-danger"></span>
                        </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" id="addcours" name="addcours" value="Ajouter"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mydetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><center> Cours de la <span id="libcl"></span></center></h4>
            </div>
            <form class="form-inline" style="margin-top: 15px; margin-bottom: 15px">
                <center>
                    <div class="form-group">
                        <label class="sr-only">Année académique</label>
                        <input type="text"  class="form-control" id="annee" placeholder="<?php echo ''.getAnneeEnCours(); ?>">
                        <input type="hidden"  class="form-control" id="classeinput" >
                    </div>
                    <button type="button" class="btn btn-primary" id="lancer" name="lancer">Lancer</button>
                </center>
            </form>
            <center>
                <table id="resultCours" class="table table-bordered table-striped" style="margin-left: 15px; width: auto; margin-right: 15px">
                    <thead>
                    <tr>
                        <th style='text-align:center;'>Matière</th>
                        <th style='text-align:center;'>Coefficient</th>
                        <th style='text-align:center;'>Professeur</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style='text-align:center;'>Matière</th>
                        <th style='text-align:center;'>Coefficient</th>
                        <th style='text-align:center;'>Professeur</th>
                    </tr>
                    </tfoot>
                </table>
            </center>
        </div>
    </div>
</div>

<script>

    $(document).on( "click", '.add_cours_classe',function(e) {
        var id = $(this).data('idcl');
        var lib = $(this).data('libcl');

        $("#reslibCl").text(lib);
        $('#classeid').val(id);

        //tinyMCE.get('business_skill_content').setContent(content);
    });

    /*$('#form_addcours').on('submit', function () {
        event.preventDefault();
        var mat = $('#matiere').val();
        var coef = $('#coef').val();
        var prof = $('#professeur').val();
        var classe = $('#classeid').val();

        //alert('Matiere : '+mat+' Coef : '+coef+' Prof : '+prof+' Classe : '+classe);
        $.ajax({
            url: controller/CoursController.php",
            method: "POST",
            data: {
                mat : mat,
                coef : coef,
                prof : prof,
                classe : classe
            },
            success: function(data) {
                    $('#myaddModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#action_alert').html('<center><div class="alert alert-success">Cours ajouté</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
            },
            error : function () {
                $('#myaddModal').modal('hide');
                $('.modal-backdrop').remove();
                $('#action_alert').html('<center><div class="alert alert-danger">Erreur ajout</div></center>');
                $("#action_alert").dialog({
                    modal: true,
                    open: function(event, ui){
                        setTimeout("$('#action_alert').dialog('close')",3000);
                    }
                });
            }
        });
    });*/


    $(document).on( "click", '.details_classe',function(e) {
        var id = $(this).data('id');
        $('#classeinput').val(id);
        var lib = $(this).data('lib');
        $("#libcl").text(lib);
        $('#annee').val('');
        $('#resultClasse > tbody').empty();
        $.ajax({
            url: "../../controller/CoursController.php?classe_id="+id,
            dataType: "text",
            success: function (data) {
                $('#resultCours > tbody').empty();
                if(data){
                    $('#resultCours').append(data);
                }
                else {
                    $('#resultCours').append("<tr><td colspan='3'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                showModalDialog("PAS BON");
            }
        });
    });

    $(document).ready(function () {
        $('#lancer').click(function () {
            $.ajax({
                url: "../../controller/CoursController.php",
                method: "POST",
                data: {
                    annee : $('#annee').val(),
                    classe : $('#classeinput').val()
                },
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#resultCours > tbody').empty();
                    if(data){
                        $('#resultCours').append(data);
                    }
                    else {
                        $('#resultCours').append("<tr><td colspan='6'><center>Pas de résultat disponible !</center></td></tr>");
                    }
                },
                error: function (e) {
                    $('#action_alert').html('<center><div class="alert alert-danger"> Une petite erreur est survenue</div></center>');
                    $('#action_alert').dialog();
                }
            });
        });
    });

</script>


</body>
</html>
