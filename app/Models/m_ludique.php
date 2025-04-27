<?php

namespace App\Models;

use CodeIgniter\Model;

class m_ludique extends Model
{
    function genereAlea($nombreQuestion, $themeQuestion){
        $db=db_connect();
        $numQuestionsAleatoires = $db->table('questions')
            ->select("questions.id")
            ->whereIn('questions.theme', $themeQuestion)
            ->orderBy("RAND()")
            ->limit($nombreQuestion)  // 8 questions aléatoires
            ->get()
            ->getResultArray();

        // Récup des IDs des questions
        $listeNumero = array_column($numQuestionsAleatoires, 'id');

        // Stocker les IDs dans la session
        session()->set('listeNumero', $listeNumero);

        return $listeNumero;
    }

    function recupQuestionsReponses($nombreQuestion, $themeQuestion)
    {
        $db = db_connect();
        $listeNumero = $this->genereAlea($nombreQuestion, $themeQuestion);
        if (!$listeNumero) {
            return false;
        }

        // Récupérer les questions et leurs propositions associées
        $query = $db->table('questions')
            ->select("questions.id as question_id, questions.libelle as question, questions.image, propositions.numero as proposition_id, propositions.libelle as reponse, associer.est_correcte")
            ->join('associer', 'associer.question_id = questions.id')
            ->join('propositions', 'propositions.numero = associer.proposition_id')
            ->whereIn('questions.id', $listeNumero)
            ->orderBy("questions.libelle")
            ->get();

        // Organiser les résultats pour inclure les propositions dans chaque question
        $result = $query->getResult();

        $questions = [];
        foreach ($result as $row) {
            // Si la question n'a pas encore été ajoutée, ajouter une entrée
            if (!isset($questions[$row->question_id])) {
                $questions[$row->question_id] = (object) [
                    'id' => $row->question_id,
                    'question' => $row->question,
                    'image' => $row->image,
                    'propositions' => [], // Initialiser un tableau pour les propositions
                ];
            }

            // Ajouter la proposition dans le tableau des propositions
            $questions[$row->question_id]->propositions[] = (object) [
                'proposition_id' => $row->proposition_id,
                'reponse' => $row->reponse,
                'est_correcte' => $row->est_correcte,
            ];
        }

        // Retourner les questions sous forme d'un tableau d'objets
        return array_values($questions);
    }

    function recupQuestionsBonneReponse(){
        $result = false;
        $db=db_connect();
        // Récupérer la liste des questions depuis la session
        $listeNumero = session()->get('listeNumero');
        $query = $db->table('questions')
            ->select("questions.id as id, questions.libelle as question, propositions.libelle as reponse,est_correcte")
            ->join('associer','associer.question_id = questions.id')
            ->join('propositions', 'propositions.numero = associer.proposition_id')
            ->where('associer.est_correcte = true')
            ->whereIn ( 'questions.id' ,$listeNumero)
            ->orderBy("questions.libelle")
            ->get();
        // verification résultat
        if($query->getNumRows()>0){
            $result = $query->getResult();
        }
        return $result;
    }
}