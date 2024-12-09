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
    img.addEventListener('mouseover', () => {
        img.style.cursor = 'zoom-in';
    });

    img.addEventListener('click', event => {
        const rect = img.getBoundingClientRect(); 
        const offsetX = event.clientX - rect.left; 
        const offsetY = event.clientY - rect.top; 
        const width = rect.width; 
        const height = rect.height;
        if (img.style.transform === 'scale(2)') {
            img.style.transform = 'scale(1)';
            img.style.transformOrigin = 'center center'; 
            img.style.cursor = 'zoom-in';
        } else {
            const originX = (offsetX / width) * 100; 
            const originY = (offsetY / height) * 100;
            img.style.transformOrigin = `${originX}% ${originY}%`; 
            img.style.transform = 'scale(2)'; 
            img.style.transition = 'transform 0.3s ease';
            img.style.cursor = 'zoom-out';
        }
    });
});

document.getElementById("themeButton").onclick = toggleTheme;
