<?php ?>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .errors_data{
        color: #e84c3d;
        font-weight: 600;
        font-size: 12px;
    }
</style>

<div class="inner-page-banner" style="padding: 25px 0;">
    <div class="banner-wrapper">
        <div class="container-fluid">
            <div class="banner-main-content-wrap">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 d-flex align-items-center">
                        <div class="banner-content">
                            <h4 style=" color: #ffffff;">
                                نربطك بفرص العمل المناسبة
                                <br />
                                تاهيل ويب يوصل سيرتك الذاتية إلى المؤسسات المهتمة بك.
                            </h4>
                            <ul class="breadcrumb-list">
                                <li><a href="#"><?php echo $this->lang->line("job_application_form"); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-page pt-40 mb-100" id="for_up_just">
    <div class="container">

        <div class="col-lg-7">
            <div class="inquiry-form">
                <div class="details-form-title">
                    <h4>
                        ادخل بياناتك وسنتواصل معك بأسرع وقت
                    </h4>
                </div>

                <form class="new_contact_demo" id="job_apply_for" accept-charset="UTF-8">
                    <div class="product-sidebar" style="padding: 0px; background: none;">
                        <div class="product-widget mb-20">
                            <div class="check-box-item">
                                <div class="checkbox-container">
                                    <div class="row" >

                                        <div class="col-md-12 mb-30">
                                            <div class="form-inner ">
                                                <label><?php echo $this->lang->line("The position you wish to apply for"); ?>*</label>
                                                <select style="background: #fff !important;" id="contact_apply_for">
                                                    <option value="marketing"><?php echo $this->lang->line("marketing"); ?></option>
                                                    <option value="trainer"><?php echo $this->lang->line("trainer"); ?></option>
                                                    <option value="assistant_coach"><?php echo $this->lang->line("assistant_coach"); ?></option>
                                                    <option value="receptionist"><?php echo $this->lang->line("receptionist"); ?></option>
                                                    <option value="registration_official"><?php echo $this->lang->line("registration_official"); ?></option>
                                                    <option value="customer_service"><?php echo $this->lang->line("customer_service"); ?></option>
                                                    <option value="translator"><?php echo $this->lang->line("translator"); ?></option>
                                                    <option value="graphic_designer"><?php echo $this->lang->line("graphic_designer"); ?></option>
                                                    <option value="accountant"><?php echo $this->lang->line("accountant"); ?></option>
                                                    <option value="human_resources"><?php echo $this->lang->line("human_resources"); ?></option>
                                                </select>
                                            </div>
                                        </div>                                               

                                        <div class="col-md-12">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("name"); ?>*</label>
                                                <input type="text" placeholder="" id="contact_name">
                                                <span id="e_c_name" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("phone"); ?>*</label>
                                                <input type="text" placeholder="Ex- +962-79* ** ***" id="contact_phone">
                                                <span id="e_c_phone" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("email"); ?>*</label>
                                                <input type="email" placeholder="Ex- info@gmail.com" id="contact_email">
                                                <span id="e_c_email" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("talk_about_your_self"); ?>*</label>
                                                <textarea id="contact_bio" placeholder="<?php echo $this->lang->line("talk_about_your_self"); ?>..."></textarea>
                                                <span id="e_c_bio" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-20">
                                            <div class="form-inner">
                                                <label><?php echo $this->lang->line("degree"); ?>*</label>
                                                <select style="background: #fff !important;" id="contact_degree">
                                                    <option value="bachelor"><?php echo $this->lang->line("bachelor"); ?></option>
                                                    <option value="master"><?php echo $this->lang->line("master"); ?></option>
                                                    <option value="PHD"><?php echo $this->lang->line("PHD"); ?></option>
                                                </select>
                                            </div>
                                        </div>                            

                                        <div class="col-md-6 mb-20">
                                            <div class="form-inner">
                                                <label><?php echo $this->lang->line("years_of_Experience"); ?>*</label>
                                                <select style="background: #fff !important;" id="contact_years_experience">
                                                    <option value="less_than_one_year"><?php echo $this->lang->line("less_than_one_year"); ?></option>
                                                    <option value="from_1_to_3_years"><?php echo $this->lang->line("from_1_to_3_years"); ?></option>
                                                    <option value="from_3_to_5_years"><?php echo $this->lang->line("from_3_to_5_years"); ?></option>
                                                    <option value="from_5_to_10_years"><?php echo $this->lang->line("from_5_to_10_years"); ?></option>
                                                    <option value="more_than_10_years"><?php echo $this->lang->line("more_than_10_years"); ?></option>
                                                </select>
                                            </div>
                                        </div>    

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("nationality"); ?>*</label>
                                                <input type="text" placeholder="" id="contact_nationality">
                                                <span id="e_c_nationality" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label><?php echo $this->lang->line("current_country_residence"); ?>*</label>
                                                <input type="text" placeholder="" id="contact_current_country">
                                                <span id="e_c_current_country" class="errors_data"></span>
                                            </div>
                                        </div>         

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label>تحميل السيرة الذاتية</label>
                                                <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h6 class="dropzone-msg-title">
                                                            قم بإسقاط الملفات هنا أو انقر للتحميل
                                                        </h6>
                                                    </div>

                                                </div>
                                                <span id="e_c_job_application_cv" class="errors_data"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-inner mb-30">
                                                <label>تحميل الصورة الشخصية </label>
                                                <div class="dropzone dropzone-default" id="kt_dropzone_2">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h6 class="dropzone-msg-title">
                                                            قم بإسقاط الملفات هنا أو انقر للتحميل
                                                        </h6>
                                                    </div>
                                                </div>
                                                <span id="e_c_job_application_photo" class="errors_data"></span>
                                            </div>
                                        </div>                                            

                                        <input type="hidden" name="photo" id="job_application_photo" value="" />        
                                        <input type="hidden" name="cv_t" id="job_application_cv" value="" /> 

                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-inner">
                                                    <button type="submit" class="primary-btn3"><?php echo $this->lang->line("submit"); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $('#kt_dropzone_1').dropzone({
        url: "<?php echo base_url() ?>home/add_cv_job_application_form", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        success: function (evt) {
            var response = JSON.parse(evt.xhr.responseText);
            var name = response.name;

            document.getElementById('job_application_cv').value = name;
        }
    });
</script>

<script type="text/javascript">
    $('#kt_dropzone_2').dropzone({
        url: "<?php echo base_url() ?>home/add_photo_job_application_form", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        success: function (evt) {
            var response = JSON.parse(evt.xhr.responseText);
            var name = response.name;

            document.getElementById('job_application_photo').value = name;
        }
    });
</script>

<script>
    $(document).ready(function () {

        $("#job_apply_for").submit(function (event) {
            var formData = {
                contact_apply_for: $("#contact_apply_for").val(),
                contact_name: $("#contact_name").val(),
                contact_email: $("#contact_email").val(),
                contact_phone: $("#contact_phone").val(),
                contact_bio: $("#contact_bio").val(),
                contact_degree: $("#contact_degree").val(),
                contact_years_experience: $("#contact_years_experience").val(),
                contact_nationality: $("#contact_nationality").val(),
                contact_current_country: $("#contact_current_country").val(),
                contact_training_package: $("#contact_training_package").val(),
                contact_cv_link: $("#job_application_cv").val(),
                contact_photo_link: $("#job_application_photo").val(),
            };

            //console.log(formData);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>home/submit_job_application_form",
                data: formData,
                encode: true,
            }).done(function (data) {

                obj = JSON.parse(data);

                //console.log(obj);
                if (!obj.success) {

                    if (obj.errors.contact_name) {
                        document.getElementById("e_c_name").innerHTML = obj.errors.contact_name;
                    } else {
                        document.getElementById("e_c_name").innerHTML = "";
                    }

                    if (obj.errors.contact_email) {
                        document.getElementById("e_c_email").innerHTML = obj.errors.contact_email;
                    } else {
                        document.getElementById("e_c_email").innerHTML = "";
                    }

                    if (obj.errors.contact_phone) {
                        document.getElementById("e_c_phone").innerHTML = obj.errors.contact_phone;
                    } else {
                        document.getElementById("e_c_phone").innerHTML = "";
                    }

                    if (obj.errors.contact_bio) {
                        document.getElementById("e_c_bio").innerHTML = obj.errors.contact_bio;
                    } else {
                        document.getElementById("e_c_bio").innerHTML = "";
                    }

                    if (obj.errors.contact_nationality) {
                        document.getElementById("e_c_nationality").innerHTML = obj.errors.contact_nationality;
                    } else {
                        document.getElementById("e_c_nationality").innerHTML = "";
                    }

                    if (obj.errors.contact_current_country) {
                        document.getElementById("e_c_current_country").innerHTML = obj.errors.contact_current_country;
                    } else {
                        document.getElementById("e_c_current_country").innerHTML = "";
                    }

                    if (obj.errors.job_application_cv) {
                        document.getElementById("e_c_job_application_cv").innerHTML = obj.errors.job_application_cv;
                    } else {
                        document.getElementById("e_c_job_application_cv").innerHTML = "";
                    }

                    if (obj.errors.job_application_photo) {
                        document.getElementById("e_c_job_application_photo").innerHTML = obj.errors.job_application_photo;
                    } else {
                        document.getElementById("e_c_job_application_photo").innerHTML = "";
                    }



                } else {
                    $("#job_apply_for").html(
                            '<div class="alert alert-success">شكرا لك - سنتواصل معك بأسرع وقت</div>'
                            );
                }
            });
            event.preventDefault();
            document.getElementById("for_up_just").scrollIntoView();
        });
    });
</script>