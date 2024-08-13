let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');
let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');
let loadingSpinner = document.querySelector('.loading-spinner');

// Toggle Navbar and Profile Menu
document.querySelector('#menu-btn').onclick = () => {
    toggleMenu(navbar, profile);
};

document.querySelector('#user-btn').onclick = () => {
    toggleMenu(profile, navbar);
};

// Close menus when clicking outside
document.addEventListener('click', (e) => {
    if (!navbar.contains(e.target) && !document.querySelector('#menu-btn').contains(e.target)) {
        navbar.classList.remove('active');
    }
    if (!profile.contains(e.target) && !document.querySelector('#user-btn').contains(e.target)) {
        profile.classList.remove('active');
    }
});

// Debounce scroll event
let scrollTimeout;
window.onscroll = () => {
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(() => {
        navbar.classList.remove('active');
        profile.classList.remove('active');
    }, 100);
};

// Handle image switching with a loading spinner
subImages.forEach(image => {
    image.onclick = () => {
        handleImageSwitch(image);
    };
});

// Keyboard accessibility for menu and profile toggles
document.querySelector('#menu-btn').onkeypress = (e) => {
    handleKeyPress(e, navbar, profile);
}

document.querySelector('#user-btn').onkeypress = (e) => {
    handleKeyPress(e, profile, navbar);
}

// Toggle menus with transition
function toggleMenu(openMenu, closeMenu) {
    openMenu.classList.toggle('active');
    closeMenu.classList.remove('active');
    applyTransition(openMenu);
}

// Handle key press for accessibility
function handleKeyPress(event, openMenu, closeMenu) {
    if (event.key === 'Enter' || event.key === ' ') {
        toggleMenu(openMenu, closeMenu);
    }
}

// Handle image switching with smooth transitions
function handleImageSwitch(imageElement) {
    loadingSpinner.style.display = 'block';
    let src = imageElement.getAttribute('src');
    mainImage.src = src;

    mainImage.onload = () => {
        loadingSpinner.style.display = 'none';
        applyImageTransition(mainImage);
    };

    mainImage.onerror = () => {
        loadingSpinner.style.display = 'none';
        mainImage.src = 'path/to/fallback-image.jpg'; // Provide a fallback image path
    };
}

// Function to apply smooth transitions to elements
function applyTransition(element) {
    element.style.transition = 'all 0.3s ease-in-out';
}

// Function to apply transition effect to images
function applyImageTransition(image) {
    image.style.transition = 'opacity 0.3s ease-in-out';
    image.style.opacity = 0;
    setTimeout(() => {
        image.style.opacity = 1;
    }, 100);
}
