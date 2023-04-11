<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calendar"></i> Dokumentasi
        <small>Tambah</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Dokumentasi</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addDokumentasi" action="<?php echo base_url() ?>dokumentasi/addNewDokumentasi" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="jumlah_doc">Jumlah DOC</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('jumlah_doc'); ?>" id="jumlah_doc" name="jumlah_doc" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_panen">Jumlah Panen</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('jumlah_panen'); ?>" id="jumlah_panen" name="jumlah_panen" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('tanggal_mulai'); ?>" id="tanggal_mulai" name="tanggal_mulai" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_panen">Tanggal Panen</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('tgl_panen'); ?>" id="tgl_panen" name="tgl_panen" maxlength="256" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sisa_pakan">Sisa pakan (sak)</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('sisa_pakan'); ?>" id="sisa_pakan" name="sisa_pakan" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="berat_ayam">Berat Ayam</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('berat_ayam'); ?>" id="berat_ayam" name="berat_ayam" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_biaya">Jumlah Biaya</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('jumlah_biaya'); ?>" id="jumlah_biaya" name="jumlah_biaya" maxlength="256" />
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