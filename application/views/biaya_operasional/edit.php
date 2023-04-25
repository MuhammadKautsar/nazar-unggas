<?php
$biayaOperasionalId = $biayaOperasionalInfo->idbiaya;
$tanggal = $biayaOperasionalInfo->tanggal;
$kebutuhan_id = $biayaOperasionalInfo->kebutuhan_id;
$harga = $biayaOperasionalInfo->harga;
$periode_id = $biayaOperasionalInfo->periode_id;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <i class="fa fa-money "></i> Biaya Operasional
        <small>Ubah</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Task Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>biayaOperasional/editBiayaOperasional" method="post" id="editBiayaOperasional" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">  
                                    <input type="hidden" value="<?php echo $biayaOperasionalId; ?>" name="idbiaya" id="biayaOperasionalId" /> 
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control required" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal" maxlength="256" />
                                    </div>                              
                                    <div class="form-group">
                                        <label for="kebutuhan_id">Jenis Kebutuhan</label>
                                        <select class="form-control required" id="kebutuhan_id" name="kebutuhan_id">
                                            <?php
                                            if(!empty($kebutuhans))
                                            {
                                                foreach ($kebutuhans as $kb)
                                                {
                                                    ?>
                                                    <option value="<?php echo $kb->idkebutuhan ?>" <?php if ($kebutuhan_id == $kb->idkebutuhan) { echo ' selected="selected"'; } ?>><?= $kb->nama_kebutuhan ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control required" value="<?php echo $harga; ?>" id="harga" name="harga" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_id">Periode</label>
                                        <?php
                                            if(!empty($periodes))
                                            {
                                                foreach ($periodes as $pr)
                                                {
                                                    if ($pr->status == 'Aktif') {
                                                        ?>
                                                        <input type="number" class="form-control required" value="<?php echo $pr->idperiode ?>" id="periode_id" name="periode_id" readonly />
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
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