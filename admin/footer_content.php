<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logo_path = $mysql->real_escape_string($_POST['logo_path']);
    $email = $mysql->real_escape_string($_POST['email']);
    $telegram_link = $mysql->real_escape_string($_POST['telegram_link']);
    $telegram_icon_path = $mysql->real_escape_string($_POST['telegram_icon_path']);
    $vk_link = $mysql->real_escape_string($_POST['vk_link']);
    $vk_icon_path = $mysql->real_escape_string($_POST['vk_icon_path']);

    $query = "UPDATE footer_content SET 
        logo_path='$logo_path', 
        email='$email', 
        telegram_link='$telegram_link', 
        telegram_icon_path='$telegram_icon_path', 
        vk_link='$vk_link', 
        vk_icon_path='$vk_icon_path' 
        WHERE id = 1";

    if ($mysql->query($query)) {
        echo "<script>alert('Данные успешно обновлены'); window.location.href = 'footer_content.php';</script>";
        exit();
    } else {
        echo "Ошибка обновления: " . $mysql->error;
    }
}

$result = $mysql->query("SELECT * FROM footer_content WHERE id = 1");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование футера</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование содержимого подвала сайта</h2>
    <form method="post" action="footer_content.php">
        <label>Путь к логотипу:<br />
            <input type="text" name="logo_path" value="<?= htmlspecialchars($row['logo_path']) ?>" required />
        </label><br /><br />
        <label>Email:<br />
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required />
        </label><br /><br />
        <label>Ссылка на Telegram:<br />
            <input type="url" name="telegram_link" value="<?= htmlspecialchars($row['telegram_link']) ?>" />
        </label><br /><br />
        <label>Путь к иконке Telegram:<br />
            <input type="text" name="telegram_icon_path" value="<?= htmlspecialchars($row['telegram_icon_path']) ?>" />
        </label><br /><br />
        <label>Ссылка на VK:<br />
            <input type="url" name="vk_link" value="<?= htmlspecialchars($row['vk_link']) ?>" />
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
