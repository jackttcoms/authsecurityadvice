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
        <section class="py-3 f-14">
            <div class="container pb-4">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12">
                        <h1><?php echo $title; ?></h1>
                        <p>log in to account</p>
                    </div>
                    <div class="col-sm-6 col-md-6 mt-4">
                        <?php if(!empty($formData['global_err'])) { ?><div class="alert alert-danger"><?php echo $formData['global_err']; ?></div><?php } ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>username</label>
                                <input class="form-control <?php echo (!empty($formData['username_err'])) ? 'is-invalid' : ''; ?>" type="text" required placeholder="" name="username" autofocus="" value="<?php echo $formData['username']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['username_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input class="form-control <?php echo (!empty($formData['password_err'])) ? 'is-invalid' : '';?>" type="password" name="password" required placeholder="" value="<?php echo $formData['password']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <?php $this->csrf->CSRFInput() ?>
                                <button class="btn btn-sm btn-primary mr-2" data-disable-with="Logging in..." type="submit">login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>        
    </main>
    <!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data); ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min', 'start/bootstrap.bundle.min', 'start/fontawesome-all.min', 'main', 'custom']); ?>
</body>
</html>