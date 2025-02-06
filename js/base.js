document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("themeToggle");
    const themeIcon = document.getElementById("themeIcon");
    const htmlElement = document.documentElement;
    const storedTheme = localStorage.getItem("theme") || "light";
    htmlElement.setAttribute("data-bs-theme", storedTheme);
    updateIcon(storedTheme);
    themeToggle.addEventListener("click", function () {
        let currentTheme = htmlElement.getAttribute("data-bs-theme");
        let newTheme = currentTheme === "light" ? "dark" : "light";
        htmlElement.setAttribute("data-bs-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        updateIcon(newTheme);
    });

    function updateIcon(theme) {
        if (theme === "light") {
            themeIcon.classList.remove("bi-sun");
            themeIcon.classList.add("bi-moon");
            themeToggle.title = "Passa alla modalità notte";
        } else {
            themeIcon.classList.remove("bi-moon");
            themeIcon.classList.add("bi-sun");
            themeToggle.title = "Passa alla modalità chiara";
        }
    }
});