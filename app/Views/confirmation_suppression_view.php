<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<!-- confirmation_suppression_view.php -->
<div class="pratique">
<h2>Êtes-vous sûr de vouloir supprimer cette question ?</h2>
<!-- Affichage de la question spécifique -->
<h3>Intitulé de la question : <?= $question->libelle ?></h3>
    <?=form_open(base_url('/public/adminPage/supprimer/' . $question->id)) ?>
        <p>
        <?php
        $data = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Oui');
        echo form_submit($data);
        ?>
        </p>
    <?= form_close(); ?>
    <?=form_open(base_url().'public/adminPage'); ?>
        <?php
        $data = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Annuler');
        echo form_submit($data);
        ?>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>