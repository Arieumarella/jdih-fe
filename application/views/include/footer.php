<!-- ***** Footer Area Start ***** -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer-single-widget">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/core-img/logo.png" alt=""></a>
                    <div class="copywrite-text mt-30">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Hak Cipta © 2019<br>
                            Biro Hukum, Sekretariat Jenderal <br>
                            Kementerian Umum Dan Perumahan Rakyat<br>
                            Jl. Pattimura No.20,<br>
                            Rt.2/RW/1. Selon, Kby. Baru, <br>
                            Kota Jakarta Selatan, DKI Jakarta 12110,<br>
                            Indonesia,<br><br>
                            P : (021) 739-6783 Ext: 1386, (021) 723-5216<br>
                            E : jdih@pu.go.id
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="footer-single-widget">
                    <ul class="footer-menu d-flex justify-content-between">
                        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
                        <li><a href="<?php echo base_url(); ?>">Produk Hukum</a></li>
                        <li><a href="<?php echo base_url(); ?>Statistik">Statistik</a></li>
                        <li><a href="<?php echo base_url() ?>Tentang-kami">Tentang Kami</a></li>
                        <li><a href="<?php echo base_url() ?>Prasyarat">Prasyarat</a></li>
                        <li><a href="<?php echo base_url() ?>Kontak-kami">Kontak Kami</a></li>
                    </ul>
                </div>
                <div>

                </div>
            </div>

            <div class="col mt-3">
                <div class="hover01 column">
                    <div>
                        <figure><a href="https://play.google.com/store/apps/details?id=com.pupr.jdih" target="_blank"><img src="<?php echo base_url(); ?>assets/img/core-img/google-play-badge.png" alt=""></a></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<style>
    .hover01 figure img {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }

    .hover01 figure:hover img {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>-->
<!-- Active js -->
<script src="<?php echo base_url(); ?>assets/js/active.js"></script>

<script src="<?= base_url() ?>/assets/js/translations.js"></script>

<script>
    $.each(translations, function(indexInArray, valueOfElement) {
        $(`label:contains('${indexInArray}')`).addClass("translatable");
        $(`a:contains('${indexInArray}')`).addClass("translatable");
    });


    function translateText(textToTranslate, targetLanguage) {
        if (translations[textToTranslate]) {
            const translatedText = translations[textToTranslate][targetLanguage];
            return translatedText || textToTranslate;
        } else {
            return textToTranslate;
        }
    }

    function setLanguageLocalStorage(languageCode) {
        localStorage.setItem('selectedLanguage', languageCode);
    }


    function getLanguageLocalStorage() {
        return localStorage.getItem('selectedLanguage') || 'id';
    }

    function translateElements(targetLanguage) {
        $('.translatable').each(function() {
            const originalText = $(this).text();
            const translatedText = translateText(originalText, targetLanguage);
            $(this).text(translatedText);
        });

        $('.translatable_placeholder').each(function() {
            const originalText = $(this).attr("placeholder");
            const translatedText = translateText(originalText, targetLanguage);
            $(this).attr("placeholder", translatedText);
        });
    }


    $('.lang-button').click(function(e) {
        const targetLanguage = e.target.value;
        setLanguageLocalStorage(targetLanguage);
        translateElements(targetLanguage);
        window.location.reload()
    });


    $(document).ready(function() {
        const savedLanguage = getLanguageLocalStorage();
        $('#language-select').val(savedLanguage);
        translateElements(savedLanguage);
    });

    $(document).on("draw.dt", function() {
        const savedLanguage = getLanguageLocalStorage();
        $('#language-select').val(savedLanguage);
        translateElements(savedLanguage);
    });
</script>

</body>

</html>