<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/MatiereDB.php';
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
    <div class="panel panel-info ">
        <div id="info"></div>
        <div id="action_alertm" title="Message"></div>
        <div class="panel-heading" align="center"><h2>Listes des matières</h2></div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
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
                    $matieres = listeMatiere();
                    while($result=mysqli_fetch_row($matieres))
                    {
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td><center><button type='button' class='btn btn-warning btn-xs edit_button' 
                                        data-toggle='modal' data-target='#myeditModal'
                                        data-libelle='$result[1]'
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
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouvelle matière</h4>
                <button type="button" id="closeaddmatiere" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/MatiereController.php">
                    <div class="form-group">
                        <label class="control-label">Libellé</label>
                        <input class="form-control" type="text" name="libm" id="libm" placeholder="Entrer le libellé"/>
                        <span id="err_libellem" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" id="validerm" name="validerm">Valider</button>
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
                <button type="button" id="closeeditmatiere" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Édition matière</h4>
            </div>
            <form method="post" action="../../controller/MatiereController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control matiere_id" type="hidden" name="matiere_id" required>
                        <label class="control-label">Libellé</label>
                        <input class="form-control matiere_libelle" name="libellem" placeholder="Entrer le libellé" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="enregistrerm">Enregistrer</button>
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
                <h4 class="modal-title" id="myModalLabel">Suppression matiere</h4>
            </div>
            <form method="post" action="../../controller/MatiereController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <h3>Voulez-vous vraiment supprimer?</h3>
                        <input class="form-control del_id" type="hidden" name="idm_del" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="supprimerm">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('info').style.display = 'none';

    $(document).on( "click", '.edit_button',function(e) {
        var id = $(this).data('id');
        var lib = $(this).data('libelle');

        $(".matiere_id").val(id);
        $(".matiere_libelle").val(lib);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

    /*$('#edit_matiere').on('submit', function () {
        event.preventDefault();
        //var count_data = 0;
        //alert($('#lib').val());
        var form_data = $(this).serialize();
        $.ajax({
            url: "controller/MatiereController.php",
            method: "POST",
            data: form_data,
            success: function(data) {
                //$('#edit_matiere')[0].reset();
                $('#closeeditmatiere').click();
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

    $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
    });

    /*$('#validerm').click(function () {
        //event.preventDefault();
        var err_libelle = '';
        var libelle = '';

        if($('#libm').val() == ''){
            err_libelle= 'Saisir le libellé';
            $('#err_libellem').text(err_libelle);
            $('#libm').css('border-color', '#cc0000');
            libelle = '';
        }else {
            err_libelle = '';
            $('#err_libellem').text(err_libelle);
            $('#libm').css('border-color', '');
            libelle = $('#libm').val();
        }

        if(err_libelle != ''){
            return false;
        }else {
            var form_data = $('#form_addmatiere').serialize();
            $.ajax({
                url: controller/MatiereController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#closeaddmatiere').click();
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
                error: function (e) {
                    console.log('ERREUR : ' + e);
                }
            });
        }

    });*/


</script>


</body>
</html>
