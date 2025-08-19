<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
    // Обновляем все пункты меню в цикле
    foreach ($_POST['ids'] as $index => $id) {
        $id = (int)$id;
        $text = $mysql->real_escape_string($_POST['text'][$index]);
        $link = $mysql->real_escape_string($_POST['link'][$index]);
        $display_order = (int)$_POST['display_order'][$index];

        $updateQuery = "UPDATE menu SET text='$text', link='$link', display_order='$display_order' WHERE id=$id";
        $mysql->query($updateQuery);
    }
    echo "<script>alert('Пункты меню успешно обновлены'); window.location.href='menu.php';</script>";
    exit();
}

// Получаем все пункты меню
$result = $mysql->query("SELECT * FROM menu ORDER BY display_order ASC");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование меню</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Редактирование меню</h2>

    <form method="post" action="menu.php">
        <table>
            <thead>
                <tr>
                    <th>Текст</th>
                    <th>Ссылка</th>
                    <th>Порядок отображения</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <input type="hidden" name="ids[]" value="<?= $row['id'] ?>">
                        <input type="text" name="text[]" value="<?= htmlspecialchars($row['text']) ?>" required>
                    </td>
                    <td><input type="text" name="link[]" value="<?= htmlspecialchars($row['link']) ?>" required></td>
                    <td><input type="number" name="display_order[]" value="<?= $row['display_order'] ?>" required min="1"></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
