<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo "<script>alert('{$_SESSION['login_error']}');</script>";
    unset($_SESSION['login_error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="assets/Icon/logo-JJ.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
                    </div>
                    <div class="card-body">
                        <form id="login-form" action="proseslogin.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text password-toggle h-100">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-100" style="margin-top:20px;">Login</button>
                        </form>
                        <div class="askaccount mt-2">
                            <p>Belum memiliki akun? <a href="regist.html" class="text-success">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('.password-toggle').on('click', function() {
            var passwordInput = $(this).parent().prev('input');
            var passwordIcon = $(this).find('i');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                passwordIcon.removeClass('fa-eye-slash');
                passwordIcon.addClass('fa-eye');
            } else {
                passwordInput.attr('type', 'password');
                passwordIcon.removeClass('fa-eye');
                passwordIcon.addClass('fa-eye-slash');
            }
        });

    </script>
</body>
</html>