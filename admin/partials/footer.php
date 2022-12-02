</div>
</section>
<div class="footer">
    <div class="container footer__content">
        <div class="footer__social">
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-telegram"></i>
            </a>
        </div>
        <div class="footer__copyright">
            2022 All rights reserved, Fast Shoes. Developed By -
            <a href="#">HPD</a>
        </div>
    </div>
</div>

<script>
const body = document.querySelector("body"),
    modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "dark") {
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        localStorage.setItem("mode", "dark");
    } else {
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        localStorage.setItem("status", "close");
    } else {
        localStorage.setItem("status", "open");
    }
})
</script>
</body>

</html>