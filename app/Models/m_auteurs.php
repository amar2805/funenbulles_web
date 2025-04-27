<?php

namespace App\Models;

use CodeIgniter\Model;

class m_auteurs extends Model
{
    function recupAuteurs($annee): bool|array
    {
        $result = false;
        $db=db_connect();
        // Récupérer la liste des auteurs du festival (année transmise)
        $query = $db->table('auteur')
            ->select("nom_auteur, prenom_auteur, pseudo_auteur, participants.texte")
            ->join('participants','participants.auteur = auteur.id_auteur')
            ->where('participants.festival = ',$annee)
            ->get();
        // verification résultat
        if($query->getNumRows()>0){
            $result = $query->getResult();
        }
        return $result;
    }
}