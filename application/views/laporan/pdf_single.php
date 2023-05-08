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
    <h1>Laporan</h1>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Umur</th>
            <th>Ayam mati</th>
            <th>Ayam afkir</th>
            <th>Pakan (sak)</th>
            <th>Jumlah</th>
            <th>Berat ayam</th>
            <th>Periode</th>
        </tr>
        <?php $i = 1; ?>
        <?php
        if(!empty($record))
        {
        ?>
        <tr>
            <td><?php echo $record->iddata ?></td>
            <td><?php echo $record->tanggal ?></td>
            <td><?php echo $record->umur ?></td>
            <td><?php echo $record->ayam_mati ?></td>
            <td><?php echo $record->afkir ?></td>
            <td><?php echo $record->pakan ?></td>
            <td><?php echo $record->ayam_mati + $record->afkir + $record->pakan ?></td>
            <td><?php echo $record->berat_ayam ?></td>
            <td><?php echo $record->periode_id ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>