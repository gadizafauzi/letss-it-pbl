document.addEventListener("DOMContentLoaded", () => {

    // ================= ELEMENTS =================
    const tabs        = document.querySelectorAll(".tab");
    const roleInput   = document.getElementById("role");
    const loginInput  = document.getElementById("login");
    const passwordInput  = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const form        = document.getElementById("loginForm");
    const button      = document.getElementById("loginBtn");
    const btnText     = document.getElementById("btnText");
    const cardImg     = document.getElementById("cardIllustration");

    // ================= TAB ROLE =================
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            const role = tab.dataset.role;
            roleInput.value = role;
            updatePlaceholder(role);
        });
    });

    // ================= PLACEHOLDER =================
    function updatePlaceholder(role) {
        if (role === "student") {
            loginInput.placeholder = "Masukkan NIS";
        } else if (role === "teacher") {
            loginInput.placeholder = "Masukkan NIP";
        } else {
            loginInput.placeholder = "Masukkan Username";
        }
    }

    // ================= TOGGLE PASSWORD =================
    if (togglePassword) {
        togglePassword.addEventListener("click", () => {
            const icon = togglePassword.querySelector("i");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.className = "fa-solid fa-eye-slash";
            } else {
                passwordInput.type = "password";
                icon.className = "fa-solid fa-eye";
            }
        });
    }

    // ================= BUTTON LOADING =================
    if (form) {
        form.addEventListener("submit", () => {
            button.classList.add("loading");
            if (btnText) btnText.textContent = "Memproses...";
        });
    }

});
