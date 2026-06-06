        document.addEventListener("DOMContentLoaded", () => {
            const toggle = document.getElementById("adminToggle");
            const pass   = document.getElementById("admin_password");
            const form   = document.getElementById("adminLoginForm");
            const btn    = document.getElementById("adminBtn");
            const btnTxt = document.getElementById("adminBtnText");

            toggle.addEventListener("click", () => {
                const icon = toggle.querySelector("i");
                if (pass.type === "password") {
                    pass.type = "text";
                    icon.className = "fa-solid fa-eye-slash";
                } else {
                    pass.type = "password";
                    icon.className = "fa-solid fa-eye";
                }
            });

            form.addEventListener("submit", () => {
                btn.classList.add("loading");
                btnTxt.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            });
        });