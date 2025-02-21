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
                <li class="menu__item"><a class="menu__link" href="#" id="loginBtn"><img class="menu__account" src="img/account.svg" alt="Аккаунт"></a></li>
            </ul>
        </nav>
        <div class="start">
            <h1>Ваш надежный партнер в мире <br><span>инженерных коммуникаций </span></h1>
            <p class="start__subtitle">Проектирование и монтаж электрооборудования и освещения, слаботочных систем, систем водоснабжения и канализации, а также систем отопления, вентиляции и кондиционирования.</p>
            <a href="index.php#contacts" class="button-link"><div class="button">Консультация</div></a>
        </div>
    </header>

<div id="registerModal" class="modal" action="reg.php" method="POST">
    <div class="modal__content">
        <div class="modal__title">
            <h2>Регистрация</h2>
            <div class="verticalLine"></div>
            <a href="#" id="loginBtnModal"><h2><span>Авторизация</span></h2></a>
        </div>
        <form action="reg.php" method="POST" id="registerForm">
            <input type="text" name="FIO" placeholder="ФИО" required>
            <input type="text" name="number" placeholder="Номер телефона" id="phoneInput" class="phone-input" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="repeat_password" placeholder="Повторите пароль" required>
            <div id="messageBoxReg"></div>
            <button type="submit">Зарегестрироваться</button>
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

            <form action="auth.php" method="POST" id="loginForm">
                    <input type="text" name="number" placeholder="Номер телефона" class="phone-input" required>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <div id="messageBoxLog" class="messageBoxLog"></div>
                    <button type="submit">Войти</button>
            </form>
    </div>
</div>

    
    <section class="count">
            <div class="count__item">
                <div class="count__number">300</div>
                <div class="count__text">среднее количество обслуживаний инженерных коммуникаций в месяц</div>
            </div>
            <div class="count__item">
                <div class="count__number">20</div>
                <div class="count__text">лет успешной работы</div>
            </div>
            <div class="count__item">
                <div class="count__number">782</div>
                <div class="count__text">успешных объектов, сделанных специалистами нашей компании</div>
            </div>
    </section>

    <section class="services"><a name="services"></a>
        <h2 class="services__title">Проектирование и монтаж  инженерных систем</h2>
        <div class="services__items">
            <div class="services__item" id="showElectrics">
                <p class="services__text">Электрооборудование и освещение</p>
            </div>
            <div class="vertical-line"></div>
            <div class="services__item" id="showSlabtoch">
                <p class="services__text">Слаботочные системы</p>
            </div>
        </div>
        <div class="line"></div>
        <div class="services__items">
            <div class="services__item" id="showWater">
                <p class="services__text">Системы водоснабжения и канализации</p>
            </div>
            <div class="vertical-line"></div>
            <div class="services__item" id="showAir">
                <p class="services__text">Систем отопления, вентиляции и кондиционирования</p>
            </div>
        </div>
    </section>


    <section class="electrics hidden">
        <div class="service">
        <h2>Электрооборудование и освещение</h2>
        <p class="service__description">Преобразите свое пространство с нашим современным электрооборудованием и освещением! Мы предлагаем широкий выбор решений для любого интерьера — от стильных светильников до высококачественной электропроводки. Наши специалисты помогут создать атмосферу, в которой будет комфортно и безопасно. 
            Доверьте нам свои проекты, и мы превратим ваши идеи в реальность!</p>
            <div class="service__list">
                <div class="service__item">
                    <div class="service__number">1</div>
                    <p class="service__title">Установка и модернизация электрооборудования</p>
                </div>
                <div class="service__item">
                    <div class="service__number">2</div>
                    <p class="service__title">Проектирование освещения</p>
                </div>
                <div class="service__item">
                    <div class="service__number">3</div>
                    <p class="service__title">Обслуживание и диагностика</p>
                </div>
            </div>
            <p class="service__description">Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.</p>
        </div>
    </section>

    <section class="slabtoch hidden">
        <div class="service">
        <h2>Слаботочные системы</h2>
        <p class="service__description">Мы предоставляем высококачественные решения в области слаботочных систем, которые обеспечивают надежную и эффективную связь, безопасность и автоматизацию процессов в вашем бизнесе. Наша команда экспертов поможет разработать и внедрить системы, соответствующие вашим потребностям.</p>
            <div class="service__list">
                <div class="service__item">
                    <div class="service__number">1</div>
                    <div class="service__point">
                        <p class="service__title">Проектирование слаботочных систем</p>
                        <p class="service__text">Мы создаем индивидуальные проекты для аудиовизуальных систем, охранных сигнализаций, видеонаблюдения и сетевой инфраструктуры.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">2</div>
                    <div class="service__point">
                        <p class="service__title">Монтаж и установка</p>
                        <p class="service__text">Профессиональная установка оборудования обеспечит безупречную работу всех систем. Мы выполняем монтаж систем видеонаблюдения, доступа, связи и автоматизации.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">3</div>
                    <div class="service__point">
                        <p class="service__title">Обслуживание и поддержка</p>
                        <p class="service__text">Предлагаем услуги по обслуживанию и ремонту слаботочных систем, чтобы гарантировать их бесперебойную работу и безопасность.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">4</div>
                    <div class="service__point">
                        <p class="service__title">Интеграция</p>
                        <p class="service__text">Объединение всех слаботочных систем в единую структуру для повышения эффективности и удобства использования.</p>    
                    </div>
                </div>
            </div>
            <p class="service__description">Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.</p>
        </div>
    </section>

    <section class="water hidden">
        <div class="service">
        <h2>Системы водоснабжения и канализации</h2>
        <p class="service__description">Мы предлагаем профессиональные решения в области систем водоснабжения и канализации, которые обеспечивают надежное и эффективное водообеспечение вашего объекта. Наша команда специалистов гарантирует высокий уровень качества на каждом этапе — от проектирования до обслуживания.</p>
            <div class="service__list">
                <div class="service__item">
                    <div class="service__number">1</div>
                    <div class="service__point">
                        <p class="service__title">Проектирование систем</p>
                        <p class="service__text">Разработка индивидуальных проектов водоснабжения и канализации, учитывающих особенности вашего объекта и его потребности.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">2</div>
                    <div class="service__point">
                        <p class="service__title">Монтаж и установка</p>
                        <p class="service__text">Профессиональная установка всех компонентов систем — трубопроводов, насосов, очистных сооружений — с применением современных технологий и материалов.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">3</div>
                    <div class="service__point">
                        <p class="service__title">Обслуживание и ремонт</p>
                        <p class="service__text">Регулярное техническое обслуживание систем для предотвращения аварий и обеспечения надежной работы в любое время.</p>    
                    </div>
                </div>
                <div class="service__item">
                    <div class="service__number">4</div>
                    <div class="service__point">
                        <p class="service__title">Интеграция</p>
                        <p class="service__text">Проведение анализа качества воды и консультирование по вопросам улучшения ее характеристик.</p>    
                    </div>
                </div>
            </div>
            <p class="service__description">Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.</p>
        </div>
    </section>
    <section class="air hidden">
        <div class="service">
        <h2>Системы отопления, вентиляции и кондиционирования</h2>
        <p class="service__description">Мы предлагаем комплексные решения для создания комфортного климата в вашем доме или офисе. Наша команда профессионалов обеспечивает установку и обслуживание систем отопления, вентиляции и кондиционирования, адаптированных под индивидуальные потребности каждого клиента. Мы используем только качественные материалы и современные технологии, что гарантирует надежность и эффективность работы всех систем.</p>
            <div class="service__list">
                <div class="service__item">
                    <div class="service__number">1</div>
                    <p class="service__title">Проектирование и монтаж систем отопления.</p>
                </div>
                <div class="service__item">
                    <div class="service__number">2</div>
                    <p class="service__title">Установка и обслуживание вентиляционных систем.</p>
                </div>
                <div class="service__item">
                    <div class="service__number">3</div>
                    <p class="service__title">Кондиционирование воздуха для помещений различного назначения.</p>
                </div>
            </div>
            <p class="service__description">Для получения более детальной информации и расчета стоимости услуг, пожалуйста, свяжитесь снами, оставив заявку на консультацию или напишите нам на почту или в Telegram. Нажмите кнопку ниже для консультации.</p>
        </div>
    </section>


    <section class="application">
        <h2>Оставьте заявку на консультацию</h2>
        <p>Мы предлагаем организовать консультацию для обсуждения инженерных вопросов, оценки стоимости сметы на ремонт и определения объема работ в любом удобмном для вас виде.</p>
        <a href="index.php#contacts" class="button-link"><div class="button">Перейти к заявке</div></a>
    </section>

    <section class="projects">

    </section>

    <section class="repair"><a name="repair"></a>
        <h2>Ремонт под ключ</h2>
        <p class="repair__description">Предлагаем услугу ремонта под ключ, которая включает в себя все этапы: от проектирования до финальной отделки. Мы обеспечиваем качественное выполнение работ, используя только надежные материалы и современные технологии. Наша команда профессионалов гарантирует соблюдение сроков и индивидуальный подход к каждому клиенту.</p>
        <p>С нами вы получите:</p>
        <div class="repair__list">
            <div class="repair__item">
                <div class="repair__number">1</div>
                <p class="repair__text">Полный контроль над процессом</p>
            </div>
            <div class="repair__item">
                <div class="repair__number">2</div>
                <p class="repair__text">Прозрачное ценообразование</p>
            </div>
            <div class="repair__item">
                <div class="repair__number">3</div>
                <p class="repair__text">Гарантия на выполненные работы</p>
            </div>
        </div>
        <p class="repair__description">Обратите внимание на комфорт и стиль вашего пространства – доверьте ремонт нам! Чтобы узнать подробнее, пишите нам!</p>
    </section>

    <section class="history"><a name="about"></a>
        <h2>История компании</h2>
        <div class="history__items">
            <div class="history__text">
                <p class="history__description">"Компания "БАМСтрой" начала свою деятельность более двадцати лет назад с амбициозной целью – стать ведущим игроком на рынке инженерных коммуникаций. Идея создания компании зародилась,  находясь в области строительства и инженерии, видя необходимость в комплексных и надежных решениях для жилых и коммерческих объектов.</p>
                <p class="history__description">Сотрудники компании, каждый из которых имел богатый опыт в электроснабжении, водоснабжении и вентиляционных системах, объединили свои усилия, чтобы предложить услуги, основанные на инновациях, высоких стандартах качества и индивидуальном подходе к клиентам.</p>
                <p class="history__description">За плечами компании сотни успешных проектов различной сложности, начиная от небольших коттеджей и заканчивая масштабными промышленными объектами. Команда "БАМСтрой" продолжает развиваться, постоянно обучаясь и совершенствуя свои навыки, чтобы оставаться на пике технологических изменений и предоставлять клиентам только лучшие решения."</p>
        </div>
        <img class=""history__img src="img/boss.svg">
        </div>
        <p class="history__boss">Основатель компании – Быханов Александр Михайлович</p>
    </section>

    <section class="contacts"><a name="contacts"></a>
        <h2>Контактная информация</h2>
        <div class="contacts__items">
            <div class="contacts__text">
                 <p class="contacts__title">Почта:    bam_71@mail.ru</p>
            </div>
            <div class="contacts__icon">
                 <img src="img/telegram.svg">
                 <img src="img/vk.svg">
            </div>
        </div>   
    </section>

    <section class="form">
        <h2>Оставьте заявку на консультацию</h2>
        <p>Заполните форму для того, чтобы мы смогли с вами связаться!</p>
        <form action="application.php" method="POST">
            <input type="text" name="FIO" placeholder="ФИО" required>
            <input type="text" name="number" placeholder="Номер телефона" class="phone-input" required>
            <input  type="text" name="message" placeholder="Сообщение">
            <div id="messageBox"></div>
            <button type="submit">Отправить заявку</button>
        </form>
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