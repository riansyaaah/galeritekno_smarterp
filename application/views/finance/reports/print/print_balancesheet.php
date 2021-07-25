<html>  
<style>
    table.first {
        color: #003300;
        font-family: arial;
        font-size: 6pt;
    }
    /* Clearfix (clear floats) */
    row::after {
        content: "";
        clear: both;
        display: table;
    }
    * {
        font-size: 8pt;
    }
    .total {
        border-top: 0.1pt solid black;
        border-bottom: 0.1pt solid black;
    }
</style>
 <body>
    <table> 
        <tr>
            <td>
                <table  class="row" cellpadding="3">
                    <?php $totalKiri = 0;
                    foreach ($list_balancesheetkiri as $row) : ?>
                        <tr bgcolor="#ffffff">
                            <td style="width: 70%"><b><?= $row['AccountName']; ?></b></td>
                            <td align="right" style="width: 30%"></td>
                        </tr>
                        <?php foreach($row['group'] as $group) : ?>
                            <tr bgcolor="#ffffff">
                                <td><b><?= $group['AccountName']; ?></b></td>
                                <td align="right"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <?php
                                    
                                    $balance = (intval($sgroup['opendebit']) + intval($sgroup['mutasidebit'])) - (intval($sgroup['opencredit']) + intval($sgroup['mutasicredit']));
                                   
                                    if(strlen($sgroup['nourut']) == 6) {
                                        $totalKiri += $balance;
                                    }
                                ?>
                                <tr bgcolor="#ffffff">
                                    <td><?= $sgroup['AccountName']; ?></td>
                                    <td align="right" class="><?= (strlen($sgroup['nourut']) == 6)? 'total' : ''; ?>"><?= number_format(intval($balance), 0, ",", "."); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </td>
            <td>
                <table class="row" cellpadding="3">
                    <?php $totalKanan = 0;
                    foreach ($list_balancesheetkanan as $row) : ?>
                        <tr bgcolor="#ffffff">
                            <td style="width: 70%"><b><?= $row['AccountName']; ?></b></td>
                            <td align="right" style="width: 30%"><?= ($row['level'] != 'TYPE')?number_format(intval($balance), 0, ",", ".") : ''; ?></td>
                        </tr>
                        <?php foreach($row['group'] as $group) : ?>
                            <tr bgcolor="#ffffff">
                                <td><b><?= $group['AccountName']; ?></b></td>
                                <td align="right"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <?php
                                   
                                        $balance = (intval($sgroup['opencredit']) + intval($sgroup['mutasicredit'])) - (intval($sgroup['opendebit']) + intval($sgroup['mutasidebit']));
                                    if(strlen($sgroup['nourut']) == 6) {
                                        $totalKanan += $balance;
                                    }
                                ?>
                                <tr bgcolor="#ffffff">
                                    <td><?= $sgroup['AccountName']; ?></td>
                                    <td align="right" class="><?= (strlen($sgroup['nourut']) == 6)? 'total' : ''; ?>"><?= ($sgroup['level'] != 'TYPE')?number_format(intval($balance), 0, ",", ".") : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; 
                    foreach ($list_balancesheetkanan2 as $row) : ?>
                        <tr bgcolor="#ffffff">
                            <td style="width: 70%"><b><?= $row['AccountName']; ?></b></td>
                            <td align="right" style="width: 30%"><?= ($row['level'] != 'TYPE')?number_format(intval($balance), 0, ",", ".") : ''; ?></td>
                        </tr>
                        <?php foreach($row['group'] as $group) : ?>
                            <tr bgcolor="#ffffff">
                                <td><b><?= $group['AccountName']; ?></b></td>
                                <td align="right"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <?php
                                   
                                        $balance = (intval($sgroup['opencredit']) + intval($sgroup['mutasicredit'])) - (intval($sgroup['opendebit']) + intval($sgroup['mutasidebit']));
                                    if(strlen($sgroup['nourut']) == 6) {
                                        $totalKanan += $balance;
                                    }
                                ?>
                                <tr bgcolor="#ffffff">
                                    <td><?= $sgroup['AccountName']; ?></td>
                                    <td align="right" class="><?= (strlen($sgroup['nourut']) == 6)? 'total' : ''; ?>"><?= ($sgroup['level'] != 'TYPE')?number_format(intval($balance), 0, ",", ".") : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr><tr><td><br><br></td></tr>
        <tr>
            <td>
                <table cellpadding="3">
                    <tr>
                        <td style="width: 70%"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL ASET / AKTIVA</b></td>
                        <td align="right" class="total" style="width: 30%"><?= number_format(intval($totalKiri), 0, ",", "."); ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table cellpadding="3">
                    <tr>
                        <td style="width: 70%"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL  HUTANG / LIABILITY</b></td>
                        <td align="right" class="total" style="width: 30%"><?= number_format(intval($totalKanan), 0, ",", ".") ; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>