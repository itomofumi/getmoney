<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Get money</title>
        <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
        <style>
            body {
                margin: 50px 0 0 0;
                padding: 0;
                width: 100%;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                text-align: center;
                color: #aaa;
                font-size: 18px;
            }

            h1 {
                color: #719e40;
                letter-spacing: -3px;
                font-family: 'Lato', sans-serif;
                font-size: 100px;
                font-weight: 200;
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <h1>Get money</h1>
        <div>a microframework for PHP</div>
            <p>Try <a href="http://localhost/cc/close">localhost/cc/close</a></p>

            <h3>BTC_JPY</h3>
            <p>Last : <?php echo e($last); ?></p>
            <p>Bid : <?php echo e($bid); ?></p>
            <p>Ask : <?php echo e($ask); ?></p>
            <p>High : <?php echo e($high); ?></p>
            <p>Low : <?php echo e($low); ?></p>
            <p>Volume : <?php echo e($volume); ?></p>
            <p>Timestamp : <?php echo e($timestamp); ?></p>

    </body>
</html>
