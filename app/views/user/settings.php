<!doctype html>
<html lang="en">
<head>
	<!-- Head -->
	<?php extend_view(['common/head'], $data) ?>
	<!-- CSS -->
    <?php load_style(['start/bootstrap.min', 'main', 'custom']) ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
</head>
<body class="d-flex flex-column">
	<!-- Global Message -->
	<?php echo startHelp::flash('message'); ?>
	<!-- Header -->
	<?php extend_view(['common/header'], $data) ?>

    <!-- Page Content -->
    <main class="flex-grow">
        <section class="py-3 f-14">
            
            <form action="" method="post">
                <input type="checkbox" name="2sa" value="1" <?php echo ($always['getUserData'][0]['extra_security'] == '1') ? 'checked': '' ?>>
                <button type="submit">Enable 2 Step Auth</button>
            </form>
            <img src='<?php echo $data['qrcode']; ?>' />
            <h2>Download Authenticator App to Iphone/Android/Windows Phone.... then add the barcode! <small>You can only view this barcode once logged in so make sure you scan it otherwise you cannot access ur account</small></h2>
            
        </section>        
    </main>
    <!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data); ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min', 'start/bootstrap.bundle.min', 'start/fontawesome-all.min', 'main', 'custom']); ?>
</body>
</html>