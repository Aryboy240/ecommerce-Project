/*
    Developer: man kwok angus
    University ID: 230049488
    Function: Dynamically setting the width of the stock, incoming, and outgoing bars based on the values provided
*/
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.bar').forEach(bar => {
        let value = bar.dataset.stock || bar.dataset.incoming || bar.dataset.outgoing;
        bar.style.width = value + '%';

        if (!bar.querySelector('p')) {
            let valueText = document.createElement('p');
            valueText.textContent = value; 
            bar.appendChild(valueText); 
        } else {
            bar.querySelector('p').textContent = value; 
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".bar-container").forEach(container => {
        const bar = container.querySelector(".bar");
        const increaseBtn = container.querySelector(".increase-btn");
        const decreaseBtn = container.querySelector(".decrease-btn");
        let value = parseInt(bar.dataset.stock || bar.dataset.incoming || bar.dataset.outgoing);

        bar.textContent = value;
        bar.style.width = value + "%";

        function updateBar(newValue) {
            if (newValue >= 0 && newValue <= 100) {
                value = newValue;
                bar.textContent = value;
                bar.style.width = value + "%";
            }
        }

        increaseBtn.addEventListener("click", function() {
            updateBar(value + 1); 
        });

        decreaseBtn.addEventListener("click", function() {
            updateBar(value - 1); 
        });
    });
});