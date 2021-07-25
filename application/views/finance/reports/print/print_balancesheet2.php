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
    
    
</style>
 <body>
    <table> 
        <tr>
        <td><table  class="row" cellpadding="4">  
      <?php foreach ($list_balancesheetkiri as $row) {
      if($row['level'] == 'TYPE'){$dorong = "&nbsp;&nbsp;";} 
      if($row['level'] == 'GROUP'){$dorong = "&nbsp;&nbsp;&nbsp;&nbsp;";} 
      if($row['level'] == 'SGROUP'){$dorong = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} 
      if(substr($row['AccountNo'],'0','1') or substr($row['AccountNo'],'0','7')){
        $balance = (intval($row['opendebit']) + intval($row['mutasidebit'])) - (intval($row['opencredit']) + intval($row['mutasicredit']));
      }else{
        $balance = (intval($row['opencredit']) + intval($row['mutasicredit'])) - (intval($row['opendebit']) + intval($row['mutasidebit']));
      }
      ?>
      <tr bgcolor="#ffffff">
      <td><?php echo $dorong.$row['AccountName']; ?></td>
      <td align="right"><?php echo number_format(intval($balance), 0, ",", ",") ; ?></td>
    </tr>
      <?php } ?>
</table></td>
        <td><table  class="row" cellpadding="4">  
      <?php foreach ($list_balancesheetkanan as $row) {
      if($row['level'] == 'TYPE'){$dorong = "&nbsp;&nbsp;";} 
      if($row['level'] == 'GROUP'){$dorong = "&nbsp;&nbsp;&nbsp;&nbsp;";} 
      if($row['level'] == 'SGROUP'){$dorong = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} 
      if(substr($row['AccountNo'],'0','1') or substr($row['AccountNo'],'0','7')){
        $balance = (intval($row['opendebit']) + intval($row['mutasidebit'])) - (intval($row['opencredit']) + intval($row['mutasicredit']));
      }else{
        $balance = (intval($row['opencredit']) + intval($row['mutasicredit'])) - (intval($row['opendebit']) + intval($row['mutasidebit']));
      }
      ?>
      <tr bgcolor="#ffffff">
      <td><?php echo $dorong.$row['AccountName']; ?></td>
      <td align="right"><?php echo number_format(intval($balance), 0, ",", ",") ; ?></td>
    </tr>
      <?php } ?>
</table></td>
        </tr>
     
</table>
    </body>   
    
    
    
    <!--<table> 
  <tr>
    <td>
  <table  class="row" cellpadding="4">  
      <?php foreach ($list_balancesheetkiri as $row) {
      
      if(substr($row['AccountNo'],'0','1') or substr($row['AccountNo'],'0','7')){
        $balance = (intval($row['opendebit']) + intval($row['mutasidebit'])) - (intval($row['opencredit']) + intval($row['mutasicredit']));
      }else{
        $balance = (intval($row['opencredit']) + intval($row['mutasicredit'])) - (intval($row['opendebit']) + intval($row['mutasidebit']));
      }
      ?>
      <tr bgcolor="#ffffff">
      <td><?php echo $row['AccountName']; ?></td>
      <td align="right"><?php echo number_format(intval($balance), 0, ",", ",") ; ?></td>
    </tr>
      <?php } ?>
</table>
      </td>
      <td>
    <table  class="row" cellpadding="4">  
      <?php foreach ($list_balancesheetkanan as $row) {?>
      <tr bgcolor="#ffffff">
      <td><?php echo $row['AccountName']; ?></td>
      <td align="right"><?php echo number_format(intval($balance), 0, ",", ",") ; ?></td>
    </tr>
      <?php } ?>
</table>
          </td>
    <style>
        table#dasar {
            color: #003300;
            font-family: arial;
            font-size: 9pt;
        }
        td {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        th {
            font-weight: bold;
        }
        .rtKanan {
            text-align: right;
        }
        .rtTengah {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .total {
            border-top: 1pt solid black ;
            border-bottom: 1pt solid black;
        }
    </style>
    <table style="width: 100%;" id="dasar">
        <tr>
            <td>
                <table class="anggota">
                    <?php foreach($list_balancesheetkiri as $lbk) : ?>
                        <tr class="bold">
                            <th style="width: 58%;"><?= $lbk['AccountName'] ?></th>
                            <th style="width: 20%;" class="rtKanan"><?= $tgl['satu']; ?></th>
                            <th style="width: 2%"></th>
                            <th style="width: 20%;" class="rtKanan"><?= $tgl['dua']; ?></th>
                        </tr>
                        <?php foreach($lbk['group'] as $group) : ?>
                            <tr>
                                <td style="width: 58%;"><br><br><?= $group['AccountName'] ?></td>
                                <td style="width: 20%;"></td>
                                <td style="width: 2%"></td>
                                <td style="width: 20%;"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <?php $total = ( preg_match("/TOTAL/i", $sgroup['AccountName']))? 1 : 0; ?>
                                <tr>
                                    <td style="width: 58%;"><?= $sgroup['AccountName'] ?></td>
                                    <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($sgroup['opendebit']), 0, '', '.') ?></td>
                                    <td style="width: 2%"></td>
                                    <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($sgroup['opencredit']), 0, '', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </td>
            <td>
                <table class="anggota">
                    <tr>
                        <th style="width: 58%;">LIABILITIES & EQUITY</th>
                        <th style="width: 20%;" class="rtKanan"><?= $tgl['satu']; ?></th>
                        <th style="width: 2%"></th>
                        <th style="width: 20%;" class="rtKanan"><?= $tgl['dua']; ?></th>
                    </tr>
                    <?php foreach($list_balancesheetkanan as $lbk) : ?>
                        <?php
                            $kananOpenDebit = 0;
                            $kananOpenCredit = 0;
                        ?>
                        <tr>
                            <th style="width: 58%;"><br><br><?= $lbk['AccountName'] ?></th>
                            <td style="width: 20%;"></td>
                            <th style="width: 2%"></th>
                            <td style="width: 20%;"></td>
                        </tr>
                        <?php foreach($lbk['group'] as $group) : ?>
                            <tr>
                                <td style="width: 58%;"><br><br><?= $group['AccountName'] ?></td>
                                <td style="width: 20%;"></td>
                                <th style="width: 2%"></th>
                                <td style="width: 20%;"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <?php
                                    $kananOpenDebit += $sgroup['opendebit'];
                                    $kananOpenCredit += $sgroup['opencredit'];
                                    $total = ( preg_match("/TOTAL/i", $sgroup['AccountName']))? 1 : 0;
                                ?>
                                <tr>
                                    <td style="width: 58%;"><?= $sgroup['AccountName'] ?></td>
                                    <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($sgroup['opendebit']), 0, '', '.') ?></td>
                                    <th style="width: 2%"></th>
                                    <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($sgroup['opencredit']), 0, '', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td style="width: 58%;"><br><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL '.str_replace('&nbsp;', '', $lbk['AccountName']); ?></td>
                            <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($kananOpenDebit), 0, '', '.'); ?></td>
                            <th style="width: 2%"></th>
                            <td style="width: 20%;" class="rtKanan <?= ($total == 1)? 'total' : '' ?>"><?= number_format(intval($kananOpenCredit), 0, '', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <th style="width: 58%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL ASSETS</th>
                        <th style="width: 20%" class="rtKanan total"><?= number_format(intval($totAset['kiri']), 0, '', '.') ?></th>
                        <th style="width: 2%"></th>
                        <th style="width: 20%" class="rtKanan total"><?= number_format(intval($totAset['kanan']), 0, '', '.') ?></th>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <th style="width: 58%">TOTAL LIABILITIES & EQUITY</th>
                        <th style="width: 20%" class="rtKanan total"><?= number_format(intval($totLiTas['kiri']), 0, '', '.') ?></th>
                        <th style="width: 2%"></th>
                        <th style="width: 20%" class="rtKanan total"><?= number_format(intval($totLiTas['kiri']), 0, '', '.') ?></th>
                    </tr>
                </table>
            </td>
        </tr>
    </table>-->
</html>