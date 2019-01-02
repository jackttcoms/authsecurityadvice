    <!-- Required Tags -->
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Helpers -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="<?php echo OWNER; ?>" >
    <meta property="og:site_name" content="<?php echo $getSettings[0]['global_company']; ?>">
    <meta property="og:type" content="website">
    
    <!-- Brand Identity -->
    <link rel="canonical" href="<?php echo "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <link rel="shortcut icon" href="<?php echo FULL_ROOT . '/uploads/global/' . $getSettings[0]['global_favicon']; ?>">
    <link rel="icon" type="image/png" href="<?php echo FULL_ROOT . '/uploads/global/' . $getSettings[0]['global_favicon']; ?>">
	
	<!-- Unique Page SEO -->
	<title><?php echo (!empty($title)) ? $title : $getSettings[0]['global_company']; ?> | <?php echo $getSettings[0]['global_company']; ?></title>
	<meta name="description" content="<?php echo (!empty($description)) ? $description : ''; ?>">
	
	<!-- Social Unique SEO -->
	<meta property="og:title" content="<?php echo (!empty($title)) ? $title : $getSettings[0]['global_company']; ?>">
	<meta property="og:image" content="<?php echo (!empty($og_image)) ? $og_image : FULL_ROOT . '/uploads/global/' . $getSettings[0]['global_ogimg']; ?>">
	<meta property="og:description" content="<?php echo (!empty($description)) ? $description : ''; ?>">
    <meta property="og:locale" content="en_GB">
