<?php
session_start();
include 'db.php';

// Проверяем, является ли пользователь администратором
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    die("Ошибка: Доступ запрещен.");
}

$user_id = $_SESSION['id'];
$user_query = $mysql->prepare("SELECT role FROM users WHERE id_users = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user_data = $user_result->fetch_assoc();

if ($user_data['role'] !== 'admin') {
    die("Ошибка: У вас нет прав доступа.");
}

// Проверяем, передан ли ID заявки
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Ошибка: ID заявки не указан.");
}

$application_id = $_GET['id'];

// Получаем информацию о заявке
$app_query = $mysql->prepare("SELECT * FROM application WHERE id_application = ?");
$app_query->bind_param("i", $application_id);
$app_query->execute();
$app_result = $app_query->get_result();

if ($app_result->num_rows === 0) {
    die("Ошибка: Заявка не найдена.");
}

$app_data = $app_result->fetch_assoc();

// Обновление статуса заявки
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['status']) || empty($_POST['status'])) {
        die("Ошибка: Выберите статус заявки.");
    }

    $new_status = $_POST['status'];
    $update_query = $mysql->prepare("UPDATE application SET status = ? WHERE id_application = ?");
    $update_query->bind_param("si", $new_status, $application_id);

    if ($update_query->execute()) {
        echo "<p>Статус заявки успешно обновлен.</p>";
    } else {
        echo "<p>Ошибка обновления статуса: " . $mysql->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование заявки</title>
</head>
<body>
    <h2>Редактирование заявки #<?php echo htmlspecialchars($app_data['id_application']); ?></h2>
    <p><strong>ФИО:</strong> <?php echo htmlspecialchars($app_data['FIO']); ?></p>
    <p><strong>Номер телефона:</strong> <?php echo htmlspecialchars($app_data['number']); ?></p>
    <p><strong>Дата и время:</strong> <?php echo htmlspecialchars($app_data['datetime']); ?></p>
    <p><strong>Сообщение:</strong> <?php echo htmlspecialchars($app_data['message']); ?></p>
    
    <form method="POST">
        <label for="status">Статус заявки:</label>
        <select name="status" id="status">
            <option value="В обработке" <?php echo ($app_data['status'] == 'В обработке') ? 'selected' : ''; ?>>В обработке</option>
            <option value="Принята" <?php echo ($app_data['status'] == 'Принята') ? 'selected' : ''; ?>>Принята</option>
            <option value="Отклонена" <?php echo ($app_data['status'] == 'Отклонена') ? 'selected' : ''; ?>>Отклонена</option>
        </select>
        <button type="submit">Обновить статус</button>
    </form>
    <p><a href="profile.php">Назад</a></p>
</body>
</html>


?>
