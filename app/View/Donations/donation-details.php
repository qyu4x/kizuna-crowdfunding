<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$model['title']??'Details'?></title>
    <link rel="stylesheet" href="donations.css">
    <script src="https://kit.fontawesome.com/af225b9a49.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <style>
        <?php include 'donation-details.css'; ?>
    </style>
</head>
<body>
<nav>
    <div class="container">
        <h2 class="logo">
            Kizuna crowdfunding
        </h2>
        <div class="search-bar">
            <ul>
                <li><a href=#>Home</a></li>
                <li><a href=#">About Kizuna</a></li>
                <li><a href=#>Programs</a></li>
                <li><a href=#>Contact</a></li>
            </ul>
        </div>
        <div class="create">
            <button type="button" class="btn btn-primary" for="create-post">Hii, <?=$model["user"]["name"]??'guest'?></button>
            <div class="profile-photo">
                <img src="./images/profile-1.jpg" alt="">
            </div>
        </div>
    </div>
</nav>
<div class="sub-container">
    <div class="small-container single-donation">
        <div class="row">
            <div class="col-2">
                <img src=<?=$model["result"]["imageUrl"]?> alt="" width="100%">
            </div>

            <div class="col-2">
                <p>Home / Donations </p>
                <h1><?=$model["result"]["title"]?></h1>
                <div class="needed">
                    <h4>
                        Kebutuhan dana
                    </h4>
                    <h4 class="funding-needs"><?=$model["result"]["moneyNeeded"]?></h4>
                </div>
                <div class="collected">
                    <h4 class>
                        Dana terkumpul
                    </h4>
                    <h4 class="funding-needs-"><?=$model["result"]["moneyCollected"]?></h4>
                </div>

                <h3>Details <i class="uil uil-list-ui-alt"></i></h3>
                <br>
                <p><?=$model["result"]["description"]?></p>

                <div>
                    <a href="/payment/<?=$model['result']['id']?>" class="button">Donation Now</a>
                </div>
            </div>


        </div>
    </div>
</div>
<footer>
    <div>
        <p>SUBSCRIPTION</p>

        <i class="fa fa-twitter"></i>
        <i class="fa fa-pinterest"></i>
        <i class="fa fa-youtube"></i>
    </div>

    </div>
    <div>
        <p>Kizuna crowdfunding</p>
        <ul>
            <li><a href="#">About Kizuna crowdfunding</a></li>
            <li><a href="#">Mitra Blog</a></li>
            <li><a href="#">Karrier</a></li>
            <li><a href="#">Kizuna crowdfunding Present</a></li>
            <li><a href="#">Kizuna crowdfunding Affiliate Program</a></li>
            <li><a href="#">Kizuna crowdfunding Points</a></li>
        </ul>
    </div>
    <div>
        <p>Costumer Service</p>
        <ul>
            <li><a href="#">Kizuna crowdfunding Care</a></li>
            <li><a href="#">Terms and Conditions</a></li>
            <li><a href="#">Karrier</a></li>
        </ul>
    </div>
    <div>
        <p>Contact Us</p>
        <ul>
            <li><a href="#"><i class="fab fa-facebook-square"></i>&nbsp Kizuna crowdfunding</a></li>
            <li><a href="#"><i class="fa fa-instagram"></i>&nbsp @Kizunacrowdfunding</a></li>
            <li><a href="#"><i class="fa fa-twitter"></i>@kizunacw</a></li>
        </ul>
    </div>
</footer>
<div class="copy-right">
    <p>&copy;copy-right Kizuna crowdfunding 2022 by Ariq Khoiri</p>
</div>
</body>
</html>

