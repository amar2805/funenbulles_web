<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <?= form_open(base_url() . 'public/contactValider'); ?>
            <h1><?= esc($titre) ?></h1>
        <p>
            <?= form_label('Nom : ', 'nom'); ?>
            <?php
            $data = [
                'name' => 'nom',
                'id' => 'nom',
                'value' => set_value('nom'),
                'size' => '20'
            ];
            echo form_input($data);
            ?>
            <p style="color: #c0392b;">
            <?= isset($validation) ? $validation->getError('nom') : ''; ?>
        </p>

        <p>
            <?= form_label('Prénom : ', 'prenom'); ?>
            <?php
            $data = [
                'name' => 'prenom',
                'id' => 'prenom',
                'value' => set_value('prenom'),
                'size' => '15'
            ];
            echo form_input($data);
            ?>
            <p style="color: #c0392b;">
            <?= isset($validation) ? $validation->getError('prenom') : ''; ?>
        </p>

        <p>
            <?= form_label('Email : ', 'email'); ?>
            <?php
            $data = [
                'name' => 'email',
                'id' => 'email',
                'value' => set_value('email'),
                'size' => '35'
            ];
            echo form_input($data);
            ?>
            <p style="color: #c0392b;">
            <?= isset($validation) ? $validation->getError('email') : ''; ?>
        </p>

        <p>
            <?= form_label('Sujet : ', 'sujet'); ?>
            <?php
            $data = [
                'name' => 'sujet',
                'id' => 'sujet',
                'value' => set_value('sujet'),
                'maxlength' => '100',
                'size' => '50'
            ];
            echo form_input($data);
            ?>
            <p style="color: #c0392b;">
            <?= isset($validation) ? $validation->getError('sujet') : ''; ?>
        </p>

        <p>
            <?= form_label('Message', 'message', ['style' => 'display: block; margin-bottom: 12px; margin-top: -5px;']); ?>
            <?php
            $data = [
                'name' => 'message',
                'id' => 'message',
                'value' => set_value('message'),
                'rows' => 10,
                'cols' => 70,
                'style' => 'resize: none;'
            ];
            echo form_textarea($data);
            ?>
            <p style="color: #c0392b;">
            <?= isset($validation) ? $validation->getError('message') : ''; ?>
        </p>
            <p>
                <?php
                $data = [
                    'name' => 'submit',
                    'id' => 'submit',
                    'value' => 'Valider',
                ];
                echo form_submit($data);
                ?>
            </p>
        <?= form_close(); ?>
    </div>
<?= $this->endSection(); ?>