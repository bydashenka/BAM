<?php
if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
}
session_start();

include 'db.php';

// Проверяем, вошел ли пользователь
$isLoggedIn = isset($_SESSION['id_users']) && !empty($_SESSION['id_users']);
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$user_number = isset($_SESSION['number']) ? $_SESSION['number'] : null;

if ($isLoggedIn && empty($user_role)) {
    $user_id = $_SESSION['id_users'];
    $stmt = $mysql->prepare("SELECT role FROM users WHERE id_users = ?");

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();

        if ($user_data && isset($user_data['role'])) {
            $_SESSION['role'] = $user_data['role']; // Сохраняем роль в сессии
            $user_role = $user_data['role'];
        }
    }
}

// Если по какой-то причине роль осталась пустой — форсим "client"
if (!$user_role) {
    $user_role = 'client';
    $_SESSION['role'] = 'client';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta  name="description" content="БАМСтрой - строительно-ремонтная компания">
    <link rel="stylesheet" href="style.css">
    <title>BAMStroy</title>
</head>
<body>
    <header>
        <nav class="menu">
            <ul class="menu__items">
                <li class="menu__item"><a class="menu__link" href="index.php"><img class="menu__logo" src="img/logo.svg" alt="Логотип BAMStroy"></a></li>
                <li class="menu__item"><a class="menu__link" href="index.php#services">Инженерные системы</a></li>
                <li class="menu__item"><a class="menu__link" href="index.php#repair">Ремонт под ключ</a></li>
                <li class="menu__item"><a class="menu__link" href="index.php#contacts">Контакты</a></li>
                <li class="menu__item"><a class="menu__link" href="#"><img class="menu__account" src="img/account.svg" alt="Аккаунт"></a></li>
            </ul>
        </nav>
    </header>

    <section class="profile">
        <h2><?= ($user_role == 'admin') ? 'Административная панель' : 'Личный кабинет' ?></h2>
        <h2><?= ($user_role == 'admin') ? 'Заявки' : ('Ваши заявки' . (isset($_SESSION['FIO']) ? ', ' . $_SESSION['FIO'] : '')) ?></h2>
        <table>
            <?php
            if ($user_role == 'client' && empty($user_number)) {
                echo "<tr><td colspan='5'>Ошибка: номер телефона не найден в сессии.</td></tr>";
            } else {
                if ($user_role == 'admin') {
                    $query = "SELECT * FROM application ORDER BY datetime DESC";
                    $stmt = $mysql->prepare($query);
                } else {
                    $query = "SELECT * FROM application WHERE number = ? ORDER BY datetime DESC";
                    $stmt = $mysql->prepare($query);
                    $stmt->bind_param("s", $user_number);
                }

                if ($stmt) {
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        echo "<tr>";
                        if ($user_role == 'admin') {
                            echo "<th>ФИО</th><th>Номер телефона</th>";
                        }
                        echo "<th>Дата и время заявки</th><th>Сообщение</th><th>Статус</th>";
                        if ($user_role == 'admin') {
                            echo "<th>Изменить</th>";
                        }
                        echo "</tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            if ($user_role == 'admin') {
                                echo "<td>{$row['FIO']}</td><td>{$row['number']}</td>";
                            }
                            echo "<td>{$row['datetime']}</td><td>{$row['message']}</td><td>{$row['status']}</td>";
                            if ($user_role == 'admin') {
                                echo "<td><a href='update.php?id={$row['id_application']}'>Изменить</a></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Нет заявок.</td></tr>";
                    }
                    $stmt->close();
                } else {
                    echo "<tr><td colspan='5'>Ошибка запроса.</td></tr>";
                }
            }
            ?>
        </table>





<?php if ($isLoggedIn): ?>
<div class="button">
    <a class="button-link" href="/logout.php">Выйти</a>
        </div>
<?php endif; ?>
</section>

    <footer>
        <div class="footmenu">
            <ul class="footmenu__items">
                <li class="footmenu__item"><a class="footmenu__link" href="#services">Инженерные системы</a></li>
                <li class="footmenu__item"><a class="footmenu__link" href="#repair">Ремонт под ключ</a></li>
                <li class="footmenu__item"><a class="footmenu__link" href="#about">О нас</a></li>
                <li class="footmenu__item"><a class="footmenu__link" href="#contacs">Контакты</a></li>
            </ul>
            <div class="footmenu__logo">
                <img class="footmenu__img" src="img/logo.svg" alt="Логотип BAMStroy">
            </div>
            <div class="footmenu__social">
                <p class="footmenu__mail">bam_71@mail.ru</p>
                <div class="footmenu__icons">
                    <a href="#"><img class="footmenu__icon" src="img/telegram.svg" alt="telegram"></a>
                    <a href="#"><img class="footmenu__icon" src="img/vk.svg" alt="vk"></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>