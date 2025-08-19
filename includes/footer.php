<?php
require_once __DIR__ . '/db.php';

// Получаем пункты меню
$menuItems = [];
$menuQuery = $mysql->query("SELECT * FROM menu ORDER BY display_order");
if ($menuQuery) {
    while ($row = $menuQuery->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

// Получаем данные футера
$footerResult = $mysql->query("SELECT * FROM footer_content LIMIT 1");
$footer = $footerResult->fetch_assoc();
?>

<footer>
    <div class="footmenu">
        <ul class="footmenu__items">
            <?php foreach ($menuItems as $item): ?>
                <li class="footmenu__item">
                    <a class="footmenu__link" href="<?= $item['link'] ?>">
                        <?= $item['text'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="footmenu__logo">
            <img class="footmenu__img" src="<?= $footer['logo_path'] ?>" alt="Логотип BAMStroy">
        </div>

        <div class="footmenu__social">
            <p class="footmenu__mail"><?= $footer['email'] ?></p>
            <div class="footmenu__icons">
                <?php if ($footer['telegram_link']): ?>
                    <a href="<?= $footer['telegram_link'] ?>" target="_blank">
                        <img class="footmenu__icon" src="<?= $footer['telegram_icon_path'] ?>" alt="telegram">
                    </a>
                <?php endif; ?>

                <?php if ($footer['vk_link']): ?>
                    <a href="<?= $footer['vk_link'] ?>" target="_blank">
                        <img class="footmenu__icon" src="<?= $footer['vk_icon_path'] ?>" alt="vk">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
