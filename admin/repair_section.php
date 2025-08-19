<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обновление repair_section
    $title = $mysql->real_escape_string($_POST['title']);
    $description = $mysql->real_escape_string($_POST['description']);
    $footer_text = $mysql->real_escape_string($_POST['footer_text']);

    $updateSection = "UPDATE repair_section SET 
        title = '$title', 
        description = '$description', 
        footer_text = '$footer_text' 
        WHERE id = 1";

    $mysql->query($updateSection);

    // Обновление repair_items
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $index => $id) {
            $id = (int)$id;
            $item_title = $mysql->real_escape_string($_POST['item_title'][$index]);
            $item_order = (int)$_POST['item_order'][$index];

            $updateItem = "UPDATE repair_items SET title='$item_title', item_order=$item_order WHERE id=$id";
            $mysql->query($updateItem);
        }
    }

    echo "<script>alert('Раздел и элементы успешно обновлены'); window.location.href='repair_section.php';</script>";
    exit();
}

// Получение данных
$section = $mysql->query("SELECT * FROM repair_section WHERE id = 1")->fetch_assoc();
$items = $mysql->query("SELECT * FROM repair_items ORDER BY item_order ASC");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Редактирование раздела "Ремонт под ключ"</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        input[type=text], input[type=number], textarea { width: 100%; box-sizing: border-box; }
        button { padding: 8px 16px; margin-top: 20px; }
    </style>
</head>
<body>
<div class="edit">
    <h2>Редактирование раздела "Ремонт под ключ"</h2>
    <form method="post">
        <label>Заголовок:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($section['title']) ?>" required><br><br>

        <label>Описание:</label><br>
        <textarea name="description" rows="5" required><?= htmlspecialchars($section['description']) ?></textarea><br><br>

        <label>Текст в футере:</label><br>
        <textarea name="footer_text" rows="3" required><?= htmlspecialchars($section['footer_text']) ?></textarea><br><br>

        <h3>Элементы ремонта</h3>
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Порядок</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items->fetch_assoc()): ?>
                <tr>
                    <td>
                        <input type="hidden" name="ids[]" value="<?= $item['id'] ?>">
                        <input type="text" name="item_title[]" value="<?= htmlspecialchars($item['title']) ?>" required>
                    </td>
                    <td>
                        <input type="number" name="item_order[]" value="<?= $item['item_order'] ?>" min="1" required>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ-панель</a>
    </div>
</body>
</html>
