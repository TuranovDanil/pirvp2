<?php

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