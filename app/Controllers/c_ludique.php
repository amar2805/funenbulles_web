<?php

namespace App\Controllers;

use App\Models\m_ludique;
use Config\Services;

class c_ludique extends BaseController
{
    public function index()
    {
        $session = Services::session();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => "Affichage page de l'espace ludique impossible",
                'message' => "Vous ne pouvez pas y accéder car vous êtes déjà connecté",
                'retour' => "Retour admin",
            ];
            return view('non_autorise_view', $data);
        }
        $session->remove('login');
        $session->remove('role');
        $session->remove('admin');
        $session->destroy();
        $model = new m_ludique();
        $themesChoisis = ['Bd', 'Manga'];
        $nombreQuestions = 8;
        if ($this->request->getPost('theme')) {
            $themesChoisis = $this->request->getPost('theme');
        }
        if ($this->request->getPost('nombre_questions')) {
            $nombreQuestions = $this->request->getPost('nombre_questions');
        }
        $description = "";
        if (!$this->request->getPost()) {
            $description = "8 questions sur les deux thèmes par défaut";
        } elseif (count($themesChoisis) === 2) {
            $description = "$nombreQuestions questions sur tous les thèmes";
        } elseif (count($themesChoisis) === 1) {
            $description = "$nombreQuestions questions sur le thème : {$themesChoisis[0]}";
        }
        $questions = $model->recupQuestionsReponses($nombreQuestions, $themesChoisis);
        $data = [
            'title' => 'Espace Ludique',
            'titre' => 'Connaissez-vous bien les Bandes Dessinées et les Mangas ?',
            'description' => $description,
            'questions' => $questions,
        ];

        return view('ludique_view', $data);
    }

    public function valider()
    {
        $totalQuestions = 0;
        $score = 0;
        $model = new m_ludique();
        $questions = $model->recupQuestionsBonneReponse();
        $bonnesReponses = [];
        if (!empty($questions)) {
            $totalQuestions = count($questions);
            foreach ($questions as $question) {
                $repQuestion = $this->request->getPost($question->id);
                if ($repQuestion == $question->reponse && $question->est_correcte == 1) {
                    $score++;
                    $bonnesReponses[] = $question;
                }
            }
        }
        $data = [
            'score' => $score,
            'questionsOk' => $bonnesReponses,
            'title' => 'Résultat Quiz',
            'titre' => 'Résultat du Quiz',
            'totalQuestions' => $totalQuestions
        ];
        return view('result_ludique_view', $data);
    }
}
//    public function valider()
//    {
//        $themeChoisi = $this->request->getPost('theme');
//        $model = new m_ludique();
//        $data = [
//            'title' => 'Espace Ludique',
//            'titre' => 'Connaissez-vous bien les BANdes dessinées ? ',
//            'questions' => $model->recupQuestionsReponses(),
//            'theme' => $themeChoisi
//        ];
//        return view('ludique_quiz_view', $data);
//    }
//
//    public function validerscore()
//    {
//        $model = new m_ludique(); // Modèle des réponses
//        $questions = $model->recupQuestionsBonneReponse(); // Récupère les questions liées depuis la session
//
//        $score = 0;
//        $bonnesReponses = []; // Stocker ici les bonnes réponses
//
//        if (is_array($questions) && !empty($questions)) {
//            foreach ($questions as $question) {
//                $reponseUtilisateur = $this->request->getPost($question->id);
//
//                log_message('debug', "Question ID: {$question->id}, Réponse utilisateur: {$reponseUtilisateur}, Bonne réponse: {$question->reponse}");
//
//                if ((string)$reponseUtilisateur === (string)$question->reponse && (int)$question->est_correcte === 1) {
//                    $score++;
//                    $bonnesReponses[] = $question;
//                }
//            }
//        }
//
//        $data = [
//            'score' => $score,
//            'questionsOk' => $bonnesReponses, // Questions correctes
//            'title' => 'Résultat Quiz',
//        ];
//
//        return view('result_ludique_view', $data);
//    }
//
//    public function validerquestion()
//    {
//        $model = new m_ludique();
//        $questionActuelle = 1;
//        $themeChoisi = $this->request->getPost('theme');
//        $nombreTotalQuestion = $this->request->getPost('nombre_question');
//
//        $data = [
//            'title' => "Quiz : $themeChoisi",
//            'titre' => 'Quiz',
//            'theme' => $themeChoisi,
//            'question_actuelle' => $questionActuelle,
//            'nombre_total_question' => $nombreTotalQuestion,
//            'questions' => $model->recupQuestionsReponses($nombreTotalQuestion)
//        ];
//
//        return view('ludique_quiz_view', $data);
//    }
//}