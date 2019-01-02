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
test out permissions
            <h3>Add Role</h3>
             <?php if(!empty($formData['global_err'])) { ?><div class="alert alert-danger"><?php echo $formData['global_err']; ?></div><?php } ?>
            <form action="" method="post">
                            <div class="form-group">
                                <label>role name</label>
                                <input class="form-control <?php echo (!empty($formData['role_name_err'])) ? 'is-invalid' : ''; ?>" type="text" placeholder="" name="role_name" autofocus="" value="<?php echo $formData['role_name']; ?>">
                                <span class="invalid-feedback"><?php echo $formData['role_name_err']; ?></span>
                            </div>
                                    <div class="form-group">
                                <label>role desc</label>
                                <input class="form-control <?php echo (!empty($formData['role_desc_err'])) ? 'is-invalid' : ''; ?>" type="text" placeholder="" name="role_desc" autofocus="" value="<?php echo $formData['role_desc'] ?>">
                                <span class="invalid-feedback"><?php echo $formData['role_desc_err']; ?></span>
                            </div>
    <?php $this->csrf->CSRFInput() ?>
                <input name="newrole" type="hidden">
                                <button class="btn btn-sm btn-primary mr-2" data-disable-with="Adding Role..." type="submit">add role</button>
            </form>
            <hr>
  <h3>All Roles</h3>    
                                <?php if($always['getRoles'] === FALSE) { ?>
                                <div class="alert alert-warning mb-0" role="alert">
                                    <b><i class="fas fa-info-circle"></i> No Roles Found!</b>
                                </div>
                                <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-light mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($always['getRoles'] as $role) : ?>
                                            <tr>
                                                <td><?php echo $role['role_id']; ?></td>
                                                <td><?php echo $role['role_name']; ?></td>
                                                <td><?php echo (!empty($role['role_desc'])) ? $role['role_desc'] : '<small class="text-muted">N/A</small>'; ?></td>
                                                <td><?php if ($role['role_status'] === '1') { echo '<span class="badge badge-success">Active</span>'; } else { echo '<span class="badge badge-warning">Disabled</span>'; } ?></td>
                                                <td><a href="<?php echo FULL_ROOT . '/admin/roles/modify/' . $role['role_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Modify Role"><i class="far fa-edit"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                        <div class="mt-4">
                            <?php echo $always['pageLinks']; ?>
                        </div>
            
            
            
<div class="container">
    <h2 class="mt-3">jquery-upload-progress form example</h2>
    <p>This is an example for using jquery-upload progress to submit a form with multiple files input.</p>

    <form class="col-lg-6 col-md-8 col-xs-12" asp-controller="Samples" asp-action="SubmitForm" method="post">
        <div class="card mb-5">
            <div class="card-header">
                <i class="fa fa-bar-chart"></i>
                Submit your homework here
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label asp-for="Name"></label>
                    <input asp-for="Name" type="text" class="form-control" placeholder="Enter your app name...">
                    <span asp-validation-for="Name" class="text-danger"></span>
                    <small class="form-text text-muted">@Localizer["Your name will be shown when giving points."]</small>
                </div>

                <div class="form-group">
                    <label asp-for="Email"></label>
                    <input asp-for="Email" type="email" class="form-control" placeholder="Enter your email...">
                    <span asp-validation-for="Email" class="text-danger"></span>
                    <small class="form-text text-muted">@Localizer["Your email will be used to contact you."]</small>
                </div>

                <div class="input-group mb-3">
                    <label asp-for="IconAddress" class="w-100"></label>
                    <input asp-for="IconAddress" class="form-control" type="text" readonly="readonly" id="@nameof(Model.IconAddress)">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#avatarModal">
                            Upload New Avatar
                        </button>
                    </span>
                </div>
                <div class="form-group">
                    <span asp-validation-for="IconAddress" class="text-danger"></span>
                </div>
                <img class="img-fluid mb-3 d-none" id="avatar">

                <div class="input-group mb-3">
                    <label asp-for="HomeworkAddress" class="w-100"></label>
                    <input asp-for="HomeworkAddress" class="form-control" type="text" readonly="readonly" id="@nameof(Model.HomeworkAddress)">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#homeworkModal">
                            Upload your Homework
                        </button>
                    </span>
                </div>
                <div class="form-group">
                    <span asp-validation-for="HomeworkAddress" class="text-danger"></span>
                </div>
<input type="hidden" name="itemform">
                <input type="submit" class="btn btn-primary mb-5" data-disable-with="Submitting..." value="Submit" />
            </div>
        </div>
        <?php $this->csrf->CSRFInput() ?>
    </form>

    <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Avatar uploader</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-body" enctype="multipart/form-data" asp-controller="Samples" asp-action="Uploader" method="post">
                    <input type="file" name="file1" class="dropify avatar-file" data-allowed-file-extensions="png jpg bmp jpeg gif ico" data-max-file-size="30M" />
                    <input type="submit" class="btn btn-success" value="Upload" id="uploadButton" />
                    <?php $this->csrf->CSRFInput() ?>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="homeworkModal" tabindex="-1" role="dialog" aria-labelledby="homeworkModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Homework uploader</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-body" enctype="multipart/form-data" action="" method="post">
                    <input type="file" name="file" class="dropify homework-file" data-allowed-file-extensions="png jpg bmp jpeg gif zip" data-max-file-size="100M" />
                    <input type="hidden" name="itemupload1">
                    <input type="submit" class="btn btn-success" value="Upload" id="uploadButton2" />
                    <?php $this->csrf->CSRFInput() ?>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</div>
            
            <?php
$ip = '81.159.49.195';
//$details = json_decode(file_get_contents("https://ipinfo.io/{$ip}/json"));
//$details = var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));
$details = json_decode(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip), true);
$browser = $_SERVER['HTTP_USER_AGENT'];
$referrer = $_SERVER['HTTP_REFERER'];
 if ($referred == "") {
  $referrer = "This page was accessed directly";
  }
echo "<b>Visitor IP address:</b><br/>" . $ip . "<br/>";
echo "<b>Browser (User Agent) Info:</b><br/>" . $browser . "<br/>";
echo "<b>Referrer:</b><br/>" . $referrer . "<br/>";
echo "<br>";
echo "<b>Country:</b><br/>" . $details['geoplugin_countryCode']; // ->  . ;
    var_dump($details);
?>
            
            
        </section>        
    </main>
    <!-- End Page Content -->

	<!-- Footer -->
	<?php extend_view(['common/footer'], $data); ?>
	<!-- JS -->
	<?php load_script(['start/jquery-3.3.1.min', 'start/bootstrap.bundle.min', 'start/fontawesome-all.min', 'main', 'custom']); ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
         /*   var settings = {
                onFinish: function (elements, data) {
                    $('#IconAddress').val(data.value);
                    $('#avatar').attr('src', data.value);
                    $('#avatar').removeClass('d-none');
                }
            };
            $('.avatar-file').setProgressedUploader(settings);
            var settings2 = {
                onFinish: function (elements, data) {
                    $('#HomeworkAddress').val(data.value);
                    $('.avatar-file').val(data.message);
                    
                }
            }
            $('.homework-file').setProgressedUploader(settings2);
            */
            
var settings = {
    onInit: function (elements) {
        //Occurs when element loads.
    },

    onGetFile: function (elements) {
        //Occurs when user put a file in it.
    },

    onStartSubmitting: function (elements) {
        //Occurs when user is submitting the form.
    },

    onProcessing: function (elements) {
        //Occurs when all data transformed.
        $('#IconAddress').val('doing');
    },

    onFinish: function (elements, data) {
        //Occurs when server gives response.
        $('#IconAddress').val('done');
    },
    
    onError: function(e){
        //Occurs when server could not accept the file.
        $('#IconAddress').val('bad');
    }
};

//$('#file').setProgressedUploader(settings);
            $('.avatar-file').setProgressedUploader(settings);
            $('.dropify').dropify();
        });
    </script>
</body>
</html>