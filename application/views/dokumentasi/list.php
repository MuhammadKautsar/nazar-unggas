<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calendar"></i> Dokumentasi
        <!-- <small>Tambah, Ubah, Hapus</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <?php
                if($is_admin == 1)
                {
                ?>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>periode/add"><i class="fa fa-print"></i> Cetak Dokumentasi</a>
                <?php
                } else {
                ?>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>dokumentasi/add"><i class="fa fa-plus"></i> Tambah</a>
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
                    <h3 class="box-title">List Dokumentasi</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>dokumentasi/dokumentasiListing" method="POST" id="searchList">
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
                    <?php
                    if($is_admin == 1)
                    {
                    ?>
                        <th class="text-center">No</th>
                        <th class="text-center">Jumlah DOC</th>
                        <th class="text-center">Jumlah panen</th>
                        <th class="text-center">Tanggal mulai</th>
                        <th class="text-center">Tanggal panen</th>
                        <th class="text-center">Sisa pakan</th>
                        <th class="text-center">Berat ayam</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Biaya operasional</th>
                    <?php
                    } else {
                    ?>
                        <th class="text-center">No</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Jumlah DOC</th>
                        <th class="text-center">Jumlah panen(kg)</th>
                        <th class="text-center">Tanggal mulai</th>
                        <th class="text-center">Tanggal panen</th>
                        <th class="text-center">Sisa pakan(sak)</th>
                        <th class="text-center">Berat ayam</th>
                        <th class="text-center">Biaya operasional</th>
                        <th class="text-center">Aksi</th>
                    <?php
                    }
                    ?>
                </div>
                    </tr>
                    <?php $i = 1; ?>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                        <?php
                        if($is_admin == 1)
                        {
                        ?>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-center"><?php echo $record->iddokumentasi ?></td>
                        <td class="text-center"><?php echo $record->iddokumentasi ?></td>
                        <td class="text-center"><?php echo $record->jumlah_panen ?></td>
                        <td class="text-center"><?php echo $record->jumlah_panen ?></td>
                        <td class="text-center"><?php echo $record->tgl_panen ?></td>
                        <td class="text-center"><?php echo $record->sisa_pakan ?></td>
                        <td class="text-center"><?php echo $record->berat_ayam ?></td>
                        <td class="text-center"><?php echo $record->jumlah_biaya ?></td>
                        <?php
                        } else {
                        ?>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-center"><?php echo $record->iddokumentasi ?></td>
                        <td class="text-center"><?php echo $record->iddokumentasi ?></td>
                        <td class="text-center"><?php echo $record->jumlah_panen ?></td>
                        <td class="text-center"><?php echo $record->jumlah_panen ?></td>
                        <td class="text-center"><?php echo $record->tgl_panen ?></td>
                        <td class="text-center"><?php echo $record->sisa_pakan ?></td>
                        <td class="text-center"><?php echo $record->berat_ayam ?></td>
                        <td class="text-center"><?php echo $record->jumlah_biaya ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'dokumentasi/edit/'.$record->iddokumentasi; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('dokumentasi/delete/'.$record->iddokumentasi); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                        </td>
                        <?php
                        }
                        ?>
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
