<!doctype html>
<html lang="en">
<head>
	<!-- Head -->
	<?php extend_view(['common/head'], $data) ?>
	<!-- CSS -->
    <?php load_style(['start/bootstrap.min', 'main', 'custom']) ?>
</head>
<body oncontextmenu="return false" class="d-flex flex-column">
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
                        <p>second step login</p>
                    </div>
                    <div class="col-sm-6 col-md-6 mt-4">
                        <?php if(!empty($formData['global_err'])) { ?><div class="alert alert-danger"><?php echo $formData['global_err']; ?></div><?php } ?>
                        <h1>Hi, <?php echo $formData['username']; ?></h1>
                        <p>enter the code from your authwenticator app to finish login</p>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>code</label>
                                <input class="form-control <?php echo (!empty($formData['code_err'])) ? 'is-invalid' : '';?>" type="text" name="code" placeholder="" value="<?php echo $formData['code']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['code_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <?php $this->csrf->CSRFInput() ?>
                                <button class="btn btn-sm btn-primary mr-2" data-disable-with="Verifying..." type="submit">verify</button>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                  <form action="<?php echo FULL_ROOT; ?>/user/logout" method="post">
        <button type="submit" data-disable-with="Logging out...">logout</button>
      </form>
        </section>        
    </main>
    <!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data); ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min', 'start/bootstrap.bundle.min', 'start/fontawesome-all.min', 'main', 'custom']); ?>
</body>
</html>