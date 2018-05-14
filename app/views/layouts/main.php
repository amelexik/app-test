<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Sf::app()->getParam('appName', 'Test App'); ?>
        - <?= Sf::app()->getParam('appDescription', ''); ?></title>
    <!-- Bootstrap -->
    <link href="/web/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="/web/css/main.css?v=2" rel="stylesheet">
</head>
<body>

<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="/"><?= Sf::app()->getParam('appName', 'Test App'); ?></a></h1>
                <p><?= Sf::app()->getParam('appDescription', ''); ?></p>
                <?php if (Sf::app()->Identity->getIsGuest()) { ?>
                    <p>U can add, edit, drop, reply comments - just <a href="#" data-toggle="modal" data-target="#login-modal">sign in</a>! Enjoy</p>
                <?php } else { ?>
                    <p>Hello <?=identity()->getLogin(); ?>! <a href="/site/logout" class="btn btn-primary">Logout</a></p>
                <?php } ?>

                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="loginmodal-container">
                            <h1>Login to Your Account</h1><br>
                            <form method="post" action="/">
                                <input type="text" value="user" name="login" placeholder="Username">
                                <input type="password" value="password" name="password" placeholder="Password">
                                <input type="submit" class="login loginmodal-submit" value="Login">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="container">

</div>

<?= $content; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="/web/js/common.js?v=2"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/web/js/bootstrap.min.js"></script>
</body>
</html>