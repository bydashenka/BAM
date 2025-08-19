<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../includes/db.php';

function formatPhoneNumber($number) {
    // Удаляем всё, кроме цифр
    $clean = preg_replace('/\D/', '', $number);

    if (strlen($clean) === 11 && $clean[0] === '7') {
        return '+7 (' . substr($clean, 1, 3) . ') ' . substr($clean, 4, 3) . '-' . substr($clean, 7, 2) . '-' . substr($clean, 9, 2);
    }

    return $number; // если что-то не так — выводим как есть
}

// Проверка авторизации
if (!isset($_SESSION['number'])) {
    header('Location: /index.php');
    exit();
}

// Получаем данные пользователя
$user_phone = $_SESSION['number'];
$user_data = [];
$applications = [];

$stmt = $mysql->prepare("SELECT FIO, number FROM users WHERE number = ?");
if ($stmt) {
    $stmt->bind_param("s", $user_phone);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();
}

// Получаем заявки
$stmt = $mysql->prepare("SELECT * FROM application WHERE number = ? ORDER BY datetime DESC");
if ($stmt) {
    $stmt->bind_param("s", $user_phone);
    $stmt->execute();
    $applications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="account-container">
        <h1>Личный кабинет</h1>
        
        <div class="user-info">
            <h2>Здравствуйте, <?= htmlspecialchars($user_data['FIO'] ?? 'Пользователь') ?>!</h2>
            <p>Ваш номер телефона: <?= htmlspecialchars(formatPhoneNumber($user_data['number'] ?? '')) ?></p>
        </div>

        <h2>Ваши заявки</h2>
        <?php if (!empty($applications)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Дата и время</th>
                        <th>Сообщение</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?= htmlspecialchars($app['datetime']) ?></td>
                        <td><?= htmlspecialchars($app['message']) ?></td>
                        <td class="status-<?= htmlspecialchars($app['status']) ?>">
                            <?= match($app['status']) {
                                'pending' => 'В обработке',
                                'completed' => 'Завершена',
                                'rejected' => 'Отклонена',
                                default => htmlspecialchars($app['status'])
                            } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>У вас пока нет заявок</p>
        <?php endif; ?>

        <div class="button">
            <a href="logout.php" class="button-link">Выйти из аккаунта</a>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>