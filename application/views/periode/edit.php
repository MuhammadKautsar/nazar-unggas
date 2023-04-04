<?php
$periodeId = $periodeInfo->idperiode;
$tanggal_mulai = $periodeInfo->tanggal_mulai;
$jumlah_doc = $periodeInfo->jumlah_doc;
$status = $periodeInfo->status;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calendar"></i> Periode
        <small>Ubah</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Periode</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>periode/editPeriode" method="post" id="editPeriode" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control required">
                                            <option value="Aktif"<?php if ($status == 'Aktif') { echo ' selected="selected"'; } ?>>Aktif</option>
                                            <option value="Selesai"<?php if ($status == 'Selesai') { echo ' selected="selected"'; } ?>>Selesai</option>
                                        </select>
                                        <input type="hidden" value="<?php echo $periodeId; ?>" name="idperiode" id="periodeId" />
                                        <!-- <input type="hidden" value="<?php echo $tanggal_mulai; ?>" name="tanggal_mulai" id="tanggal_mulai" />
                                        <input type="hidden" value="<?php echo $jumlah_doc; ?>" name="jumlah_doc" id="jumlah_doc" /> -->
                                    </div>
                                </div>
                            </div>
                        </div>

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
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
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