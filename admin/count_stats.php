<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['count_number'] as $id => $count_number) {
        $count_number = $mysql->real_escape_string($count_number);
        $count_text = $mysql->real_escape_string($_POST['count_text'][$id]);

        $query = "UPDATE count_stats SET count_number = '$count_number', count_text = '$count_text' WHERE id = $id";
        $mysql->query($query);
    }
    echo "<script>alert('Данные успешно обновлены'); window.location.href = 'count_stats.php';</script>";
    exit();
}

// Получаем все записи
$result = $mysql->query("SELECT * FROM count_stats ORDER BY id");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование статистики</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование раздела Статистика</h2>
    <form method="post" action="count_stats.php">
        <?php while ($row = $result->fetch_assoc()): ?>
            <fieldset style="margin-bottom: 20px; padding: 10px;">
                <legend>Статистика <?= $row['id'] ?></legend>
                <label>Количество:<br />
                    <input type="number" name="count_number[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['count_number']) ?>" required />
                </label><br /><br />
                <label>Текст описания:<br />
                    <textarea name="count_text[<?= $row['id'] ?>]" rows="3" required><?= htmlspecialchars($row['count_text']) ?></textarea>
                </label>
            </fieldset>
        <?php endwhile; ?>

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
