<?php

$TIMSKx = [
    'compa' => '0b00000010',
    'ovf' => '0b00000001',
];

$isr = [
    'compa' => 'COMPA_vect',
    'ovf' => 'OVF_vect',
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
</head>
<body class="py-4 container">
    <h1 class="mb-2">TEP AVR generátor</h1>

    <h2>Kód</h2>
    <code class="text-light bg-dark" style="display: block; white-space: pre-wrap;">
        #include &lt;avr/interrupt.h>

        Main()
        {
            TCCR<?=$_GET['timer']?>A = 0b00000000;
            TCCR<?=$_GET['timer']?>B = 0b000<?=$_GET['event'] == 'compa' ? '01' : '00' ?><?=$_GET['csx']?>;
            TIMSK<?=$_GET['timer']?> = 0b000000<?=($_GET['event'] == 'compa') ? '10' :  '01'?>;
    <?php if ($_GET['event'] == 'compa'): ?>
        OCR<?=$_GET['timer']?>A = <?=$_GET['n']?>;
    <?php endif; ?>
        sei();

            DDRF = 0b11111111;
            
            while (1) {}
        }

        ISR(TIMER<?=$_GET['timer']?>_<?=$isr[$_GET['event']]?>)
        {
            PORTF ~= PORTF;
    <?php if ($_GET['event'] == 'ovf'): ?>
        TCNT<?=$_GET['timer']?> = <?=65536 - $_GET['n']?>;
    <?php endif; ?>
    }
    </code>
</body>
</html>