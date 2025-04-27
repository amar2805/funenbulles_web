<?php

namespace App\Controllers;

use App\Models\m_expositions;
use CodeIgniter\Config\Services;

class c_Home extends BaseController
{
    public function index(): string
    {
        $session = Services::session();
        $model = new m_expositions();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => "Affichage page d'accueil impossible",
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
            'title' => 'Accueil'
        ];

        return view('home_view', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'À propos'
        ];

        return view('about_view', $data);
    }

    public function mentionslegales()
    {
        $data = [
            'title' => 'Mentions Légales',
            'titre' => 'Mentions Légales'
        ];

        return view('mentionslegales_view', $data);
    }
}