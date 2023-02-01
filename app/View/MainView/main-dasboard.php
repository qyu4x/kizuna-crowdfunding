<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$responseDonation['title']?? 'Kizuna'?></title>
    <!--icon cdn and style css hreff-->
    <style>
        <?php include 'main-dasboard.css'; ?>
    </style>
    <script src="https://kit.fontawesome.com/af225b9a49.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

</head>
<body>
<nav>
    <div class="container">
        <h2 class="logo">
            Kizuna
        </h2>
        <div class="search-bar">
            <i class="uil uil-search"></i>
            <input type="search" placeholder="find more people in needed ">
        </div>
        <div class="create">
            <button type="" class="btn btn-primary" for="create-post"><?=$model['user']['idUsername']??'@anonymus'?></button>
            <div class="profile-photo">
                <img src="https://img-9gag-fun.9cache.com/photo/am7qzVX_460s.jpg" alt="">
            </div>
        </div>
    </div>
</nav>

<!--main -->
<main>
    <div class="container">
        <!--left navigation button -->
        <div class="left">
            <a class="profile">
                <div class="profile-photo">
                    <img src="https://img-9gag-fun.9cache.com/photo/am7qzVX_460s.jpg" alt="">
                </div>
                <div class="handle">
                    <h4><?=$model['user']['username']??'Hii, users'?></h4>
                    <p class="text-muted">
                        @<?=$model['user']['idUsername']??'guest'?>!
                    </p>
                </div>
            </a>
            <!--sidebar-->
            <div class="sidebar">
                <a class="menu-item active">
                    <span><i class="uil uil-home"></i></span><h3>Home</h3>
                </a>
                <a class="menu-item" id="notifications">
                    <span><i class="uil uil-bell"><small class="notification-count">3+</small></i></span><h3>Notifications</h3>
                    <!--notifications pop up-->

                    <div class="notifications-popup">
                        <?php foreach($model['donation'] as $row): ?>
                        <div>
                            <div class="profile-photo">
                                <img src=<?= $row["image_url"]?> alt="">
                            </div>
                            <div class="notifications-body">
                                <b><?= $row["organizer"]?></b> <?= $row["title"]?>
                                <small class="text-muted">3 DAYS AGO</small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </a>
                <a class="menu-item" id="message-notifications">
                    <span><i class="uil uil-envelope-alt"><small class="notification-count">3</small></i></span><h3>Messages</h3>
                </a>
                <a class="menu-item">
                    <span><i class="uil uil-bookmark"></i></span><h3>Bookmark</h3>
                </a>
                <a class="menu-item" href="/about">
                    <span><i class="uil uil-info-circle"></i></span><h3>About kizuna</h3>
                </a>
                <a class="menu-item">
                    <span><i class="uil uil-setting"></i></span><h3>Settings</h3>
                </a>
            </div>
            <!--end of side bar -->
            <?php if($model['user']['idUsername'] != null) : ?>
                <button type="button" for="logout-account" class="btn btn-primary"><a href="/users/logout">Logout</a></button>
            <?php else : ?>
                <button type="button" for="login-account" class="btn btn-primary"><a href="/users/login">Login</a></button>
            <?php endif; ?>
        </div>
        <!--middle main content -->
        <div class="middle">
            <!---feeds-->
            <?php foreach($model['donation'] as $row): ?>

                <div class="feeds">
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src=<?= $row["image_url"]?> alt="">
                                </div>
                                <div class="info">
                                    <a href="/details/<?=$row["id"]?>"><h3><?= $row["title"]?></h3></a>
                                    <small>24 agustus 2022</small>
                                </div>
                            </div>
                        </div>

                        <div class="photo">
                            <a href="/details/<?=$row["id"]?>" class="a-click"><img src=<?= $row["image_url"]?> alt=""></a>
                        </div>

                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <p class="text-muted">
                                    Terkumpul
                                </p>
                                <b>Rp.<?= $row["money_collected"]?></b>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>


                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <p class="text-muted">
                                    Dana yang dibutuhkan
                                </p>
                                <b>Rp.<?= $row["money_needed"]?></b>
                            </div>
                            <div class="days">
                                <span><?= $row["rest_of_the_day"]?> Hari lagi</span>
                            </div>
                        </div>

                        <div class="caption">
                            <span><?= $row["organizer"]?><i class="uil uil-check"></i></span>
                            <p><?= $row["description"]?></p>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
        <!--right navigation status -->
        <div class="right">
            <div class="messages">
                <div class="heading">
                    <h4>Donation History</h4><i class="uil uil-history"></i>
                </div>
                <!--search bar--->
                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search donation history" id="history-donation-search">
                </div>

                <div class="category">
                    <h6>Primary</h6>
                </div>

                <?php if($model['history'] != null) : ?>
                    <?php foreach($model['history'] as $history): ?>
                        <div class="message">
                            <div class="profile-photo">
                                <img src=<?= $history["image_url"] ?? ""?> alt="">

                            </div>
                            <div class="message-body">
                                <h5><?= $history["organizer"]?></h5>
                                <p >Terimakasih kamu telah berdonasi sebesar <?= $history["total_donations"]?> untuk <?= $history["title"]?> pada <?= $history["created_at"]?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="message">
                        <div class="profile-photo">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRItdGE2CtK9feAyR8My22gKCblKEOlsR13hg&usqp=CAU" alt="">

                        </div>
                        <div class="message-body">
                            <h5><?= "Kizuna team"?></h5>
                            <p >Opps, saat ini kamu belum memiliki riwayat Donasi</p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="container-footer">
        <footer>
            <div>
                <p>SUBSCRIPTION</p>

                <i class="fa fa-twitter"></i>
                <i class="fa fa-pinterest"></i>
                <i class="fa fa-youtube"></i>
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
    </div>


    </div>


</main>


<script>
    <?php require_once("main-dasboard.js");?>
</script>


</body>
</html>
