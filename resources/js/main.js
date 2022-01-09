const hamburger = document.querySelector(".hamburger");
const menuWrapper = document.querySelector(".menu-wrapper");
const overlay = document.querySelector("#dark-overlay");

hamburger.addEventListener("click", () => {
    toggleMenu();
});

overlay.addEventListener("click", () => {
    toggleMenu();
});

const toggleMenu = () => {
    hamburger.classList.toggle("active");
    menuWrapper.classList.toggle("show");
    overlay.classList.toggle("show");
};

const gallery = document.querySelector(".gallery-carousel");

if (gallery) {
    const flkty = new Flickity(gallery, {
        setGallerySize: true,
        adaptiveHeight: true,
        imagesLoaded: true,
        draggable: false,
        wrapAround: true,
        pageDots: false,
    });
}

const brand = document.querySelector(".brand");

brand.addEventListener("click", (e) => {
    e.preventDefault();
    let path = window.location.pathname;

    if (path === "/") {
        scrollTo(0, 0);
    } else {
        window.location.href = "/";
    }
});
