document.addEventListener("DOMContentLoaded", () => {

    const tabs = document.querySelectorAll(".tab");
    const roleInput = document.getElementById("role");
    const loginInput = document.getElementById("login");
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("togglePassword");
    const form = document.getElementById("loginForm");
    const button = document.getElementById("loginBtn");

    // TAB ROLE
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            const role = tab.dataset.role;
            roleInput.value = role;

            updatePlaceholder(role);
        });
    });

    function updatePlaceholder(role) {
        if (role === "student") loginInput.placeholder = "Masukkan NIS / NISN";
        else if (role === "teacher") loginInput.placeholder = "Masukkan NIP";
        else loginInput.placeholder = "Masukkan Username";
    }

    // TOGGLE PASSWORD
    toggleIcon.addEventListener("click", () => {
        const isHidden = passwordInput.type === "password";
        passwordInput.type = isHidden ? "text" : "password";

        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });

    // LOADING BUTTON
    form.addEventListener("submit", () => {
        button.classList.add("loading");
        button.innerHTML = "Loading...";
    });

});
