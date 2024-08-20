import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// TailwindCSS Dark Mode

document.querySelectorAll(".setMode").forEach((item) =>
    item.addEventListener("click", () => {
        if (localStorage.dark == 1) {
            localStorage.dark = 0;
            document.documentElement.classList.remove("dark");
        } else {
            localStorage.dark = 1;
            document.documentElement.classList.add("dark");
        }
    })
);
