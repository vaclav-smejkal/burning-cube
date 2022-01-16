const menuWrapper = document.querySelector(".menu-wrapper");
const hamburger = document.querySelector(".hamburger");
const overlay = document.querySelector("#dark-overlay");
const menuItems = document.querySelectorAll(".menu a");

hamburger.addEventListener("click", () => {
    toggleMenu();
});

overlay.addEventListener("click", () => {
    toggleMenu();
});

menuItems.forEach((item) => {
    item.addEventListener("click", () => {
        if (window.innerWidth <= 992) {
            toggleMenu();
        }
    });
});

const toggleMenu = () => {
    hamburger.classList.toggle("active");
    menuWrapper.classList.toggle("show");
    overlay.classList.toggle("show");
    document.querySelector("body").classList.toggle("scroll-lock");
};

const gallery = document.querySelector(".gallery-carousel");

if (gallery) {
    const flkty = new Flickity(gallery, {
        adaptiveHeight: true,
        imagesLoaded: true,
        draggable: true,
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

const collapseBtns = document.querySelectorAll(".btn-collapse");

if (collapseBtns.length) {
    collapseBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            btn.classList.toggle("collapsed");

            const i = e.target.dataset.cardCollapse;
            const cardCollapse = document.querySelectorAll(
                ".card-collapse." + i
            );

            cardCollapse.forEach((collapse) => {
                collapse.classList.toggle("show");
            });
        });
    });
}

const navbar = document.querySelector("#navbar");
window.addEventListener("scroll", () => {
    if (scrollY > 100) {
        navbar.classList.add("scrolling");
    } else {
        navbar.classList.remove("scrolling");
    }
});

const scrollToElemOffset = (scrollToElems, offset, elementId) => {
    scrollToElems.forEach((btn) => {
        if (window.innerWidth <= 992) {
            offset = 40;
        }
        const element = document.getElementById(elementId);
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        btn.addEventListener("click", (e) => {
            e.preventDefault();
            window.scrollTo({
                top: offsetPosition,
            });
        });
    });
};

window.onload = () => {
    const scrollToPackages = document.querySelectorAll(".scroll-to-packages");
    scrollToElemOffset(scrollToPackages, 80, "packages");

    const scrollToEarlyAccess = document.querySelectorAll(
        ".scroll-to-early-access"
    );
    scrollToElemOffset(scrollToEarlyAccess, 80, "early-access");

    const scrollToContact = document.querySelectorAll(".scroll-to-contact");
    scrollToElemOffset(scrollToContact, 80, "contact");
};
