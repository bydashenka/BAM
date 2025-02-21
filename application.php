<?php
header('Content-Type: application/json; charset=utf-8'); // Отвечаем JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";

// Получаем и фильтруем данные
$FIO = trim($_POST['FIO']);
$number = preg_replace('/\D/', '', $_POST['number']); // Убираем нецифровые символы
$message = trim($_POST['message']);

// Проверяем обязательные поля
if (empty($FIO) || empty($number)) {
    echo json_encode(["status" => "error", "message" => "Заполните обязательные поля!"]);
    exit();
}

// Проверяем корректность номера телефона 
if (!preg_match('/^(\+7|7|8)?\d{10}$/', $number)) {
    echo json_encode(["status" => "error", "message" => "Введите корректный номер телефона."]);
    exit();
}

// SQL-запрос (теперь добавили `message`)
$sqlInsert = "INSERT INTO application (FIO, number, message, datetime, status) VALUES (?, ?, ?, NOW(), 'Заявка отправлена')";
$stmt = $mysql->prepare($sqlInsert);
$stmt->bind_param("sss", $FIO, $number, $message);

if ($stmt->execute()) {
    $_SESSION['id'] = $stmt->insert_id;
    json_encode(["status" => "success", "message" => "Заявка отправлена!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Ошибка отправки."]);
}

// Закрываем соединение
$stmt->close();
$mysql->close();
exit();
?>
