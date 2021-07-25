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
    <p>&nbsp;&nbsp;No Transaksi&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['noTransaction']; ?><br>
        Tanggal Masuk&nbsp;: <?= $dataPrint['tglTransaction']; ?><br>
        Surat Jalan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['suratJalan']; ?><br>
        No PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['noPo']; ?><br>
        Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['nama']; ?><br>
        Kode Supplier&nbsp;&nbsp;: <?= $dataPrint['kode']; ?><br>
        Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['email']; ?><br>
        No. Telp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['telp']; ?><br>
        CP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['cp']; ?><br>
        Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $dataPrint['alamat']; ?>
    </p>
    <table style="width: 100% !important;" cellpadding="3">
        <tr>
            <th class="fwBold text-center" style="width: 5%;">No</th>
            <th class="fwBold text-center" style="width: 30%;">Nama Item</th>
            <th class="fwBold text-center" style="width: 10%;">Unit</th>
            <th class="fwBold text-center" style="width: 12.5%;">Harga Satuan</th>
            <th class="fwBold text-center" style="width: 10%;">Jumlah</th>
            <th class="fwBold text-center" style="width: 10%;">Jumlah Aktual</th>
            <th class="fwBold text-center" style="width: 10%;">Kondisi</th>
            <th class="fwBold text-center" style="width: 12.5%;">Total</th>
        </tr>
        <?php foreach($dataPrint['details'] as $detail) : ?>
            <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= $detail['itemmaster']; ?></td>
                <td class="text-center"><?= $detail['unit']; ?></td>
                <td class="text-right"><?= number_format($detail['harga_satuan'], 0, ',', '.'); ?></td>
                <td class="text-center"><?= $detail['jumlah']; ?></td>
                <td class="text-center"><?= $detail['jumlah_act']; ?></td>
                <td class="text-center"><?= $detail['kondisimasuk']; ?></td>
                <td class="text-right"><?= number_format($detail['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="fwBold">
            <td colspan="7" class="text-center">Total</td>
            <td class="text-right"><?= number_format($dataPrint['totTotal'], 0, ',', '.'); ?></td>
        </tr>
    </table>
</html>