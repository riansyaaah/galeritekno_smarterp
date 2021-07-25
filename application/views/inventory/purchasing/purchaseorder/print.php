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
        <p>SPEEDLAB - LENTERA HEALTHCARE<br>JL. Kemang Raya no. 81B Jakarta Selatan<br>021-22905888<br>NPWP : 80.384.970.2-721.000</p>
        <h1 style="font-size: 17px;" class="text-center fwBold"><span class="text-right" style="font-size: 7px; font-weight: normal;">Rev : <?= $data['rev']; ?></span><br>Purchase Order<br><span style="font-size: 9px;"><?= $data['noPO']; ?></span></h1>
        <table class="fullWidth">
            <tr>
                <td>
                    <table class="fullWidth">
                        <tr>
                            <td style="width: 30%;">Tanggal</td>
                            <td>: <?= date('Y-m-d', $data['tglPO']); ?></td>
                        </tr>
                        <tr>
                            <td>Tipe PO</td>
                            <td>:</td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
        </table>
        <br><br>
        <table class="fullWidth" cellpadding="0">
            <tr>
                <td>
                    <table class="fullWidth">
                        <tr>
                            <td style="width: 30%;">TO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Vendor Name</td>
                            <td>: <?= $data['namaVendor']; ?></td>
                        </tr>
                        <tr>
                            <td>Vendor Address</td>
                            <td>: <?= $data['alamatVendor']; ?></td>
                        </tr>
                        <tr>
                            <td>Vendor Phone/Fax</td>
                            <td>: <?= $data['tlpVendor']; ?></td>
                        </tr>
                        <tr>
                            <td>Contact Person</td>
                            <td>: <?= $data['cpVendor']; ?></td>
                        </tr>
                        <tr>
                            <td>Incoterms</td>
                            <td>: </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td style="width: 30%;"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>PO Priority</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Quotation No.</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Branch/Jobsite</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Storage Location</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Transporter</td>
                            <td>: </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br><br>
        <table class="fullWidth" cellpadding="3">
            <tr class="text-center">
                <th class="fwBold border" style="width: 5%;">No</th>
                <th class="fwBold border" style="width: 30%;">Nama Item</th>
                <th class="fwBold border" style="width: 10%;">QTY</th>
                <th class="fwBold border" style="width: 10%;">UOM</th>
                <th class="fwBold border" style="width: 15%;">Harga Satuan</th>
                <th class="fwBold border" style="width: 10%;">Total Diskon</th>
                <th class="fwBold border" style="width: 10%;">Total Harga</th>
                <th class="fwBold border" style="width: 10%;">Remark</th>
            </tr>
            <?php if(count($data['details']) > 0) : ?>
                <?php foreach($data['details'] as $detail) : ?>
                    <tr>
                        <td class="text-center border"><?= $detail['no']; ?></td>
                        <td class="border"><?= $detail['itemmaster']; ?></td>
                        <td class="text-center border"><?= $detail['jumlah']; ?></td>
                        <td class="text-center border"><?= $detail['unit']; ?></td>
                        <td class="text-right border"><?= $detail['hargaSatuan']; ?></td>
                        <td class="text-right border"></td>
                        <td class="text-right border"><?= $detail['totalHarga']; ?></td>
                        <td class="text-right border"></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center border">~ Data Kosong ~</td>
                </tr>
            <?php endif; ?>
        </table>
        <br><br>
        <table class="fullWidth">
            <tr>
                <td class="border">&nbsp;&nbsp;&nbsp;Total Harga dalam Huruf :<br><br><br><span class="text-italic">&nbsp;&nbsp;&nbsp;<?= $data['terbilang']; ?> Rupiah</span></td>
                <td>
                    <table>
                        <tr>
                            <td>Mata Uang</td>
                            <td>:</td>
                            <td class="text-right">IDR</td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>:</td>
                            <td class="text-right"><?= $data['total']; ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <td>PPN</td>
                            <td>:</td>
                            <td class="text-right">0</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>Ketentuan Umum :</p>
        <ol class="text-justify" style="font-size: 7pt;">
            <li>Barang yang spesifikasinya tidak sesuai dengan pesanan, cacat atau rusak akan dikembalikan. Biaya pengembalian menjadi tanggung jawab Vendor. Dalam waktu yang sesingkat-singkatnya dan atas persetujuan dari LENTERA GROUP, Vendor akan mengirimkan barang penggantinya dengan spesifikasi yang sama atau lebih tinggi tanpa adanya tambahan biaya.</li>
            <li>Bila ditemukan ketidaksesuaian harga di Purchase Order (PO) dengan kesepakatan harga pada perjanjian atau dokumen kesepakatan sah lainnya yang dikeluarkan oleh LENTERA GROUP, harap memberitahukan kepada LENTERA GROUP sebelum pengiriman Barang. LENTERA GROUP berhak untuk melakukan klaim atas selisih harga yang sudah terjadi kapanpun dan Vendor wajib melakukan pengembalian atas selisih harga tersebut.</li>
            <li>Persetujuan untuk melakukan perubahan part number Barang yang dikirim dengan part number replacement atau interchange yang berbeda harganya dengan yang tercantum di Purchase Order (PO) harus didapatkan oleh Vendor sebelum pengiriman Barang, kecuali atas persetujuan.</li>
            <li>Ketentuan dan Kondisi lainnya mengacu pada Perjanjian atau kesepakatan sebelumnya yang masih berlaku, jika ada.</li>
            <li>Penagihan harus disertakan Purchase Order (PO) dan Tanda Terima Pengiriman Barang.</li>
        </ol>
        <br><br>
        <table class="fullWidth text-center" cellpadding="4">
            <tr class="fwBold">
                <th style="width: 30%;" class="border">Diajukan</th>
                <th style="width: 5%;"></th>
                <th style="width: 30%;" class="border">Diketahui</th>
                <th style="width: 5%;"></th>
                <th style="width: 30%;" class="border">Disetujui</th>
            </tr>
            <tr>
                <td class="border" style="height: 50px;"><br><br><br><br>General Affairs</td>
                <td></td>
                <td class="border"><br><br><br><br>Manager GA</td>
                <td></td>
                <td class="border"><br><br><br><br>Direktur GPOD</td>
            </tr>
        </table>
    </section>
</html>