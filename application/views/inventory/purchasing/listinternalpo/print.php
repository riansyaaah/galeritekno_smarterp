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
    <p>
        <span class="fwBold">No. Purchase Order :</span> <?= $data['noPO']; ?><br>
        <span class="fwBold">Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> <?= $data['tglPO']; ?>
    </p>
    <section>
        <table style="width: 100% !important;" cellpadding="3">
            <tr>
                <th class="fwBold text-center" style="width: 10%;">No</th>
                <th class="fwBold text-center" style="width: 50%;">Nama Item</th>
                <th class="fwBold text-center" style="width: 20%;">Unit</th>
                <th class="fwBold text-center" style="width: 20%;">Jumlah</th>
            </tr>
            <?php if(count($data['details']) > 0) : ?>
                <?php foreach($data['details'] as $detail) : ?>
                    <tr>
                        <td class="text-center"><?= $detail['no']; ?></td>
                        <td><?= $detail['namaItem']; ?></td>
                        <td class="text-center"><?= $detail['satuan']; ?></td>
                        <td class="text-center"><?= $detail['jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">~ Data Kosong ~</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</html>