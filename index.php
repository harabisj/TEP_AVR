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
    <h1>TEP AVR generátor</h1>

    <form action="generate.php" method="GET">
        <div class="form-group mb-3">
        <label for="event">Událost</label>
            <select name="event" class="form-control" required>
                <option value="compa">Shoda s registrem A</option>
                <option value="ovf">Přetečení</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="frequency">Frekvence</label>
            <div class="input-group">
                <input type="number" name="frequency" class="form-control" required>
                <span class="input-group-text">Hz</span>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="timer">Časovač</label>
            <select name="timer" class="form-control" required>
                <option value="1">TIMER1</option>
                <option value="3">TIMER3</option>
                <option value="4">TIMER4</option>
                <option value="5">TIMER5</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <input type="submit" class="btn btn-primary" value="Vypočítej to, lol">
        </div>
    </form>

    <small>
        <a class="text-muted" href="https://github.com/harabisj/TEP_AVR">Available on GitHub</a>
    </small>
</body>
</html>