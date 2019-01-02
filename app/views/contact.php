<!doctype html>
<html>
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
		<section class="page-content">
            <div class="jumbotron rounded-0 text-center">
                <div class="container">
                    <h1 class="mb-0">contact us test</h1>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card mb-5">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">contact us test</h5>
                            </div>
                            <div class="card-body">
                                <form class="mb-0" method="POST" action="">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputName">field&nbsp;<span class="required">*</span></label>
                                                <input autofocus="" id="inputName" class="form-control <?php echo (!empty($formData['name_err'])) ? 'is-invalid' : '';?>" name="name" value="<?php echo $formData['name']; ?>" ="" type="text" placeholder="...">
                                                <small class="invalid-feedback"><?php echo (!empty($formData['name_err'])) ? $formData['name_err'] : ''; ?></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail">ffffff&nbsp;<span class="required">*</span></label>
                                                <input id="inputEmail" class="form-control <?php echo (!empty($formData['email_err'])) ? 'is-invalid' : '';?>" name="email" value="<?php echo $formData['email']; ?>" ="" type="email" placeholder="...">
                                                <small class="invalid-feedback"><?php echo (!empty($formData['email_err'])) ? $formData['email_err'] : ''; ?></small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputSubject">feffwfwf&nbsp;<span class="required">*</span></label>
                                                <input id="inputSubject" class="form-control <?php echo (!empty($formData['subject_err'])) ? 'is-invalid' : '';?>" name="subject" value="<?php echo $formData['subject']; ?>"   ="" type="text" placeholder="...">
                                                <small class="invalid-feedback"><?php echo (!empty($formData['subject_err'])) ? $formData['subject_err'] : ''; ?></small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="textareaMessage">ffffff&nbsp;<span class="required">*</span></label>
                                                <textarea id="textareaMessage" placeholder="<?php echo LANG['contact-field4']; ?>..." class="form-control <?php echo (!empty($formData['message_err'])) ? 'is-invalid' : '';?>" name="message" value="<?php echo $formData['message']; ?>" ="" rows="5" aria-describedby="messHelp"></textarea>
                                                <small class="invalid-feedback"><?php echo (!empty($formData['message_err'])) ? $formData['message_err'] : ''; ?></small>
                                                <small id="messHelp" class="form-text text-muted <?php echo (!empty($formData['message_err'])) ? 'd-none' : ''; ?>">ffffff</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                <?php $this->csrf->CSRFInput() ?>
                                                <button data-disable-with="Sending test..." type="submit">Send 💩</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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