/*  Developer: Aryan Kora
    University ID: 230059030
    Function: Theme changer script
*/

const themeMap = {
    dark: "light",
    light: "dark",
};

const theme =
    localStorage.getItem("theme") ||
    ((tmp = Object.keys(themeMap)[0]), localStorage.setItem("theme", tmp), tmp);
const bodyClass = document.body.classList;
bodyClass.add(theme);

function toggleTheme() {
    const current = localStorage.getItem("theme");
    const next = themeMap[current];

    bodyClass.replace(current, next);
    localStorage.setItem("theme", next);
}

//Zoom Feature

document.querySelectorAll('.product-card img').forEach(img => {
    let isZoomed = false;

    img.addEventListener('mousemove', event => {
        if (isZoomed) {
            const rect = img.getBoundingClientRect();
            const offsetX = event.clientX - rect.left; 
            const offsetY = event.clientY - rect.top; 
            const width = rect.width;
            const height = rect.height;

            const originX = (offsetX / width) * 100;
            const originY = (offsetY / height) * 100;

            img.style.transformOrigin = `${originX}% ${originY}%`;
        }
    });

    img.addEventListener('click', () => {
        if (isZoomed) {
            // Reset zoom
            img.style.transform = 'scale(1)';
            img.style.transformOrigin = 'center center';
            img.style.cursor = 'zoom-in';
            isZoomed = false;
        } else {
            // Enable zoom
            img.style.transform = 'scale(2)';
            img.style.transition = 'transform 0.3s ease';
            img.style.cursor = 'zoom-out';
            isZoomed = true;
        }
    });
});

document.getElementById("themeButton").onclick = toggleTheme;
