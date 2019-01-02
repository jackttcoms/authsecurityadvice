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
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-sm-4">
                        <?php extend_view(['admin/nav'], $data) ?>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <ul class="nav nav-tabs border-bottom-0">
                            <li class="nav-item">
                                <a class="nav-link chewi-navlink active" href="<?php echo FULL_ROOT.'/admin/email-templates'; ?>">Email Templates Management: <b>Editing</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link chewi-navlink" href="#'; ?>">New Template <small>Soon!</small></a>
                            </li>
                        </ul>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="title">Subject</label>
                                        <input type="text" name="subject" class="form-control <?php echo (!empty($formData['subject_err'])) ? 'is-invalid' : '';?>" value="<?php echo $getEmailData[0]['subject']; ?>">
                                        <span class="invalid-feedback"><?php echo $formData['subject_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">HTML Email Content</label>
                                        <textarea name="content" rows="<?php substr_count( $getPageData[0]['content'], " \r\n " ); ?>" class="form-control textarea <?php echo (!empty($formData['content_err'])) ? 'is-invalid' : ''; ?>">
                                            <?php echo $getEmailData[0]['template']; ?>
                                        </textarea>
                                        <span class="invalid-feedback"><?php echo $formData['content_err']; ?></span>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="name">Additional notes about template</label>
                                        <textarea name="notes" rows="2" class="form-control"><?php echo $getEmailData[0]['notes']; ?></textarea>
                                    </div>
                                    <?php $this->csrf->CSRFInput() ?>
                                    <input type="hidden" name="saveMain">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
				    </div>
                </div>
            </div>
            <form action="" method="post">
            <input type="hidden" name="fakeEmail">
            <button>send test email</button>
            </form>
        </section>
	</main>
	<!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data) ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min','start/bootstrap.bundle.min','start/fontawesome-all.min','main','custom','slick.min']); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.8.1/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: ".textarea",
			content_css: ['<?php echo FULL_ROOT;?>/css/textarea.css','https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'],
			valid_elements : '*[*]',
			themes: "modern",
			branding: false,
            convert_urls: false,
			plugins: ['advlist autolink lists link image charmap preview', 'visualblocks code', 'insertdatetime media contextmenu paste code'],
			toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code'
		});
	</script>
</body>
</html>