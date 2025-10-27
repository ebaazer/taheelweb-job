
<!--  Main jQuery  -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery-3.7.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery-ui.js"></script>
<!-- Popper and Bootstrap JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/popper.min.js"></script>
<!-- Swiper slider JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/swiper-bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/slick.js"></script>
<!-- Waypoints JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/waypoints.min.js"></script>
<!-- WOW JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/wow.min.js"></script>
<!-- Counterup JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery.counterup.min.js"></script>
<!-- Isotope  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/isotope.pkgd.min.js"></script>
<!-- Magnific-popup  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery.magnific-popup.min.js"></script>
<!-- GSAP  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/gsap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/simpleParallax.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/TweenMax.min.js"></script>
<!-- Marquee  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery.marquee.min.js"></script>
<!-- Select2  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery.nice-select.min.js"></script>
<!-- Select2  JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/jquery.fancybox.min.js"></script>
<!-- Custom JS -->
<script src="<?php echo base_url(); ?>assets/frontend/neckle_2/<?php echo $site_folder; ?>/assets/js/custom.js"></script>


<script>
    function change_language(el) {
        var newLanguage = $(el).data("row-id");

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>home/change_language/' + newLanguage,
            success: function (response) {
                if (response == 'false') {
                    location.reload();
                } else if (response == 'true') {
                    location.reload();
                }
            }
        });
    }
</script>

