<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <i class="fa fa-file-text"></i> Data Harian
        <small>Tambah</small>
      </h1>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Data Harian</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addDataHarian" action="<?php echo base_url() ?>dataHarian/addNewDataHarian" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="minggu_ke">Minggu ke</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('minggu_ke'); ?>" id="minggu_ke" name="minggu_ke" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('tanggal'); ?>" id="tanggal" name="tanggal" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="umur">Umur Ayam</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('umur'); ?>" id="umur" name="umur" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ayam_mati">Ayam Mati</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('ayam_mati'); ?>" id="ayam_mati" name="ayam_mati" maxlength="256" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="afkir">Afkir</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('afkir'); ?>" id="afkir" name="afkir" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pakan">Pakan (sak)</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('pakan'); ?>" id="pakan" name="pakan" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="berat_ayam">Berat Ayam</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('berat_ayam'); ?>" id="berat_ayam" name="berat_ayam" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_id">Periode</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('periode_id'); ?>" id="periode_id" name="periode_id" maxlength="256" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
    </section>
    
</div>