<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <?= form_open(base_url() . 'public/espace_ludique'); ?>
        <h1><?= esc($titre) ?></h1>
        <br>
        <?php if (!empty($error)): ?>
            <p style="color: red; font-weight: bold;"><?= esc($error) ?></p>
        <?php endif; ?>
        <p>Choisissez les thèmes :</p>
        <?php
        // Checkboxes pour les thèmes
        $themes = ['Bd' => 'Bd', 'Manga' => 'Manga'];
        foreach ($themes as $value => $label) {
            $data = [
                'name' => 'theme[]',
                'id' => $value,
                'value' => $value,
                'checked' => false,
            ];
            echo form_checkbox($data);
            echo form_label($label, $value);
        }
        ?>
        <p>Choisissez le nombre de questions :</p>
        <?php
        // Radios pour le nombre de questions
        $nombreQuestionsOptions = [5, 8, 10, 15];
        foreach ($nombreQuestionsOptions as $option) {
            $data = [
                'name' => 'nombre_questions',
                'id' => 'nb_' . $option,
                'value' => $option,
                'checked' => false,
            ];
            echo form_radio($data);
            echo form_label($option . ' questions', 'nb_' . $option);
        }
        ?>
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
    <div class="pratique">
        <?= form_open(base_url() . 'public/validerRep'); ?>
        <p>Si rien n'est sélectionné, un quiz apparaît avec 8 questions par défaut</p>
        <h2><?= esc($description) ?></h2>
        <?php foreach ($questions as $question): ?>
        <div class="question-block" style="margin-bottom: 20px;">
            <p><?= esc($question->question); ?></p>
            <?php if (!empty($question->image)): ?>
            <div>
                <?php
                $image = [
                    'src' => base_url('public/assets/images/img_question/' . esc($question->image) . '.png'),
                    'style' => 'max-width: 100%; height: auto; display: block; margin: auto;'
                ]; ?>
                <?= img($image);?>
            </div>
        <?php endif; ?>
        <!-- Affichage des propositions -->
        <?php foreach ($question->propositions as $proposition): ?>
            <?= form_radio([
                'name'  => $question->id, // Utiliser l'ID de la question
                'value' => $proposition->reponse,
                'id'    => 'reponse_' . $proposition->proposition_id
            ]); ?>
            <?= form_label(esc($proposition->reponse), 'reponse_' . $proposition->proposition_id); ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
    <p>
        <?php
        $data = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Valider');
        echo form_submit($data);
        ?>
    </p>
<?= form_close(); ?>
<?= $this->endSection(); ?>