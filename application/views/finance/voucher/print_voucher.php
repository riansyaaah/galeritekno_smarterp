<html>
    <style>
        * {
            font-size: 8pt;
        }
        table {
            width: 100%;
        }
        th, td {
            border: 1px solid black;
        }
        table tr th {
            font-weight: bold;
        }
        .rtTengah {
            text-align: center;
        }
        .rtKanan {
            text-align: right;
        }
        .rtKiri {
            text-align: left;
        }
        .gundul {
            border: none;
        }
        .ttd {
            height: 50px;
        }
    </style>
    <p>Date<?= $date; ?>
        <br>Voucher No<?= $voucher; ?>
        <br>Ledger<?= $ledger; ?>
        <br>Account<?= $account; ?>
        <br>Pay To<?= $payTo; ?>
        <br>Total<?= $totalAmount; ?>
    </p>
    <table>
        <tr>
            <th class="rtTengah" style="width: 7%">No</th>
            <th class="rtTengah" style="width: 59%">Description</th>
            <th class="rtTengah" style="width: 17%">Account</th>
            <th class="rtTengah" style="width: 17%">Amount</th>
        </tr>
        <?php $i = 1;
        foreach($items as $item) : ?>
            <tr>
                <td class="rtTengah"><?= $i++ ?></td>
                <td><?= $item->Description; ?></td>
                <td><?= $item->AccountNo; ?></td>
                <td class="rtKanan"><?=  number_format($item->Debit, 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><br><br>
    <table>
        <tr>
            <th style="width: 27%;" class="rtTengah">Approved By</th>
            <th style="width: 9.5%;" class="gundul rtTengah"></th>
            <th style="width: 27%;" class="rtTengah">Prepared By</th>
            <th style="width: 9.5%;" class="gundul rtTengah"></th>
            <th style="width: 27%;" class="rtTengah">Requested By</th>
        </tr>
        <tr>
            <td class="ttd"></td>
            <td class="ttd gundul"></td>
            <td class="ttd"></td>
            <td class="ttd gundul"></td>
            <td class="ttd"></td>
        </tr>
    </table>
</html>