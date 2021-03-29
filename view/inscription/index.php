<?php
include_once '../../public/web/menu.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.css"/>
    <script src="../../public/js/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/bootstrap-3.4.0.min.js"></script>
    <script src="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
    <style>
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .separator::before {
            content: '';
            width : 25px;
            border-bottom: 1px solid #000;
            margin-right: .1em;
        }
        .separator::after {
            margin-left: .25em;
            content: '';
            flex: 5;
            border-bottom: 1px solid #000;
        }
    </style>
</head>
<body>

<div class="container" style="max-width: 600px; padding-right: 50px; padding-left: 50px">
    <div style="margin-top: 20px;" class="separator"><h3 style="margin-top: 10px">Inscription</h3></div>
    <div style="margin-bottom: 15px; padding-top: 10px; padding-right: 15px; padding-left: 15px; padding-bottom: 10px; box-shadow: 6px 6px 10px black;">
        <div id="action_alert" title="Message"></div>
        <form method="post" id="form_inscription">
            <div class="eleve" style="margin-top: 10px; box-shadow: 4px 4px 4px gray; border: 1px ridge gray">
                <div class="modal-header" style="margin-bottom: 10px">
                    <h4 class="modal-title" id="exampleModalLabel" align="center">Élève</h4>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Prénom(s)</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom">
                        <span id="err_prenom" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom">
                        <span id="err_nom" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Date de naissance</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Sélectionner la date">
                        <span id="err_date" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Lieu de naissance</label>
                        <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Entrer le lieu de naissance">
                        <span id="err_lieu" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-check form-check-inline" style="margin-left: 15px; margin-right: 15px">
                    <label class="control-label">Sexe :</label>
                    <input class="form-check-input" style="margin-left: 30px" type="radio" name="sexe" id="sexem" value="m">
                    <label class="form-check-label" for="sexem">Masculin</label>
                    <input class="form-check-input" style="margin-left: 80px" type="radio" name="sexe" id="sexef" value="f">
                    <label class="form-check-label" for="sexef">Féminin</label>
                </div>
                <span style="margin-left: 15px; margin-right: 15px" id="err_sexe" class="text-danger"></span>
                <div class="modal-footer"></div>
            </div>
            <div class="classe" style="margin-top: 10px; box-shadow: 4px 4px 4px gray; border: 1px ridge gray">
                <div class="modal-header" style="border-bottom: none">
                    <h4 class="modal-title" id="exampleModalLabel" align="center">Classe</h4>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlSelect1">Classe</label>
                        <select class="form-control" id="classe" name="classe">
                            <option value="" > <?php echo "Sélectionner la classe";?> </option>
                            <?php
                            include_once "../../model/DB.php";
                            include_once "../../model/ClasseDB.php";
                            $list = listeClasse();
                            while($row = mysqli_fetch_row($list)){
                                ?>
                                <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                            <?php } ?>
                        </select>
                        <span id="err_classe" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Niveau</label>
                        <input type="text" class="form-control" name="niveau" id="niveau" placeholder="Niveau" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Montant Inscription</label>
                        <input type="text" class="form-control" name="montant" id="montant" placeholder="Montant Inscription" readonly>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="valider" name="valider">Valider</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>
</div>


<script type="application/javascript">
    //ajax REST SOAP
    $(document).ready(function () {
        $("#classe").change(function () {
            $('#niveau').val("");
            $('#montant').val("");
            $idclasse = $("#classe").val();
            $.ajax({
                url: "../../controller/ClasseController.php?idc="+$idclasse,
                dataType: "json",
                success: function (data) {
                    $('#niveau').val(data['2']);
                    $('#montant').val(data['3']);
                },
                error: function (e) {
                    alert("PAS BON");
                }
            });
        });
    });

    /*$(document).ready(function () {
        $("#resultTable").hide();
        $('#cl').autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url: "controller/InscriptionController.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#cl').val(ui.item.label);
                //$('#data-container').val(ui.item.value);
                return false;
            }
        });
    });*/


    $('#valider').click(function () {
        //event.preventDefault();
        var err_prenom = '';
        var err_nom = '';
        var err_date  = '';
        var err_lieu = '';
        var err_sexe = '';
        var err_classe = '';
        var prenom = '';
        var nom = '';
        var date = '';
        var lieu = '';
        var sexe = '';
        var classe = '';

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
        if($('#classe').val() == ''){
            err_classe = 'Sélectionner la classe';
            $('#err_classe').text(err_classe);
            $('#classe').css('border-color', '#cc0000');
            classe = '';
        }else {
            err_classe = '';
            $('#err_classe').text(err_classe);
            $('#classe').css('border-color', '');
            classe = $('#classe').val();
        }

        if(err_prenom != '' || err_nom != '' || err_date != '' || err_lieu != '' || err_sexe != '' || err_classe != ''){
            return false;
        }else {
            var form_data = $('#form_inscription').serialize();
            $.ajax({
                url: "../../controller/InscriptionController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#action_alert').html('<center><div class="alert alert-success"> Inscription effectuée</div></center>');
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
    });

</script>

</body>
</html>
