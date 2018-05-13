<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="/web/css/main.css" rel="stylesheet">
</head>
<body>

<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><?= Sf::app()->getParam('appName', 'Test App'); ?></h1>
                <p><?= Sf::app()->getParam('appDescription', ''); ?></p>
                <?php if (Sf::app()->Identity->getIsGuest()) { ?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary">Login</a>

                    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="loginmodal-container">
                                <h1>Login to Your Account</h1><br>
                                <form method="post">
                                    <input type="text" name="login" placeholder="Username">
                                    <input type="password" name="password" placeholder="Password">
                                    <input type="submit" class="login loginmodal-submit" value="Login">
                                </form>

                                <div class="login-help">
                                    <a href="#">Register</a> - <a href="#">Forgot Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="/site/logout" class="btn btn-primary">Logout</a>
                <?php } ?>
            </div>
        </div>

    </div>
</div>

<div class="container">

</div>

<?= $content; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/web/js/common.js?v=1"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/web/js/bootstrap.min.js"></script>
</body>
</html>