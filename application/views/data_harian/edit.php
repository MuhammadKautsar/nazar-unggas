<?php
$dataHarianId = $dataHarianInfo->iddata;
$minggu_ke = $dataHarianInfo->minggu_ke;
$tanggal = $dataHarianInfo->tanggal;
$umur = $dataHarianInfo->umur;
$ayam_mati = $dataHarianInfo->ayam_mati;
$afkir = $dataHarianInfo->afkir;
$pakan = $dataHarianInfo->pakan;
$berat_ayam = $dataHarianInfo->berat_ayam;
$periode_id = $dataHarianInfo->periode_id;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file-text"></i> Data Harian
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
                        <h3 class="box-title">Masukkan Detail Data Harian</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>dataHarian/editDataHarian" method="post" id="editDataHarian" role="form">
                        <div class="box-body">
                        <div class="row">
                                <div class="col-md-6"> 
                                    <input type="hidden" value="<?php echo $dataHarianId; ?>" name="iddata" id="dataHarianId" />                               
                                    <div class="form-group">
                                        <label for="minggu_ke">Minggu ke</label>
                                        <input type="number" class="form-control required" value="<?php echo $minggu_ke; ?>" id="minggu_ke" name="minggu_ke" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control required" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="umur">Umur Ayam</label>
                                        <input type="number" class="form-control required" value="<?php echo $umur; ?>" id="umur" name="umur" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ayam_mati">Ayam Mati</label>
                                        <input type="number" class="form-control required" value="<?php echo $ayam_mati; ?>" id="ayam_mati" name="ayam_mati" maxlength="256" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="afkir">Afkir</label>
                                        <input type="number" class="form-control required" value="<?php echo $afkir; ?>" id="afkir" name="afkir" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pakan">Pakan (sak)</label>
                                        <input type="number" class="form-control required" value="<?php echo $pakan; ?>" id="pakan" name="pakan" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="berat_ayam">Berat Ayam</label>
                                        <input type="number" class="form-control required" value="<?php echo $berat_ayam; ?>" id="berat_ayam" name="berat_ayam" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_id">Periode</label>
                                        <select class="form-control required" id="periode_id" name="periode_id">
                                            <?php
                                            if(!empty($periodes))
                                            {
                                                foreach ($periodes as $pr)
                                                {
                                                    if ($pr->status == 'Aktif') {
                                                        ?>
                                                        <option value="<?php echo $pr->idperiode ?>"><?= $pr->idperiode ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
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