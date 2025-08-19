<?php
session_start();
if (!isset($_SESSION['id_users']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../user/auth.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>
<div class="admin">
    <h1>Административная панель</h1>
    <nav>
        <ul class="admin__list">
            <li class="admin__link"><a class="admin__text" href="applications.php">Заявки</a></li>
            <li class="admin__link"><a class="admin__text" href="header_content.php">Шапка сайта</a></li>
            <li class="admin__link"><a class="admin__text" href="menu.php">Меню</a></li>
            <li class="admin__link"><a class="admin__text" href="count_stats.php">Статистика</a></li>
            <li class="admin__link"><a class="admin__text" href="services.php">Услуги</a></li>
            <li class="admin__link"><a class="admin__text" href="consultation_section.php">Секция консультации</a></li>
            <li class="admin__link"><a class="admin__text" href="repair_section.php">Секция ремонта</a></li>
            <li class="admin__link"><a class="admin__text" href="company_history.php">История компании</a></li>
            <li class="admin__link"><a class="admin__text" href="contacts.php">Контакты</a></li>
            <li class="admin__link"><a class="admin__text" href="footer_content.php">Подвал</a></li>
        </ul>
    </nav>
    <form action="../user/logout.php" method="post">
        <button type="submit">Выйти из админ-панели</button>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
