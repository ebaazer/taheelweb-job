<?php
$twitter_card = "summary_large_image";
$twitter_site = "@taheelweb";
$twitter_creator = "@taheelweb";
$web_name = "تأهيل ويب للتوظيف";
$site_name = "تأهيل ويب للتوظيف";
$title = $web_name;
$description = "اكتشف أحدث وظائف التأهيل والرعاية الصحية: فرص عمل لأخصائيي التربية الخاصة، العلاج الطبيعي، العلاج الوظيفي، وعلاج النطق. نربط الكفاءات بالمراكز المتخصصة في تأهيل ذوي الإعاقة.";
$keywords = "وظائف التربية الخاصة, وظائف العلاج الوظيفي, وظائف العلاج الطبيعي, وظائف علاج النطق, وظائف التخاطب, فرص عمل مع ذوي الإعاقة, وظائف الاحتياجات الخاصة, توظيف أخصائيين تأهيل, معلم تربية خاصة, أخصائي علاج وظيفي شاغر, أخصائي علاج طبيعي شاغر, أخصائي نطق وتخاطب, مراكز تأهيل, وظائف تأهيل ورعاية, العمل مع المعاقين";
$image_url = base_url() . 'assets/frontend/master/rtl/assets/img/become_trainer_2.png';
$canonical_url = base_url(uri_string());

?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<link rel="canonical" href="<?php echo $canonical_url; ?>">
<meta name="author" content="تأهيل ويب">
<meta name="description" content="<?php echo htmlspecialchars($description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="ar"> <meta name="turbolinks-root" content="/">
<meta name="turbolinks-cache-control" content="no-cache"> <meta name="csrf-param" content="authenticity_token" />
<meta name="csrf-token" content="" /> 
<meta property="og:locale" content="ar_AR"> <meta property="og:type" content="website">
<meta property="og:site_name" content="<?php echo $site_name; ?>">
<meta property="og:url" content="<?php echo $canonical_url; ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
<meta property="og:image" content="<?php echo $image_url; ?>">
<meta property="og:image:width" content="1200"> <meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo htmlspecialchars($title); ?>"> <meta name="twitter:card" content="<?php echo $twitter_card; ?>">
<meta name="twitter:site" content="<?php echo $twitter_site; ?>">
<meta name="twitter:creator" content="<?php echo $twitter_creator; ?>">
<meta name="twitter:url" content="<?php echo $canonical_url; ?>">
<meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
<meta name="twitter:image" content="<?php echo $image_url; ?>">
