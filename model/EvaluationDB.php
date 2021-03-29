<?php

    function addEvaluation($libelle,$type,$sem,$annee,$classe,$matiere)
    {
        $sql = "INSERT INTO evaluation VALUES (NULL, '$libelle' , '$type', '$sem', '$annee', '$classe', '$matiere',0)";
        return executeSQL($sql);
    }

    function listeEvaluation()
    {
        $sql = "SELECT * FROM evaluation";
        return executeSQL($sql);
    }

    function updateEvalution($id,$libelle,$type,$sem,$annee,$classe,$matiere)
    {
        $sql = "UPDATE evaluation SET libelleEv = '$libelle',
                                  typeEv = '$type',
                                  semestre = '$sem',
                                  anneeAcad = '$annee',
                                  classe = '$classe',
                                  idMatiere = '$matiere'
                                  WHERE idEv = $id";
        return executeSQL($sql);
    }

    function deleteEvaluation($id)
    {
        $sql = "DELETE FROM evaluation WHERE idEv = $id";
        return executeSQL($sql);
    }

    function getEvaluationByClasse($id,$ann,$sem)
    {
        $sql = "SELECT * FROM evaluation e, classe c, matiere m
                  WHERE e.classe=c.id AND c.id='$id' AND e.semestre='$sem' AND e.idMatiere=m.id AND e.anneeAcad='$ann'
                  ORDER BY e.libelleEv ASC";
        return executeSQL($sql);
    }