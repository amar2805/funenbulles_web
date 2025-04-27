<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="pratique">
    <h1><?= esc($titre); ?></h1>
    <?= form_open(base_url('public/plusun')); ?>
    <p>
        <!-- Champ pour le libellé de la question -->
        <?= form_label('Intitulé de la nouvelle question :', 'libelle'); ?>
        <?php
        $data = [
            'name' => 'libelle',
            'id' => 'libelle',
            'size' => '50',
            'value' => set_value('libelle')
        ];
        echo form_input($data);
        ?>
    </p>
    <p style="color: red;">
        <?= isset($validation) ? $validation->getError('libelle') : ''; ?>
    </p>
    <?= form_label('Thème :', 'theme'); ?>
    <br>
    <?php
    echo form_radio([
        'name' => 'theme[]',
        'id' => 'Bd',
        'value' => 'Bd',
        'checked' => set_value('theme') === 'Bd' // Vérification si c'était pré-sélectionné
    ]);
    echo form_label('Bd', 'Bd');
    ?>
    <?php
    echo form_radio([
        'name' => 'theme[]',
        'id' => 'Manga',
        'value' => 'Manga',
        'checked' => set_value('theme') === 'Manga' // Vérification si c'était pré-sélectionné
    ]);
    echo form_label('Manga', 'Manga');
    ?>
    <?php
    echo form_radio([
        'name' => 'theme[]',
        'id' => 'Comics',
        'value' => 'Comics',
        'checked' => set_value('theme') === 'Comics' // Vérification si c'était pré-sélectionné
    ]);
    echo form_label('Comics', 'Comics');
    ?>
    <p style="color: red;">
        <?= isset($validation) ? $validation->getError('theme') : ''; ?>
    </p>
    <p>
        <?php
        $data = [
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Ajouter la question'
        ];
        echo form_submit($data);
        ?>
    </p>
    <?= form_close(); ?>
    <p>
        <?= form_open(base_url('public/adminPage')); ?>
        <?php
        $data = [
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Retour à la liste des questions',
        ];
        echo form_submit($data);
        ?>
        <?= form_close(); ?>
    </p>
</div>
<?= $this->endSection(); ?>