<?php

namespace App\Controllers;

use App\Models\m_expositions;
use CodeIgniter\Config\Services;

class c_expositions extends BaseController
{
    public function index(){
        $session = Services::session();
        $model = new m_expositions();
        if ($session->get('admin')) {
            $data = [
                'title' => 'Non autorisé',
                'titre' => 'Affichage page exposition impossible',
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
            'title' => "Les Expositions",
            'titre' => "Hommage à Turk et à son Génie ! ",
            'resume' => "Mais qu'est-ce qui fait le charme d'un album de Léonard ? \n Réponse : ses personnages.
             Un génie un peu fou (ou complètement timbré, c'est selon) qui enchaîne les inventions les plus farfelues.
             Un certain chat tigré qui ne peut pas s'empêcher de lâcher au moins une vanne par page.
             Sans oublier le célèbre disciple, qui sert la science et c'est sa joie, toujours prêt à se prendre une enclume sur le coin de la tronche.
             \n Et bien voilà ce que vous pourrez voir et lire dans cette exposition..",
            'auteurNom' => "Liégeois",
            'auteurPrenom' => "Philippe",
            'expositions' => $model->recupExpositions("Liégeois", "Philippe")
        ];
        return view('exposition_view', $data);
    }

}