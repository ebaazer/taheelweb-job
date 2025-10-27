<?php
$this->db->select("a.*");
$this->db->from("privacy a");
$this->db->where("a.active", 1);
$this->db->where("a.active", 1);
$this->db->order_by('id', 'DESC');
$this->db->limit(1);
$privacy_array = $this->db->get()->row();
?>
<div class="return-and-exchange-pages pt-100 mb-100">
    <div class="container">
        <div class="row">


            <div class="col-lg-12 ">
                <div class="update-date">
                    <h6><i class="bi bi-caret-right-fill"></i> <?php
                        $date_privacy = explode(" ", $privacy_array->last_update);
                        $version_privacy = 'VPR' . substr($date_privacy[0], 2, 2) . $privacy_array->id;

                        echo $this->lang->line('version');
                        ?>
                    </h6>
                    <p>
                        <?php
                        echo $version_privacy;
                        ?>
                    </p>
                </div>
                <div class="update-date mb-30">
                    <h6><i class="bi bi-caret-right-fill"></i>
                        <?php
                        echo $this->lang->line('last_updated');
                        ?></h6>
                    <p>
                        <?php
                        echo $date_privacy[0];
                        ?>
                    </p>
                </div>                
            </div>            


            <div class="col-lg-12 mb-40">
                <div class="return-and-exchange">
                    <?php
                    echo $privacy_array->privacy
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>