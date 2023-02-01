<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include 'index.css'; ?>
    </style>
    <title><?= $model['title']?></title>
</head>
<body>
    <div class="main">
        <nav>
            <div class="logo">Kizuna Crowdfunding</div>
            <div>
                <ul>
                    <li><a href=/guest>Home</a></li>
                    <li><a href=/about>About Kizuna</a></li>
                    <li><a href=>Programs</a></li>
                    <li><a href=>Contact</a></li>
                </ul>
            </div>
            <a href="/guest" class="button">Guest mode</a>
        </nav>

        <div class="content">
            <span class="yume">Welcome to Kizuna Crowdfunding...</span>
            <h1>Let's help for those in need with kizuna... </h1>
            <p>Please create an account first if you don't have an account
            </p>
            <a href="/users/register" class="button-content">Sign Up</a>
            <a href="/users/login" class="button-content">Log in</a>
        </div>
    </div>
</body>
</html>