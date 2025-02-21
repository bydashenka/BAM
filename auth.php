<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";

// Проверяем, переданы ли данные
if (!isset($_POST['number'], $_POST['password'])) {
    echo json_encode(["status" => "error", "message" => "Заполните все поля"]);
    exit();
}

// Очищаем номер телефона (оставляем только цифры)
$number = preg_replace('/\D/', '', trim($_POST['number']));
$password = trim($_POST['password']);

// Подготовленный запрос к БД
$sql = "SELECT * FROM users WHERE number = ?";
$stmt = $mysql->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Ошибка сервера при подготовке запроса"]);
    exit();
}

$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Проверка, является ли пароль в базе данных хешированным
    if (password_verify($password, $user['password'])) {
        $_SESSION['id_users'] = $user['id_users'];
        $_SESSION['FIO'] = $user['FIO'];
        $_SESSION['number'] = $user['number'];
        echo json_encode(["status" => "success", "message" => "Вы авторизованы!", "redirect" => "/account.php"]);
        exit();
    } elseif ($user['password'] === $password) { // Для паролей, которые не хешированы
        // При первой авторизации можно хешировать пароль и обновить его в базе
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Обновление пароля в базе данных
        $update_sql = "UPDATE users SET password = ? WHERE id_users = ?";
        $update_stmt = $mysql->prepare($update_sql);
        $update_stmt->bind_param("si", $hashedPassword, $user['id_users']);
        $update_stmt->execute();

        // Устанавливаем сессионные данные и подтверждаем успешный вход
        $_SESSION['id_users'] = $user['id_users'];
        $_SESSION['FIO'] = $user['FIO'];
        $_SESSION['number'] = $user['number'];
        $_SESSION['role'] = $user['role'];


        echo json_encode(["status" => "success", "message" => "Вы авторизованы и ваш пароль был зашифрован.", "redirect" => "/account.php"]);
        exit();
    } else {
        echo json_encode(["status" => "error", "message" => "Неверный пароль!"]);
        exit();
    }
} else {
    echo json_encode(["status" => "error", "message" => "Такого аккаунта не существует. Зарегистрируйтесь."]);
    exit();
}
?>
