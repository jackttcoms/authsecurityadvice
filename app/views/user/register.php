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
                    </div>
                    <div class="col-sm-6 col-md-6 mt-4">
                        <?php if(!empty($formData['global_err'])) { ?><div class="alert alert-danger"><?php echo $formData['global_err']; ?></div><?php } ?>
                        <form id="register" action="" method="POST">
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label1']; ?> <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['fname_err'])) ? 'is-invalid' : ''; ?>" type="text" placeholder="<?php echo LANG['auth-register-label1']; ?>" name="fname" autofocus="" value="<?php echo $formData['fname']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['fname_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label2']; ?> <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['lname_err'])) ? 'is-invalid' : ''; ?>" type="text" placeholder="<?php echo LANG['auth-register-label2']; ?>" name="lname" autofocus="" value="<?php echo $formData['lname']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['lname_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label3']; ?> <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['username_err'])) ? 'is-invalid' : ''; ?>" type="text" placeholder="<?php echo LANG['auth-register-label3']; ?>" name="username" autofocus="" value="<?php echo $formData['username']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['username_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label4']; ?> <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['email_err'])) ? 'is-invalid' : ''; ?>" name="email" type="email" value="<?php echo $formData['email']; ?>" placeholder="<?php echo LANG['auth-register-label4']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['email_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label5']; ?>  <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['password_err'])) ? 'is-invalid' : ''; ?>" name="password" type="password" placeholder="<?php echo LANG['auth-register-label5']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo LANG['auth-register-info1']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label6']; ?> <span class="required">*</span></label>
                                <input class="form-control <?php echo (!empty($formData['confirm_password_err'])) ? 'is-invalid' : ''; ?>" name="confirm_password" type="password" placeholder="<?php echo LANG['auth-register-label6']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['confirm_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo LANG['auth-register-label7']; ?> <span class="required">*</span></label>
                                <select class="form-control <?php echo (!empty($formData['country_err'])) ? 'is-invalid' : ''; ?>" name="country" data-toggle="tooltip" data-placement="right" title="<?php echo LANG['auth-register-info2']; ?>">
                                    <option value="<?php echo $formData['country']; ?>" selected><?php echo (!empty($formData['country'])) ? $formData['country-name'] : LANG['auth-register-label8']; ?></option>
                                    <optgroup label="Popular Countries">
                                        <?php foreach($always['getPopularCountries'] as $message) : ?><option value="<?php echo $message['country_code']; ?>"><?php echo $message['country_name']; ?></option><?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="All Countries">
                                        <?php foreach($always['getCountries'] as $message) : ?><option value="<?php echo $message['country_code']; ?>"><?php echo $message['country_name']; ?></option><?php endforeach; ?>
                                    </optgroup>
                                </select>
                                <span class="invalid-feedback"><?php echo $formData['country_err']; ?></span>
                            </div>
                            <div class="form-group">
<p class="text-center link-info"><small>By signing up to Codester you confirm that you agree with the <a href="https://www.codester.com/info/member_terms" target="_blank">member terms and conditions</a></small></p>
                                <?php $this->csrf->CSRFInput() ?>
                                <?php echo $always['helpRecaptcha']->button('Sign Up', 'btn-primary btn-block mb-3'); ?>
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
    <?php if($always['getSettings'][0]['global_recaptchaon'] == '1') { echo $always['helpRecaptcha']->script(); } ?>
</body>
</html>