<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <title>Вход</title>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <?php
            require_once __DIR__ . '/boot.php';

            $user = null;

            if (check_auth()) {
                // Получим данные пользователя по сохранённому идентификатору
                $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
                $stmt->execute(['id' => $_SESSION['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php if ($user) { ?>

                <h1>Welcome back, <?= htmlspecialchars($user['username']) ?>!</h1>

                <form class="mt-5" method="post" action="logout.php">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>

            <?php } else { ?>
                <h1>Форма входа</h1>

                <?php flash(); ?>

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
                        <button type="submit" class="btn btn-primary">Auth</button>
                        <a class="btn btn-outline-primary" href="registration_view.php">Register</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>