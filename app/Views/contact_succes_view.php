<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="pratique">
    <h1><?= esc($titre)?></h1>
    <p><?= esc($nom)?> <?= esc($prenom)?> : Récapitulatif de Votre demande :</p>
    <p>sujet : <?= esc($sujet)?> </p>
    <p>message : <?= esc($message)?> </p>
    <p>mail : <?= esc($email)?> </p>
    <h2>Merci pour votre demande, nous allons y répondre dans les plus brefs delais.</h2>
</div>
<?= $this->endSection(); ?>