<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file-text"></i> Laporan
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <?php
                if($le_vel != 1)
                {
                ?>
                    <a class="btn btn-primary" target="_blank" href="<?php echo base_url(); ?>laporan/pdf"><i class="fa fa-print"></i> Cetak Laporan</a>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Laporan</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>periode/periodeListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Umur</th>
                        <th>Ayam mati</th>
                        <th>Ayam afkir</th>
                        <th>Pakan (sak)</th>
                        <th>Berat ayam</th>
                        <th>Periode</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->iddata ?></td>
                        <td><?php echo $record->tanggal ?></td>
                        <td><?php echo $record->umur ?></td>
                        <td><?php echo $record->ayam_mati ?></td>
                        <td><?php echo $record->afkir ?></td>
                        <td><?php echo $record->pakan ?></td>
                        <td><?php echo $record->berat_ayam ?></td>
                        <td><?php echo $record->periode_id ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "booking/bookingListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
