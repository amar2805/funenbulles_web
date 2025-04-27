<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <h1><?= esc($titre) ?></h1>

        <h2>Éditeur</h2>
        <p>
            Association FunEnBulles<br>
            Adresse : 1 Rue Horizon Vert, 37170 Chambray-lès-Tours<br>
            E-mail : <a href="mailto:contact@funenbulles.fr">contact@funenbulles.fr</a><br><br>
            Directeur de la publication : Charles Hatan, Président de l'association FunEnBulles.
        </p>

        <h2>Hébergement</h2>
        <p>
            Le site est hébergé par :<br>
            <strong>Nom Prénom</strong><br>
            1 Rue Horizon Vert, 37170 Chambray-lès-Tours<br>
            Téléphone : <strong>...</strong><br>
            Site internet : <a href="#">[Lien vers le site de l'hébergeur]</a>
        </p>

        <h2>Conception et développement</h2>
        <p>
            Le site FunEnBulles a été conçu et développé par :<br>
            <strong>Geek4Fun</strong><br>
            E-mail : <a href="mailto:dev@geek4fun.com">dev@geek4fun.com</a><br>
            &copy; 2024-2025 Geek4Fun. Tous droits réservés.
        </p>

        <h2>Objectif et qualité des contenus</h2>
        <p>
            Le site FunEnBulles a pour objectif de promouvoir le Festival de Bandes Dessinées organisé chaque
            année à Chambray-lès-Tours. Les informations publiées sont régulièrement mises à jour afin de garantir leur exactitude.<br>
            Si une erreur ou une information incomplète est repérée, vous pouvez contacter l'administrateur
            du site via l'adresse : <a href="mailto:contact@funenbulles.fr">contact@funenbulles.fr</a>.
        </p>

        <h2>Propriété intellectuelle</h2>
        <p>
            Tous les contenus présents sur ce site, y compris les textes, images, logos, illustrations, et vidéos,
            sont protégés par les lois en vigueur sur la propriété intellectuelle.<br>
            Toute reproduction, modification, ou réutilisation des contenus du site est interdite sans l'autorisation
            écrite de l'association FunEnBulles.
        </p>

        <h2>Responsabilité</h2>
        <p>
            L'association FunEnBulles décline toute responsabilité pour :<br>
        <ul>
            <li>Les dommages résultant de l'utilisation du site.</li>
            <li>Les interruptions temporaires du site liées à des maintenances ou problèmes techniques.</li>
        </ul>
        </p>

        <h2>Utilisation des données personnelles</h2>
        <p>
            Le site FunEnBulles respecte la législation en vigueur sur la protection des données personnelles (RGPD).
            Pour plus d’informations sur la collecte et l’utilisation de vos données, veuillez consulter notre
            <a href="#">Politique de confidentialité</a>.
        </p>

        <h2>Gestion des cookies</h2>
        <p>
            Ce site utilise des cookies pour améliorer l'expérience utilisateur. Vous pouvez paramétrer ou désactiver
            les cookies directement depuis votre navigateur.
        </p>
        <?= form_close(); ?>
    </div>
<?= $this->endSection(); ?>