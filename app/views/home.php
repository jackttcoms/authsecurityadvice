<!doctype html>
<html lang="en">
<head>
	<!-- Head -->
	<?php extend_view(['common/head'], $data) ?>
	<!-- CSS -->
    <?php load_style(['start/bootstrap.min', 'main', 'custom']) ?>
</head>
<body class="d-flex flex-column">
	<!-- Global Message -->
	<?php echo startHelp::flash('message'); ?>
	<!-- Header -->
	<?php extend_view(['common/header'], $data) ?>

	<!-- Page Content -->
	<main class="flex-grow">
        I'm a sample homepage
        
        <form action="" method="post">
            <input class="form-control <?php echo (!empty($formData['email_err'])) ? 'is-invalid' : ''; ?>" name="email" type="email" value="<?php echo $formData['email']; ?>" required>
            <span class="invalid-feedback"><?php echo $formData['email_err']; ?></span>
            <button data-disable-with="Sending mail..." type="submit">Send 💩</button>
            <?php $this->csrf->CSRFInput() ?>
        </form>
        <?php $url = 'i saw a goat'; echo startHelp::slugify($url); ?>
        
	</main>
	<!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data) ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min', 'start/bootstrap.bundle.min', 'start/fontawesome-all.min', 'main', 'custom']); ?>
</body>
</html>