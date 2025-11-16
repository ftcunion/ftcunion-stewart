// Check if we have a stored preference for dark mode
if (localStorage.getItem('ftcunion-color-mode') === 'dark') {
    // Add the dark class to the body
    document.body.classList.add('ftcunion-dark');
} else if (localStorage.getItem('ftcunion-color-mode') === 'light') {
    // Add the light class to the body
    document.body.classList.add('ftcunion-light');
}

// Add event listeners to the buttons to set the local storage and update the body class
document.addEventListener('DOMContentLoaded', function () {
    const darkModeButton = document.querySelector('.wp-social-link-ftcunion-social-link-dark');
    const lightModeButton = document.querySelector('.wp-social-link-ftcunion-social-link-light');
    if (darkModeButton) {
        darkModeButton.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('ftcunion-color-mode', 'dark');
            document.body.classList.add('ftcunion-dark');
            document.body.classList.remove('ftcunion-light');
        });
    }
    if (lightModeButton) {
        lightModeButton.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('ftcunion-color-mode', 'light');
            document.body.classList.add('ftcunion-light');
            document.body.classList.remove('ftcunion-dark');
        });
    }
});