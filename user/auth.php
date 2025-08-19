<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../includes/db.php";

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный метод запроса']);
    exit();
}

// Очистка входных данных для предотвращения XSS
$number = htmlspecialchars(preg_replace('/\D/', '', $_POST['number'] ?? ''), ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

if (empty($number) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Заполните все поля']);
    exit();
}

$stmt = $mysql->prepare("SELECT id_users, FIO, number, password, role FROM users WHERE number = ?");
$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Пользователь с таким номером не найден']);
    exit();
}

$user = $result->fetch_assoc();

if (password_verify($password, $user['password'])) {
    $_SESSION['id_users'] = $user['id_users'];
    $_SESSION['FIO'] = $user['FIO'];
    $_SESSION['number'] = $user['number'];
    $_SESSION['role'] = $user['role'];
    
    $response = [
        'status' => 'success',
        'message' => 'Авторизация успешна!',
        'redirect' => $user['role'] === 'admin' ? 'admin/admin.php' : 'user/account.php'
    ];
} else {
    $response = ['status' => 'error', 'message' => 'Неверный пароль'];
}

echo json_encode($response);
?>
