<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

// Обновление статуса заявки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_application'], $_POST['status'])) {
    $id = intval($_POST['id_application']);
    $status = $mysql->real_escape_string($_POST['status']);

    $update_sql = "UPDATE application SET status = '$status' WHERE id_application = $id";
    if ($mysql->query($update_sql)) {
        echo "<script>alert('Статус обновлен');</script>";
    } else {
        echo "<script>alert('Ошибка при обновлении статуса');</script>";
    }
}

// Получаем все заявки
$result = $mysql->query("SELECT * FROM application ORDER BY datetime DESC");
function formatPhoneNumber($number) {
    // Удаляем всё, кроме цифр
    $clean = preg_replace('/\D/', '', $number);

    if (strlen($clean) === 11 && $clean[0] === '7') {
        return '+7 (' . substr($clean, 1, 3) . ') ' . substr($clean, 4, 3) . '-' . substr($clean, 7, 2) . '-' . substr($clean, 9, 2);
    }

    return $number; // если что-то не так — выводим как есть
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Заявки - Админка</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
<div class="edit">
    <h1>Управление заявками</h1>
    <a href="admin.php" class="out">← Вернуться в админ-панель</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Сообщение</th>
                <th>Дата и время</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_application']) ?></td>
                        <td><?= htmlspecialchars($row['FIO']) ?></td>
                        <td><?= htmlspecialchars(formatPhoneNumber($row['number'] ?? '')) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        <td><?= htmlspecialchars($row['datetime']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_application" value="<?= $row['id_application'] ?>" />
                                <select name="status" required>
                                    <?php
                                    $statuses = ["Заявка отправлена", "В обработке", "Выполнена", "Отменена"];
                                    foreach ($statuses as $status_option) {
                                        $selected = ($row['status'] === $status_option) ? 'selected' : '';
                                        echo "<option value=\"$status_option\" $selected>$status_option</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit">Обновить</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">Заявок пока нет</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
