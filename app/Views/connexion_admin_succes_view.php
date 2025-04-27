<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <?=form_open(base_url().'public/adminPage'); ?>
        <p>
            <?php
            $data = array(
                'name' => 'recherche',
                'id' => 'submit',
                'value' => esc($recherche),
                'size' => 29,
                'placeholder' => "Rechercher un mot-clé d'une question",
                'type' => 'text');
            echo form_input($data);
            ?>
            <button type="submit" id="submit" class="search-icon-button">
                <span class="material-icons">search</span>
            </button>
        </p>
        <?= form_close(); ?>
        <?=form_open(base_url().'public/ajoutQuestion'); ?>
        <p>
            <?php
            $data = array(
                'name' => 'submit',
                'id' => 'submit',
                'value' => 'Ajouter une question');
            echo form_submit($data);
            ?>
        </p>
        <?= form_close(); ?>
        <?php
        if ($questions == false):
            echo "<h3> Aucune question trouvé </h3>";
        else :
            // affichage des informations trouvées de façon formatée
            ?>
            <table>
                <thead>         <!-- en-tête -->
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">intitulé de la question</th>
                    <th style="border: 1px solid black; padding: 8px;">theme</th>
                    <th style="border: 1px solid black; padding: 8px;">actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // récupération des enregistrements, parcours du curseur
                foreach ($questions as $question): ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;"><?= esc($question->libelle) ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?= esc($question->theme) ?></td>
                        <td style="border: 1px solid black; padding: 8px;">
                            <?php
                            $datasuppr = [
                                'src' => base_url('/public/assets/images/icons/supprimer.jpg'),
                                'alt' => 'Supprimer',
                                'title' => 'Supprimer',
                                'style' => 'width: 20px;cursor: pointer;'
                            ];
                            $datamodif = [
                                'src' => base_url('/public/assets/images/icons/modifier.jpg'),
                                'alt' => 'Modifier',
                                'title' => 'Modifier',
                                'style' => 'width: 20px;cursor: pointer;'
                            ];
                            ?>
                            <?= anchor(base_url('/public/adminPage/confirmerSuppression/' . $question->id), img($datasuppr), [
                                'onclick' => "return confirm('Êtes-vous sûr de vouloir supprimer la question : $question->libelle ?');"
                            ]); ?>
                            <?= anchor(base_url('public/modifierQuestion/' . $question->id), img($datamodif)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?= $this->endSection(); ?>