<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'c_Home::index');
$routes->get('/about', 'c_Home::about');
$routes->get('/expositions', 'c_expositions::index');
$routes->get('/mentionslegales', 'c_Home::mentionslegales');
$routes->match(['get', 'post'], '/espace_ludique', 'c_ludique::index');
$routes->get('/auteurs', 'c_auteurs::index');
$routes->get('/pratique', 'c_pratique::index');
$routes->get('/admin', 'c_admin::index');
$routes->match(['get','post'], '/connexionValider', 'c_admin::connexion');
$routes->match(['get','post'], '/ajoutQuestion', 'c_admin::ajoutQuestion');
$routes->match(['get', 'post'], '/modifierQuestion/(:num)', 'c_admin::modifierQuestion/$1');
$routes->get('/deconnexion', 'c_admin::deconnexion');
$routes->match(['get','post'], '/adminPage', 'c_admin::pageAdmin');
$routes->match(['get','post'],'/contact', 'c_contact::formContact');
$routes->get('adminPage/confirmerSuppression/(:num)', 'c_admin::confirmerSuppression/$1');
$routes->match(['get','post'],'adminPage/supprimer/(:num)', 'c_admin::supprimer/$1');
$routes->match(['get','post'],'/contactValider', 'c_contact::validerEnvoi');
$routes->match(['get', 'post'], '/quiz', 'c_ludique::valider');
$routes->match(['get', 'post'], '/validerRep', 'c_ludique::valider');
$routes->get('/ajoutUtilisateur', 'c_admin::ajoutUtilisateur');
$routes->match(['get', 'post'], '/plusun', 'c_admin::plusun');