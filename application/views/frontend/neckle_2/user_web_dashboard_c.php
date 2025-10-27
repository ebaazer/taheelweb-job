
<div class="product-page pt-100 mb-100">
    <div class="container">


        <div class="row g-xl-4 gy-5">
            <div class="col-xl-3">
                <div class="product-sidebar">

                    <div class="product-widget mb-20">
                        <div class="check-box-item">
                            <h6 class="product-widget-title mb-20"> 
                                <?php echo $this->lang->line('menu') . ' ' . $this->lang->line('home'); ?>
                            </h6>
                            <div class="checkbox-container">
                                <ul class="wp-block-categoris-cloud">

                                    <!--
                                    <li>
                                        <a href="home/user_web_dashboard" class="active">
                                            <span>
                                                dashboard
                                            </span>
                                        </a>
                                    </li>
                                    -->

                                    <li>
                                        <a href="<?php echo base_url(); ?>home/user_web_dashboard_c" class="active">
                                            <span>
                                                <?php echo $this->lang->line('courses'); ?>
                                            </span>
                                        </a>
                                    </li>                                    

                                    <li>
                                        <a href="<?php echo base_url(); ?>home/user_web_dashboard" class="active">
                                            <span>
                                                <?php echo $this->lang->line('certificates'); ?>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo base_url(); ?>login/logout" class="active"><span>
                                                <?php echo $this->lang->line('sign_out'); ?>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">

                <?php
                //userweb_id
                //$this->session->userdata('userweb_id')

                $u_e = $this->db->get_where('user_web', array('user_web_id' => $this->session->userdata('userweb_id')))->row()->email;

                $this->db->select("a.*");
                $this->db->from("course_subscribers a");
                $this->db->where('email', $u_e);
                $this->db->where('active', 1);
                $cc_data_user_web = $this->db->get()->result_array();

                //print_r($cc_data_user_web);

                foreach ($cc_data_user_web as $cc_data_user_web_row) {
                    ?>

                    <div class="row g-4 mb-40">
                        <div class="col-lg-12 col-sm-6">
                            <div class="shop-card2">
                                <div class="content">
                                    <?php
                                    $date_cc_exp = explode(" ", $cc_data_user_web_row['date']);

                                    if ($cc_data_user_web_row['course_id'] == '6') {
                                        $cc_name = 'أساسيات التصوير الفوتوغرافي - مستوى مبتدئ';
                                    } else {
                                        $cc_data = $this->db->get_where('courses', array('id' => $cc_data_user_web_row['course_id']))->row();
                                        $cc_name = $cc_data->name;
                                        $cc_date = $cc_data->date_courses;
                                    }
                                    ?>
                                    <h6><?php echo $this->lang->line('course_begins_on'); ?>  : 
                                        <?php
                                        echo $cc_date;
                                        ?>                                        
                                    </h6>
                                    <h6><?php echo $this->lang->line('name'); ?>  : <?php echo $cc_data_user_web_row['name']; ?> </h6>
                                    <h6>
                                        <?php echo $this->lang->line('course'); ?>  : 
                                        <a href="<?php echo base_url(); ?>home/courses_detail/<?php echo $cc_data->encrypt_thread; ?>">
                                            <?php echo $cc_name; ?>
                                        </a>                                        
                                    </h6>                                    

                                    <h6>
                                        <a href="<?php echo $cc_data->early_payment_link; ?>">
                                        رابط دفع رسوم الدورة  : 
                                        
                                            التسجيل المبكر
                                        </a>          
                                        <br />
                                        <p style=" color: red;">
                                        ملاحظة:بعد اتمام الدفع يرجى التواصل معنا على هاتف 
                                        
                                        <br />
                                        00962-788-254746
                                        </p>
                                    </h6>                                     
                                    
                                    
                                    <div class="content-btm">
                                        <!--
                                        <div class="price">
                                            <div class="button-group" style=" padding-top: 10px;">
                                                <a target="_blank" class="primary-btn6" href="<?php echo base_url(); ?>home/open_verify_certificate/<?php echo $cc_data_user_web_row['encrypt_thread']; ?>">
                                        <?php //echo $this->lang->line("open"); ?>
                                                </a>
                                            </div>  
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>