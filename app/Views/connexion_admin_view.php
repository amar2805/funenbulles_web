<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <?php
        use Config\Services;
        $session = Services::session();
        if (!$session->getFlashData('infoConnexion')): ?>
            <h1><?= esc($titre) ?></h1>
        <?php else: ?>
            <h1><?= esc($session->getFlashData('infoConnexion')) ?></h1>
        <?php endif; ?>

        <?= form_open(base_url() . 'public/connexionValider'); ?>
        <p>
            <?= form_label('Login : ', 'login');
            $data = [
                'name' => 'login',
                'id' => 'login',
                'value' => set_value('login'),
                'placeholder' => 'Gaston',
                'minlength' => 6,
                'size' => 20,
            ];
            echo form_input($data);

            if (isset($validation) && $validation->getError('login')) {
                echo '<br><br><span class="erreurs" style="color: red;">';
                echo esc($validation->getError('login'));
                echo '</span>';
            }
            ?>
        </p>
        <p>
            <?= form_label('Mot de Passe : ', 'mdp');
            $data = [
                'name' => 'mdp',
                'id' => 'mdp',
                'value' => set_value('mdp'),
                'placeholder' => 'JesuislabdFestival?',
                'minlength' => 12,
                'size' => 20,
            ];
            echo form_password($data);

            if (isset($validation) && $validation->getError('mdp')) {
                echo '<br><br><span class="erreurs" style="color: red;">';
                echo esc($validation->getError('mdp'));
                echo '</span>';
            }
            ?>
        </p>
        <p>
            <?php
            $data = [
                'name' => 'connexion',
                'id' => 'submit',
                'value' => 'Valider',
            ];
            echo form_submit($data);
            ?>
        </p>
        <?= form_close(); ?>
    </div>
<?= $this->endSection(); ?>