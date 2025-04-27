<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="auteurs">
<h1><?=$titre?></h1>
</div>
<div class="auteurs-container">
        <?php foreach ($auteurs as $auteur): ?>
            <div class="auteur-item">
                <h3><?= esc($auteur->prenom_auteur) . ' ' . esc($auteur->nom_auteur); ?></h3>
                <?php if(isset($auteur->pseudo_auteur)):?>
                <p><strong>Pseudo:</strong> <?= esc($auteur->pseudo_auteur); ?></p>
                <?php endif;?>
                <p><?= esc($auteur->texte); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

<?= $this->endSection(); ?>
