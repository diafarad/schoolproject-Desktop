<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/ProfesseurDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Professeur</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="../../public/js/bootstrap-3.4.0.min.js"></script>
    <script src="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/dataTables.semanticui.min.js"></script>
    <script src="../../public/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
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
            });
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
    <div id="action_alert" title="Message"></div>
    <div class="panel panel-info ">
        <div class="panel-heading" align="center"><h2>Listes des professeurs</h2></div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Nom complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
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
                    $professeurs = listeProfesseur();
                    while($result=mysqli_fetch_row($professeurs))
                    {
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td style='text-align:center;'>$result[2]</td>
                                <td style='text-align:center;'>$result[3]</td>
                                <td style='text-align:center;'>$result[4]</td>
                                <td><center><button type='button' class='btn btn-info btn-xs details_classe' 
                                        data-toggle='modal' data-target='#mydetailModal'
                                        data-id='$result[0]'
                                        data-lib='$result[1]'>
                                        Détails
                                    </button></center></td>
                                <td><center><button type='button' class='btn btn-warning btn-xs edit_button' 
                                        data-toggle='modal' data-target='#myeditModal'
                                        data-nom='$result[1]'
                                        data-date='$result[2]'
                                        data-lieu='$result[3]'
                                        data-genre='$result[4]'
                                        data-mat='$result[0]'>
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
                    <th style='text-align:center;'>Nom complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
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
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouveau Professeur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/ProfesseurController.php">
                        <div class="form-group">
                            <label class="control-label">Nom complet</label>
                            <input type="text" class="form-control" id="nomp" name="nomp" placeholder="Entrer le nom complet">
                            <span id="err_nom" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Date de naissance</label>
                            <input type="date" class="form-control" id="date" name="datep" placeholder="Sélectionner la date">
                            <span id="err_date" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lieu de naissance</label>
                            <input type="text" class="form-control" id="lieu" name="lieup" placeholder="Entrer le lieu de naissance">
                            <span id="err_lieu" class="text-danger"></span>
                        </div>
                        <div class="form-check form-check-inline" style="margin-left: 15px; margin-right: 15px">
                            <label class="control-label">Sexe :</label>
                            <input class="form-check-input" style="margin-left: 30px" type="radio" name="sexep" id="sexem" value="m">
                            <label class="form-check-label" for="sexem">Masculin</label>
                            <input class="form-check-input" style="margin-left: 80px" type="radio" name="sexep" id="sexef" value="f">
                            <label class="form-check-label" for="sexef">Féminin</label>
                        </div>
                        <span style="margin-left: 15px; margin-right: 15px" id="err_sexe" class="text-danger"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="validerp" name="validerp">Valider</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" align="center">Édition Professeur</h4>
            </div>
            <form method="post" action="../../controller/ProfesseurController.php">
            <div class="modal-body">
                <div class="form-group">
                    <label for="heading">Nom complet</label>
                    <input class="form-control prof_mat" type="hidden" id="matp" name="matp">
                    <input class="form-control prof_nom" type="text" id="nomp" name="nomp">
                    <span id="err_nomp" class="text-danger"></span>
                </div>
                <div class="form-group ">
                    <label class="control-label">Date Naiss</label>
                    <input class="form-control prof_date" type="date" id="datep" name="datep" placeholder="Sélectionner la date de naiss" >
                    <span id="err_datep" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label class="control-label">Lieu de Naiss</label>
                    <input class="form-control prof_lieu" type="text" id="lieup" name="lieup" placeholder="Entrer le lieu de naiss" >
                    <span id="err_lieup" class="text-danger"></span>
                </div>
                <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                    <div class="form-check form-check-inline">
                        <label class="control-label">Sexe :</label>
                        <input class="form-check-input" style="margin-left: 30px" type="radio" name="sexep" id="sexemas" value="m">
                        <label class="form-check-label" for="sexemas">Masculin</label>
                        <input class="form-check-input" style="margin-left: 80px" type="radio" name="sexep" id="sexefem" value="f">
                        <label class="form-check-label" for="sexefem">Féminin</label>
                    </div>
                    <span id="err_sexep" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="enregistrerp" name="enregistrerp">Enregistrer</button>
                    <button type="reset" class="btn btn-danger">Annuler</button>
                </div>
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
            <form method="post" action="../../controller/ProfesseurController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <h3>Voulez-vous vraiment supprimer?</h3>
                        <input class="form-control del_id" type="hidden" name="idp_del" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="supprimerp">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mydetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><center> Liste des cours </center></h4>
            </div>
            <form class="form-inline" style="margin-top: 15px; margin-bottom: 15px">
                <center>
                <div class="form-group">
                    <label class="sr-only">Année académique</label>
                    <input type="text"  class="form-control" id="annee" placeholder="Entrer l'année académique">
                    <input type="hidden"  class="form-control" id="idprof" >
                </div>
                <button type="button" class="btn btn-primary" id="lancer" name="lancer">Lancer</button>
                </center>
            </form>
            <center>
            <table id="resultCours" class="table table-bordered table-striped" style="width:auto;">
                <thead>
                <tr>
                    <th style='text-align:center;'>Matière</th>
                    <th style='text-align:center;'>Coef.</th>
                    <th style='text-align:center;'>Classe</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Matière</th>
                    <th style='text-align:center;'>Coef.</th>
                    <th style='text-align:center;'>Classe</th>
                </tr>
                </tfoot>
            </table>
            </center>
        </div>
    </div>
</div>


<script>
    $(document).on( "click", '.edit_button',function(e) {
        var mat = $(this).data('mat');
        var nom = $(this).data('nom');
        var date = $(this).data('date');
        var lieu = $(this).data('lieu');
        var genre = $(this).data('genre');

        $(".prof_mat").val(mat);
        $(".prof_nom").val(nom);
        $(".prof_date").val(date);
        $(".prof_lieu").val(lieu);
        if(genre == 'm'){
            $("#sexemas").prop( "checked", true );
        }
        if(genre == 'f'){
            $("#sexefem").prop( "checked", true );
        }
    });

    $(document).on( "click", '.details_classe',function(e) {
        var id = $(this).data('id');
        $('#idprof').val(id);
        $('#resultCours > tbody').empty();
        $.ajax({
            url: "../../controller/ProfesseurController.php?profid="+id,
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

    $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
    });

    /*$('#valider').click(function () {
        //event.preventDefault();
        var err_prenom = '';
        var err_nom = '';
        var err_date  = '';
        var err_lieu = '';
        var err_sexe = '';
        var prenom = '';
        var nom = '';
        var date = '';
        var lieu = '';
        var sexe = '';
        var mail = $('#mail').val();
        var tel = $('#tel').val();

        if($('#prenom').val() == ''){
            err_prenom = 'Saisir le prénom';
            $('#err_prenom').text(err_prenom);
            $('#prenom').css('border-color', '#cc0000');
            prenom = '';
        }else {
            err_prenom = '';
            $('#err_prenom').text(err_prenom);
            $('#prenom').css('border-color', '');
            prenom = $('#prenom').val();
        }
        if($('#nom').val() == ''){
            err_nom = 'Saisir le nom';
            $('#err_nom').text(err_nom);
            $('#nom').css('border-color', '#cc0000');
            nom = '';
        }else {
            err_prenom = '';
            $('#err_nom').text(err_nom);
            $('#nom').css('border-color', '');
            nom = $('#nom').val();
        }
        if($('#date').val() == ''){
            err_date = 'Renseigner la date de naissance';
            $('#err_date').text(err_date);
            $('#date').css('border-color', '#cc0000');
            date = '';
        }else {
            err_date = '';
            $('#err_date').text(err_date);
            $('#date').css('border-color', '');
            date = $('#date').val();
        }
        if($('#lieu').val() == ''){
            err_lieu = 'Saisir le lieu de naissance';
            $('#err_lieu').text(err_lieu);
            $('#lieu').css('border-color', '#cc0000');
            lieu = '';
        }else {
            err_lieu = '';
            $('#err_lieu').text(err_lieu);
            $('#lieu').css('border-color', '');
            lieu = $('#lieu').val();
        }
        if (!$("input[name='sexe']:checked").val()) {
            err_sexe = 'Sélectionner le genre';
            $('#err_sexe').text(err_sexe);
            $('#sexef').css('outline', '1px solid red');
            $('#sexem').css('outline', '1px solid red');
            sexe = '';
        }else {
            err_sexe = '';
            $('#err_sexe').text(err_sexe);
            $('#sexef').css('outline', '');
            $('#sexem').css('outline', '');
            if($('#sexef').val() != '' && $('#sexem').val() == ''){
                sexe = $('#sexef').val();
            }
            if($('#sexem').val() != '' && $('#sexef').val() == ''){
                sexe = $('#sexem').val();
            }
        }

        if(err_prenom != '' || err_nom != '' || err_date != '' || err_lieu != '' || err_sexe != ''){
            return false;
        }else {
            var form_data = $('#form_addProf').serialize();
            $.ajax({
                url: controller/ProfesseurController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#exampleModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#action_alert').html('<center><div class="alert alert-success"> Information-s ajoutée-s</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                },
                error: function (e) {
                    $('#action_alert').html('<center><div class="alert alert-danger"> Une petite erreur est survenue</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                }
            });
        }

    });*/

    /*$('#enregistrerp').click(function () {
        //event.preventDefault();
        var err_prenom = '';
        var err_nom = '';
        var err_date  = '';
        var err_lieu = '';
        var err_sexe = '';
        var prenom = '';
        var nom = '';
        var date = '';
        var lieu = '';
        var sexe = '';
        var mail = $('#mailp').val();
        var tel = $('#telp').val();
        var mat = $('#matp').val();

        if($('#prenomp').val() == ''){
            err_prenom = 'Saisir le prénom';
            $('#err_prenomp').text(err_prenom);
            $('#prenomp').css('border-color', '#cc0000');
            prenom = '';
        }else {
            err_prenom = '';
            $('#err_prenomp').text(err_prenom);
            $('#prenomp').css('border-color', '');
            prenom = $('#prenomp').val();
        }
        if($('#nomp').val() == ''){
            err_nom = 'Saisir le nom';
            $('#err_nomp').text(err_nom);
            $('#nomp').css('border-color', '#cc0000');
            nom = '';
        }else {
            err_nom = '';
            $('#err_nomp').text(err_nom);
            $('#nomp').css('border-color', '');
            nom = $('#nomp').val();
        }
        if($('#datep').val() == ''){
            err_date = 'Renseigner la date de naissance';
            $('#err_datep').text(err_date);
            $('#datep').css('border-color', '#cc0000');
            date = '';
        }else {
            err_date = '';
            $('#err_datep').text(err_date);
            $('#datep').css('border-color', '');
            date = $('#datep').val();
        }
        if($('#lieup').val() == ''){
            err_lieu = 'Saisir le lieu de naissance';
            $('#err_lieup').text(err_lieu);
            $('#lieup').css('border-color', '#cc0000');
            lieu = '';
        }else {
            err_lieu = '';
            $('#err_lieup').text(err_lieu);
            $('#lieup').css('border-color', '');
            lieu = $('#lieup').val();
        }
        if (!$("input[name='sexep']:checked").val()) {
            err_sexe = 'Sélectionner le genre';
            $('#err_sexep').text(err_sexe);
            $('#sexefem').css('outline', '1px solid red');
            $('#sexemas').css('outline', '1px solid red');
            sexe = '';
        }else {
            err_sexe = '';
            $('#err_sexep').text(err_sexe);
            $('#sexefem').css('outline', '');
            $('#sexemas').css('outline', '');
            if($('#sexefem').val() != '' && $('#sexemas').val() == ''){
                sexe = $('#sexefem').val();
            }
            if($('#sexemas').val() != '' && $('#sexefem').val() == ''){
                sexe = $('#sexemas').val();
            }
        }

        if(err_prenom != '' || err_nom != '' || err_date != '' || err_lieu != '' || err_sexe != ''){
            return false;
        }else {
            var form_data = $('#form_editionprof').serialize();
            $.ajax({
                url: controller/ProfesseurController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#myeditModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#action_alert').html('<center><div class="alert alert-success"> Donnée-s modifiée-s</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                   // $('#action_alert').dialog();
                },
                error: function (e) {
                    $('#action_alert').html('<center><div class="alert alert-danger"> Une petite erreur est survenue</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                }
            });
        }

    });*/

    $('#lancer').click(function () {
        var ann = $('#annee').val();
        var prof = $('#idprof').val();

        $.ajax({
            url: "../../controller/CoursController.php?idp="+prof+"&an="+ann,
            dataType: "text",
            success: function(data) {
                $('#resultCours > tbody').empty();
                if(data){
                    $('#resultCours').append(data);
                }
                else {
                    $('#resultCours').append("<tr><td colspan='3'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function (e) {
                $('#action_alert').html('<center><div class="alert alert-danger"> Une petite erreur est survenue</div></center>');
                $("#action_alert").dialog({
                    modal: true,
                    open: function(event, ui){
                        setTimeout("$('#action_alert').dialog('close')",3000);
                    }
                });
            }
        });

    });

</script>


</body>
</html>
