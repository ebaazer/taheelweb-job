<?php
$twitter_card = "summary";
$twitter_site = "@artoflivingqata";
$twitter_creator = "@artoflivingqata    ";
$web_name = "أكاديمية مُتَمكّن";
$site_name = "أكاديمية مُتَمكّن";
?>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content = "أكاديمية مُتَمكّن">
<meta name='url' content='<?php echo base_url(); ?>'>
<meta name="turbolinks-root">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content = "IE=edge">
<meta name="twitter:card" content="<?php echo $twitter_card; ?>"></meta>
<meta name="twitter:site" content="<?php echo $twitter_site; ?>"></meta>
<meta name="twitter:url" content="//<?php echo base_url(); ?>/"></meta>    
<meta name="twitter:creator" content="<?php echo $twitter_creator; ?>"></meta>
<meta property="og:type" content="website"></meta>
<meta property="og:image:width" content="1000">
<meta property="og:image:height" content="1000">
<meta property="og:site_name" content="<?php echo $web_name; ?>"></meta> 
<meta property="og:site_name" content="<?php echo $site_name; ?>"></meta>
<meta name="csrf-param" content="authenticity_token" />
<meta name="csrf-token" content="" />

<?php
if ($page_name == "blog_detail") {
    $page_title = $blog->title;
    $description = $blog->short_description;
    $tags_blog = explode(',', $blog->tags_blog);
    foreach ($tags_blog as $tags_blog_row) {
        $keywords .= $this->db->get_where('tag', array('id' => $tags_blog_row))->row()->name . ',';
    }
    ?>
    <title><?php echo $page_title; ?> | <?php echo $web_name; ?></title>
    <meta name="description" content="<?php echo $description; ?>"></meta>
    <meta name="keywords" content="<?php echo $keywords; ?>"></meta>
    <meta name="twitter:url" content="<?php echo base_url(); ?>home/blog_detail/<?php echo $blog->encrypt_thread; ?>"></meta>
    <meta name="twitter:title" content="<?php echo $page_title; ?>"></meta>
    <meta name="twitter:description" content="<?php echo $description; ?>"></meta>
    <meta name="twitter:image" content="<?php echo base_url(); ?>uploads/blog_images/<?php echo $blog->photo; ?>"></meta>
    <meta property="og:url" content="<?php echo base_url(); ?>home/blog_detail/<?php echo $blog->encrypt_thread; ?>"></meta>
    <meta property="og:image" content="<?php echo base_url(); ?>uploads/blog_images/<?php echo $blog->photo; ?>"></meta>    
    <meta property="og:title" content="<?php echo $page_title; ?>"></meta>
    <meta property="og:description" content="<?php echo $description; ?>"></meta>       
    <?php
} elseif ($page_name == "become_trainer_with_us") {
    $title = $page_title;
    $description = 'هل أنت مدرب معتمد وتريد أن تقدم دورات تدريبية متخصصة انضم الآن الى فريق أكاديمية مُتَمكّن';
    $keywords = 'مدرب معتمد,كن مدربا معنا,انضم الينا كمدرب معتمد,دورات تدريبية';
    ?>
    <meta name="title" content="<?php echo $title; ?>"></meta>
    <meta name="description" content="<?php echo $description; ?>"></meta>
    <meta name="keywords" content="<?php echo $keywords; ?>"></meta>
    <meta name="twitter:title" content="<?php echo $title; ?>"></meta>
    <meta name="twitter:description" content="<?php echo $description; ?>"></meta>
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/become_trainer_2.png"></meta>
    <meta property="og:url" content="//<?php echo base_url(); ?>/"></meta>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/become_trainer_2.png"></meta>
    <meta property="og:title" content="<?php echo $title; ?>"></meta>
    <meta property="og:description" content="<?php echo $description; ?>"></meta>

    <?php
} elseif ($page_name == "job_application_form") {
    $title = $page_title;
    $description = 'انضم إلى فريقنا المميز وكن جزءًا من رحلة إبداعية';
    $keywords = 'مدرب معتمد,كن مدربا معنا,انضم الينا كمدرب معتمد,وظائف,توظيف,دورات تدريبية';
    ?>    

    <meta name="title" content="<?php echo $title; ?>"></meta>
    <meta name="description" content="<?php echo $description; ?>"></meta>
    <meta name="keywords" content="<?php echo $keywords; ?>"></meta>
    <meta name="twitter:title" content="<?php echo $title; ?>"></meta>
    <meta name="twitter:description" content="<?php echo $description; ?>"></meta>
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/job_form_img.png"></meta>
    <meta property="og:url" content="//<?php echo base_url(); ?>/"></meta>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/job_form_img.png"></meta>
    <meta property="og:title" content="<?php echo $title; ?>"></meta>
    <meta property="og:description" content="<?php echo $description; ?>"></meta>    

    <?php
} elseif ($page_name == "contact_us") {
    $title = $page_title;
    $description = 'هل تحتاج إلى مزيد من المعلومات؟ اكتب إلينا على';
    $keywords = 'مدرب معتمد,كن مدربا معنا,انضم الينا كمدرب معتمد,دورات تدريبية';
    ?>
    <meta name="title" content="<?php echo $title; ?>"></meta>
    <meta name="description" content="<?php echo $description; ?>"></meta>
    <meta name="keywords" content="<?php echo $keywords; ?>"></meta>
    <meta name="twitter:title" content="<?php echo $title; ?>"></meta>
    <meta name="twitter:description" content="<?php echo $description; ?>"></meta>
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/become_trainer_2.png"></meta>
    <meta property="og:url" content="//<?php echo base_url(); ?>/"></meta>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/become_trainer_2.png"></meta>
    <meta property="og:title" content="<?php echo $title; ?>"></meta>
    <meta property="og:description" content="<?php echo $description; ?>"></meta>
    <?php
} else {
    $title = $page_title;
    $description = 'أكاديمية متخصصة في مجال التربية الخاصة في الوطن العربي. نحرص على تقديم أعلى معايير الجودة لبناء مهارات متميزة تعزز قدرات الأفراد وتنمي خبراتهم في هذا المجال';
    $keywords = 'دورات تدريبية,دورات اون لاين,دورات تربية خاصة ,تطوير مهني';
    ?>
    <meta name="title" content="<?php echo $title; ?>"></meta>
    <meta name="description" content="<?php echo $description; ?>"></meta>
    <meta name="keywords" content="<?php echo $keywords; ?>"></meta>
    <meta name="twitter:title" content="<?php echo $title; ?>"></meta>
    <meta name="twitter:description" content="<?php echo $description; ?>"></meta>
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/logo/logo.png"></meta>
    <meta property="og:url" content="//<?php echo base_url(); ?>/"></meta>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/logo/logo.png"></meta>
    <meta property="og:title" content="<?php echo $title; ?>"></meta>
    <meta property="og:description" content="<?php echo $description; ?>"></meta>
<?php }
?>