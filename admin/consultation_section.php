<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $mysql->real_escape_string($_POST['title']);
    $description = $mysql->real_escape_string($_POST['description']);
    $button_text = $mysql->real_escape_string($_POST['button_text']);
    $button_link = $mysql->real_escape_string($_POST['button_link']);

    $query = "UPDATE consultation_section SET 
        title = '$title',
        description = '$description',
        button_text = '$button_text',
        button_link = '$button_link'
        WHERE id = 1";

    if ($mysql->query($query)) {
        echo "<script>alert('Данные успешно обновлены'); window.location.href = 'consultation_section.php';</script>";
        exit();
    } else {
        echo "<script>alert('Ошибка обновления: " . $mysql->error . "');</script>";
    }
}

$result = $mysql->query("SELECT * FROM consultation_section WHERE id = 1");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование секции консультации</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование секции консультации</h2>
    <form method="post" action="consultation_section.php">
        <label>Заголовок:<br />
            <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required />
        </label><br /><br />

        <label>Описание:<br />
            <textarea name="description" rows="5" required><?= htmlspecialchars($row['description']) ?></textarea>
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
