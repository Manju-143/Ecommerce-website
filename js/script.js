// Toggle the navbar visibility when the menu button is clicked
let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () => {
    toggleMenu(navbar, profile);
};

// Toggle the profile dropdown visibility when the user button is clicked
document.querySelector('#user-btn').onclick = () => {
    toggleMenu(profile, navbar);
};

// Hide navbar and profile dropdown on scroll
window.onscroll = () => {
    closeMenus(navbar, profile);
};

// Switch the main image when a sub-image is clicked, with a smooth transition effect
let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(image => {
    image.onclick = () => {
        switchImageWithTransition(mainImage, image.getAttribute('src'));
    };
});

// Toggle the visibility of the menu and close other active menus
function toggleMenu(openMenu, closeMenu) {
    openMenu.classList.toggle('active');
    closeMenu.classList.remove('active');
}

// Close both menus
function closeMenus(navbar, profile) {
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

// Switch the image with a smooth fade-out and fade-in effect
function switchImageWithTransition(mainImage, newSrc) {
    // Fade-out effect
    mainImage.style.transition = 'opacity 0.3s ease';
    mainImage.style.opacity = '0';

    setTimeout(() => {
        mainImage.src = newSrc;

        // Ensure the image has loaded before fading in
        mainImage.onload = () => {
            // Fade-in effect
            mainImage.style.transition = 'opacity 0.3s ease';
            mainImage.style.opacity = '1';
        };
    }, 300); // Duration of the fade-out effect (300ms)
}
