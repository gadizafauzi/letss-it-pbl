document.addEventListener("DOMContentLoaded", () => {

    // ================= ELEMENT =================
    const tabs = document.querySelectorAll(".tab");
    const roleInput = document.getElementById("role");
    const loginInput = document.getElementById("login");

    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    const form = document.getElementById("loginForm");
    const button = document.getElementById("loginBtn");

    // ================= TAB ROLE =================
    tabs.forEach(tab => {

        tab.addEventListener("click", () => {

            // hapus active semua
            tabs.forEach(t => t.classList.remove("active"));

            // active tab dipilih
            tab.classList.add("active");

            // set role
            const role = tab.dataset.role;
            roleInput.value = role;

            // ubah placeholder
            updatePlaceholder(role);
        });

    });

    // ================= PLACEHOLDER =================
    function updatePlaceholder(role) {

        if (role === "student") {

            loginInput.placeholder = "Masukkan NIS / NISN";

        } else if (role === "teacher") {

            loginInput.placeholder = "Masukkan NIP";

        } else {

            loginInput.placeholder = "Masukkan Username";

        }
    }

    // ================= TOGGLE PASSWORD =================
    togglePassword.addEventListener("click", () => {

        const icon = togglePassword.querySelector("i");

        if (passwordInput.type === "password") {

            // tampilkan password
            passwordInput.type = "text";

            // ganti icon
            icon.className = "fa-solid fa-eye-slash";

        } else {

            // sembunyikan password
            passwordInput.type = "password";

            // ganti icon
            icon.className = "fa-solid fa-eye";
        }
    });

    // ================= BUTTON LOADING =================
    form.addEventListener("submit", () => {

        button.classList.add("loading");
        button.innerHTML = "Loading...";

    });

});
