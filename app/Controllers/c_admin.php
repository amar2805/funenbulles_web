<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_admin;
use App\Models\m_contact;
use Config\Services;

class c_admin extends BaseController
{
    function index()
    {
        //$model = new m_admin();
        //$model->ajoutCompte("JesuislabdFestival?", "Gaston");
        $session = Services::session();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page de connexion impossible',
                'message' => "Vous ne pouvez pas y accéder car vous êtes déjà connecté",
                'retour' => "Retour admin",
            ];
            return view('non_autorise_view', $data);
        }
        $session->remove('login');
        $session->remove('role');
        $session->remove('admin');
        $session->destroy();
        $model = new m_admin();
        $data = [
            'title' => 'Connexion',
            'titre' => 'Connexion administrateur',
            'validation' => Services::validation()
        ];
        return view('connexion_admin_view', $data);
    }

    function connexion()
    {
        $validation = service('validation');

        // Règles de validation
        $validation->setRules(
            [
                'login' => 'required|min_length[6]|max_length[20]',
                'mdp' => 'required|min_length[12]',
            ],
            [
                'login' => [
                    'required' => 'Votre identifiant est obligatoire',
                    'min_length' => '6 caractères minimum',
                    'max_length' => '20 caractères maximum',
                ],
                'mdp' => [
                    'required' => 'Votre mot de passe est obligatoire',
                    'min_length' => '12 caractères minimum',
                ],
            ]
        );

        // Données du formulaire
        $data = [
            'login' => $this->request->getPost('login'),
            'mdp' => $this->request->getPost('mdp'),
            'validation' => $validation,
            'title' => 'Connexion',
            'titre' => 'Connexion administrateur',
        ];

        // Si la validation échoue
        if (!$validation->run($data)) {
            return view('connexion_admin_view', $data); // Retourner la vue avec erreurs de validation
        }

        $model = new m_admin();
        $controle = $model->connexion($data['login']); // Requête pour vérifier le login dans la base

        if (!$controle) {
            // Si aucun utilisateur n'est trouvé
            $session = Services::session();
            $session->setFlashdata('infoConnexion', 'Utilisateur non trouvé'); // Message d'erreur
            return view('connexion_admin_view', $data);
        }

        $pwd = $controle[0]->motPasse; // Mot de passe crypté récupéré
        $role = $controle[0]->role;   // Récupération du rôle

        if (!password_verify($data['mdp'], $pwd)) {
            // Si le mot de passe est incorrect
            $session = Services::session();
            $session->setFlashdata('infoConnexion', 'Mot de passe incorrect'); // Message d'erreur
            return view('connexion_admin_view', $data);
        }

        // Si tout est bon, on initialise les sessions utilisateur
        $session = session();
        $session->set('login', $controle[0]->login);
        $session->set('role', $role);
        $session->set('admin', $role === 'admin');

        // Redirection après réussite de la connexion
        $recherche = '';
        if ($this->request->getPost('recherche')) {
            $recherche = $this->request->getPost('recherche');
        }
        $questions = $model->getQuestions($recherche);
        $page_actuelle = $this->request->getVar('page') ?: 1;
        $limite = 30; // Nombre de questions par page
        $offset = ($page_actuelle - 1) * $limite; // Calcul de l'offset
        $questions = $model->getQuestionsPage($limite, $offset);
        $total_questions = count($model->getQuestions('')); // Récupérer toutes les questions
        // Calcul du nombre de pages
        $total_pages = ceil($total_questions / $limite);
        $data = [
            'title' => 'Espace Admin',
            'titre' => 'Espace Admin',
            'questions' => $questions,
            'recherche' => $recherche,
            'page_actuelle' => $page_actuelle,
            'total_pages' => $total_pages
        ];
        return view('espace_admin_view', $data);
    }

    function deconnexion()
    {
        $session = Services::session();
        if (!$session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page déconnexion impossible',
                'message' => "Vous ne pouvez pas y accéder car vous êtes déjà déconnecté",
                'retour' => "Retour accueil",
            ];
            return view('non_autorise_view', $data);
        }
        $session = Services::session();
        $session->remove('login');
        $session->remove('role');
        $session->remove('admin');
        $session->destroy(); // Détruire la session
        $data = [
            'title' => 'Deconnexion',
            'titre' => 'Vous avez été déconnecté'
        ];
        return view('home_view', $data);
    }

    public function pageAdmin()
    {
        $session = Services::session();
        $model = new m_admin();

        if (!$session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page administrateur impossible',
                'message' => "Vous n'êtes pas habilité à afficher cette page.",
                'retour' => "Retour accueil",
            ];
            return view('non_autorise_view', $data);
        }

        // Récupérer la page actuelle, 1 par défaut
        $page_actuelle = $this->request->getVar('page') ?: 1;
        $recherche = '';

        // Vérifier si une recherche a été effectuée
        if ($this->request->getPost('recherche')) {
            $recherche = $this->request->getPost('recherche');
        }

        $limite = 30; // Nombre d'enregistrements par page
        $offset = ($page_actuelle - 1) * $limite; // Calcul de l'offset

        // Récupérer les questions en fonction de la recherche
        if (!empty($recherche)) {
            $questions = $model->getQuestionsPageWithSearch($recherche, $limite, $offset);
            $total_questions = count($model->getQuestions($recherche)); // Nombre total de résultats correspondant à la recherche
        } else {
            $questions = $model->getQuestionsPage($limite, $offset);
            $total_questions = count($model->getQuestions('')); // Nombre total d'enregistrements sans filtre
        }

        // Calcul du nombre total de pages
        $total_pages = ceil($total_questions / $limite);

        // Passer les données à la vue
        $data = [
            'title' => 'Espace Admin',
            'titre' => 'Espace Admin',
            'questions' => $questions,
            'recherche' => $recherche,
            'page_actuelle' => $page_actuelle,
            'total_pages' => $total_pages
        ];

        return view('espace_admin_view', $data);
    }


    function ajoutQuestion()
    {
        $model = new m_admin();
        $data = [
            'title' => 'Ajout question',
            'titre' => 'Ajouter une question',
        ];
        return view('ajouter_question_view', $data);
    }
    public function plusun()
    {
        // Chargement du modèle
        $model = new m_admin();

        // Récupération des données du formulaire
        $libelle = $this->request->getPost('libelle');
        $theme = $this->request->getPost('theme');

        // Récupération des questions existantes (si besoin pour la vue)
        $recherche = '';
        $questions = $model->getQuestions($recherche);

        // Mise en place du service de validation
        $validation = service('validation');

        // Règles de validation des données
        $validation->setRules(
            [
                'libelle' => 'required|alpha_space|min_length[5]|max_length[100]',
                'theme' => 'required',
            ],
            [
                // Messages d'erreurs personnalisés
                'libelle' => [
                    'required' => 'Votre question est obligatoire.',
                    'alpha_space' => 'La question ne peut contenir que des lettres et des espaces.',
                    'min_length' => '5 caractères minimum pour la question.',
                    'max_length' => '100 caractères maximum pour la question.'
                ],
                'theme' => [
                    'required' => 'Vous êtes obligé de choisir un thème.'
                ]
            ]
        );

        // Préparation des données pour la vue
        $data = [
            'libelle' => $libelle,
            'theme' => $theme,
            'title' => 'Espace Admin',
            'titre' => 'Ajouter une question',
            'questions' => $questions,
            'recherche' => $recherche
        ];

        // Vérification des règles de validation
        if ($validation->run(['libelle' => $libelle, 'theme' => $theme])) {
            // Validation réussie, insertion dans la base de données
            $model->ajouterQuestion($libelle, $theme);
            return redirect()->to(base_url('public/adminPage'));
        } else {
            // Validation échouée, retour avec les messages d'erreur
            $data['validation'] = $validation;
            return view('ajouter_question_view', $data);
        }
    }

    function modifierQuestion($id)
    {
        $model = new m_admin();

        // Gestion des requêtes POST uniquement
        if ($this->request->getPost())
        {
            $recherche = '';
            $libelle = $this->request->getPost('libelle');
            $theme = $this->request->getPost('theme');
            $questions = $model->getQuestions($recherche);
            $message = $model->modifierQuestion($id, $libelle, $theme);

            // Ajoutez un message de confirmation ou d'erreur
            $session = Services::session();
            return redirect()->to(base_url('public/adminPage')); // Redirection vers l'espace admin après modification
        }

        // Pré-remplir le formulaire avec les données existantes
        $question = db_connect()
            ->table('questions')
            ->getWhere(['id' => $id], 1)
            ->getRow();

        if ($question) {
            $data = [
                'title' => 'Modifier une question',
                'titre' => 'Modifier une question',
                'question' => $question
            ];
            return view('modifier_question_view', $data);
            }
    }
    public function confirmerSuppression($id)
    {
        $model = new m_admin();
        $question = $model->getQuestionsid($id);
        $data = [
            'title' => 'Suppression question',
            'titre' => 'Suppression question',
            'question' => $question
        ];
        return view('confirmation_suppression_view', $data);
    }
    function supprimer($id)
    {
        $model = new m_admin();
        $message = $model->supprimerQuestion($id);
        $page_actuelle = $this->request->getVar('page') ?: 1;
        $limite = 30;
        $total_questions = count($model->getQuestions('')); // Récupérer toutes les questions
        // Calcul du nombre de pages
        $total_pages = ceil($total_questions / $limite);
        $recherche = '';
        $data = [
            'title' => 'Espace Admin',
            'titre' => 'Espace Admin',
            'questions' => $model->getQuestions($recherche),
            'recherche' => $recherche,
            'page_actuelle' => $page_actuelle,
            'total_pages' => $total_pages
        ];
        return redirect()->to(base_url('public/adminPage'));
    }
}