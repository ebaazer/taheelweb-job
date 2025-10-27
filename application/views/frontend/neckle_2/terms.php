<?php
$this->db->select("a.*");
$this->db->from("terms a");
$this->db->where("a.active", 1);
$this->db->order_by('id', 'DESC');
$this->db->limit(1);
$terms_array = $this->db->get()->row();
?>
<div class="return-and-exchange-pages pt-100 mb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="update-date">
                    <h6><i class="bi bi-caret-right-fill"></i> <?php
                        $date_terms = explode(" ", $terms_array->last_update);
                        $version_terms = 'VTE' . substr($date_terms[0], 2, 2) . $terms_array->id;

                        echo $this->lang->line('version');
                        ?>
                    </h6>
                    <p>
                        <?php
                        echo $version_terms;
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
                        echo $date_terms[0];
                        ?>
                    </p>
                </div>                
            </div>
            <div class="col-lg-12 mb-40">
                <div class="return-and-exchange">
                    <?php
                    echo $terms_array->terms
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>