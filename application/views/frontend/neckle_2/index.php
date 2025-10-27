<?php
//$this->session->set_userdata('site_lang', 'arabic');

if ($this->session->userdata('site_lang') == 'arabic') {
    $language = 'arabic';
    $this->session->set_userdata('site_lang', $language);
    $this->session->set_userdata('language', $language);
    $this->session->set_userdata('site_folder', 'rtl');

    $site_folder = $this->session->userdata('site_folder');
    $language = $this->session->userdata('site_lang');
    $site_lang = $this->session->userdata('site_lang');

    $text_align = "right";
} elseif ($this->session->userdata('site_lang') == 'english') {
    $language = 'english';
    $this->session->set_userdata('site_lang', $language);
    $this->session->set_userdata('language', $language);
    $this->session->set_userdata('site_folder', 'ltr');

    $site_folder = $this->session->userdata('site_folder');
    $language = $this->session->userdata('site_lang');
    $site_lang = $this->session->userdata('site_lang');

    $text_align = "left";
} else {
    $language = 'arabic';
    $this->session->set_userdata('site_lang', $language);
    $this->session->set_userdata('language', $language);
    $this->session->set_userdata('site_folder', 'rtl');

    $site_folder = $this->session->userdata('site_folder');
    $language = $this->session->userdata('site_lang');
    $site_lang = $this->session->userdata('site_lang');

    $text_align = "right";
}

$title = $this->frontend_model->get_frontend_by_page_seo('title', $page_name);
$description = $this->frontend_model->get_frontend_by_page_seo('description', $page_name);
$phone_home_page = $this->frontend_model->get_frontend_by_page_seo('phone_home_page', 'all');
$social = json_decode($this->frontend_model->get_frontend_settings('social_links'));
$email_contact = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
$phone_contact = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
?>

<!doctype html>
<html lang="en" <?php if ($language == "arabic") echo 'dir="rtl"'; ?>>

    <head>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

        <?php
        include 'fonts.php';
        include 'metas.php';
        include 'include_top.php';
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            include 'google_analytics.php';
            include 'user_analytics.php';
        }
        ?>
        <style>
            .has-error{
                font-size: 12px;
            }
        </style>

        <link rel="icon" href="<?php echo base_url(); ?>assets/logo/favicon.png" type="image/gif" sizes="20x20">
    </head>

    <body class="tt-magic-cursor" style="">

        <?php
        // Preloader
        //include_once 'preloader.php';
        // Modals
        // Advance-search-modal
        //include_once 'advance_search_modal.php';
        //include_once 'change_language_modal.php';

        // Sidebar Menu
        include_once 'sidebar_menu.php';

        // Search Bar
        //include_once 'search_bar.php';
        //if ($page_name == 'user_web_dashboard') {
        //} else {
        //include_once 'navigation_01.php'; // التصميم الاول
        include_once 'navigation_02.php';
        //}

        include $page_name . '.php';

        //if ($page_name == 'user_web_dashboard') {
        //include 'user_web_footer.php';
        //} else {
        include 'footer.php';
        //}
        ?>

        <?php
        //include_once 'sign_up_modal.php';
        //include_once 'login_modal.php';
        //include_once 'sell_us_modal.php';

        include 'include_bottom.php';
        ?>   

        <script>
            $(".marquee_text").marquee({
                direction: "left",
                duration: 25000,
                gap: 50,
                delayBeforeStart: 0,
                duplicated: true,
                startVisible: true,
            });
            $(".marquee_text2").marquee({
                direction: "left",
                duration: 25000,
                gap: 50,
                delayBeforeStart: 0,
                duplicated: true,
                startVisible: true,
            });

            //list grid view
            jQuery(document).ready(function ($) {
                $('.lists').click(function (event) {
                    event.preventDefault();
                    $('.list-grid-product-wrap').addClass('list-group-wrapper').removeClass('grid-group-wrapper');
                });
                $('.grid').click(function (event) {
                    event.preventDefault();
                    $('.list-grid-product-wrap').removeClass('list-group-wrapper').addClass('grid-group-wrapper');
                });
            });
            $('.list-grid-btn-group li').on('click', function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
        </script>
        
    </body>
</html>