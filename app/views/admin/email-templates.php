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
                                <?php if($getEmail === FALSE) { ?>
                                <div class="alert alert-warning mb-0" role="alert">
                                    <b><i class="fas fa-info-circle"></i> No Email Templates Found!</b>
                                </div>
                                <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-light mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Notes</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($getEmail as $link) : ?>
                                            <tr>
                                                <td><?php echo $link['name']; ?></td>
                                                <td><?php echo (!empty($link['notes'])) ? $link['notes'] : 'N/A';?></td>
                                                <td><?php if ($link['status'] == 1){ ?><span class="badge badge-success">Active</span><?php } else{ ?><span class="badge badge-warning">Inactive</span><?php } ?></td>
                                                <td><a href="<?php echo FULL_ROOT.'/admin/email-templates/edit/'.$link['id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit Template"><i class="far fa-edit"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>

                        <div class="mt-4">
                            <?php echo $pageLinks; ?>
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