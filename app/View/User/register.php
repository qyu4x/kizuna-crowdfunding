

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <form method="post" action="/users/register">
            <h1>Register</h1>
            <hr>
            <p>Kizuna crowdfunding</p>
            <label for="id_username">Username</label>
            <input name="id_username" type="text" id="id_username" placeholder="enter the username you want" value="<?=$_POST['id_username']?? ''?>">
            <label for="email">Email</label>
            <input name="email" type="text" id="email" placeholder="example@gmail.com" value="<?=$_POST['email']?? ''?>">
            <label for="name">Your name</label>
            <input name="name" type="text" id="name" placeholder="your name" value="<?= $_POST['name']?? ''?>">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="password">
            <button type="submit" onclick="check(this.form)">Register</button>
        </form>
    </div>
    <div class="right">
        <img src="https://cdn.pixabay.com/photo/2020/07/01/06/59/alms-5358682_640.jpg" alt="">
    </div>
</div>
</body>
</html>

