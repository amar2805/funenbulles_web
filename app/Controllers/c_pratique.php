<?php

namespace App\Controllers;

use App\Models\m_auteurs;
use CodeIgniter\Config\Services;

class c_pratique extends BaseController
{

    public function index()
    {
        $session = Services::session();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page des informations pratiques impossible',
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
            'title' => "Infos Pratiques",
        ];
        return view('pratique_view', $data);
    }
}