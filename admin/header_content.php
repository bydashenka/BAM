<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logo_path = $mysql->real_escape_string($_POST['logo_path']);
    $account_icon_path = $mysql->real_escape_string($_POST['account_icon_path']);
    $main_title = $mysql->real_escape_string($_POST['main_title']);
    $subtitle = $mysql->real_escape_string($_POST['subtitle']);
    $button_text = $mysql->real_escape_string($_POST['button_text']);
    $button_link = $mysql->real_escape_string($_POST['button_link']);

    $query = "UPDATE header_content SET 
        logo_path = '$logo_path',
        account_icon_path = '$account_icon_path',
        main_title = '$main_title',
        subtitle = '$subtitle',
        button_text = '$button_text',
        button_link = '$button_link'
        WHERE id = 1";

    if ($mysql->query($query)) {
        echo "<script>alert('Данные успешно обновлены'); window.location.href = 'header_content.php';</script>";
        exit();
    } else {
        echo "<script>alert('Ошибка обновления: " . $mysql->error . "');</script>";
    }
}

$result = $mysql->query("SELECT * FROM header_content WHERE id = 1");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование хедера</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование содержимого шапки сайта</h2>
    <form method="post" action="header_content.php">
        <label>Путь к логотипу:<br />
            <input type="text" name="logo_path" value="<?= htmlspecialchars($row['logo_path']) ?>" required />
        </label><br /><br />

        <label>Путь к иконке аккаунта:<br />
            <input type="text" name="account_icon_path" value="<?= htmlspecialchars($row['account_icon_path']) ?>" required />
        </label><br /><br />

        <label>Главный заголовок:<br />
            <textarea name="main_title" rows="3" required><?= htmlspecialchars($row['main_title']) ?></textarea>
        </label><br /><br />

        <label>Подзаголовок:<br />
            <textarea name="subtitle" rows="3" required><?= htmlspecialchars($row['subtitle']) ?></textarea>
        </label><br /><br />

        <label>Текст кнопки:<br />
            <input type="text" name="button_text" value="<?= htmlspecialchars($row['button_text']) ?>" required />
        </label><br /><br />

        <label>Ссылка кнопки:<br />
            <input type="text" name="button_link" value="<?= htmlspecialchars($row['button_link']) ?>" required />
        </label><br /><br />

        <button type="submit">Сохранить изменения</button>
    </form>


    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
