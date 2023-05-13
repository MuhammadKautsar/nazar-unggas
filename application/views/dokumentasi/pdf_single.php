<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style type="text/css">
        .table{
            width: 100%;
            border-spacing: 0;
        }
        .table tr:first-child th,
        .table tr:first-child td{
            border-top: 1px solid #000;
        }
        .table tr:first-child th,
        .table tr:first-child td{
            border-left: 1px solid #000;
        }
        .table tr th,
        .table tr td{
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Dokumentasi</h1>
    <table class="table table-bordered">
        <tr>
        <th class="text-center">No</th>
            <th class="text-center">Jumlah DOC</th>
            <th class="text-center">Jumlah panen</th>
            <th class="text-center">Tanggal mulai</th>
            <th class="text-center">Tanggal panen</th>
            <th class="text-center">Sisa pakan</th>
            <th class="text-center">Berat ayam</th>
            <th class="text-center">Periode</th>
            <th class="text-center">Biaya operasional</th>
        </tr>
        <?php $i = 1; ?>
        <?php
        if(!empty($record))
        {
        ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td class="text-center"><?php echo $record->jumlah_doc ?></td>
            <td class="text-center"><?php echo $record->jumlah_panen ?></td>
            <td class="text-center"><?php echo $record->tanggal_mulai ?></td>
            <td class="text-center"><?php echo $record->tgl_panen ?></td>
            <td class="text-center"><?php echo $record->sisa_pakan ?></td>
            <td class="text-center"><?php echo $record->berat_ayam ?></td>
            <td class="text-center"><?php echo $record->periode_id ?></td>
            <td class="text-center">Rp <?php echo $record->jumlah_biaya ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>