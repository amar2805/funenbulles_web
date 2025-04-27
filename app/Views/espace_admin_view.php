<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
    <div class="pratique">
        <?=form_open(base_url().'public/adminPage'); ?>
        <p>
            <?php
            $data = array(
                'name' => 'recherche',
                'id' => 'submit',
                'value' => "",
                'size' => 29,
                'placeholder' => "Rechercher un mot-clé d'une question",
                'type' => 'text');
            echo form_input($data);
            ?>
            <?php
            $data = [
                'name' => 'button',
                'id' => 'submit',
                'type' => 'submit',
                'content' => '<span class="material-icons">search</span>'];
            echo form_button($data);?>
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
            if ($recherche != ""):
                echo '<h3>Résultat(s) pour : ' . esc($recherche) . ' (' . count($questions) . ' résultat(s))</h3>';
            endif;
            ?>
            <table>
                <thead>         <!-- en-tête -->
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">id</th>
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
                        <td style="border: 1px solid black; padding: 8px;"><?= esc($question->id) ?></td>
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
                            <?= anchor(base_url('/public/adminPage/confirmerSuppression/' . $question->id), img($datasuppr)); ?>
                            <?= anchor(base_url('public/modifierQuestion/' . $question->id), img($datamodif)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <!-- Pagination -->
        <div class="pagination">
            <!-- Bouton Précédent -->
            <?php
            if ($page_actuelle > 1) {
                echo form_submit([
                    'name' => 'pagination',
                    'id' => 'submit',
                    'value' => 'Précédent',
                    'onclick' => "window.location.href='" . base_url('public/adminPage?page=' . ($page_actuelle - 1) . '&recherche=' . urlencode($recherche)) . "';"
                ]);
            }
            ?>

            <!-- Affichage des numéros de page -->
            <?php for ($numero_page = 1; $numero_page <= $total_pages; $numero_page++): ?>
                <?php if ($numero_page != $page_actuelle): ?>
                    <?= form_radio([
                        'name' => 'page',
                        'id' => 'page_' . $numero_page,
                        'value' => $numero_page,
                        'onclick' => "window.location.href='" . base_url('public/adminPage?page=' . $numero_page . '&recherche=' . urlencode($recherche)) . "';"
                    ]); ?>
                    <?= form_label($numero_page, 'page_' . $numero_page); ?>
                <?php else: ?>
                    <span><?= $numero_page ?></span>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Bouton Suivant -->
            <?php
            if ($page_actuelle < $total_pages) {
                echo form_submit([
                    'name' => 'pagination',
                    'id' => 'submit',
                    'value' => 'Suivant',
                    'onclick' => "window.location.href='" . base_url('public/adminPage?page=' . ($page_actuelle + 1) . '&recherche=' . urlencode($recherche)) . "';"
                ]);
            }
            ?>
        </div>
    </div>
<?= $this->endSection(); ?>