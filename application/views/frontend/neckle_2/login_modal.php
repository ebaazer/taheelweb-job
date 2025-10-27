<?php
$get_coursesId = $this->session->userdata('coursesId');
$this->session->set_userdata('coursesId', '');

if ($get_coursesId > 0 || $get_coursesId != null) {
    $get_coursesId;
} else {
    $get_coursesId = 0;
}
?>
<!-- logIn Modals -->
<div class="modal signUp-modal two fade" id="logInModal01" tabindex="-1" aria-labelledby="logInModal01Label"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="login-wrapper">
                    <div class="login-img">
                        <img src="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/home2/login-img-2.png" alt="">
                        <!--
                        <div class="logo">
                            <a href="#">
                                <img src="assets/frontend/master/rtl/assets/img/logo.svg" alt="">
                            </a>
                        </div>
                        -->
                    </div>
                    <div class="login-content">
                        <div class="login-header">
                            <h4 class="modal-title" id="logInModal01Label"><?php echo $this->lang->line('log_in'); ?></h4>
                            <p>
                                <?php echo $this->lang->line('dont_have_any_account'); ?> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#signUpModal01">
                                    <?php echo $this->lang->line('sign_up'); ?>
                                </button>
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>

                        <form id="form_log_in" method="POST">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="form-inner"> 
                                        <label><?php echo $this->lang->line('enter_your_email_address'); ?>*</label>
                                        <input type="email" id="email_sign" name="email_sign" placeholder="<?php echo $this->lang->line('type_email'); ?>">
                                        <div class="fv-plugins-message-container" style="color: red;" id="email_sign-group"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner"> 
                                        <label><?php echo $this->lang->line('password'); ?>*</label>
                                        <input id="password_sign" name="password_sign" type="password" placeholder="******">
                                        <div class="fv-plugins-message-container" style="color: red;" id="password_sign-group"></div>
                                        <!-- <i class="bi bi-eye-slash" id="togglePassword3"></i> -->
                                    </div>
                                </div>

                                <input id="coursesId_sign" name="coursesId_sign" value="<?php echo $get_coursesId; ?>" type="hidden">

                                <!--
                                <div class="col-lg-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input type="checkbox" id="html">
                                            <label for="html"><?php echo $this->lang->line('forget_password'); ?></label>
                                        </div>
                                        <a href="#" class="forgot-pass"><?php echo $this->lang->line('forget_password'); ?></a>
                                    </div>
                                </div>
                                -->

                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <button class="primary-btn2" type="submit">
                                            <?php echo $this->lang->line('log_in'); ?>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <!--
                            <ul class="social-icon">
                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/home1/icon/google.svg" alt=""></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/home1/icon/facebook.svg" alt=""></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/home1/icon/twiter.svg" alt=""></a></li>
                            </ul>
                            -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#form_log_in").submit(function (event) {

        var formData = {
            email_sign: $("#email_sign").val(),
            password_sign: $("#password_sign").val(),
        };
        //console.log(formData);
        //alert(formData);
        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>home/login_user_web/",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {

            console.log(data);
            //alert(data);

            if (!data.success) {
                if (data.errors.email_sign) {
                    $("#email_sign-group").addClass("has-error");
                    document.getElementById("email_sign-group").innerHTML = data.errors.email_sign;
                } else {
                    document.getElementById("email_sign-group").innerHTML = "";
                }

                if (data.errors.password_sign) {
                    $("#password_sign-group").addClass("has-error");
                    document.getElementById("password_sign-group").innerHTML = data.errors.password_sign;
                } else {
                    document.getElementById("password_sign-group").innerHTML = "";
                }

            } else {
                console.log('sssss');
                window.location.replace("<?php echo base_url(); ?>home/user_web_dashboard");
            }
        });
        event.preventDefault();
    });
</script>
