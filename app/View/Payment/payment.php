<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <style>
        <?php include 'payment.css';?>
    </style>
</head>
<body>
<header>
    <div class="container">
        <script type="text/javascript">
            <?php if (isset($model['error'])) {?>
                let errorMessage = <?=json_encode($model['error']) ?>;
                alert(errorMessage)
            <?php }?>
        </script>
        <form class="inner-container" method="post">
            <div class="left">
                <h3>BILLING ADDRESS</h3>
                Address
                <input type="text" name="address" placeholder="Enter address">

                City
                <input type="text" name="city" placeholder="Enter City">
                <div id="zip">
                    <label>
                        State
                        <select name="state" type="text" id="state" >
                            <option>Choose State..</option>
                            <option>Indonesia</option>
                            <option>Malaysia</option>
                            <option>Singapore</option>
                        </select>
                    </label>
                    <label>
                        Zip code
                        <input type="number" name="zip_code" placeholder="Zip code">
                    </label>
                </div>
                </div>
                <div class="right">
                    <h3>PAYMENT</h3>
                    Accepted Card
                    <br>
                    <img src="https://i.ibb.co/XbYkfLC/card1.png" width="100">
                    <img src="https://i.ibb.co/D5x9Hqx/card2.png" width="50">
                    <br><br>

                    Credit card number
                    <input type="text" name="card_number" placeholder="Enter card number">

                    Exp month
                    <input type="text" name="exp_month" placeholder="Enter Month">
                    Enter Amount
                    <input type="text" name="amount_money" placeholder="Rp. Enter the amount of money">
                <div id="zip">
                    <label>
                        Exp year
                        <select name="exp_year">
                            <option>Choose Year..</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                        </select>
                    </label>
                    <label>
                        CVV
                        <input type="number" name="cvv" placeholder="CVV">
                    </label>
                </div>
                <button type="submit" name="">Process to Donation</button>
             </div>
        </form>
    </div>
</header>
</body>
</html>
