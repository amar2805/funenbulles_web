<?php

namespace App\Models;

use CodeIgniter\Model;

class m_expositions extends Model
{
    function recupExpositions($auteurNom, $auteurPrenom){
        $result = false;
        $db=db_connect();
        // Récupérer la liste des bandes dessinées de l'auteur
        $query = $db->table('livre')
            ->select("titre_livre, serie_id, numTome_livre, image_livre, dateParution_livre")
            ->join('collaborer','collaborer.livre_isbn = livre.isbn_livre')
            ->join('auteur','collaborer.auteur_id = auteur.id_auteur')
            ->where('auteur.nom_auteur = ',$auteurNom)
            ->where('auteur.prenom_auteur = ',$auteurPrenom)
            ->orderBy('serie_id', 'ASC')
            ->get();
        // verification résultat
        if($query->getNumRows()>0){
            $result = $query->getResult();
        }
        return $result;
    }
}