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

<div class="container" style="padding-right: 50px; padding-left: 50px; max-width: 600px;">
        <div id="action_alert" title="Message"></div>
        <div style="margin-top: 20px;" class="separator"><h3 style="margin-top: 10px">Réinscription</h3></div>
    <div style="margin-bottom: 15px; padding-top: 10px; padding-right: 15px; padding-left: 15px; padding-bottom: 10px; box-shadow: 6px 6px 10px black;">
    <div id="action_alert" title="Message"></div>
        <form method="post" id="form_reinscription">
            <div class="eleve" style="margin-top: 10px; box-shadow: 4px 4px 4px gray; border: 1px ridge gray">
                <div class="modal-header" style="margin-bottom: 10px">
                    <h4 class="modal-title" id="exampleModalLabel" align="center">Élève</h4>
                </div>
                <div style="margin-left: 15px; margin-right: 15px" class="form-group">
                    <center><label class="control-label">Matricule</label>
                    <input class="form-control" style="max-width: 200px; text-align: center;" type="text" name="mat" id="mat" placeholder="Saisir le matricule"/>
                    <span id="err_mat" class="text-danger"></span></center>
                </div>
                <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="control-label">Nom Complet</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" readonly>
                </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Date de naissance</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date de naissance" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Lieu de naissance</label>
                        <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu de naissance" readonly>
                    </div>
                </div>
                <div class="form-check form-check-inline" style="margin-left: 15px; margin-right: 15px">
                    <label class="control-label">Sexe :</label>
                    <label class="form-check-label" for="sexe" id="sexe">Genre</label>
                </div>
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

    $(document).ready(function () {
        $("#mat").change(function () {
            $('#nom').val("");
            $('#date').val("");
            $('#lieu').val("");
            $("input[name='sexe']:disabled").val('');
            $mat = $("#mat").val();
            $.ajax({
                url: "../../controller/EleveController.php?mat="+$mat,
                dataType: "json",
                success: function (data) {
                    $('#nom').val(data['1']);
                    $('#date').val(data['2']);
                    $('#lieu').val(data['3']);
                    if(data['4'] == 'm'){
                        //alert("Masculin");
                        $('#sexe').text('Masculin');
                    }
                    if(data['4'] == 'f'){
                       //alert("Feminin");
                        $('#sexe').text('Féminin');
                    }
                },
                error: function (e) {
                    alert("PAS BON");
                }
            });
        });
    });

    $('#valider').click(function () {
        //event.preventDefault();
        var err_mat= '';
        var err_classe = '';
        var mat = '';
        var classe = '';

        if($('#mat').val() == ''){
            err_mat= 'Saisir le matricule';
            $('#err_mat').text(err_mat);
            $('#mat').css('border-color', '#cc0000');
            mat = '';
        }else {
            err_mat = '';
            $('#err_mat').text(err_mat);
            $('#mat').css('border-color', '');
            mat = $('#mat').val();
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

        if(err_mat != '' || err_classe != ''){
            return false;
        }else {
            var form_data = $('#form_reinscription').serialize();
            $.ajax({
                url: "../../controller/InscriptionController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#action_alert').html('<center><div class="alert alert-success"> RéInscription effectuée</div></center>');
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
