<?php

namespace App\Controllers;

use App\Models\m_auteurs;
use CodeIgniter\Config\Services;

class c_auteurs extends BaseController
{
    public function index(){
        $session = Services::session();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page des auteurs impossible',
                'message' => "Vous ne pouvez pas y accéder car vous êtes déjà connecté",
                'retour' => "Retour admin",
            ];
            return view('non_autorise_view', $data);
        }
        $session->remove('login');
        $session->remove('role');
        $session->remove('admin');
        $session->destroy();
        $model = new m_auteurs();
        $data = [
            'title' => "Les auteur(e)s",
            'titre' => "Ils seront parmis nous cette année : ",
            'auteurs' => $model->recupAuteurs(2025)
        ];
        return view('auteurs_view', $data);
    }
}