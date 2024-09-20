<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<style>
    #example2_info.dataTables_info {
        font-size: 14px;
    }

    .dataTables_paginate {
        float: right;margin-top:-20px
    }
    @media (min-width:640px){
        #div_prod{height:100px;}
    }
    @media (min-width: 760px) {
        #div_prod{height:50px;}
    }

    @media (min-width: 880px) {
        #div_prod{height:50px;}

    }
    @media (min-width: 920px) {
        #div_prod{height:50px;}
    }
    table#example2.dataTable tbody tr:hover {
        background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
    }

    table#example2.dataTable tbody tr:hover > .sorting_1 {
        background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
    }
</style>

<?php $url = base_url('berita/create_json_all/'); ?>
<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div id="div_prod" class="panel-heading" style="background-color: #45678d;color:#fff;border-bottom:3px solid #fcfcfc;">
        <div class="col-md-12" id="noperaturan-colomn" style="padding-bottom: 10px">
            <div class="row">
                <div class="col-md-6 text-bold">
                    <label style="color: #fff;margin-top:10px;margin-left:10px">Index Berita</label>
                </div>
                
            </div>
        </div>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="div_produk_hukum" role="tabpanel" aria-labelledby="tab1">
                <!-- Single Blog Post -->
                <table id="example2" class="table table-bordered	 table-striped"  width="100%" border=0> 
                    <thead style="display:none"><tr><td></td></tr></thead>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').DataTable({
            'ordering': false,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bLengthChange": false,
            "ajax": {
                "url": "<?php echo $url; ?>",
                "dataType": "json",
                "data":{ "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
                "type": "POST"
            },
            "columns": [
                {"data": "data"}
                ]

        });



    });


</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery-1.13.16.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.1.13.16.min.js"></script>

