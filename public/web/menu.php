<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>School Project</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <script src="../../public/js/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/bootstrap-3.4.0.min.js"></script>

    <style>
        /*Reset CSS*/
        *{
            margin: 0px;
            padding: 0px;
            font-family: Avenir, sans-serif;
        }

        nav{
            width: 100%;
            margin: 0 auto;
            background-color: #171717;
            position: relative;
            top: 0px;
        }

        nav ul{
            list-style-type: none;
        }

        nav ul li{
            float: left;
            width: auto;
            padding-right: 20px;
            padding-left: 20px;
            text-align: center;
            position: relative;
        }

        nav ul::after{
            content: "";
            display: table;
            clear: both;
        }

        nav a{
            display: block;
            text-decoration: none;
            color: #fff;
            border-bottom: 2px solid transparent;
            padding: 10px 0px;
        }

        nav a:hover{
            color: orange;
            border-bottom: 2px solid gold;
            text-decoration: none;
        }

        .sous{
            display: none;
            box-shadow: 0px 1px 2px #CCC;
            background-color: #3b3b3b;
            position: absolute;
            width: 85%;
            z-index: 1000;
        }
        nav > ul li:hover .sous{
            display: block;
        }
        .sous li{
            float: none;
            width: 100%;
            padding-right: 0px;
            padding-left: 0px;
            text-align: left;
        }
        .sous a{
            padding: 10px;
            border-bottom: none;
        }
        .sous a:hover{
            border-bottom: none;
            background-color: RGBa(200,200,200,0.1);
        }
        .deroulant > a::after{
            content:" ▼";
            font-size: 12px;
        }

        .conteneur{
            margin: 50px 20px;
            height: 1500px;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="../../index.php" style="font-weight: bold">Accueil</a></li>
        <li><a href="../../view/classe/index.php" style="font-weight: bold">Classe</a></li>
        <li class="deroulant"><a style="font-weight: bold">Enseignements&ensp;</a>
            <ul class="sous">
                <li><a href="../../view/matiere/index.php" style="font-weight: bold">Matières</a></li>
                <li><a href="../../view/professeur/index.php" style="font-weight: bold">Professeurs</a></li>
                <li><a href="../../view/cours/index.php" style="font-weight: bold">Cours</a></li>
            </ul>
        </li>
        <li class="deroulant"><a style="font-weight: bold">Ré/Inscription&ensp;</a>
            <ul class="sous">
                <li><a href="../../view/inscription/index.php" style="font-weight: bold">Inscription</a></li>
                <li><a href="../../view/inscription/reinscription.php" style="font-weight: bold">Réinscription</a></li>
            </ul>
        </li>
        <li class="deroulant"><a style="font-weight: bold">Études&ensp;</a>
            <ul class="sous">
                <li><a href="../../view/eleve/index.php" style="font-weight: bold">Élève</a></li>
                <li><a href="../../view/evaluation/index.php" style="font-weight: bold">Évaluation</a></li>
            </ul>
        </li>
        <li><a href="../../view/statistique/index.php" style="font-weight: bold">Statistiques</a></li>
    </ul>
</nav>

</body>
</html>