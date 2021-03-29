<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';

$dataRes= array();
$conn = getConnection();

$sql = "SELECT COUNT(id), anneeAcad  FROM inscription GROUP BY anneeAcad ORDER BY anneeAcad DESC LIMIT 10";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){
    $nbre = $row[0];
    $annee = $row[1];
    //var_dump($row);
    $dataRes[] = array("y" => $nbre, "label" => $annee);
}

/********************************************************/
$dataRes1= array();
$anneeEncours = getAnneeEnCours();
$sql2 = "SELECT COUNT(i.id), c.libelle FROM inscription i, classe c WHERE i.classe=c.id AND i.anneeAcad='$anneeEncours' GROUP BY c.id,c.libelle";
$result1 = mysqli_query($conn,$sql2);

while($row = mysqli_fetch_array($result1)){
    $nbre = $row[0];
    $classe = $row[1];
    //var_dump($row);
    $dataRes1[] = array("label" => $classe, "y" => $nbre);
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stats</title>
    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light4",
                title:{
                    text: "Nombre d'Inscriptions par Année Académique",
                    fontSize : 15
                },
                axisY: {
                    title: "Inscriptions"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataRes, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                theme: "light4",
                animationEnabled: true,
                title: {
                    text: "Nombre d'inscriptions par classe",
                    fontSize : 15
                },
                data: [{
                    type: "pie",
                    indexLabel: "{y}",
                    yValueFormatString: "#,##0",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "#36454F",
                    indexLabelFontSize: 18,
                    indexLabelFontWeight: "bolder",
                    showInLegend: true,
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataRes1, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

            

        }

        $(document).on( "click", '#lancer',function(event) {
            event.preventDefault();
            var an = $('#ann').val();
            //alert(an);
            //var form_data = $(this).serialize();
            $.ajax({
                url: "../../controller/StatsController.php",
                method: "POST",
                data: {ann : an},
                dataType: "json",
                success: function(dataRes) {
                    //alert('YES');
                    var chart1 = new CanvasJS.Chart("chartContainer1", {
                        theme: "light4",
                        animationEnabled: true,
                        title: {
                            text: "Nombre d'inscriptions par classe",
                            fontSize : 15
                        },
                        data: [{
                            type: "pie",
                            indexLabel: "{y}",
                            yValueFormatString: "#,##0",
                            indexLabelPlacement: "inside",
                            indexLabelFontColor: "#36454F",
                            indexLabelFontSize: 18,
                            indexLabelFontWeight: "bolder",
                            showInLegend: true,
                            legendText: "{label}",
                            dataPoints: dataRes
                        }]
                    });
                    chart1.render();
                },
                error: function(data){
                    console.log('ERREUR : ' + data);
                }
            });
        });

    </script>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 28%;
            padding: 10px;
            height: 120px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

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
            width : 115px;
            border-bottom: 1px solid #000;
        }
    </style>
</head>
<body>

<div style="margin-top: 50px; margin-left: 70px" class="separator"><h3 style="margin-top: 10px">Statistiques</h3></div>

<div class="container" style="margin-top: 50px">

    <div class="row">
        <div style="float: left; border: 2px solid black; width: 50%; height: 350px" class="left">
            <div id="chartContainer" style="height: 330px; max-width: 920px; margin: 0px auto; font-size: 5px"></div>
        </div>
        <div style="float: right; border: 2px ridge black; width: 50%; height: 350px" class="right">
            <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
            <div class="form-inline" style="float: right; margin-top: 5px; margin-right: 5px">
                <input type="text" id="ann" placeholder="Année académique" class="form-control">
                <input type="button" id="lancer" value="Lancer" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>

<script src="../../public/canvasjs-3.2/canvasjs.min.js"></script>
</body>
</html>
