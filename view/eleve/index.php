<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/EleveDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classe</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.css"/>
    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script src="../../public/js/bootstrap-3.4.0.min.js"></script>
    <script src="../../public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
</head>
<body>

<div class="container" style="margin-top: 50px">
    <form class="form-inline" style="margin-top: 15px; margin-bottom: 15px">
        <center>
            <div class="form-group">
                <input type="text" class="form-control" id="annee" placeholder="Entrer l'année académique">
            </div>
            <div class="form-group">
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
            </div>
        </center>
    </form>
    <div class="panel panel-info ">
        <div class="panel-heading" align="center"><h2>Listes des élèves</h2></div>
        <div class="panel-body">
        <div id="alarmmsg"></div>
                    <?php
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
            ?>
            <table id="result" class="table table-bordered table-striped" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom Complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="7" style='text-align:center; font-weight: normal;'>Pas de correspondance</th>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom Complet</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Action</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Modal for Edit button -->
<div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" align="center">Édition élève</h4>
            </div>
                <div class="modal-body">
                    <form method="post" action="../../controller/EleveController.php" id="form_editioneleve">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input class="form-control eleve_mat" type="hidden" id="mat" name="mat" required>
                                <label class="control-label">Nom complet</label>
                                <input class="form-control eleve_nom" id="nom" name="nom" placeholder="Entrer le nom complet" >
                                <span id="err_nom" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <label class="control-label">Date Naiss</label>
                            <input class="form-control eleve_date" type="date" id="date" name="date" placeholder="Sélectionner la date de naiss" >
                            <span id="err_date" class="text-danger"></span>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <label class="control-label">Lieu de Naiss</label>
                            <input class="form-control eleve_lieu" type="text" id="lieu" name="lieu" placeholder="Entrer le lieu de naiss" >
                            <span id="err_lieu" class="text-danger"></span>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <div class="form-check form-check-inline">
                                <label class="control-label">Sexe :</label>
                                <input class="form-check-input" style="margin-left: 30px" type="radio" name="sexe" id="sexem" value="m">
                                <label class="form-check-label" for="sexem">Masculin</label>
                                <input class="form-check-input" style="margin-left: 80px" type="radio" name="sexe" id="sexef" value="f">
                                <label class="form-check-label" for="sexef">Féminin</label>
                            </div>
                            <span id="err_sexe" class="text-danger"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="enregistrer" name="enregistrer">Enregistrer</button>
                            <button type="reset" class="btn btn-danger">Annuler</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->


<!-- Modal for Edit button -->
<div class="modal fade" id="mynoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" align="center">Notes de l'élève <span id="nom_eleve"></span></h4>
                <center>
                    <div class="form-inline">
                        <label for="">Semestre</label>
                        <select style="width: 35px; padding: 0 0 0 3px;" class='form-control' type="text" name="semestre" id="semestre">
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                        </select>
                    </div>
                    <input class="form-control matEl" type="hidden" name="matEl" readonly>
                    <input class="form-control anNote" type="hidden" name="anNote" readonly>
                    <input class="form-control classNote" type="hidden" name="classNote" readonly>
                </center>
            </div>
            <div class="modal-body">
                <center>
                    <table id="resultNote" class="table table-bordered table-striped" style="width:auto; margin-bottom: 10px">
                        <thead>
                        <tr>
                            <th style='text-align:center;'>Matière</th>
                            <th style='text-align:center;'>Devoir</th>
                            <th style='text-align:center;'>Examen</th>
                            <th style='text-align:center;'>Coef.</th>
                            <!--<th style='text-align:center;'>Moy.</th>
                            <th style='text-align:center;'>Appréciation</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style='text-align:center;'>Matière</th>
                            <th style='text-align:center;'>Devoir</th>
                            <th style='text-align:center;'>Examen</th>
                            <th style='text-align:center;'>Coef.</th>
                            <!--<th style='text-align:center;'>Moy.</th>
                            <th style='text-align:center;'>Appréciation</th>-->
                        </tr>
                        </tfoot>
                    </table>
                    <form method="post" target='_blank' action="../../view/bulletin/index.php">
                        <input class="form-control matEl" type="hidden" name="matEl" readonly>
                        <input class="form-control anNote" type="hidden" name="anNote" readonly>
                        <input class="form-control classNote" type="hidden" name="classNote" readonly>
                        <input class="form-control semNote" type="hidden" name="semNote" readonly>
                        <button class="btn btn-info" type="submit"><img style="height: 20px; width: 20px" src="../../public/image/icons8-impression-30.png" alt=""></button>
                    </form>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->

<script>
    $(document).on( "click", '#printNote',function(e) {
        var mat = $(".matEl").val();
        var classe = $(".classNote").val();
        var annee = $(".anNote").val();
        var sem = $("#semestre").val();

        //alert(mat + ' '+ classe + ' '+ annee + ' ' + sem);

        $.ajax({
            url: "../../view/bulletin/index.php?mat="+mat+"&cl="+classe+"&an="+annee+"&sem="+sem,
            method: "GET",
            success: function(data) {
                console.log('Bulletin ok');
            }
        });

    });

    $(document).on( "click", '.edit_button',function(e) {
        var mat = $(this).data('mat');
        var nom = $(this).data('nom');
        var date = $(this).data('date');
        var lieu = $(this).data('lieu');
        var genre = $(this).data('genre');

        $(".eleve_mat").val(mat);
        $(".eleve_nom").val(nom);
        $(".eleve_date").val(date);
        $(".eleve_lieu").val(lieu);
        if(genre == 'm'){
            $( "#sexem" ).prop( "checked", true );
        }
        if(genre == 'f'){
            $( "#sexef" ).prop( "checked", true );
        }
    });

    $(document).on( "click", '.note_button',function(e) {
        var mat = $(this).data('mat');
        var nom = $(this).data('nom');
        var classe = $(this).data('classe');
        var annee = $(this).data('annee');
        var sem = $("#semestre").val();

        $("#nom_eleve").text(nom);
        $("#nom_eleve").val(nom);
        $(".matEl").val(mat);
        $(".anNote").val(annee);
        $(".classNote").val(classe);
        $(".semNote").val(sem);

        $('#resultNote > tbody').empty();
        $.ajax({
            url: "../../controller/EleveController.php",
            method: "POST",
            data: {
                anNote : annee,
                clNote : classe,
                semNote : sem,
                matNote : mat
            },
            dataType: "json",
            success: function(data) {
                //alert(data);
                if(data.length > 0){
                    var len = data.length;
                    for(var i=0; i<len; i++){
                        var matiere = data[i].matiere;
                        var devoir = data[i].devoir;
                        var examen = data[i].examen;
                        var coef = data[i].coef;
                        var classe = $('#classe').val();
                        var annee = $('#annee').val();

                        var tr_str = "<tr>" +
                            "<td align='center'>" + matiere + "</td>" +
                            "<td align='center'>" + devoir + "</td>" +
                            "<td align='center'>" + examen + "</td>" +
                            "<td align='center'>" + coef + "</td>" +
                            "</tr>";

                        $("#resultNote tbody").append(tr_str);
                    }
                }
                else {
                    $('#resultNote').append("<tr><td colspan='8'><center>Pas de résultat disponible !</center></td></tr>");
                }
            },
            error: function () {
                alert("Pas bon");
            }
        });
    });

    $(document).ready(function () {
        $('#semestre').change(function () {
            $('#resultNote > tbody').empty();
            var mat = $(".matEl").val();
            var classe = $(".classNote").val();
            var annee = $(".anNote").val();
            var sem = $("#semestre").val();
            $(".semNote").val(sem);

            //$("#nom_eleve").val(prenom + ' ' + nom);
            //alert(mat);

            $('#resultNote > tbody').empty();
            $.ajax({
                url: "../../controller/EleveController.php",
                method: "POST",
                data: {
                    anNote : annee,
                    clNote : classe,
                    semNote : sem,
                    matNote : mat
                },
                dataType: "json",
                success: function(data) {
                    //alert(data);
                    if(data.length > 0){
                        var len = data.length;
                        for(var i=0; i<len; i++){
                            var matiere = data[i].matiere;
                            var devoir = data[i].devoir;
                            var examen = data[i].examen;
                            var coef = data[i].coef;
                            var classe = $('#classe').val();
                            var annee = $('#annee').val();

                            var tr_str = "<tr>" +
                                "<td align='center'>" + matiere + "</td>" +
                                "<td align='center'>" + devoir + "</td>" +
                                "<td align='center'>" + examen + "</td>" +
                                "<td align='center'>" + coef + "</td>" +
                                "</tr>";

                            $("#resultNote tbody").append(tr_str);
                        }
                    }
                    else {
                        $('#resultNote').append("<tr><td colspan='8'><center>Pas de résultat disponible !</center></td></tr>");
                    }
                },
                error: function () {
                    alert("Pas bon");
                }
            });
        });
    });

    $(document).ready(function () {
        $('#classe').change(function () {
            $('#result > tbody').empty();
            $.ajax({
                url: "../../controller/EleveController.php",
                method: "POST",
                data: {
                    annee : $('#annee').val(),
                    classe : $('#classe').val()
                },
                dataType: "json",
                success: function(data) {
                    //alert(data);
                   if(data.length > 0){
                       var len = data.length;
                       for(var i=0; i<len; i++){
                           var mat = data[i].mat;
                           var nom = data[i].nom;
                           var date = data[i].date;
                           var lieu = data[i].lieu;
                           var genre = data[i].genre;
                           var classe = $('#classe').val();
                           var annee = $('#annee').val();

                           var tr_str = "<tr>" +
                               "<td align='center'>" + mat + "</td>" +
                               "<td align='center'>" + nom + "</td>" +
                               "<td align='center'>" + date + "</td>" +
                               "<td align='center'>" + lieu + "</td>" +
                               "<td align='center'>" + genre + "</td>" +
                               "<td align='center'><button type='button' class='btn btn-warning btn-xs edit_button'" +
                               "data-toggle='modal' data-target='#myeditModal'" +
                               "data-nom='"+nom+"'" +
                               "data-date='"+date+"'" +
                               "data-lieu='"+lieu+"'" +
                               "data-genre='"+genre+"'" +
                               "data-mat='"+mat+"'>Éditer</button></td>" +
                               "<td align='center'><button type='button' class='btn btn-info btn-xs note_button'" +
                               "data-toggle='modal' data-target='#mynoteModal'" +
                               "data-nom='"+nom+"'" +
                               "data-annee='"+annee+"'" +
                               "data-classe='"+classe+"'" +
                               "data-mat='"+mat+"'>Voir notes</button></td>" +
                               "</tr>";

                           $("#result tbody").append(tr_str);
                        }
                        //alert ("mat :"+mat+", nom :"+nom+", date : "+date+", sexe : "+genre);
                   }
                    else {
                        $('#result').append("<tr><td colspan='9'><center>Pas de résultat disponible !</center></td></tr>");
                    }
                },
                error: function () {
                    alert("Pas bon");
                }
            });
        });
    });

    $('#enregistrer').click(function () {
        //event.preventDefault();
        var err_nom = '';
        var err_date  = '';
        var err_lieu = '';
        var err_sexe = '';
        var nom = '';
        var date = '';
        var lieu = '';
        var sexe = '';
        var mat = $('#mat').val();
        if($('#nom').val() == ''){
            err_nom = 'Saisir le nom';
            $('#err_nom').text(err_nom);
            $('#nom').css('border-color', '#cc0000');
            nom = '';
        }else {
            err_nom = '';
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

    });

</script>


</body>
</html>
