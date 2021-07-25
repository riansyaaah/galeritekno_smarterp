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
        .text-justify {
            text-align: justify !important;
        }
        .fullWidth {
            width: 100% !important;
        }
        .text-italic {
            font-style: italic;
        }

    </style>
    <section>
        <table class="fwBold">
            <tr>
                <td style="width: 15%;">No Berita Acara</td>
                <td>: <?= $data['noRecommend']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= $data['tglRecommend']; ?></td>
            </tr>
        </table>
        <br><br>
        <table cellpadding="4">
            <tr>
                <td class="border text-center fwBold">Nama Penyedia Toko</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['namaToko']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Nama Produk</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['namaProduk']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Gambar Produk</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border">
                        <img src="<?= base_url('assets/images/logocoa.png'); ?>" alt="<?= $detail['gambarProduk']; ?>">
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Harga Satuan</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border text-right">Rp <?= number_format($detail['hargaSatuan'], 0, '.', ','); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Ongkos Kirim</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border text-right">Rp <?= number_format($detail['ongkir'], 0, '.', ','); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Estimasi Pengiriman</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['estimasi']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold" colspan="<?= count($data['detail'])+1; ?>">SPESIFIKASI</td>
            </tr>
            <tr>
                <td class="border text-center fwBold">Warna</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['warna']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Ukuran</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['ukuran']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Kelengkapan</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['kelengkapan']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Free Bonus</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['bonus']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="border text-center fwBold">Lokasi</td>
                <?php foreach($data['detail'] as $detail) : ?>
                    <td class="border"><?= $detail['lokasi']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td colspan="<?= count($data['detail'])+1; ?>" class="border">Rekomendasi GA :</td>
            </tr>
            <tr>
                <td colspan="<?= count($data['detail'])+1; ?>" class="border">Alasan :</td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td style="width: 30%;" class="border text-center">Diajukan<br><br><br><br><br><br>General Affairs</td>
                <td style="width: 5%;"></td>
                <td style="width: 30%;" class="border text-center">Diketahui<br><br><br><br><br><br>Manager GA</td>
                <td style="width: 5%;"></td>
                <td style="width: 30%;" class="border text-center">Disetujui<br><br><br><br><br><br>Direktur GPOD</td>
            </tr>
        </table>
    </section>
</html>