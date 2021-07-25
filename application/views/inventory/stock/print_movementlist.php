<html>
    <style>
        * {
            font-size: 8pt;
        }
        th, td {
            border: 1pt solid black;
        }
        .fwBold {
            font-weight: bold !important;
        }
        .text-center {
            text-align: center !important;
        }
        .text-right {
            text-align: right !important;
        }
    </style>
    <br><br>
    <table style="width: 100% !important;" cellpadding="3">
        <tr>
            <th class="fwBold text-center" style="width: 5%;">No</th>
            <th class="fwBold text-center" style="width: 12%;">Tanggal</th>
            <th class="fwBold text-center" style="width: 14%;">No. Transaksi</th>
            <th class="fwBold text-center" style="width: 45%;">Nama Item</th>
            <th class="fwBold text-center" style="width: 12%;">Jumlah Masuk</th>
            <th class="fwBold text-center" style="width: 12%;">Jumlah Keluar</th>
        </tr>
        <?php foreach($datas as $data) : ?>
            <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td class="text-center"><?= $data['tglTransaction']; ?></td>
                <td class="text-center"><?= $data['noTransaction']; ?></td>
                <td><?= $data['itemmaster']; ?></td>
                <td class="text-center"><?= $data['jumlahIn']; ?></td>
                <td class="text-center"><?= $data['jumlahOut']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</html>