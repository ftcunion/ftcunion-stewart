// Define a function which returns the current color mode based on local storage or system preference
function getCurrentColorMode() {
    if (localStorage.getItem('ftcunion-color-mode') === 'dark') {
        return 'ftcunion-dark';
    } else if (localStorage.getItem('ftcunion-color-mode') === 'light') {
        return 'ftcunion-light';
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        return 'ftcunion-dark';
    } else {
        return 'ftcunion-light';
    }
}

// Add the color mode class to the html tag
document.documentElement.classList.add(getCurrentColorMode());

// Add event listeners to the buttons to set the local storage and update the body class
document.addEventListener('DOMContentLoaded', function () {
    const darkModeButton = document.querySelector('.wp-social-link-ftcunion-social-link-dark');
    const lightModeButton = document.querySelector('.wp-social-link-ftcunion-social-link-light');
    if (darkModeButton) {
        darkModeButton.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('ftcunion-color-mode', 'dark');
            document.documentElement.classList.add('ftcunion-dark');
            document.documentElement.classList.remove('ftcunion-light');
        });
    }
    if (lightModeButton) {
        lightModeButton.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('ftcunion-color-mode', 'light');
            document.documentElement.classList.add('ftcunion-light');
            document.documentElement.classList.remove('ftcunion-dark');
        });
    }
});