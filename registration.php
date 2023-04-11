<?php
//require_once 'dbconnect.php';
//
//// Если флаг на добавление, до добавляем запись
//if (!empty($_POST['submit']) && $_POST['submit'] == 'ADD') {
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

// Проверим, не занято ли имя пользователя
$stmt = pdo()->prepare("SELECT * FROM users WHERE login = :login");
$stmt->execute(['login' => $_POST['login']]);
if ($stmt->rowCount() > 0) {
    flash('Это login заня.');
    header('Location: registration_view.php'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
}

// Добавим пользователя в базу
$stmt = pdo()->prepare("INSERT INTO users (`login`, `password`) VALUES (:login, :password)");
$stmt->execute([
    'login' => $_POST['login'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
]);

header('Location: auth_view.php');