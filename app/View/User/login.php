<!--<div class="container col-xl-10 col-xxl-8 px-4 py-5">-->

<!--    <div class="row align-items-center g-lg-5 py-5">-->
<!--        <div class="col-lg-7 text-center text-lg-start">-->
<!--            <h1 class="display-4 fw-bold lh-1 mb-3">Login</h1>-->
<!--        </div>-->
<!--        <div class="col-md-10 mx-auto col-lg-5">-->
<!--            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/users/login">-->
<!--                <div class="form-floating mb-3">-->
<!--                    <input name="id_username" type="text" class="form-control" id="id_username" placeholder="id_username" value="--><?//= $_POST['id_username'] ?? ''?><!--">-->
<!--                    <label for="id_username">Username</label>-->
<!--                </div>-->
<!--                <div class="form-floating mb-3">-->
<!--                    <input name="password" type="password" class="form-control" id="password" placeholder="password">-->
<!--                    <label for="password">Password</label>-->
<!--                </div>-->
<!--                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        <?php include 'login-and-register.css'; ?>
    </style>
</head>
<body>
<div class="container">
    <script type="text/javascript">
        <?php if (isset($model['error'])) {?>
        let errorMessage = <?=json_encode($model['error']) ?>;
        alert(errorMessage)
        <?php }?>
    </script>
    <div class="login">
        <form method="post" action="/users/login">
            <h1>Login</h1>
            <hr>
            <p>Kizuna crowdfunding</p>
            <label for="id_username">Username</label>
            <input name="id_username" type="text" id="id_username" placeholder="your username" value="<?= $_POST['id_username']?? ''?>">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="password">
            <button type="submit">Login</button>
        </form>
        <div class="create">
            <p>Gapunya account?, <a href="/users/register">buat dulu yuk!</a></p>
        </div>
    </div>
    <div class="right">
        <img src="https://i.postimg.cc/xXJXG6Jq/bao-charity-1.png" alt="">
    </div>
</div>
</body>
</html>