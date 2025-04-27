<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <h1><?= esc($titre); ?></h1>
        <?= form_open(base_url('public/modifierQuestion/' . $question->id)) ?>
        <p>
            <!-- Champ pour le libellé de la question -->
            <?= form_label('Nouvel intitulé :', 'libelle'); ?>
            <?php
            $data = [
                'name' => 'libelle',
                'id' => 'libelle',
                'size' => '87',
                'value' => $question->libelle
            ];
            echo form_input($data);
            ?>
        </p>
        <?= form_label('Thème :', 'theme'); ?>
        <br>
        <?php
        if (isset($question->theme) && $question->theme === 'Bd'):
            $themeBdChecked = true;
        else:
            $themeBdChecked = false;
        endif;
        if (isset($question->theme) && $question->theme === 'Manga'):
            $themeMangaChecked = true;
        else:
            $themeMangaChecked = false;
        endif;
        if (isset($question->theme) && $question->theme === 'Comics'):
            $themeComicsChecked = true;
        else:
            $themeComicsChecked = false;
        endif;
        echo form_radio([
            'name' => 'theme[]',
            'id' => 'Bd',
            'value' => 'Bd',
            'checked' => $themeBdChecked // Vérification si c'était pré-sélectionné
        ]);
        echo form_label('Bd', 'Bd');
        ?>
        <?php
        echo form_radio([
            'name' => 'theme[]',
            'id' => 'Manga',
            'value' => 'Manga',
            'checked' => $themeMangaChecked // Vérification si c'était pré-sélectionné
        ]);
        echo form_label('Manga', 'Manga');
        ?>
        <?php
        echo form_radio([
            'name' => 'theme[]',
            'id' => 'Comics',
            'value' => 'Comics',
            'checked' => $themeComicsChecked // Vérification si c'était pré-sélectionné
        ]);
        echo form_label('Comics', 'Comics');
        ?>
        <p>
            <?php
            $data = [
                'name' => 'submit',
                'id' => 'submit',
                'value' => 'Modifier'
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