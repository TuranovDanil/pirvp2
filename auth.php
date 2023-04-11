<?php
//require_once 'dbconnect.php';
//
//// Если флаг на добавление, до добавляем запись
//if (!empty($_POST['submit']) && $_POST['submit'] == 'AUTH') {
//
//    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
//    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
//
//    $password = md5($password);
//
//    $result1 = "SELECT * FROM users WHERE login = '$login'";
//    $user1 = mysqli_query($mysqli, $result1);
//    $user1 = mysqli_fetch_assoc($user1);
//    if (!empty($user1)) {
//        echo "Логин занят";
//        exit();
//    }
//
//    $query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
//    $res = mysqli_query($mysqli, $query);
//
//    if (!$res) die (mysqli_error($mysqli));
//
//    if (mysqli_affected_rows($mysqli) == 1) {
//        echo "<h2>Запись добавлена</h2>";
//    }
//}
//
//


require_once __DIR__ . '/boot.php';

// проверяем наличие пользователя с указанным юзернеймом
$stmt = pdo()->prepare("SELECT * FROM users WHERE login = :login");
$stmt->execute(['login' => $_POST['login']]);
if (!$stmt->rowCount()) {
    flash('Пользователь с такими данными не зарегистрирован');
    header('Location: auth_view.php');
    die;
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// проверяем пароль
if (password_verify($_POST['password'], $user['password'])) {
    // Проверяем, не нужно ли использовать более новый алгоритм
    // или другую алгоритмическую стоимость
    // Например, если вы поменяете опции хеширования
    if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = pdo()->prepare('UPDATE users SET password = :password WHERE login = :login');
        $stmt->execute([
            'login' => $_POST['login'],
            'password' => $newHash,
        ]);
    }
    $_SESSION['user_id'] = $user['id'];
    header('Location: films.php');
    die;
}

flash('Пароль неверен');
header('Location: auth_view.php');