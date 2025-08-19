document.addEventListener('DOMContentLoaded', () => {
    const toggleServiceBlocks = () => {
        const serviceItems = document.querySelectorAll('.services__item');
        serviceItems.forEach(item => {
            item.addEventListener('click', () => {
                serviceItems.forEach(i => i.classList.remove('selected'));
                item.classList.add('selected');
                document.querySelectorAll('.electrics, .slabtoch, .water, .air').forEach(block => {
                    block.classList.add('hidden');
                });
                const targetClass = item.id.replace('show', '').toLowerCase();
                const targetBlock = document.querySelector(`.${targetClass}`);
                if (targetBlock) targetBlock.classList.remove('hidden');
            });
        });
    };
    toggleServiceBlocks();

    
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');

    const toggleModal = (modalToShow, modalToHide) => {
        if (modalToShow) modalToShow.style.display = 'block';
        if (modalToHide) modalToHide.style.display = 'none';
    };

    document.getElementById('loginBtn')?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleModal(loginModal, registerModal);
    });

    document.getElementById('registerBtnModal')?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleModal(registerModal, loginModal);
    });

    document.getElementById('loginBtnModal')?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleModal(loginModal, registerModal);
    });

    window.addEventListener('click', (e) => {
        if (e.target === loginModal || e.target === registerModal) {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        }
    });


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

// АВТОРИЗАЦИЯ
const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        const messageBox = this.querySelector(".message-box");

        fetch("user/auth.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (messageBox) {
                messageBox.textContent = data.message;
                messageBox.className = `message-box ${data.status}`;
                
                if (data.status === "success") {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                }
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            if (messageBox) {
                messageBox.textContent = "Ошибка соединения";
                messageBox.className = "message-box error";
            }
        });
    });
}

// РЕГИСТРАЦИЯ
const registerForm = document.getElementById("registerForm");
if (registerForm) {
    registerForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(registerForm);
        const messageBox = this.querySelector(".message-box");

        fetch("user/reg.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (messageBox) {
                messageBox.textContent = data.message;
                messageBox.className = `message-box ${data.status}`;
            }
            if (data.status === "success") {
                registerForm.reset();
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            if (messageBox) {
                messageBox.textContent = "Ошибка соединения";
                messageBox.className = "message-box error";
            }
        });
    });
}

    // ЗАЯВКА
    const applicationForm = document.getElementById("applicationForm");
    if (applicationForm) {
        applicationForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const messageBox = document.getElementById("messageBox");
            
            try {
                const response = await fetch("includes/application.php", {
                    method: "POST",
                    body: new FormData(applicationForm)
                });
                
                const data = await response.json();
                
                if (messageBox) {
                    messageBox.innerHTML = `<p style="color: ${data.status === "success" ? "green" : "red"}">${data.message}</p>`;
                }
                
                if (data.status === "success") {
                    applicationForm.reset();
                }
            } catch (error) {
                console.error("Ошибка:", error);
                if (messageBox) {
                    messageBox.innerHTML = '<p style="color: red">Ошибка соединения</p>';
                }
            }
        });
    }
});