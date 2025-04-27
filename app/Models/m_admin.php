<?php

namespace App\Models;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;

class m_admin extends Model
{
    function connexion($infoLogin){

        $result = false;
        // connexion à la Bdd
        $db=db_connect();
        // requête
        $query = $db->table('users')
            ->select('login, motPasse, role')
            ->where('login =', $infoLogin)
            ->get();
        // verification résultat
        if($query->getNumRows()>0){
            $result = $query->getResult();
        }
        return $result;
    }
    function ajoutCompte($mdpUser, $login)
    {
        $db=db_connect();
        $mdpHash = password_hash($mdpUser, PASSWORD_DEFAULT);
        $informations = array(
            'login' => $login,
            'motPasse' => $mdpHash
        );
        $query = $db->table('users')->insert($informations);
    }

    function getQuestions($recherche)
    {
        $db = db_connect();
        if (!empty($recherche)) {
            $query = $db->table('questions')
                ->where("libelle LIKE '%" . $recherche . "%'");
        } else {
            $query = $db->table('questions');
        }
        $query = $query->get();

        // Retourner un tableau vide si aucune ligne n'est trouvée
        if ($query->getNumRows() > 0) {
            return $query->getResult(); // Retourne un tableau d'objets
        } else {
            return []; // Retourne un tableau vide si aucune question n'est trouvée
        }
    }
    public function getQuestionsPageWithSearch($recherche, $limite, $offset)
    {
        $db = db_connect();
        $query = $db->table('questions')
            ->like('libelle', $recherche)  // Recherche sur le libellé
            ->limit($limite, $offset) // Limite les résultats à 30 par page
            ->get();

        if ($query->getNumRows() > 0) {
            return $query->getResult();
        }
        return []; // Retourner un tableau vide si aucune question n'est trouvée
    }

    function getQuestionsid($id)
    {
        return $this->db->table('questions')
            ->where('id', $id)
            ->get()
            ->getRow();
    }
    public function getQuestionsPage($limite, $offset)
    {
        $db = db_connect();
        $query = $db->table('questions')
            ->limit($limite, $offset)
            ->get();

        if ($query->getNumRows() > 0) {
            return $query->getResult();
        }
        return []; // Retourner un tableau vide si aucune question n'est trouvée
    }


    public function modifierQuestion($id, $libelle, $theme)
    {
        $db = db_connect();

        try {
            // Préparation de la requête UPDATE
            $builder = $db->table('questions');
            $builder->set('libelle', $libelle); // Définir le nouveau libellé
            $builder->set('theme', $theme);     // Définir le nouveau thème
            $builder->where('id', $id);         // Filtrer par l'ID de la question
            $builder->update();                 // Exécuter la mise à jour

            // Vérification du résultat de l'update
            if ($db->affectedRows() > 0) {
                return "La question a été mise à jour avec succès.";
            } else {
                return "Aucune modification n'a été apportée.";
            }
        } catch (\Exception $e) {
            return "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }

    public function supprimerQuestion($id)
    {
        $db = db_connect();
        // Supprimer la question en fonction de l'ID
        $db->table('questions')
            ->where('id', $id)
            ->delete();

        // Retourner true si une ligne donc si la question a été supprimée)
        return $db->affectedRows() > 0;
    }

    public function derniereQuestion()
    {
        $db = db_connect();
        try {
            // Récupérer l'ID de la dernière question en utilisant ORDER BY et LIMIT 1
            $query = $db->table('questions')
                ->select('id')
                ->orderBy('id', 'DESC') // Trier par ID décroissant
                ->limit(1) // Limiter à 1 résultat
                ->get();

            $result = $query->getRow(); // Récupérer la première ligne du résultat
            return $result->id; // Retourner directement l'ID
        } catch (\Exception $e) {
            return $e->getMessage(); // Retourner le message d'erreur en cas d'exception
        }
    }

    public function ajouterQuestion($libelle, $theme)
    {
        $db = db_connect();
        try {
            // Appeler la méthode pour obtenir le dernier ID
            $dernierid = $this->derniereQuestion();
            $nouveauid = $dernierid + 1; // Incrémenter le dernier ID de 1
            $image = $nouveauid;

            $data = [
                'id' => $nouveauid,
                'libelle' => $libelle,
                'theme'   => $theme,
                'image'   => $image
            ];
            $db->table('questions')->insert($data);

            // Vérifier si une ligne a été insérée
            if ($db->affectedRows() > 0) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e->getMessage(); // Retourner le message d'erreur en cas d'exception
        }
    }
}