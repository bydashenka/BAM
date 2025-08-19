-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 19 2025 г., 15:11
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `BAM`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id_application` int(11) NOT NULL,
  `FIO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id_application`, `FIO`, `number`, `message`, `datetime`, `status`) VALUES
(3, 'Быханова Дарья Александровна', '79007896545', 'приветик', '2025-02-20 17:05:27', 'Заявка отправлена'),
(4, 'Быханова Дарья Александровна', '79007896545', 'еще раз приветик', '2025-02-20 17:05:32', 'Выполнена'),
(5, 'Риорсон Ксейден', '79000000000', 'Вайоленс?', '2025-02-20 22:36:08', 'Заявка отправлена'),
(6, 'Риорсон Ксейден', '78888888888', 'ага', '2025-02-21 18:23:42', 'Заявка отправлена'),
(7, 'Лобанов Филипп Беранрдович', '79000000000', '', '2025-02-21 18:35:58', 'Заявка отправлена'),
(8, 'Лобанов Филипп Беранрдович', '79000000000', '', '2025-02-21 18:36:01', 'Заявка отправлена'),
(9, 'Лобанов Филипп Беранрдович', '79000000001', '', '2025-02-21 18:36:07', 'Заявка отправлена'),
(10, 'Лобанов Филипп Беранрдович', '79000000001', '', '2025-02-21 18:36:08', 'Заявка отправлена'),
(11, 'Лобанов Филипп Беранрдович', '79000000001', '', '2025-02-21 18:36:08', 'Заявка отправлена'),
(12, 'Лобанов Филипп Беранрдович', '79000000001', '', '2025-02-21 18:36:09', 'Заявка отправлена'),
(13, 'Быханова Дарья Александровна', '79007896545', '', '2025-02-21 18:36:22', 'Заявка отправлена'),
(14, 'Быханова Дарья Александровна', '79007896545', '', '2025-02-21 18:36:22', 'Заявка отправлена'),
(15, 'Быханова Дарья Александровна', '79007896545', '', '2025-02-21 18:36:23', 'Заявка отправлена'),
(16, 'Быханова Дарья Александровна', '79007896545', '', '2025-02-21 18:36:23', 'Заявка отправлена'),
(17, 'Быханова Дарья Александровна', '79007896545', '', '2025-02-21 18:36:23', 'Заявка отправлена'),
(18, 'Никулина Александра Романовна', '79104444444', '', '2025-05-04 17:24:02', 'Заявка отправлена'),
(19, 'Никулина Александра Романовна', '74444444444', '', '2025-05-04 21:03:52', 'Заявка отправлена'),
(20, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:24:51', 'Заявка отправлена'),
(21, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:25:44', 'Заявка отправлена'),
(22, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:26:20', 'Заявка отправлена'),
(23, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:26:38', 'Заявка отправлена'),
(24, 'Лобанов Филипп Беранрдович', '78888888888', 'Привет', '2025-05-05 15:26:55', 'Заявка отправлена'),
(25, 'Лобанов Филипп Беранрдович', '78888888888', '', '2025-05-05 15:27:44', 'Заявка отправлена'),
(26, 'Лобанов Филипп Беранрдович', '78888888888', '', '2025-05-05 15:29:15', 'Заявка отправлена'),
(27, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:29:28', 'Заявка отправлена'),
(28, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:29:53', 'Заявка отправлена'),
(29, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:30:40', 'Заявка отправлена'),
(30, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:30:45', 'Заявка отправлена'),
(31, 'Никулина Александра Романовна', '74444444444', 'Привет', '2025-05-05 15:30:58', 'Заявка отправлена'),
(32, 'Никулина Александра Романовна', '74444444444', 'Тестик', '2025-05-05 15:32:25', 'Заявка отправлена'),
(33, 'Никулина Александра Романовна', '74444444444', 'Тестик', '2025-05-05 15:33:34', 'Заявка отправлена'),
(34, 'Никулина Александра Романовна', '74444444444', 'тест', '2025-05-05 15:36:40', 'Заявка отправлена'),
(35, 'Никулина Александра Романовна', '74444444444', 'тест', '2025-05-05 15:36:54', 'Заявка отправлена'),
(36, 'Никулина Александра Романовна', '74444444444', '44', '2025-05-05 15:37:43', 'В обработке'),
(37, 'Быханова Дарья Александровна', '79009605353', 'привет', '2025-05-25 14:39:57', 'Заявка отправлена'),
(38, 'Быханова Дарья Александровна', '79103431511', 'Привет', '2025-05-25 14:40:58', 'В обработке'),
(39, 'Быханова Дарья Александровна', '79103431511', 'ааааааааа', '2025-05-25 16:11:36', 'Заявка отправлена'),
(40, 'Быханова Дарья Александровна', '79009009090', 'привет', '2025-06-08 23:23:20', 'Отменена');

-- --------------------------------------------------------

--
-- Структура таблицы `application_section`
--

CREATE TABLE `application_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application_section`
--

INSERT INTO `application_section` (`id`, `title`, `description`, `button_text`, `button_link`) VALUES
(1, 'Оставьте заявку на консультацию ', 'Наши специалисты свяжутся с вами в ближайшее время', 'Оставить заявку', '#contacts');

-- --------------------------------------------------------

--
-- Структура таблицы `company_history`
--

CREATE TABLE `company_history` (
  `id` int(11) NOT NULL,
  `section_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `founder_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `company_history`
--

INSERT INTO `company_history` (`id`, `section_title`, `description1`, `description2`, `description3`, `image_path`, `founder_text`) VALUES
(1, 'История компании', '\"Компания \"БАМСтрой\" начала свою деятельность более двадцати лет назад с амбициозной целью – стать ведущим игроком на рынке инженерных коммуникаций. Идея создания компании зародилась, находясь в области строительства и инженерии, видя необходимость в комплексных и надежных решениях для жилых и коммерческих объектов.\"', 'Сотрудники компании, каждый из которых имел богатый опыт в электроснабжении, водоснабжении и вентиляционных системах, объединили свои усилия, чтобы предложить услуги, основанные на инновациях, высоких стандартах качества и индивидуальном подходе к клиентам.', 'За плечами компании сотни успешных проектов различной сложности, начиная от небольших коттеджей и заканчивая масштабными промышленными объектами. Команда \"БАМСтрой\" продолжает развиваться, постоянно обучаясь и совершенствуя свои навыки, чтобы оставаться на пике технологических изменений и предоставлять клиентам только лучшие решения.\"', 'assets/img/boss.svg', 'Основатель компании – Быханов Александр Михайлович ');

-- --------------------------------------------------------

--
-- Структура таблицы `consultation_section`
--

CREATE TABLE `consultation_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consultation_section`
--

INSERT INTO `consultation_section` (`id`, `title`, `description`, `button_text`, `button_link`) VALUES
(1, 'Оставьте заявку на консультацию ', 'Мы предлагаем организовать консультацию для обсуждения инженерных вопросов, оценки стоимости сметы на ремонт и определения объема работ в любом удобмном для вас виде.', 'Перейти к заявке', 'index.php#contacts');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `section_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Контактная информация',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/telegram.svg',
  `vk_icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/vk.svg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `section_title`, `email`, `telegram_link`, `vk_link`, `telegram_icon_path`, `vk_icon_path`) VALUES
(1, 'Контактная информация ', 'bam_71@mail.ru', 'https://t.me/your_telegram', 'https://vk.com/your_vk', 'assets/img/telegram.svg', 'assets/img/vk.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `count_stats`
--

CREATE TABLE `count_stats` (
  `id` int(11) NOT NULL,
  `count_number` int(11) NOT NULL,
  `count_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `count_stats`
--

INSERT INTO `count_stats` (`id`, `count_number`, `count_text`) VALUES
(1, 300, 'среднее количество обслуживаний инженерных коммуникаций в месяц'),
(2, 20, 'лет успешной работы'),
(3, 782, 'успешных объектов, сделанных специалистами нашей компании');

-- --------------------------------------------------------

--
-- Структура таблицы `footer_content`
--

CREATE TABLE `footer_content` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL DEFAULT 'img/logo.svg',
  `email` varchar(255) NOT NULL DEFAULT 'bam_71@mail.ru',
  `telegram_link` varchar(255) DEFAULT NULL,
  `telegram_icon_path` varchar(255) NOT NULL DEFAULT 'img/telegram.svg',
  `vk_link` varchar(255) DEFAULT NULL,
  `vk_icon_path` varchar(255) NOT NULL DEFAULT 'img/vk.svg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `footer_content`
--

INSERT INTO `footer_content` (`id`, `logo_path`, `email`, `telegram_link`, `telegram_icon_path`, `vk_link`, `vk_icon_path`) VALUES
(1, '/bam/assets/img/logo.svg', 'bam_71@mail.ru', 'https://t.me/your_telegram', '/bam/assets/img/telegram.svg', 'https://vk.com/your_vk', '/bam/assets/img/vk.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `header_content`
--

CREATE TABLE `header_content` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL DEFAULT 'img/logo.svg',
  `account_icon_path` varchar(255) NOT NULL DEFAULT 'img/account.svg',
  `main_title` text NOT NULL,
  `subtitle` text NOT NULL,
  `button_text` varchar(255) NOT NULL DEFAULT 'Консультация',
  `button_link` varchar(255) NOT NULL DEFAULT '#contacts'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `header_content`
--

INSERT INTO `header_content` (`id`, `logo_path`, `account_icon_path`, `main_title`, `subtitle`, `button_text`, `button_link`) VALUES
(1, '/bam/assets/img/logo.svg', '/bam/assets/img/account.svg', 'Ваш надежный партнер в мире <br><span>инженерных коммуникаций</span>', 'Проектирование и монтаж электрооборудования и освещения, слаботочных систем, систем водоснабжения и канализации, а также систем отопления, вентиляции и кондиционирования.', 'Консультация', '#contacts');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `text` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `text`, `link`, `display_order`) VALUES
(1, 'Инженерные системы', '#services', 1),
(2, 'Ремонт под ключ', '#repair', 2),
(3, 'О нас', '#about', 3),
(4, 'Контакты', '#contacts', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `repair_items`
--

CREATE TABLE `repair_items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `repair_items`
--

INSERT INTO `repair_items` (`id`, `title`, `item_order`) VALUES
(1, 'Полный контроль над процессом', 1),
(2, 'Прозрачное ценообразование', 2),
(3, 'Гарантия на выполненные работы', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `repair_section`
--

CREATE TABLE `repair_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `repair_section`
--

INSERT INTO `repair_section` (`id`, `title`, `description`, `footer_text`) VALUES
(1, 'Ремонт под ключ', 'Предлагаем услугу ремонта под ключ, которая включает в себя все этапы: от проектирования до финальной отделки. Мы обеспечиваем качественное выполнение работ, используя только надежные материалы и современные технологии. Наша команда профессионалов гарантирует соблюдение сроков и индивидуальный подход к каждому клиенту. <br> С нами вы получите:', 'Обратите внимание на комфорт и стиль вашего пространства – доверьте ремонт нам! Чтобы узнать подробнее, пишите нам!');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `footer_text`, `image_path`, `class_name`) VALUES
(1, 'Электрооборудование и освещение', 'Преобразите свое пространство с нашим современным электрооборудованием и освещением! Мы предлагаем широкий выбор решений для любого интерьера — от стильных светильников до высококачественной электропроводки. Наши специалисты помогут создать атмосферу, в которой будет комфортно и безопасно. Доверьте нам свои проекты, и мы превратим ваши идеи в реальность!', 'Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.', 'assets/img/service1.svg', 'electrics'),
(2, 'Слаботочные системы привет!', 'Мы предоставляем высококачественные решения в области слаботочных систем, которые обеспечивают надежную и эффективную связь, безопасность и автоматизацию процессов в вашем бизнесе. Наша команда экспертов поможет разработать и внедрить системы, соответствующие вашим потребностям.', 'Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.', 'assets/img/serv2.svg', 'slabtoch'),
(3, 'Системы водоснабжения и канализации', 'Мы предлагаем профессиональные решения в области систем водоснабжения и канализации, которые обеспечивают надежное и эффективное водообеспечение вашего объекта. Наша команда специалистов гарантирует высокий уровень качества на каждом этапе — от проектирования до обслуживания.', 'Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.', 'assets/img/serv3.svg', 'water'),
(4, 'Системы отопления, вентиляции и кондиционирования', 'Мы предлагаем комплексные решения для создания комфортного климата в вашем доме или офисе. Наша команда профессионалов обеспечивает установку и обслуживание систем отопления, вентиляции и кондиционирования, адаптированных под индивидуальные потребности каждого клиента. Мы используем только качественные материалы и современные технологии, что гарантирует надежность и эффективность работы всех систем.', 'Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.', 'assets/img/serv4.svg', 'air');

-- --------------------------------------------------------

--
-- Структура таблицы `service_items`
--

CREATE TABLE `service_items` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `item_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `title`, `description`, `item_order`) VALUES
(1, 1, 'Установка и модернизация электрооборудования', NULL, 1),
(2, 1, 'Проектирование освещения', NULL, 2),
(3, 1, 'Обслуживание и диагностика', NULL, 3),
(4, 2, 'Проектирование слаботочных систем', 'Мы создаем индивидуальные проекты для аудиовизуальных систем, охранных сигнализаций, видеонаблюдения и сетевой инфраструктуры.', 1),
(5, 2, 'Монтаж и установка', 'Профессиональная установка оборудования обеспечит безупречную работу всех систем. Мы выполняем монтаж систем видеонаблюдения, доступа, связи и автоматизации.', 2),
(6, 2, 'Обслуживание и поддержка', 'Предлагаем услуги по обслуживанию и ремонту слаботочных систем, чтобы гарантировать их бесперебойную работу и безопасность.', 3),
(7, 2, 'Интеграция', 'Объединение всех слаботочных систем в единую структуру для повышения эффективности и удобства использования.', 4),
(8, 3, 'Проектирование систем', 'Разработка индивидуальных проектов водоснабжения и канализации, учитывающих особенности вашего объекта и его потребности.', 1),
(9, 3, 'Монтаж и установка', 'Профессиональная установка всех компонентов систем — трубопроводов, насосов, очистных сооружений — с применением современных технологий и материалов.', 2),
(10, 3, 'Обслуживание и ремонт', 'Регулярное техническое обслуживание систем для предотвращения аварий и обеспечения надежной работы в любое время.', 3),
(11, 3, 'Интеграция', 'Проведение анализа качества воды и консультирование по вопросам улучшения ее характеристик.', 4),
(12, 4, 'Проектирование и монтаж систем отопления.', NULL, 1),
(13, 4, 'Установка и обслуживание вентиляционных систем.', NULL, 2),
(14, 4, 'Кондиционирование воздуха для помещений различного назначения.', NULL, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `FIO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_users`, `FIO`, `number`, `password`, `role`) VALUES
(1, 'Быханова Дарья Александровна', '79999999999', '$2y$10$6WAskiV4BoUMQtZ6OSdN2uHX5U6thShw0gHGXHymMYbX0hSKHVXnG', 'admin'),
(3, 'lflfllfl', '89009605222', '$2y$10$nT5d2Q4jdE1i5Dvm45aXfuRzx1pNSrg5tgxd/86eHE5Nh5ANL/MDS', 'client'),
(4, 'Быханова Дарья', '79007896646', '$2y$10$Y2CsTAL0lIqGhzPirhi3OelXoPcUrJXz7Q1kY851cJ.ulrgd3XX9K', 'client'),
(5, 'Андреев Андрей Михайлович', '79007896540', '$2y$10$6QT62ee8si9ZOPrsynO6/.UdruJjScFRpO7YkNmCuMSzSOuQpLuFe', 'client'),
(6, 'Михайлов Максим Александрович', '79007896511', '$2y$10$W4taxwORr7ZEsHd.W/SzNeJy/ANKq44JGnNwR52gzyvguYPjLeKKi', 'client'),
(7, 'Романов Роман Романович', '79009009000', '$2y$10$/b6C8V1cOW7TclsLWWuM9.FF1u/sHT3gcOP.s9pE/tA1O0zkZWcam', 'client'),
(8, 'Никулина Александра Романовна', '74444444444', '$2y$10$I2bHj6ZjRqsAstLdQ5nZk.u4kNoaGSFygca0rR6nmuSh1wSYxaUeC', 'client'),
(9, 'Хабарова Анна Андреевна', '76666666666', '$2y$10$Gah2BOuxnNXvUXtCRrwMZujmh1KTVVBmr7D459dwfoNsoPIDUxMou', 'client'),
(10, 'Быханова Дарья Александровна', '79103431511', '$2y$10$MFjHSQrUYpJ9zydpu2Ru/O1HqpzotlNtLO6hHjKv9fjHHdCBvvM7G', 'client'),
(11, 'Быханова Дарья Александровна', '79009009090', '$2y$10$liSad1wC6WeIgUncCj6qjuAFfIB.NKEL9M.6zFP8K0gMpDjDX0up2', 'client');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id_application`);

--
-- Индексы таблицы `application_section`
--
ALTER TABLE `application_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `company_history`
--
ALTER TABLE `company_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `consultation_section`
--
ALTER TABLE `consultation_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `count_stats`
--
ALTER TABLE `count_stats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `footer_content`
--
ALTER TABLE `footer_content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `header_content`
--
ALTER TABLE `header_content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `repair_items`
--
ALTER TABLE `repair_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `repair_section`
--
ALTER TABLE `repair_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Индексы таблицы `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `application_section`
--
ALTER TABLE `application_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `company_history`
--
ALTER TABLE `company_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `consultation_section`
--
ALTER TABLE `consultation_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `count_stats`
--
ALTER TABLE `count_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `footer_content`
--
ALTER TABLE `footer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `header_content`
--
ALTER TABLE `header_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `repair_items`
--
ALTER TABLE `repair_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `repair_section`
--
ALTER TABLE `repair_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `service_items`
--
ALTER TABLE `service_items`
  ADD CONSTRAINT `service_items_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
