<?php

use services\DatabaseSeeder;

$databaseSeed = new DatabaseSeeder();

$databaseSeed->run();



?>
<html>
<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/BossBayProject/css/style.css" >
    <link rel="stylesheet" href="/BossBayProject//css/parallax.css" >
    <link rel="stylesheet" href="/BossBayProject/css/header.css" >
    <link rel="stylesheet" href="/BossBayProject/css/login.css" >
    <link rel="stylesheet" href="/BossBayProject/css/sweatalert.css">
    <link rel="stylesheet" href="/BossBayProject/css/profile.css">
    <link rel="stylesheet" href="/BossBayProject/css/about.css">
    <link rel="stylesheet" href="/BossBayProject/css/shop.css">
    <link rel="stylesheet" href="/BossBayProject/css/cart.css">
    <link rel="stylesheet" href="/BossBayProject/css/article.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="/BossBayProject/js/sweatalert.js"></script>

    <script src="/BossBayProject/js/header.js"></script>
    <script src="/BossBayProject/js/modal.js"></script>
    <script src="/BossBayProject/js/countdown.js"></script>

</head>
<body>

<?php $this->renderComponent("login.php")  ?>

  <header id="js-header">
    <div class="container clearfix">

        <div class="navLeft">
            <nav class="effectHeader">
                <?php
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                ?>
                <a href="/BossBay/Homepage" <?php if($actual_link == "http://localhost/BossBay/Homepage"){echo "class='active'";} ?> data-hover="Home">Home</a>
                <a href="/BossBay/Shop" <?php if($actual_link == "http://localhost/BossBay/Shop"){echo "class='active'";} ?>  data-hover="Shop">Shop</a>
                <a href="/BossBay/About" <?php if($actual_link == "http://localhost/BossBay/About"){echo "class='active'";} ?> data-hover="About">About</a>

            </nav>
        </div>

        <div class="navMiddle">
            <h1 id="logo">BossBay</h1>
        </div>

        <div class="navRight">
            <nav class="effectHeader">

                <?php

                if(\services\Sessionmanagement::get('user'))
                {
                    $user = unserialize(\services\Sessionmanagement::get('user'))['username'];
                    $image = unserialize(\services\Sessionmanagement::get('user'))['image'];
                    ?>
                    <a href="/user/userpage"  class="iconUser <?php if($actual_link == "http://localhost/user/userpage"){echo "active";} ?>">
                        <i class="fa fa-user"></i>
                    </a>

                    <a href="/user/cart"  class="iconUser <?php if($actual_link == "http://localhost/user/cart"){echo "active";} ?>">
                        <i class="fa fa-shopping-cart"></i>
                    </a>

                    <a href="/user/logout"  class="iconUser">
                        <i class="fa fa-sign-out"></i>
                    </a>

                    <img src="<?php if($image != null){
                      echo '/BossBayProject/assets/userimages/'.$image;} else{
                        echo '/BossBayProject/assets/userimages/defaultUser.png';
                      }?>" class="userImage" width="35" height="35"}>

                    <label for="" class="userLabel"><?php echo $user ?></label>

                    <?php
//                    echo '<a class="userNav" href="/user/userpage" data-hover="'.$user.'">Welcome '.$user.'</a>';
                }else {
                    echo '<a href="#modal" class="iconUser">';
                    echo '<i class="fa fa-sign-in"></i>';
                    echo '</a>';
                }
                ?>
            </nav>
        </div>

    </div>
  </header>
