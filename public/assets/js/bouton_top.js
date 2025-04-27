window.onscroll = function () {
    const backToTopButton = document.getElementById("retourHaut");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = "block";
    } else {
        backToTopButton.style.display = "none";
    }
};

document.getElementById("retourHaut").onclick = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
