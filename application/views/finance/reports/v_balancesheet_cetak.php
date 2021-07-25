<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" media="all">
    <title><?=$title;?></title>
    <style media="screen">
        th, td {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
    <style media="print">
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, header, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        th, td {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin: 0 !important;
        }
        body {
            width:100%;
            height:100%;
            /*-webkit-transform: rotate(-90deg) scale(.58,.58); 
            -moz-transform:rotate(-90deg) scale(.81,.81) translate(.56, .56);*/
            transform: rotate(-90deg) translateX(-180px);
        }
    </style>
</head>
<body>
     <div class="content">
        <h5 class="text-center mb-1">PT SPEEDLAB INDONESIA </h5>
        <h2 class="text-center mb-1">BALANCE SHEETS</h2>
        <h5 class="text-center"><?= $datenow; ?></h5>
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless">
                    <?php foreach($data1 as $data) :?>
                        <tr>
                            <th><?= $data['AccountName']; ?></th>
                            <th class="text-right">Jan-2017</th>
                            <th class="text-right">Dec-2016</th>
                        </tr>
                        <?php foreach($data['group'] as $group) : ?>
                            <tr>
                                <td class="pl-4"><?= $group['AccountName']; ?></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <tr>
                                    <td class="pl-5"><?= $sgroup['AccountName']; ?></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right">0</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td class="pl-4"><?= 'TOTAL '.$group['AccountName']; ?></td>
                                <td class="text-right border-top border-bottom border-dark">0</td>
                                <td class="text-right border-top border-bottom border-dark">0</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr style="height: 170px;"></tr>
                        <tr>
                            <th><?= 'TOTAL '.$data['AccountName']; ?></th>
                            <th class="text-right border-top border-bottom border-dark">0</th>
                            <th class="text-right border-top border-bottom border-dark">0</th>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless">
                    <tr>
                        <th>LIABILITIES & EQUITY</th>
                        <th class="text-right">Jan-2017</th>
                        <th class="text-right">Dec-2016</th>
                    </tr>
                    <?php foreach($data2 as $data) :?>
                        <tr>
                            <th><?= $data['AccountName']; ?></th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                        </tr>
                        <?php foreach($data['group'] as $group) : ?>
                            <tr>
                                <td class="pl-4"><?= $group['AccountName']; ?></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                            <?php foreach($group['sgroup'] as $sgroup) : ?>
                                <tr>
                                    <td class="pl-5"><?= $sgroup['AccountName']; ?></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right">0</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td class="pl-4"><?= 'TOTAL '.$group['AccountName']; ?></td>
                                <td class="text-right border-top border-bottom border-dark">0</td>
                                <td class="text-right border-top border-bottom border-dark">0</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><?= 'TOTAL '.$data['AccountName']; ?></td>
                            <td class="text-right border-top border-bottom border-dark">0</td>
                            <td class="text-right border-top border-bottom border-dark">0</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="height: 50px;"></tr>
                    <tr>
                        <th>TOTAL LIABILITIES & EQUITY</th>
                        <th class="text-right border-top border-bottom border-dark">0</th>
                        <th class="text-right border-top border-bottom border-dark">0</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Approved By
                    </div>
                    <div class="card-body" style="height: 50px;">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Prepared By
                    </div>
                    <div class="card-body" style="height: 50px;">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Requested By
                    </div>
                    <div class="card-body" style="height: 50px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
