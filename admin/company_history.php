<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_title = $mysql->real_escape_string($_POST['section_title']);
    $description1 = $mysql->real_escape_string($_POST['description1']);
    $description2 = $mysql->real_escape_string($_POST['description2']);
    $description3 = $mysql->real_escape_string($_POST['description3']);
    $image_path = $mysql->real_escape_string($_POST['image_path']);
    $founder_text = $mysql->real_escape_string($_POST['founder_text']);

    $query = "UPDATE company_history SET 
        section_title = '$section_title',
        description1 = '$description1',
        description2 = '$description2',
        description3 = '$description3',
        image_path = '$image_path',
        founder_text = '$founder_text' 
        WHERE id = 1";

    if ($mysql->query($query)) {
        echo "<script>alert('Данные успешно обновлены'); window.location.href = 'company_history.php';</script>";
        exit();
    } else {
        echo "<script>alert('Ошибка обновления: " . $mysql->error . "');</script>";
    }
}

$result = $mysql->query("SELECT * FROM company_history WHERE id = 1");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование истории компании</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование истории компании</h2>
    <form method="post" action="company_history.php">
        <label>Заголовок раздела:<br />
            <input type="text" name="section_title" value="<?= htmlspecialchars($row['section_title']) ?>" required />
        </label><br /><br />

        <label>Описание 1:<br />
            <textarea name="description1" rows="4" required><?= htmlspecialchars($row['description1']) ?></textarea>
        </label><br /><br />

        <label>Описание 2:<br />
            <textarea name="description2" rows="4" required><?= htmlspecialchars($row['description2']) ?></textarea>
        </label><br /><br />

        <label>Описание 3:<br />
            <textarea name="description3" rows="4" required><?= htmlspecialchars($row['description3']) ?></textarea>
        </label><br /><br />

        <label>Путь к изображению:<br />
            <input type="text" name="image_path" value="<?= htmlspecialchars($row['image_path']) ?>" required />
        </label><br /><br />

        <label>Текст основателя:<br />
            <textarea name="founder_text" rows="3" required><?= htmlspecialchars($row['founder_text']) ?></textarea>
        </label><br /><br />

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
