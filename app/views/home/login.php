<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="<?= BASEURL ?>dist/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?= BASEURL ?>public/attribute/icon.png" height="100" class='mb-4'>
                                <h3>Sign In To Dashboard</h3>
                            </div>

                            <form method="post">

                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username" autofocus>
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left mb-5">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <button class="btn btn-primary btn-block" name="signin">Sign In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?= BASEURL ?>dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="<?= BASEURL ?>dist/assets/js/app.js"></script>
    <script src="<?= BASEURL ?>dist/assets/js/main.js"></script>
</body>

</html>