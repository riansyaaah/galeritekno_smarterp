<!doctype html>
<html lang="en">
  <head>
    <style type="text/css">
      h1 {text-align:center; font-size:18px;}
      h2 {font-size:14px;}
      .tengah {text-align:center; }
      .kiri {padding-left:5px;}
      
      
      table.nilai {border-collapse: collapse; width:90%;}
      table.nilai td, tr{font-size: 13; padding: 2px 2px 2px 2px; border-bottom: 1px solid #f2f2f2;}
      table.nilai tr:nth-child(even){background-color: #f2f2f2}
      
      table.nilai1 {border-collapse: collapse; width:90%;}
      
      .borderheader {
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
      }
          @media print {
    html, body {
        display: block; 
        font-family: "Calibri";
        margin: 0;
    }

    @page {
      size: 21.59cm 13.97cm;
    }

    .logo {
      width: 30%;
    }

}

    </style>
  </head>
    <body style="background-image: url('<?php echo $kop; ?>'); background-image-resize:6">
    <div>
      <!-- HEADER -->
      <div style="width:100%;">
      <div style="width:100%; padding-top:50px; float:center; text-align:center;">
          <table class="nilai1" style="width:100%; ">
                <tr>
                  <td style="text-align:center;text-decoration: underline;"><b><font size="7">KWITANSI</font></b></td>
                </tr><tr>
                  <!-- <td style="text-align:center;"><font size="6"><b>001/PCR-SPEEDLAB/04/21</b></font></td> -->
                </tr>
            </table>
                    <br>
                    <br>
                    <table class="nilai" style="width:100%; float:left;">
                <tr>
                  <td style="text-align:left;"><font size="6"><b>Sudah terima dari</b></font></td>
                  <br><br>
                  <td style="text-align:left;width:25px"><font size="6"><b>:</b></font></td>
                  <br><br>
                  <td style="text-align:left;width:25px"><font size="6"><b><?php echo $billto;?></b></font></td>
                </tr>
                <br><br>
                        <tr>
                  <td><font size="6"><b>Banyaknya uang</b></font></td>
                  <br><br>
                  <td style="text-align:left;width:25px"><font size="6"><b>:</b></font></td>
                  <br><br>
                   <td style="text-align:left;width:25px"><font size="6"><b><i><?php echo $terbilang; ?> Rupiah</i></b></font></td>
                </tr>
                <br><br>
                                <tr>
                  <td style="text-align:left;width:25px"><font size="6"><b>Untuk Pembayaran</b></font></td>
                  <br><br><br>
                  <td style="text-align:left;width:25px"><font size="6"><b>:</b></font></td>
                  <br><br><br>
                   <td>
                  <?php foreach ($listpemeriksaan as $b) { ?>
                 <br><font size="6"><b><?php echo $b['jumlah'];?> Orang Pemeriksaan <?php echo $b['detailketerangan']?> </b></font><br>
                  <?php } ?>
                    <br><br></td>
                </tr>
                <br><br>
                
                    </table>
                    <br>
                    
                    <br>
                    <div style="width:100%;">
            <div style="width:60%; float:left;">
              <table class="nilai1">
                  <tr><td style="text-align:left;color:green;"><font size="6"><b>______________________________</b></font></td></tr>
                  <tr>
                  <td style="text-align:left;"><font size="7"><b><?php echo "RP ".number_format($total, 0, ".", "."); ?></b></font></td>
                  </tr>
                  <tr>
                  <td style="text-align:left;color:green;"><font size="6"><b>______________________________</b></font></td>
                  </tr>
              </table>
            </div>
            <div style="width:40%;float:right;">
        <table class="nilai1" style="text-align: center">
                    <tr><td><font size="6"><b><?php echo $titimangsa;?>, <?php echo date('d F Y', strtotime($tanggalinvoice));?></b></font></td></tr>
         <tr><td style="color: white;"> .</td></tr>
                    <tr><td><img src="<?php echo base_url();?>assets/file/<?php echo $ttdnonmaterai;?>" width="260" ></tr>
            <tr><td><font size="6"><b><u><?php echo $namafinance; ?></u></b></font></td></tr>
            <tr><td><font size="6">Finance</font></td></tr>
        </table> 
        
      </div>
      
          </div>
        </div>
                
      </div>
            
      <!-- END HEADER -->
      
      <!-- BODY -->
      
    </div>
    </body>
</html>