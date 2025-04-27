<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_contact;
use Config\Services;

class c_contact extends BaseController
{
    public function formContact(){
        $session = Services::session();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page de contact impossible',
                'message' => "Vous ne pouvez pas y accéder car vous êtes déjà connecté",
                'retour' => "Retour admin",
            ];
            return view('non_autorise_view', $data);
        }
        $session->remove('login');
        $session->remove('role');
        $session->remove('admin');
        $session->destroy();
        $data = [
            'title' => 'Contact',
            'titre' => 'Contactez-nous',
            'validation' => Services::validation()
        ];
        return view('contact_view', $data);
    }

    function validerEnvoi()
    {
        //Mise en place du service
        $validation = service('validation');
        //Règles de validation des données
        $validation->setRules([
            'nom'=>'required|alpha|min_length[3]|max_length[100]',
            'prenom'=>'required|alpha|min_length[3]|max_length[100]',
            'email'=>'required|valid_email',
            'sujet'=>'required|min_length[10]|max_length[255]',
            'message'=>'required|min_length[30]',
        ],
            //gestion des messages d'erreurs personnalisés
            [
                'nom'=>['required'=>'Votre nom est obligatoire',
                    'alpha' => 'Le nom ne peut contenir que des lettres.',
                    'min_length'=>"3 caractères minimum pour le nom.",
                    'max_length'=>"100 caractères maximum pour le nom."],
                'prenom'=>['required'=>'Votre prénom est obligatoire',
                    'alpha' => 'Le prénom ne peut contenir que des lettres.',
                    'min_length'=>"3 caractères minimum pour le prénom.",
                    'max_length'=>"100 caractères maximum pour le prénom."],
                'email'=>['required'=>'Votre mail est obligatoire.',
                    'valid_email'=>'Veuillez entrer une adresse mail valide.'],
                'sujet'=>['required'=>'Le sujet est obligatoire.',
                    'min_length'=>"10 caractères minimum pour le sujet.",
                    'max_length'=>"255 caractères maximum pour le sujet."],
                'message'=>['required'=>'Le message est obligatoire.',
                    'min_length'=>"30 caractères minimum pour le message."],
            ]);

        $data=[
            'nom'=>$this->request->getPost('nom'),
            'prenom'=>$this->request->getPost('prenom'),
            'email'=>$this->request->getPost('email'),
            'sujet'=>$this->request->getPost('sujet'),
            'message'=>$this->request->getPost('message'),
            'title' => 'Contact',
            'titre' => 'Contactez-nous'
        ];
        //contrôle de validation des règles sur les données
        if ($validation->run($data)) {
            $dataValide = $validation->getValidated();
            $model_contact = new m_contact();
            $model_contact->ajoutContact($dataValide);
            // Message de succès
            return view('contact_succes_view', $data);
        } else {
            $data['validation'] = Services::validation();
            return view('contact_view', $data); // Retourne la vue avec les erreurs
        }
        $model_contact = new m_contact();
        $model_contact->ajoutContact($dataValide);
    }
}
