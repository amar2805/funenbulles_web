<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="expositions">
    <h1><?=$titre?></h1>
    <p><?= nl2br(esc($resume)); ?></p>
</div>
<div class="expositions-container">
    <h1><?= esc($auteurPrenom) . ' ' . esc($auteurNom); ?> c'est donc : </h1>
    <div class="exposition-grid">
    <?php if (!empty($expositions)) : ?>
        <?php foreach ($expositions as $expo) : ?>
            <?php if (!empty($expo->image_livre)) : ?>
                <div class="exposition-item">
                    <?php
                    $image = ['src' => '/public/assets/images/couvertures/'.esc($expo->image_livre).'.jpg',
                        'alt' => esc($expo->titre_livre),
                        'title' => esc($expo->titre_livre). ' (' . esc($expo->dateParution_livre) . ')'];
                    echo img($image);
                    ?>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</div>

<?= $this->endSection(); ?>
