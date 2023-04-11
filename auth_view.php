<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Вход/Регистрация</title>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h1>Форма входа</h1>
<!--            <form action="auth.php" method="post">-->
<!--                <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>-->
<!--                <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>-->
<!--                <input type="submit" name="submit" value="AUTH" class="btn btn-success"><br><br>-->
<!--            </form>-->
<!--            --><?php //flash() ?>

            <form method="post" action="auth.php">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="btn btn-outline-primary" href="registration_view.php">Register</a>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
</html>