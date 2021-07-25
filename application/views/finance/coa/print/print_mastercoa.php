<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <title>Print Master COA</title>
</head>
<style>
  @media print {
    hr {
      border: none;
      height: 3px;
      /* Set the hr color */
      color: #333;
      /* old IE */
      background-color: #333;
      /* Modern Browsers */
    }
  }

  .border-3 {
    border-width: 3px !important;
    border-color: black !important;
  }
</style>

<body>
  <div class="container">
    <div class="row mt-5 border-bottom border-3">
      <div class="col-md-6">
        <img style="max-width: 250px;" src="https://mcu.speedlab.id/asset/logo.png" class="card-img-top" alt="...">
      </div>
      <div class="col-md-6 mt-3">
        <div class="text-right">
          <h4>CHART OF ACCOUNT</h4>
        </div>
      </div>
    </div>
    <!-- <hr> -->
    <div class="col-md-10 offset-md-1 mt-2">
      <table class="table-sm" style="font-weight: 500;">
        <?php foreach ($coa_data as $row) : ?>
          <tr>
            <?php if ($row['Level'] == 'TYPE') : ?>
              <td width="50px"><?php echo $row['AccountNo']; ?></td>
              <td colspan="4">
                <?php echo $row['AccountName']; ?>
              </td>
            <?php elseif ($row['Level'] == 'GROUP') : ?>
              <td></td>
              <td width="50px"><?php echo $row['AccountNo']; ?></td>
              <td colspan="3">
                <?php echo $row['AccountName']; ?>
              </td>
            <?php elseif ($row['Level'] == 'SGROUP') : ?>
              <td style="padding-bottom:10px;"></td>
              <td></td>
              <td><?php echo $row['AccountNo']; ?></td>
              <td colspan="2">
                <?php echo $row['AccountName']; ?>
              </td>
            <?php elseif ($row['Level'] == 'CODE') : ?>
              <td class="mb-3"></td>
              <td></td>
              <td></td>
              <td><?php echo $row['AccountNo']; ?></td>
              <td colspan="1">
                <?php echo $row['AccountName']; ?>
              </td>
            <?php else : ?>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php echo $row['AccountNo']; ?> &nbsp;&nbsp;&nbsp; <?php echo $row['AccountName']; ?>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <br><br><br>
</body>
<script>
  window.print();
</script>

</html>