<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    table.first {
      color: #003300;
      font-family: arial;
      font-size: 6pt;
    }

    td {
      border-top: 0.5px solid black;
      border-bottom: 0.5px solid black;
    }

    th {
      border-top: 0.5px solid black;
      border-bottom: 0.5px solid black;
    }
  </style>
</head>

<body>
  <small align="left"><br> &nbsp;&nbsp; Account No : <?= $AccountNo; ?><br> &nbsp;&nbsp; Account Name : <?= $AccountName; ?>
  </small><br>
  <div class="row">
    <table class="first table" cellpadding="4">
      <tr>
        <th style="text-align: center; font-weight:bold">Date</th>
        <th style="text-align: center; font-weight:bold">Ref No.</th>
        <th style="text-align: center; font-weight:bold">Description</th>
        <th style="text-align: center; font-weight:bold">Source</th>
        <th style="text-align: center; font-weight:bold">Debit</th>
        <th style="text-align: center; font-weight:bold">Credit</th>
        <th style="text-align: center; font-weight:bold">Balance</th>
      </tr>
      <?php foreach ($list_ledger as $row) { ?>
        <tr bgcolor="#ffffff">
          <td><?= $row['date']; ?></td>
          <td><?= $row['reffno']; ?></td>
          <td><?= $row['description']; ?></td>
          <td><?= $row['source']; ?></td>
          <td align="right"><?= number_format(intval($row['debit']), 0, ',', '.'); ?></td>
          <td align="right"><?= number_format(intval($row['credit']), 0, ',', '.'); ?></td>
          <td align="right"><?= number_format(intval($row['balance']), 0, ',', '.'); ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>

</html>