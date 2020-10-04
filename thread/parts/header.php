<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title class="titleTxt">２５ちゃんねる</title>
    <link rel="stylesheet" href="style/style.css">
    <script type="text/javascript" src="check_submit.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Header Start -->
<header>
    <div class="black">
    </div>
    <div class="titleTxt">
        <a href="index.php"><p>２５ちゃんねる</p></a>
    </div>

</header>
<!-- Style -->
<style>
    .black{
        background-color: #4e4e4e;
        height: 30px;

    }
    .titleTxt a{
        color: white;
        text-decoration: none;
    }

    header{
    background-color: gray;
    height: 105px;
    }

    header p{
    text-align: center;
    font-size: 24px;
    color: white;
    padding-top: 20px;
    }
</style>
