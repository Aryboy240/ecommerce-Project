<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Fit - Demo</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <div class="logo">Optique</div>
        <div>
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </div>

    <h1>Find Your Perfect Glasses Fit</h1>
    <button class="find-my-fit-btn" onclick="togglePopup('initialPopup')">Find My Fit</button>

    <!-- Initial Popup -->
    <div id="initialPopup" class="initial-popup">
        <h2>Find glasses based on your face shape</h2>
        <button class="continue-btn" onclick="togglePopup('findMyFitModal')">Continue</button>
    </div>

    <!-- Modal -->
    <div id="findMyFitModal" class="modal">
        <span class="close-modal" onclick="togglePopup('findMyFitModal')">&times;</span>
        <h2>Select Your Face Shape</h2>
        <div class="face-options">
            @foreach(['Round', 'Square', 'Oval', 'Heart', 'Diamond', 'Triangle'] as $shape)
                <div onclick="showRecommendations('{{ $shape }}')">
                    <img src="{{ asset('images/'.$shape.'.png') }}" alt="{{ $shape }}">
                    <div class="face-label">{{ $shape }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recommendations Section -->
    <div id="recommendations" class="initial-popup" style="display: none;">
        <h2>Recommended Glasses</h2>
        <div class="glasses-options" id="glasses-options">
            <!-- Glasses options will be dynamically added here -->
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2024 Optique. All Rights Reserved.
    </div>

    <script>
        function togglePopup(id) {
            var element = document.getElementById(id);
            element.style.display = (element.style.display === 'none') ? 'block' : 'none';
        }

        function showRecommendations(shape) {
            const glassesData = {
                'Round': ['glasses1.png', 'glasses2.png'],
                'Square': ['glasses3.png', 'glasses4.png'],
                'Oval': ['glasses5.png', 'glasses6.png'],
                'Heart': ['glasses7.png', 'glasses8.png'],
                'Diamond': ['glasses9.png', 'glasses10.png'],
                'Triangle': ['glasses11.png', 'glasses12.png']
            };

            const glassesOptions = document.getElementById('glasses-options');
            glassesOptions.innerHTML = '';
            glassesData[shape].forEach(img => {
                glassesOptions.innerHTML += `
                    <div class="glasses-card">
                        <img src="{{ asset('images/${img}') }}" alt="Recommended Glasses">
                        <p>Glasses Model ${img}</p>
                        <button>Add to Cart</button>
                    </div>
                `;
            });
            togglePopup('recommendations');
        }
    </script>

</body>
</html>



