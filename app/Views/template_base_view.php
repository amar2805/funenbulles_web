<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title> <!-- Le titre change en fonction de la page -->
    <?= link_tag('/public/assets/css/style_funbulles.css?v=33.0'); ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0&icon_names=add" />

</head>
<body>
<!-- Bandeau contenant le logo et le titre -->
<header>
    <div class="bandeau">
        <div class="logo">
            <?php
            $image = ['src' => '/public/assets/images/logo_funBulles_couleur.png',
                'alt' => 'FunEnBulles Logo'];
            //echo img($image);
            if (!session()->get('admin')):
                echo anchor(base_url().'public/',img($image));
            else:
                echo anchor(base_url().'public/adminPage',img($image));
            endif;
            ?>
        </div>
        <!-- Barre noire pour le texte et le menu -->
        <div class="menu-bar">
                <div class="texte-au-dessus">
                    <h1>Du Fun avec des Bulles, des Bulles en Têtes</h1>
                </div>
                <!-- Menu -->
                <nav>
                    <ul class="menu">
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/', 'ACCUEIL') ?></li>
                        <?php endif; ?>
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/expositions', 'EXPOSITION(S)') ?></li>
                        <?php endif; ?>
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/auteurs', 'LES AUTEUR(E)S 2025') ?></li>
                        <?php endif; ?>
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/espace_ludique', 'ESPACE LUDIQUE') ?></li>
                        <?php endif; ?>
                        <?php if (session()->get('admin')): ?>
                            <li><?= anchor(base_url() . 'public/adminPage', 'ESPACE ADMIN') ?></li>
                        <?php endif; ?>
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/pratique', 'INFOS PRATIQUES') ?></li>
                        <?php endif; ?>
                        <?php if (!session()->get('admin')): ?>
                        <li><?= anchor(base_url().'public/contact', 'CONTACT') ?></li>
                        <?php endif; ?>
                        <li><?php if (!session()->get('admin')): ?>
                            <?= anchor(base_url().'public/admin', 'CONNEXION'); ?>
                        <?php endif; ?></li>
                        <li><?php if (session()->get('admin')): ?>
                            <?= anchor(base_url().'public/deconnexion', 'DECONNEXION'); ?>
                        <?php endif; ?></li>
                    </ul>
                </nav>
        </div>
    </div>

</header>
<main>
    <?= $this->renderSection('content'); ?>
    <div>
    <button id="retourHaut" title="Retour en haut">↑</button>
    <!-- Association du JavaScript -->
    <script src="<?= base_url('/public/assets/js/bouton_top.js'); ?>"></script>
    </div>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <?php
            $image = ['src' => '/public/assets/images/Societe_Logo.png',
                'alt' => 'Geek 4 Fun Logo'];
            if (!session()->get('admin')):
                echo anchor(base_url().'public/',img($image));
            else:
                echo anchor(base_url().'public/adminPage',img($image));
            endif;
            ?>
        </div>
        <p>&copy; Développé par <span>GEEK_4_FUN</span> 2024-2025. Tous droits réservés.</p>
        <?php if (!session()->get('admin')): ?>
        <?= anchor(base_url() . 'public/mentionslegales', 'Mentions légales'); ?>
        <?php endif; ?>
    </div>
</footer>
</body>
</html>
