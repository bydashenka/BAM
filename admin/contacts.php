<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_title = $mysql->real_escape_string($_POST['section_title']);
    $email = $mysql->real_escape_string($_POST['email']);
    $telegram_link = $mysql->real_escape_string($_POST['telegram_link']);
    $vk_link = $mysql->real_escape_string($_POST['vk_link']);
    $telegram_icon_path = $mysql->real_escape_string($_POST['telegram_icon_path']);
    $vk_icon_path = $mysql->real_escape_string($_POST['vk_icon_path']);

    $query = "UPDATE contacts SET 
        section_title = '$section_title',
        email = '$email',
        telegram_link = '$telegram_link',
        vk_link = '$vk_link',
        telegram_icon_path = '$telegram_icon_path',
        vk_icon_path = '$vk_icon_path'
        WHERE id = 1";

    if ($mysql->query($query)) {
        echo "<script>alert('Данные успешно обновлены'); window.location.href = 'contacts.php';</script>";
        exit();
    } else {
        echo "<script>alert('Ошибка обновления: " . $mysql->error . "');</script>";
    }
}

$result = $mysql->query("SELECT * FROM contacts WHERE id = 1");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование контактов</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование секции Контакты</h2>
    <form method="post" action="contacts.php">
        <label>Заголовок секции:<br />
            <input type="text" name="section_title" value="<?= htmlspecialchars($row['section_title']) ?>" required />
        </label><br /><br />

        <label>Email:<br />
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required />
        </label><br /><br />

        <label>Ссылка Telegram:<br />
            <input type="text" name="telegram_link" value="<?= htmlspecialchars($row['telegram_link']) ?>" />
        </label><br /><br />

        <label>Ссылка VK:<br />
            <input type="text" name="vk_link" value="<?= htmlspecialchars($row['vk_link']) ?>" />
        </label><br /><br />

        <label>Путь к иконке Telegram:<br />
            <input type="text" name="telegram_icon_path" value="<?= htmlspecialchars($row['telegram_icon_path']) ?>" />
        </label><br /><br />

        <label>Путь к иконке VK:<br />
            <input type="text" name="vk_icon_path" value="<?= htmlspecialchars($row['vk_icon_path']) ?>" />
        </label><br /><br />

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
