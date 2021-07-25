<html>
    <style>
        * {
            font-size: 8pt;
        }
        .border {
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
    <section>
        <br><br>
        <table style="width: 100% !important;">
            <tr>
                <td style="width: 22%;">No. Internal Purchase Order</td>
                <td>: <?= $data['noPO']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= $data['tglPO']; ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: <?= $data['namaLengkap']; ?></td>
            </tr>
            <tr>
                <td>Posisi</td>
                <td>: <?= $data['position']; ?></td>
            </tr>
            <tr>
                <td>Department</td>
                <td>: <?= $data['department']; ?></td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100% !important;" cellpadding="3">
            <tr>
                <th class="fwBold text-center border" style="width: 10%;">No</th>
                <th class="fwBold text-center border" style="width: 60%;">Nama Item</th>
                <th class="fwBold text-center border" style="width: 15%;">Unit</th>
                <th class="fwBold text-center border" style="width: 15%;">Jumlah</th>
            </tr>
            <?php if(count($data['details']) > 0) : ?>
                <?php foreach($data['details'] as $detail) : ?>
                    <tr>
                        <td class="text-center border"><?= $detail['no']; ?></td>
                        <td class="border"><?= $detail['namaItem']; ?></td>
                        <td class="text-center border"><?= $detail['satuan']; ?></td>
                        <td class="text-center border"><?= $detail['jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center border">~ Data Kosong ~</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</html>