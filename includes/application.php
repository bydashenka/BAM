<?php
// // Включаем вывод ошибок для отладки (но только если это development среда)
// // В production лучше записывать ошибки в лог
// error_reporting(0);
// ini_set('display_errors', 0);

// // Убедимся, что никакой вывод не происходит до отправки заголовков
// ob_start();

// Проверка, что метод запроса POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["status" => "error", "message" => "Метод не разрешен"]);
    exit();
}

include "./db.php";

if ($mysql->connect_error) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["status" => "error", "message" => "Ошибка подключения к БД"]);
    exit();
}

session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$current_time = time();


if (isset($_SESSION['last_request_time']) && ($current_time - $_SESSION['last_request_time'] < 1)) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["status" => "error", "message" => "Слишком много запросов. Попробуйте позже."]);
    exit();
}

$_SESSION['last_request_time'] = $current_time;

// Очищаем буфер вывода на случай, если были какие-то случайные пробелы/вывод
ob_end_clean();

// Устанавливаем заголовок JSON
header('Content-Type: application/json; charset=utf-8');

// Проверяем существование POST-переменных
$FIO = isset($_POST['FIO']) ? trim($_POST['FIO']) : '';
$number = isset($_POST['number']) ? preg_replace('/\D/', '', $_POST['number']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Валидация ФИО
if (!preg_match('/^[А-ЯЁA-Z][а-яёa-z]+(?:-[А-ЯЁA-Z][а-яёa-z]+)?\s[А-ЯЁA-Z][а-яёa-z]+(?:\s[А-ЯЁA-Z][а-яёa-z]+)?$/u', $FIO)) {
    echo json_encode(["status" => "error", "message" => "Укажите ФИО правильно."]);
    exit();
}


if (empty($FIO) || empty($number)) {
    echo json_encode(["status" => "error", "message" => "Заполните обязательные поля!"]);
    exit();
}

if (!preg_match('/^7\d{10}$/', $number)) {
    echo json_encode(["status" => "error", "message" => "Введите корректный номер телефона. Пример: +7 (912) 345-67-89"]);
    exit();
}

// Экранирование
$FIO = htmlspecialchars($FIO, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// SQL-запрос
$sqlInsert = "INSERT INTO application (FIO, number, message, datetime, status) VALUES (?, ?, ?, NOW(), 'Заявка отправлена')";
$stmt = $mysql->prepare($sqlInsert);

if ($stmt === false) {
    echo json_encode(["status" => "error", "message" => "Ошибка подготовки запроса"]);
    exit();
}

$stmt->bind_param("sss", $FIO, $number, $message);

if ($stmt->execute()) {
    $_SESSION['id'] = $stmt->insert_id;
    echo json_encode(["status" => "success", "message" => "Заявка отправлена!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Ошибка отправки."]);
}

$stmt->close();
$mysql->close();
exit();
?>