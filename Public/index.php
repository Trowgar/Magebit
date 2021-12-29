<?php
    include "../Controller/DataController.php";

    $dataController = new DataController();
    $messages = [];

    if(isset($_POST['submit'])){
        if ($dataController->checkError(trim($_POST['email']), $_POST['checkbox'])){
            $messages = $dataController->getError();
        }else{
            $dataController->setData($_POST);
            header("Location: success.html");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" type="image/x-icon" href="../IMG/SVG/logo.svg">
    <title>pineapple.</title>
</head>
<body>
    <div class="content">
        <div class="main__wrapper">
            <header class="header">
                <div class="header__content">
                    <div class="header__left">
                        <img src="../img/SVG/logo.svg" class="logo" alt="Brand Name">
                        <a href="/" class="brand__name">pineapple.</a>
                    </div>
                    <!-- left -->
                    <div class="header__right">
                        <ul class="menu">
                            <li class="menu__list"><a href="#" class="menu__link">About</a></li>
                            <li class="menu__list"><a href="#" class="menu__link">How it works</a></li>
                            <li class="menu__list"><a href="#" class="menu__link">Contact</a></li>
                        </ul>
                    </div>
                    <!-- right -->
                </div>
                <!-- header content -->
            </header>

            <div class="content__wrapper">
                
                <div class="success hidden">
                    <img class="cup" src="../IMG/SVG/cup.svg" alt="cup">
                    <p class="tittle">
                        Thanks for subscribing!
                    </p>
                    <p class="subtittle">
                        You have successfully subscribed to our email listing. Check your email for the discount code.
                    </p>
                </div>

                <div class="subscription">
                    <div class="text__content">
                        <p class="tittle">
                            Subscribe to newsletter
                        </p>
                        <p class="subtittle">
                            Subscribe to our newsletter and get 10% discount on pineapple glasses.
                        </p>
                    </div>

                    <form class="subs__form" id="form" method="POST">
                        <input type="text" name="email" class="subs__input" oninput="validate()" placeholder="Type your email address here…">
                        <button type="submit" name="submit" onsubmit="successful()" class="submit">
                            <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M17.7071 0.2929C17.3166 -0.0976334 16.6834 -0.0976334 16.2929 0.2929C15.9023 0.683403 15.9023 1.31658 16.2929 1.70708L20.5858 5.99999H1C0.447693 5.99999 0 6.44772 0 6.99999C0 7.55227 0.447693 7.99999 1 7.99999H20.5858L16.2929 12.2929C15.9023 12.6834 15.9023 13.3166 16.2929 13.7071C16.6834 14.0976 17.3166 14.0976 17.7071 13.7071L23.7071 7.70708C24.0977 7.31658 24.0977 6.6834 23.7071 6.2929L17.7071 0.2929Z" fill="#131821"/>
                            </svg>
                        </button>
                    </form>

                    <div class="terms">
                        <input form="form" class="checked" onclick="validate()" id="agree__terms" name="checkbox" type="checkbox">
                        <label for="agree__terms" class="agree__text">
                            I agree to <a href="#">terms of service</a>
                        </label>
                    </div>

                    <div class="error">
                        <?php
                            foreach ($messages as $value) {
                                echo $value . "<br>";
                            }
                        ?>     
                    </div>

                    <div class="termsError"></div>
                    
                </div>
                
                <hr class="line">

                <div class="social">
                    <ul class="social__menu">
                        <a href="#">
                            <li class="social__list facebook shadow">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a href="#">
                            <li class="social__list instagram shadow">
                                <i class="fab fa-instagram"></i>
                            </li>
                        </a>
                        <a href="#">
                            <li class="social__list twitter shadow">
                                <i class="fab fa-twitter"></i>
                            </li>
                        </a>
                        <a href="#">
                            <li class="social__list youtube shadow">
                                <i class="fab fa-youtube"></i>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
            <!-- content wrapper -->
        </div> 
    </div>
    <!-- end main wrapper -->

    <script src="../JS/validation.js"></script>
</body>
</html>