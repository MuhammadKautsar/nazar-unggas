<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file-text"></i> Laporan
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- <div class="col-xs-12 text-left">
                <h4>Filter</h4>
            </div> -->
            <?php
                if($le_vel != 1)
                {
            ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <a class="btn btn-primary" target="_blank" href="<?php echo base_url('laporan/pdf') ?>?tahun=<?php echo $tahun_selected ?>&periode=<?php echo $periode_selected ?>&minggu=<?php echo $minggu_selected ?>"><i class="fa fa-print"></i> Cetak Laporan</a>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="col-xs-12 text-left">
                <form action="<?php echo base_url(); ?>laporan/filter" method="POST">
                <?php
                    if($le_vel == 1)
                    {
                ?>
                <div class="col-md-1">
                        <label for="tahun">Tahun :</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <!-- <label for="tahun">Tahun :</label> -->
                        <select class="form-control required" id="tahun" name="tahun">
                            <option value="">-Pilih-</option>
                            <?php
                                foreach ($tahun as $row)
                                {
                                    ?>
                                        <option value="<?= $row->tahun ?>" <?= $row->tahun == $tahun_selected ? 'selected' : '' ?>><?= $row->tahun ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="col-md-1">
                        <label for="tahun">Periode :</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <!-- <label for="tahun">Periode :</label> -->
                        <select class="form-control required" id="periode" name="periode">
                            <option value="">-Pilih-</option>
                            <?php
                                foreach ($periode as $rc)
                                {
                                    ?>
                                        <option value="<?= $rc->periode ?>" <?= $rc->periode == $periode_selected ? 'selected' : '' ?>><?= $rc->periode ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                        <label for="tahun">Minggu :</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <!-- <label for="tahun">Minggu :</label> -->
                        <select class="form-control required" id="" name="minggu">
                            <option value="">-Pilih-</option>
                            <?php
                                foreach ($minggu as $rc)
                                {
                                    ?>
                                        <option value="<?= $rc->minggu ?>" <?= $rc->minggu == $minggu_selected ? 'selected' : '' ?>><?= $rc->minggu ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Filter</button>
                <a class="btn btn-default" href="<?php echo base_url(); ?>laporan">Reset</a>
                </form>
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
                    <!-- <div class="box-tools">
                        <form action="<?php echo base_url() ?>periode/periodeListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div> -->
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
                    <?php $i = 1; ?>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
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
                    <!-- <?php echo $this->pagination->create_links(); ?> -->
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
