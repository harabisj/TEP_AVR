<?php

function getN($divisor)
{
    return 16000000 / (2 * $divisor * $_GET['frequency']);
}

$pulses = [
    1 => '001',
    8 => '010',
    64 => '011',
    256 => '100',
    1024 => '101',
];

$integerNs = [];
$decimalNs = [];
foreach ($pulses as $divisor => $bits)
{
    $n = getN($divisor);
    if ($n <= pow(2, 16))
        if (is_int($n))
            $integerNs[$divisor] = $n;
        else
            $decimalNs[$divisor] = $n;
}

$event = [
    'compa' => 'Shoda s registrem A',
    'ovf' => 'Přetečení',
];

$mode = [
    'compa' => 'CTC',
    'ovf' => 'Normální',
];

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEP AVR generátor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        span.frac {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
        }
        span.frac > sup, span.frac > sub {
            display: block;
            font: inherit;
            padding: 0 0.3em;
        }
        span.frac > sup {border-bottom: 0.08em solid;}
        span.frac > span {display: none;}
    </style>
</head>
<body class="py-4 container">
    <h1 class="mb-2">TEP AVR generátor</h1>

    <h2>Zadání</h2>
    <table class="table">
        <tr>
            <th>f = </th>
            <td><?=$_GET['frequency']?> Hz</td>
        </tr>
        <tr>
            <th>f<sub>osc</sub> = </th>
            <td>16 MHz</td>
        </tr>
        <tr>
            <th>Časovač: </th>
            <td>TIMER<?=$_GET['timer']?></td>
        </tr>
        <tr>
            <th>Událost: </th>
            <td><?=$event[$_GET['event']]?></td>
        </tr>
        <tr>
            <th>Výstupní port: </th>
            <td>F</td>
        </tr>
        <tr>
            <th>Režim časovače: </th>
            <td><?=$mode[$_GET['event']]?></td>
        </tr>
    </table>

    <h2 class="mt-2 mb-3">Výpočet</h2>

    <div class="row">
        <div class="col-3">
            <p>
                N = &nbsp;
                <span class="frac">
                    <sup>f<sub>osc</sub></sup>
                    <span>&frasl;</span>
                    <sub>2 * DP * f</sub>
                </span>
            </p>
        </div>
        <div class="col-3">
            <p>
                N = &nbsp;
                <span class="frac">
                    <sup>16 * 10<sup>6</sup></sup>
                    <span>&frasl;</span>
                    <sub>2 * DP * <?=$_GET['frequency']?></sub>
                </span>
            </p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <h5>Celočíselné N</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>N</th>
                        <th>DP</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($integerNs as $d => $n): ?>
                    <tr>
                        <td><?=$n?></td>
                        <td><?=$d?></td>
                        <td>
                            <a href="code.php?timer=<?=$_GET['timer']?>&csx=<?=$pulses[$d]?>&n=<?=$n?>&event=<?=$_GET['event']?>">Kód</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-6">
            <h5>Desetinné N</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>N</th>
                        <th>DP</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($decimalNs as $d => $n): ?>
                    <tr>
                        <td><?=$n?></td>
                        <td><?=$d?></td>
                        <td><a href="code.php?timer=<?=$_GET['timer']?>&csx=<?=$pulses[$d]?>&n=<?=$n?>&event=<?=$_GET['event']?>?>">Kód</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>