<html>

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    /** 
    Set the margins of the page to 0, so the footer and the header
    can be of the full height and width !
    **/
    @page {
      margin: 0cm 0cm;
    }

    /** Define now the real margins of every page in the PDF **/
    body {
      margin-top: 3.5cm;
      margin-left: 0.5cm;
      margin-right: 0.5cm;
      margin-bottom: 2cm;
    }

    .isi {
      font-size: 10px;
      font-weight: bold;
      font-family: helvetica;
    }

    table.first {
      color: #003300;
      font-family: arial;
      font-size: 7pt;
    }

    td {
      border-top: 0.5px solid black !important;
      border-bottom: 0.5px solid black !important;
    }

    th {
      border-top: 0.5px solid black !important;
      border-bottom: 0.5px solid black !important;
    }

    /** Define the header rules **/
    header {
      position: fixed;
      top: 1cm;
      left: 0cm;
      right: 0cm;
      height: 100px;

      /** Extra personal styles **/
      /* background-color: #03a9f4; */
      color: white;
      text-align: center;
      line-height: 12px;
    }

    /** Define the footer rules **/
    footer {
      position: fixed;
      bottom: 0cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;

      /** Extra personal styles **/
      color: white;
      text-align: center;
      line-height: 1.5cm;
    }
  </style>
</head>

<body>
  <!-- Define header and footer blocks before your content -->
  <header style="color: black;">
    <p style="font-size:15px; font-family:Verdana, Geneva, Tahoma, sans-serif; font-weight:bold">PT ARUNDAYA TEKNOLOGI</p>
    <p style="font-size:25px; font-family:Verdana, Geneva, Tahoma, sans-serif; font-weight:bold;">LEDGER REPORT</p>
    <p style="font-size:15px; font-family:Verdana, Geneva, Tahoma, sans-serif; font-weight:bold;">MONTH - JUNI 2021</p>
  </header>

  <footer>
    Copyright &copy; <?php echo date("Y"); ?>
  </footer>

  <!-- Wrap the content of your PDF inside a main tag -->
  <main>
    <div class="isi">
      <p>Page 1 of 6</p>
      <p style="margin-top: -16px;">Account No : 123456123456</p>
      <p style="margin-top: -16px;">Account Name : BCA Mampang Samudra</p>
    </div>
    <div class="text-center" style="margin-top: -12px;">
      <table class="first table table-borderless table-sm" cellpadding="4">
        <thead>
          <tr>
            <th width="50px" style="text-align: center;">Date</th>
            <th width="100px" style="text-align: center;">Ref No.</th>
            <th width="150px" style="text-align: center;">Description</th>
            <th width="50px" style="text-align: center;">Source</th>
            <th width="70px" style="text-align: center;">Debit</th>
            <th width="70px" style="text-align: center;">Credit</th>
            <th width="70px" style="text-align: center;">Credit</th>
          </tr>
        </thead>
        <tbody>
          <tr style="font-weight:bold">
            <td></td>
            <td></td>
            <td style="text-align: center; font-weight:bold">Opening Balance</td>
            <td></td>
            <td style="text-align: right; font-weight:bold">0,00</td>
            <td style="text-align: right; font-weight:bold">0,00</td>
            <td style="text-align: right; font-weight:bold">0,00</td>
          </tr>
          <?php foreach ($datareport as $row) : ?>
            <tr style="font-weight:bold">
              <td style="text-align: center;">25-03-2021</td>
              <td style="text-align: center;">001/Bank-00001/D/202103</td>
              <td>Bank BCA Mampang - Penanaman Modal</td>
              <td style="text-align: center;">Bank-00001</td>
              <td style="text-align: right;">2.000.000,00</td>
              <td style="text-align: right;">0</td>
              <td style="text-align: right;">2.000.000,00</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td class="text-left" style="text-align: left; font-weight:bold">Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right; font-weight:bold">2.000.000,00</td>
            <td style="text-align: right; font-weight:bold">0</td>
            <td></td>
          </tr>
          <tr>
            <td class="text-left" style="font-weight:bold">Close Balance</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right; font-weight:bold">2.000.000,00</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </main>
</body>

</html>