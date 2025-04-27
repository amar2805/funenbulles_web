<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="pratique">
    <h1><?= esc($titre); ?></h1>
    <p><?= esc($message); ?></p>
    <?php
    if(session()->get('login')):
        ?>
        <?= form_open(base_url()."public/adminPage"); ?>
        <p>
            <?php
            $data = array(
                'name' => 'submit',
                'id' => 'submit',
                'value' => esc($retour));
            echo form_submit($data);
            ?>
        </p>
        <?= form_close(); ?>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>