
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
                                        $cc_name = $this->db->get_where('courses', array('id' => $cc_data_user_web_row['course_id']))->row()->name;
                                    }
                                    ?>
                                    <h6><?php echo $this->lang->line('certificate_No'); ?>  : 
                                        <?php
                                        if ($cc_data_user_web_row['issuing_certificate'] == 0) {
                                            echo $this->lang->line('not_released_yet');
                                        } else {
                                            echo $cc_data_user_web_row['certificate_number'];
                                        }
                                        ?>

                                    </h6>
                                    <h6><?php echo $this->lang->line('date_issue'); ?>  : 
                                        <?php
                                        if ($cc_data_user_web_row['issuing_certificate'] == 0) {
                                            echo $this->lang->line('not_released_yet');
                                        } else {
                                            echo $date_cc_exp['0'];
                                        }
                                        ?>          
                                    </h6>
                                    <h6><?php echo $this->lang->line('name'); ?>  : <?php echo $cc_data_user_web_row['name']; ?> </h6>
                                    <h6><?php echo $this->lang->line('course'); ?>  : <?php echo $cc_name; ?> </h6>                                    

                                    <div class="content-btm">
                                        <div class="price">
                                            <div class="button-group" style=" padding-top: 10px;">

                                                <?php if ($cc_data_user_web_row['issuing_certificate'] == 0) { ?>
                                                    <button class="primary-btn6" onclick="no_permissions()" >
                                                        <?php echo $this->lang->line("open"); ?>
                                                    </button>
                                                <?php } else { ?>
                                                    <a target="_blank" class="primary-btn6" href="<?php echo base_url(); ?>home/open_verify_certificate/<?php echo $cc_data_user_web_row['encrypt_thread']; ?>">
                                                        <?php echo $this->lang->line("open"); ?>
                                                    </a>
                                                <?php }
                                                ?>
                                            </div>  
                                        </div>
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

<script type="text/javascript">
    function no_permissions() {
        Swal.fire("", "<?php echo $this->lang->line('not_released_yet'); ?>", "warning");
    }
</script>