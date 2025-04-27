<?= $this->extend('template_base_view'); ?>

<?= $this->section('content'); ?>
<div class="pratique">
    <h1>Infos Pratiques</h1>
    <div class="section">
        <h2><span class="icon">💰</span> Tarifs</h2>
        <div class="tarif">
            <p><strong>Adultes :</strong> 10 euros</p>
            <p><strong>Moins de 16 ans :</strong> gratuits</p>
        </div>
    </div>
    <hr>
    <div class="section">
        <h2><span class="icon">⏰</span> Horaires</h2>
        <div class="jour">
            <p><strong>Vendredi 20 JUIN 2025</strong></p>
            <p>14h30 à 18h00</p>
        </div>
        <div class="jour">
            <p><strong>Samedi 21 JUIN 2025</strong></p>
            <p>10h00 à 18h00</p>
        </div>
        <div class="jour">
            <p><strong>Dimanche 22 JUIN 2025</strong></p>
            <p>10h00 à 17h00</p>
        </div>
    </div>
    <hr>
    <div class="section">
        <h2><span class="icon">📍</span> Localisation</h2>
        <div class="lieu">
            <p><strong>Adresse :</strong> 1 Rue Horizon Vert, 37170 Chambray-lès-Tours</p>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5406.763897156883!2d0.7186589766239685!3d47.3459405059406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fcd6c6e15be981%3A0x559abb659784db81!2s1%20Rue%20Horizon%20Vert%2C%2037170%20Chambray-l%C3%A8s-Tours!5e0!3m2!1sfr!2sfr!4v1734210376580!5m2!1sfr!2sfr"
                width="800"
                height="350"
                style="border:0;"
                allowfullscreen="true"
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
