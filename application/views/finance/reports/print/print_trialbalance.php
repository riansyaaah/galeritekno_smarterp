<html>  
    <style media="print">
        table.first {
            color: #003300;
            font-family: arial;
            font-size: 6pt;
            padding: 4pt;
        }
        th {
            border: 0.5px solid black;
            font-weight: bold;
            text-align: center;
        }
        td {
            border: 0.5px solid black;
            text-align: right;
            width: 11%;
        }
        tr {
            background-color: #ffffff;
        }
        .subJudul th {
            width: 11%;
        }
        .judul th {
            width: 22%
        }
    </style>
    <div class="container">
        <table class="first">
            <tr class="judul">  
                <th rowspan="2" style="width: 34%">Description</th>
                <th colspan="2">Opening Balance</th>
                <th colspan="2">Mutation</th>
                <th colspan="2">Close Balance</th>
            </tr>  
            <tr class="subJudul">
                <th>Debit</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
            <?php foreach($list_trialbalance as $row) : ?>
                <tr style="font-weight: <?= ($row['total'] == 1)? 'bold' : '400'; ?>; font-size: <?= ($row['level'] == 'MASTER')? '5.5' : '6'; ?>px">
                    <td style="text-align: left; width: 34%;"><?= $row['description']; ?></td>
                    <td><?= $row['opendebit'] ?></td>
                    <td><?= $row['opencredit'] ?></td>
                    <td><?= $row['mutasidebit'] ?></td>
                    <td><?= $row['mutasicredit'] ?></td>
                    <td><?= $row['closedebit'] ?></td>
                    <td><?= $row['closecredit'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</html>