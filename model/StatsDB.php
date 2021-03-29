<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 31/03/2020
 * Time: 23:35
 */

    function getNombreClasse()
    {
        $sql = "SELECT count(*) FROM classe";
        return executeSQL($sql);
    }

    function getNombreEleve(){
        $anneeAcadEncours = getAnneeEnCours();
        $sql = "SELECT count(mat) FROM eleve e, inscription i where e.mat=i.eleve AND i.anneeAcad='$anneeAcadEncours'";
        return executeSQL($sql);
    }

    function getNombreProf(){
        $anneeAcadEncours = getAnneeEnCours();
        $sql = "SELECT count(mat) FROM professeur p, cours c where p.mat=c.professeur AND c.anneeAcad='$anneeAcadEncours'";
        return executeSQL($sql);
    }

    function getNombreGarcon(){
        $anneeAcadEncours = getAnneeEnCours();
        $sql = "SELECT count(mat) FROM eleve e, inscription i where e.mat=i.eleve AND e.genre='m' AND i.anneeAcad='$anneeAcadEncours'";
        return executeSQL($sql);
    }

    function getNombreFille(){
        $anneeAcadEncours = getAnneeEnCours();
        $sql = "SELECT count(mat) FROM eleve e, inscription i where e.mat=i.eleve AND e.genre='f' AND i.anneeAcad='$anneeAcadEncours'";
        return executeSQL($sql);
    }

    function getRevenu(){
        $anneeAcadEncours = getAnneeEnCours();
        $sql = "SELECT (montantInscription+(mensualite*10))*COUNT(eleve) FROM classe c, inscription i where c.id=i.classe AND i.anneeAcad='$anneeAcadEncours'";
        return executeSQL($sql);
    }

    function getInscriptionByAnneeAcad(){
        $sql = "SELECT COUNT(id) AS nombreIns, anneeAcad  FROM inscription GROUP BY anneeAcad";
        return executeSQL($sql);
    }