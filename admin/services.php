<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

// Обработка формы при POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['services'])) {
    foreach ($_POST['services'] as $id => $serviceData) {
        $id = (int)$id;
        $title = $mysql->real_escape_string($serviceData['title']);
        $description = $mysql->real_escape_string($serviceData['description']);
        $footer_text = $mysql->real_escape_string($serviceData['footer_text']);
        $image_path = $mysql->real_escape_string($serviceData['image_path']);
        $class_name = $mysql->real_escape_string($serviceData['class_name']);

        $updateQuery = "UPDATE services SET 
            title = '$title',
            description = '$description',
            footer_text = '$footer_text',
            image_path = '$image_path',
            class_name = '$class_name'
            WHERE id = $id";

        $mysql->query($updateQuery);
    }
    echo "<script>alert('Изменения успешно сохранены');</script>";
}

// Получаем все услуги из базы
$result = $mysql->query("SELECT * FROM services ORDER BY id");
if (!$result) {
    die("Ошибка запроса: " . $mysql->error);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Управление услугами</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h2>Управление услугами</h2>

    <form method="post" action="services.php">
        <?php while ($service = $result->fetch_assoc()): ?>
            <div>
                <h3>Услуга <?= $service['id'] ?>: <?= htmlspecialchars($service['title']) ?></h3>

                <label for="title_<?= $service['id'] ?>">Название услуги:</label></br>
                <input type="text" id="title_<?= $service['id'] ?>" name="services[<?= $service['id'] ?>][title]" value="<?= htmlspecialchars($service['title']) ?>" required></br>

                <label for="description_<?= $service['id'] ?>">Описание:</label></br>
                <textarea id="description_<?= $service['id'] ?>" name="services[<?= $service['id'] ?>][description]" rows="4" required><?= htmlspecialchars($service['description']) ?></textarea></br>

                <label for="footer_text_<?= $service['id'] ?>">Текст в футере:</label></br>
                <textarea id="footer_text_<?= $service['id'] ?>" name="services[<?= $service['id'] ?>][footer_text]" rows="2"><?= htmlspecialchars($service['footer_text']) ?></textarea></br>

                <label for="image_path_<?= $service['id'] ?>">Путь к изображению:</label></br>
                <input type="text" id="image_path_<?= $service['id'] ?>" name="services[<?= $service['id'] ?>][image_path]" value="<?= htmlspecialchars($service['image_path']) ?>"></br>

                <label for="class_name_<?= $service['id'] ?>">CSS класс:</label></br>
                <input type="text" id="class_name_<?= $service['id'] ?>" name="services[<?= $service['id'] ?>][class_name]" value="<?= htmlspecialchars($service['class_name']) ?>"></br>
            </div>
        <?php endwhile; ?>

        <button type="submit">Сохранить изменения</button>
    </form>

    <a class="out" href="admin.php">← Вернуться в админ панель</a>
</div>
</body>
</html>
