<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/find_my_fit.css') }}">
    <title>Find My Fit - Optique</title>
</head>
<body>
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
    <button class="find-my-fit-btn" onclick="resetAndShowModal()">Find My Fit</button>

    <!-- Initial Popup -->
    <div id="initialPopup" class="initial-popup">
        <span class="close-modal" onclick="closeInitialPopup()">&times;</span>
        <h2>Find glasses based on your face shape</h2>
        <button class="continue-btn" onclick="showModal()">Continue</button>
    </div>

    <!-- Modal -->
    <div id="findMyFitModal" class="modal">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <h2>Select Your Face Shape</h2>
        <div class="face-options">
            <div class="face-item">
                <img src="{{ asset('images/round.png') }}" alt="Round" onclick="showRecommendations('Round')">
                <div class="face-label">Round</div>
            </div>
            <div class="face-item">
                <img src="{{ asset('images/square.png') }}" alt="Square" onclick="showRecommendations('Square')">
                <div class="face-label">Square</div>
            </div>
            <div class="face-item">
                <img src="{{ asset('images/oval.png') }}" alt="Oval" onclick="showRecommendations('Oval')">
                <div class="face-label">Oval</div>
            </div>
            <div class="face-item">
                <img src="{{ asset('images/heart.png') }}" alt="Heart" onclick="showRecommendations('Heart')">
                <div class="face-label">Heart</div>
            </div>
            <div class="face-item">
                <img src="{{ asset('images/diamond.png') }}" alt="Diamond" onclick="showRecommendations('Diamond')">
                <div class="face-label">Diamond</div>
            </div>
            <div class="face-item">
                <img src="{{ asset('images/triangle.png') }}" alt="Triangular" onclick="showRecommendations('Triangular')">
                <div class="face-label">Triangular</div>
            </div>
        </div>
    </div>

    <!-- Recommendations Section -->
    <div id="recommendations" style="display: none;">
        <h2>Recommended Glasses</h2>
        <div id="glasses-options" class="glasses-options"></div>
    </div>

    <footer class="footer">
        &copy; 2024 Optique. All Rights Reserved.
    </footer>

    <script>
        function resetAndShowModal() {
            closeModal();
            closeInitialPopup();
            document.getElementById('initialPopup').style.display = 'block';
        }

        function showModal() {
            document.getElementById('initialPopup').style.display = 'none';
            document.getElementById('findMyFitModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('findMyFitModal').style.display = 'none';
        }

        function closeInitialPopup() {
            document.getElementById('initialPopup').style.display = 'none';
        }

        function showRecommendations(shape) {
            document.getElementById('findMyFitModal').style.display = 'none';
            document.getElementById('recommendations').style.display = 'block';

            const basePath = "{{ asset('images') }}/";
            const glassesData = {
                "Round": ["glasses1.png", "glasses2.png"],
                "Square": ["glasses3.png", "glasses4.png"],
                "Oval": ["glasses5.png", "glasses6.png"],
                "Heart": ["glasses7.png", "glasses8.png"],
                "Diamond": ["glasses9.png", "glasses10.png"],
                "Triangular": ["glasses11.png", "glasses12.png"]
            };

            const glassesContainer = document.getElementById('glasses-options');
            glassesContainer.innerHTML = '';

            glassesData[shape].forEach(img => {
                glassesContainer.innerHTML += `
                    <div class="glasses-card">
                        <img src="${basePath + img}" alt="Recommended Glasses">
                        <p>Glasses Model ${img}</p>
                        <button>Add to Cart</button>
                    </div>`;
            });
        }
    </script>
</body>
</html>



