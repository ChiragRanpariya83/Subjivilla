<?php 
    session_start();
    error_reporting(0); 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SubjiVilla</title>
        <?php
        include('includes/style.php');
        include('includes/script.php');
        ?>
        </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="login-process.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" name="username" placeholder="Enter Username" />
                                                <label for="inputName">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="pwd" placeholder="Enter Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div style="color: red;"><?php echo $_SESSION['invalid']; unset($_SESSION['invalid']); ?></div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SubjiVilla 2025</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php
        include('includes/script.php');
        ?>
    </body>
</html>
