<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Donasi</title>
    <link rel="stylesheet" type="text/css" href="inovice.css">
    <style>
        <?php include 'status-payment.css'; ?>
    </style>
</head>
<body>
<header>
    <div class="container">

        <div class="mascot">
            <img src="https://i.pinimg.com/736x/1c/e8/b7/1ce8b7daff51399741148f10a68f4756.jpg" alt="">
        </div>
        <div class="about">
            <h2 class="title" id="profile">Successful transaction</h2>
            <p>
                Terimakasih <?=$model["username"]?>!, Donasi kamu sebesar Rp.<?= $model["amount"]?> berhasil diperoses pada <?= $model["date"]?> jam <?= $model["time"]?> WIB, semoga bermanfaat
            </p>
        </div>

        <a href="/" class="button-content">Back to Home</a>

    </div>

</header>
</body>
</html>

