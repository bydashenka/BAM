<?php
header('Content-Type: application/json; charset=utf-8'); // Отвечаем JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";


$_SESSION['id'] = $mysql->insert_id; 
$FIO = trim($_POST['FIO']);
$number = preg_replace('/\D/', '', $_POST['number']); // Убираем нецифровые символы
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];


if (!preg_match('/^[А-ЯЁA-Z][а-яёa-z]+(?:-[А-ЯЁA-Z][а-яёa-z]+)?\s[А-ЯЁA-Z][а-яёa-z]+(?:\s[А-ЯЁA-Z][а-яёa-z]+)?$/u', $FIO)) {
    echo json_encode(["status" => "error", "message" => "Укажите ФИО правильно."]);
    exit();
}

if (!preg_match('/^\d{11}$/', $number)) {
    echo json_encode(["status" => "error", "message" => "Введите корректный номер (11 цифр)."]);
    exit();
}

if ($password !== $repeat_password) {
    echo json_encode(["status" => "error", "message" => "Пароли не совпадают!"]);
    exit();
}

if (strlen($password) < 6) {
    echo json_encode(["status" => "error", "message" => "Пароль должен быть не менее 6 символов."]);
    exit();
}

// Проверка, есть ли такой номер
$sql = "SELECT * FROM users WHERE number = ?";
$stmt = $mysql->prepare($sql);
$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Этот номер уже зарегистрирован!"]);
    exit();
}

// Хэшируем пароль
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sqlInsert = "INSERT INTO users (FIO, number, password, role) VALUES (?, ?, ?, 'client')";
$stmt = $mysql->prepare($sqlInsert);
$stmt->bind_param("sss", $FIO, $number, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['FIO'] = $FIO;
    echo json_encode(["status" => "success", "message" => "Регистрация успешна!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Ошибка регистрации."]);
}
exit();
?>
