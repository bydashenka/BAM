<?php
session_start();
require_once __DIR__ . '/includes/db.php';

function fetchOne($query) {
    global $mysql;
    $result = $mysql->query($query);
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : [];
}

function fetchAll($query) {
    global $mysql;
    $result = $mysql->query($query);
    $rows = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function getServiceClass($id) {
    return [
        1 => 'electrics',
        2 => 'slabtoch',
        3 => 'water',
        4 => 'air'
    ][$id] ?? '';
}

$headerData = fetchOne("SELECT * FROM header_content LIMIT 1");
$stats = fetchAll("SELECT * FROM count_stats");
$services = fetchAll("SELECT * FROM services ORDER BY id LIMIT 4");
$all_services = fetchAll("SELECT * FROM services ORDER BY id");
$repair_data = fetchOne("SELECT * FROM repair_section LIMIT 1");
$repair_data['items'] = fetchAll("SELECT * FROM repair_items ORDER BY item_order");
$history_data = fetchOne("SELECT * FROM company_history LIMIT 1");
$contacts_data = fetchOne("SELECT * FROM contacts LIMIT 1");
$application = fetchOne("SELECT * FROM consultation_section WHERE id = 1");

// Полные данные услуг с элементами
$services_full = [];
foreach ($all_services as $service) {
    $stmt = $mysql->prepare("SELECT * FROM service_items WHERE service_id = ? ORDER BY item_order");
    $stmt->bind_param("i", $service['id']);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $service['items'] = $items;
    $services_full[$service['class_name']] = $service;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta  name="description" content="БАМСтрой - строительно-ремонтная компания">
    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="assets/js/main.js" defer></script>
    <title>BAMStroy</title>
</head>
<body>

<header>
<?php include_once __DIR__ . '/includes/header.php'; ?>
<section class="start">
    <h1><?= $headerData['main_title'] ?? 'Ваш надежный партнер' ?></h1>
    <p class="start__subtitle"><?= htmlspecialchars($headerData['subtitle'] ?? 'Описание компании') ?></p>
    <a href="<?= htmlspecialchars($headerData['button_link'] ?? '#contacts') ?>" class="button-link">
        <div class="button"><?= htmlspecialchars($headerData['button_text'] ?? 'Консультация') ?></div>
    </a>
</section>
</header>

<section class="count">
    <?php foreach ($stats as $stat): ?>
        <div class="count__item">
            <div class="count__number"><?= $stat['count_number'] ?></div>
            <div class="count__text"><?= $stat['count_text'] ?></div>
        </div>
    <?php endforeach; ?>
</section>



<section class="services"><a name="services"></a>
    <h2 class="services__title">Проектирование и монтаж инженерных систем</h2>
    <div class="services__items">
        <?php 
        for ($i = 0; $i < 2; $i++): 
            $service = $services[$i] ?? null;
            if ($service):
        ?>
            <div class="services__item" id="show<?= ucfirst(getServiceClass($service['id'])) ?>">
                <p class="services__text"><?= htmlspecialchars($service['title']) ?></p>
            </div>
            <?php if ($i == 0): ?>
                <div class="vertical-line"></div>
            <?php endif; ?>
        <?php 
            endif;
        endfor; 
        ?>
    </div>
    <div class="line"></div>
    <div class="services__items">
        <?php 
        for ($i = 2; $i < 4; $i++): 
            $service = $services[$i] ?? null;
            if ($service):
        ?>
            <div class="services__item" id="show<?= ucfirst(getServiceClass($service['id'])) ?>">
                <p class="services__text"><?= htmlspecialchars($service['title']) ?></p>
            </div>
            <?php if ($i == 2): ?>
                <div class="vertical-line"></div>
            <?php endif; ?>
        <?php 
            endif;
        endfor; 
        ?>
    </div>
</section>

<?php foreach (['electrics', 'slabtoch', 'water', 'air'] as $class): ?>
    <?php if (isset($services_full[$class])): ?>
        <section class="<?= $class ?> hidden" style="background-image: url('<?= $services_full[$class]['image_path'] ?? '' ?>')">
            <div class="service">
                <h2><?= htmlspecialchars($services_full[$class]['title'] ?? '') ?></h2>
                <p class="service__description"><?= htmlspecialchars($services_full[$class]['description'] ?? '') ?></p>
                
                <div class="service__list">
                    <?php foreach ($services_full[$class]['items'] ?? [] as $item): ?>
                        <div class="service__item">
                            <div class="service__number"><?= $item['item_order'] ?? '' ?></div>
                            <?php if (!empty($item['description'])): ?>
                                <div class="service__point">
                                    <p class="service__title"><?= htmlspecialchars($item['title'] ?? '') ?></p>
                                    <p class="service__text"><?= htmlspecialchars($item['description'] ?? '') ?></p>
                                </div>
                            <?php else: ?>
                                <p class="service__title"><?= htmlspecialchars($item['title'] ?? '') ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <p class="service__description"><?= htmlspecialchars($services_full[$class]['footer_text'] ?? 'Для получения более детальной информации...') ?></p>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>


<section class="application">
        <h2><?= htmlspecialchars($application['title']) ?></h2>
        <p><?= nl2br(htmlspecialchars($application['description'])) ?></p>
        <a href="<?= htmlspecialchars($application['button_link']) ?>" class="button-link">
            <div class="button"><?= htmlspecialchars($application['button_text']) ?></div>
        </a>
    </section>


    <section class="projects">

    </section>

<?php if (!empty($repair_data)): ?>
    <section class="repair"><a name="repair"></a>
        <h2><?= htmlspecialchars($repair_data['title']) ?></h2>
        <p class="repair__description"><?= htmlspecialchars($repair_data['description']) ?></p>
        <p>С нами вы получите:</p>
        <div class="repair__list">
            <?php foreach ($repair_data['items'] as $item): ?>
                <div class="repair__item">
                    <div class="repair__number"><?= $item['item_order'] ?></div>
                    <p class="repair__text"><?= htmlspecialchars($item['title']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="repair__description"><?= htmlspecialchars($repair_data['footer_text']) ?></p>
    </section>
<?php endif; ?>

<?php if (!empty($history_data)): ?>
    <section class="history"><a name="about"></a>
        <h2><?= htmlspecialchars($history_data['section_title']) ?></h2>
        <div class="history__items">
            <div class="history__text">
                <p class="history__description"><?= htmlspecialchars($history_data['description1']) ?></p>
                <p class="history__description"><?= htmlspecialchars($history_data['description2']) ?></p>
                <p class="history__description"><?= htmlspecialchars($history_data['description3']) ?></p>
            </div>
            <img class="history__img" src="<?= htmlspecialchars($history_data['image_path']) ?>" alt="boss">
        </div>
        <p class="history__boss"><?= htmlspecialchars($history_data['founder_text']) ?></p>
    </section>
<?php endif; ?>


<section class="contacts"><a name="contacts"></a>
    <h2><?= htmlspecialchars($contacts_data['section_title'] ?? 'Контактная информация') ?></h2>
    <div class="contacts__items">
        <div class="contacts__text">
            <p class="contacts__title">Почта: <?= htmlspecialchars($contacts_data['email'] ?? 'bam_71@mail.ru') ?></p>
        </div>
        <div class="contacts__icon">
            <?php if (!empty($contacts_data['telegram_link'])): ?>
                <a href="<?= htmlspecialchars($contacts_data['telegram_link']) ?>" target="_blank">
                    <img src="<?= htmlspecialchars($contacts_data['telegram_icon_path'] ?? 'assets/img/telegram.svg') ?>" alt="Telegram">
                </a>
            <?php endif; ?>
            
            <?php if (!empty($contacts_data['vk_link'])): ?>
                <a href="<?= htmlspecialchars($contacts_data['vk_link']) ?>" target="_blank">
                    <img src="<?= htmlspecialchars($contacts_data['vk_icon_path'] ?? 'assets/img/vk.svg') ?>" alt="VK">
                </a>
            <?php endif; ?>
        </div>
    </div>   
</section>

    <section class="form">
        <h2>Оставьте заявку на консультацию</h2>
        <p>Заполните форму для того, чтобы мы смогли с вами связаться!</p>
        <form action="includes/application.php" method="POST" id="applicationForm">
            <input type="text" name="FIO" placeholder="ФИО" required>
            <input type="text" name="number" placeholder="Номер телефона" class="phone-input" required maxlength="18">
            <input  type="text" name="message" placeholder="Сообщение">
            <div id="messageBox"></div>
            <button type="submit">Отправить заявку</button>
        </form>
    </section>

    <div id="registerModal" class="modal" method="POST">
    <div class="modal__content">
        <div class="modal__title">
            <h2>Регистрация</h2>
            <div class="verticalLine"></div>
            <a href="#" id="loginBtnModal"><h2><span>Авторизация</span></h2></a>
        </div>
        <form action="user/reg.php" method="POST" id="registerForm">
            <input type="text" name="FIO" placeholder="ФИО" required>
            <input type="text" name="number" placeholder="+7(000)000-00-00" id="phoneInput" class="phone-input" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="repeat_password" placeholder="Повторите пароль" required>
            <div class="message-box"></div>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>

<div id="loginModal" class="modal">
    <div class="modal__content">
        <div class="modal__title">
            <a href="#" id="registerBtnModal"><h2><span>Регистрация</span></h2></a>
            <div class="verticalLine"></div>
            <h2>Авторизация</h2>
        </div>
        <form action="user/auth.php" method="POST" id="loginForm">
            <input type="text" name="number" placeholder="+7(000)000-00-00" class="phone-input" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <div class="message-box"></div>
            <button type="submit">Войти</button>
        </form>
    </div>
</div>  

<?php include __DIR__ . '/includes/footer.php'; ?>
  
</body>
</html>