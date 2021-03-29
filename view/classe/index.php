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
        <div id="info"></div>
        <div class="panel-heading" align="center"><h2>Listes des classes</h2></div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
                    <th style='text-align:center;'>Montant Inscription</th>
                    <th style='text-align:center;'>Mensualité</th>
                    <th style="text-align: center">Action </th>
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
                    $classes = listeClasse();
                    while($result=mysqli_fetch_row($classes))
                    {
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td style='text-align:center;'>$result[2]</td>
                                <td style='text-align:center;'>$result[3]</td>
                                <td><center><button type='button' class='btn btn-info btn-xs details_classe' 
                                        data-toggle='modal' data-target='#mydetailModal'
                                        data-id='$result[0]'
                                        data-lib='$result[1]'>
                                        Détails
                                    </button></center></td>
                                <td><center><button type='button' class='btn btn-warning btn-xs edit_button' 
                                        data-toggle='modal' data-target='#myeditModal'
                                        data-libelle='$result[1]'
                                        data-montantins='$result[2]'
                                        data-montantmens='$result[3]'
                                        data-id='$result[0]'>
                                        Éditer
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
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
                    <th style='text-align:center;'>Montant Inscription</th>
                    <th style='text-align:center;'>Mensualité</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouvelle Classe</h4>
                <button type="button" class="close" id="clok" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/ClasseController.php">
                    <div class="form-group">
                        <label class="control-label">Libellé</label>
                        <input class="form-control" type="text" name="lib" id="lib" placeholder="Entrer le libellé"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Montant Inscription</label>
                        <input class="form-control" type="text" name="mont" id="mont" placeholder="Entrer le montant d'inscription"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mensualité</label>
                        <input class="form-control" type="text" name="mens" id="mens" placeholder="Entrer le montant de la mensualité"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="valider" value="Ajouter"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit button -->
<div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="edok" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Édition classe</h4>
            </div>
            <form method="post" action="../../controller/ClasseController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control classe_id" type="hidden" name="edit_id" required>
                        <label class="control-label">Libellé</label>
                        <input class="form-control classe_libelle" name="edit_libelle" placeholder="Entrer le libellé" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Montant Inscription</label>
                        <input class="form-control classe_montantIns" type="text" name="edit_montantIns" placeholder="Entrer le montant d'inscrption" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mensualité</label>
                        <input class="form-control classe_montantMens" type="text" name="edit_montantMens" placeholder="Entrer le montant de la mensualité" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->

<div class="modal fade" id="mydelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Suppression classe</h4>
            </div>
            <form method="post" action="../../controller/ClasseController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <h3>Voulez-vous vraiment supprimer?</h3>
                        <input class="form-control del_id" type="hidden" name="id_del" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="supprimer">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mydetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><center> Liste des élèves de la <span id="libcl"></span></center></h4>
            </div>
            <center>
            <table id="resultClasse" class="table table-bordered table-striped" style="width:auto;">
                <thead>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre </th>
                </tr>
                </tfoot>
            </table>
            </center>
        </div>
    </div>
</div>


<script>
    document.getElementById('info').style.display = 'none';
    //$('#clok').click();
    /*$('#addClasse').on('submit', function () {
        event.preventDefault();
        //var count_data = 0;
        //alert($('#lib').val());
        var form_data = $(this).serialize();
        $.ajax({
            url: "controller/ClasseController.php",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#addClasse')[0].reset();
                $('#clok').click();
                //$('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                document.getElementById('info').style.display = 'block';
                $('#info').html(data);
                window.setTimeout(function() {
                    $(".alert").fadeTo(700, 0).slideUp(700, function(){
                        $(this).remove();
                    });
                }, 2000);
            },
            error: function(data){
                console.log('ERREUR : ' + data);
            }
        });
    });*/

    $(document).on( "click", '.edit_button',function(e) {
        var id = $(this).data('id');
        var lib = $(this).data('libelle');
        var montantIns = $(this).data('montantins');
        var montantMens = $(this).data('montantmens');

        $(".classe_id").val(id);
        $(".classe_libelle").val(lib);
        $(".classe_montantIns").val(montantIns);
        $(".classe_montantMens").val(montantMens);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

    /*$('#editClasse').on('submit', function () {
        event.preventDefault();
        //var count_data = 0;
        //alert($('#lib').val());
        var form_data = $(this).serialize();
        $.ajax({
            url: "controller/ClasseController.php",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#editClasse')[0].reset();
                $('#edok').click();
                //$('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                document.getElementById('info').style.display = 'block';
                $('#info').html(data);
                window.setTimeout(function() {
                    $(".alert").fadeTo(700, 0).slideUp(700, function(){
                        $(this).remove();
                    });
                }, 2000);
            },
            error: function(data){
                console.log('ERREUR : ' + data);
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
            url: "../../controller/ClasseController.php?classe_id="+id,
            dataType: "text",
            success: function (data) {
                $('#resultClasse > tbody').empty();
                if(data){
                    $('#resultClasse').append(data);
                }
                else {
                    $('#resultClasse').append("<tr><td colspan='6'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                showModalDialog("PAS BON");
            }
        });
    });

    $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
    });

</script>


</body>
</html>
