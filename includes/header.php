<?php
require_once __DIR__ . '/db.php';

// Получаем данные из таблицы header_content
$headerResult = $mysql->query("SELECT * FROM header_content LIMIT 1");
$header = $headerResult->fetch_assoc();

// Получаем пункты меню
$menuResult = $mysql->query("SELECT * FROM menu ORDER BY display_order");
?>
    <nav class="menu">
        <ul class="menu__items">
            <li class="menu__item">
                <a class="menu__link" href="/bam/index.php">
                    <img class="menu__logo" src="<?= $header['logo_path'] ?>" alt="Логотип BAMStroy">
                </a>
            </li>

            <?php while ($item = $menuResult->fetch_assoc()): ?>
                <li class="menu__item">
                    <a class="menu__link" href="<?= $item['link'] ?>">
                        <p class="menu__text"><?= $item['text'] ?></p>
                    </a>
                </li>
            <?php endwhile; ?>

            <li class="menu__item">
                <a class="menu__link" href="/bam/account.php" id="loginBtn">
                    <img class="menu__account" src="<?= $header['account_icon_path'] ?>" alt="Аккаунт">
                </a>
            </li>
        </ul>
    </nav>

