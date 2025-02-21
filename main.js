document.addEventListener('DOMContentLoaded', () => { 
    // Первоначальное выделение первого элемента
    const firstItem = document.querySelector('.services__item');
    if (firstItem) {
        firstItem.classList.add('selected');

        // Показать содержимое первого элемента
        const firstContent = document.querySelector('.electrics');
        if (firstContent) firstContent.classList.remove('hidden');

        // Скрываем другие блоки
        document.querySelectorAll('.slabtoch, .water, .air').forEach(el => el.classList.add('hidden'));
    }

    // Обработчик для кликов по .services__item
    const servicesContainer = document.querySelector('.services');
    if (servicesContainer) {
        servicesContainer.addEventListener('click', (event) => {
            const item = event.target.closest('.services__item');
            if (!item) return;

            document.querySelectorAll('.services__item').forEach(innerItem => {
                innerItem.classList.remove('selected');
            });

            item.classList.add('selected');

            // Управление видимостью контента
            document.querySelectorAll('.content-section').forEach(section => section.classList.add('hidden'));

            const targetId = item.dataset.target;
            if (targetId) {
                const targetContent = document.querySelector(`.${targetId}`);
                if (targetContent) targetContent.classList.remove('hidden');
            }
        });
    }

    // Модальные окна
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');

    const toggleModal = (modalToShow, modalToHide) => {
        if (modalToShow) modalToShow.style.display = 'block';
        if (modalToHide) modalToHide.style.display = 'none';
    };

    document.getElementById('loginBtn')?.addEventListener('click', (event) => {
        event.preventDefault();
        toggleModal(loginModal, registerModal);
    });

    document.getElementById('registerBtnModal')?.addEventListener('click', (event) => {
        event.preventDefault();
        toggleModal(registerModal, loginModal);
    });

    document.getElementById('loginBtnModal')?.addEventListener('click', (event) => {
        event.preventDefault();
        toggleModal(loginModal, registerModal);
    });

    window.addEventListener('click', (event) => {
        if (event.target === loginModal || event.target === registerModal) {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        }
    });

    // Маска для телефона
    document.querySelectorAll(".phone-input").forEach(phoneInput => {
        phoneInput.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, ""); // Удаляем всё, кроме цифр
    
            if (value.startsWith("8")) {
                value = "7" + value.slice(1); // Заменяем 8 на 7
            }
    
            let formattedValue = "+7 ";
            if (value.length > 1) formattedValue += `(${value.slice(1, 4)}`;
            if (value.length >= 4) formattedValue += `) ${value.slice(4, 7)}`;
            if (value.length >= 7) formattedValue += `-${value.slice(7, 9)}`;
            if (value.length >= 9) formattedValue += `-${value.slice(9, 11)}`;

            this.value = formattedValue;
        });
    });

    // Обработка формы входа
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch("auth.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let messageBoxLog = document.getElementById("messageBoxLog");
                if (messageBoxLog) {
                    messageBoxLog.textContent = data.message;
                    messageBoxLog.style.color = data.status === "success" ? "green" : "red";
                }

                if (data.status === "success") {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                }
            })
            .catch(error => console.error("Ошибка:", error));
        });
    }

    // Обработка формы регистрации
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(registerForm);

            fetch("reg.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageBoxReg = document.getElementById("messageBoxReg");
                if (messageBoxReg) {
                    messageBoxReg.innerHTML = `<p class="${data.status}">${data.message}</p>`;
                }
                if (data.status === "success") {
                    registerForm.reset();
                }
            })
            .catch(error => console.error("Ошибка:", error));
        });
    }
});
