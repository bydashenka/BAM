<?php
session_start();
header('Content-Type: application/json; charset=utf-8');


include "../includes/db.php";

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Некорректный метод запроса';
    echo json_encode($response);
    exit();
}

// Очистка входных данных для предотвращения XSS
$FIO = htmlspecialchars(trim($_POST['FIO'] ?? ''), ENT_QUOTES, 'UTF-8');
$number = htmlspecialchars(preg_replace('/\D/', '', $_POST['number'] ?? ''), ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
$repeat_password = htmlspecialchars($_POST['repeat_password'] ?? '', ENT_QUOTES, 'UTF-8');

// Валидация данных
if (empty($FIO)) {
    $response['message'] = 'Укажите ФИО';
    echo json_encode($response);
    exit();
}

if (!preg_match('/^[А-ЯЁA-Z][а-яёa-z]+(?:-[А-ЯЁA-Z][а-яёa-z]+)?\s[А-ЯЁA-Z][а-яёa-z]+(?:\s[А-ЯЁA-Z][а-яёa-z]+)?$/u', $FIO)) {
    $response['message'] = 'Укажите ФИО правильно (Иванов Иван Иванович)';
    echo json_encode($response);
    exit();
}

if (strlen($number) !== 11) {
    $response['message'] = 'Введите корректный номер (11 цифр)';
    echo json_encode($response);
    exit();
}

if (strlen($password) < 6) {
    $response['message'] = 'Пароль должен быть не менее 6 символов';
    echo json_encode($response);
    exit();
}

if ($password !== $repeat_password) {
    $response['message'] = 'Пароли не совпадают';
    echo json_encode($response);
    exit();
}

// Проверка существующего пользователя
$stmt = $mysql->prepare("SELECT id_users FROM users WHERE number = ?");
$stmt->bind_param("s", $number);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $response['message'] = 'Этот номер уже зарегистрирован';
    echo json_encode($response);
    exit();
}

// Хеширование пароля
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Создание пользователя
$stmt = $mysql->prepare("INSERT INTO users (FIO, number, password, role) VALUES (?, ?, ?, 'client')");
$stmt->bind_param("sss", $FIO, $number, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['id_users'] = $stmt->insert_id;
    $_SESSION['FIO'] = $FIO;
    $_SESSION['number'] = $number;
    $_SESSION['role'] = 'client';
    
    $response['status'] = 'success';
    $response['message'] = 'Регистрация успешна!';
} else {
    $response['message'] = 'Ошибка при регистрации';
}

echo json_encode($response);
?>
