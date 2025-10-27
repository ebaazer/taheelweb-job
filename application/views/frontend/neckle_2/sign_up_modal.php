
<!-- Sign Up Modals -->
<div class="modal signUp-modal two fade" id="signUpModal01" tabindex="-1" aria-labelledby="signUpModal01Label"
     aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-wrapper">
                    <div class="login-img">
                        <img src="<?php echo base_url(); ?>assets/frontend/master/rtl/assets/img/home2/login-img-1.png" alt="">
                        <!--
                        <div class="logo">
                            <a href="#">
                                <img src="assets/img/img-logo.png" alt="">
                            </a>
                        </div>
                        -->
                    </div>
                    <div class="login-content">
                        <div class="login-header">
                            <h4 class="modal-title" id="signUpModal01Label"><?php echo $this->lang->line('signup'); ?></h4>
                            <p>
                                <?php echo $this->lang->line('already_have_an_account'); ?>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#logInModal01">
                                    <?php echo $this->lang->line('log_in'); ?>
                                </button>
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>

                        <form id="form_sign_up" method="POST">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label><?php echo $this->lang->line('name'); ?>*</label>
                                        <input type="text" id="name_sign_up" placeholder="<?php echo $this->lang->line('first_name'); ?>">
                                        <div class="fv-plugins-message-container" style="color: #9E9E9E; font-size: 12px;">
                                            <?php echo $this->lang->line('entered_issuing_certificate'); ?>
                                        </div>

                                        <div class="fv-plugins-message-container" style="color: red;" id="name_sign_up-group"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label><?php echo $this->lang->line('enter_your_email_address'); ?>*</label>
                                        <input type="email" id="email_sign_up" placeholder="<?php echo $this->lang->line('type_email'); ?>">
                                        <div class="fv-plugins-message-container" style="color: red;" id="email_sign_up-group"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-inner"> 
                                        <label><?php echo $this->lang->line('password'); ?>*</label>
                                        <input id="password_sign_up" type="password" placeholder="******">
                                        <div class="fv-plugins-message-container" style="color: red;" id="password_sign_up-group"></div>
                                        <!-- <i class="bi bi-eye-slash" id="togglePassword"></i> -->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <button class="primary-btn2" type="submit">
                                            <?php echo $this->lang->line('register'); ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="terms-conditon">
                                <p class="login-form__privacy">
                                    <?php echo $this->lang->line('by_clicking_registration'); ?>
                                    <a href="<?php echo base_url(); ?>home/terms_of_service">
                                        <?php echo $this->lang->line('terms'); ?>
                                    </a> 
                                    <?php echo $this->lang->line('and'); ?>
                                    <a href="<?php echo base_url(); ?>home/privacy_policy">
                                        <?php echo $this->lang->line('privacy_policies'); ?> 
                                    </a>.</p> 
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
    $("#form_sign_up").submit(function (event) {

        var formData = {
            name_sign_up: $("#name_sign_up").val(),
            email_sign_up: $("#email_sign_up").val(),
            password_sign_up: $("#password_sign_up").val(),
        };

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>home/submit_registration",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            //console.log(data);

            if (!data.success) {
                if (data.errors.name_sign_up) {
                    $("#name_sign_up-group").addClass("has-error");
                    document.getElementById("name_sign_up-group").innerHTML = data.errors.name_sign_up;
                } else {
                    document.getElementById("name_sign_up-group").innerHTML = "";
                }

                if (data.errors.email_sign_up) {
                    $("#email_sign_up-group").addClass("has-error");
                    document.getElementById("email_sign_up-group").innerHTML = data.errors.email_sign_up;
                } else {
                    document.getElementById("email_sign_up-group").innerHTML = "";
                }

                if (data.errors.password_sign_up) {
                    $("#password_sign_up-group").addClass("has-error");
                    document.getElementById("password_sign_up-group").innerHTML = data.errors.password_sign_up;
                } else {
                    document.getElementById("password_sign_up-group").innerHTML = "";
                }

            } else {
                window.location.replace("<?php echo base_url(); ?>home/user_web_dashboard");
            }
        });
        event.preventDefault();
    });
</script>
