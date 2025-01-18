<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter with Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
            font-weight: bold;
        }

        /* Sidebar Styling */
        .sidebar {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            top: 20px;
        }
        .sidebar h5 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #444;
        }
        .form-check-label {
            color: #555;
        }
        .btn[data-color] {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            line-height: 30px;
            padding: 0;
            text-align: center;
            border: 2px solid transparent;
            cursor: pointer;
            transition: border 0.2s ease;
        }
        .btn[data-color]:hover,
        .btn[data-color].active {
            border-color: #333;
        }

        /* Custom Range Slider */
        #priceRange {
            appearance: none;
            width: 100%;
            height: 8px;
            background: linear-gradient(to right, #007bff, #ddd);
            border-radius: 4px;
            outline: none;
        }
        #priceRange::-webkit-slider-thumb {
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #007bff;
            cursor: pointer;
        }

        /* Product Card Styling */
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            font-size: 14px;
            color: #666;
        }
        .card img {
            border-radius: 8px 8px 0 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                margin-bottom: 20px;
                position: static;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Product Filters with Sidebar</h2>
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-md-3 sidebar">
                <div class="mb-4">
                    <h5>Filter by Price</h5>
                    <label for="priceRange" class="form-label">Price Range</label>
                    <input type="range" class="form-range" id="priceRange" min="0" max="500" step="10">
                    <div class="d-flex justify-content-between">
                        <span>$0</span>
                        <span id="priceValue">$250</span>
                        <span>$500</span>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>Filter by Gender</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="unisex" value="unisex">
                        <label class="form-check-label" for="unisex">Unisex</label>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>Filter by Color</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-sm" style="background-color: red;" data-color="red"></button>
                        <button class="btn btn-sm" style="background-color: blue;" data-color="blue"></button>
                        <button class="btn btn-sm" style="background-color: green;" data-color="green"></button>
                        <button class="btn btn-sm" style="background-color: black;" data-color="black"></button>
                        <button class="btn btn-sm" style="background-color: white; border: 1px solid #ccc;" data-color="white"></button>
                    </div>
                </div>
                <button class="btn btn-primary w-100" id="applyFilters">Apply Filters</button>
            </div>

            <!-- Product Cards -->
            <div class="col-md-9">
                <div class="row" id="productCards">
                    <!-- Example Product Card -->
                    <div class="col-md-4 mb-4 product-card" data-price="100" data-gender="male" data-color="red">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 1">
                            <div class="card-body">
                                <h5 class="card-title">Product 1</h5>
                                <p class="card-text">Price: $100</p>
                                <p class="card-text">Gender: Male</p>
                                <p class="card-text">Color: Red</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 product-card" data-price="250" data-gender="female" data-color="blue">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 2">
                            <div class="card-body">
                                <h5 class="card-title">Product 2</h5>
                                <p class="card-text">Price: $250</p>
                                <p class="card-text">Gender: Female</p>
                                <p class="card-text">Color: Blue</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 product-card" data-price="400" data-gender="unisex" data-color="green">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 3">
                            <div class="card-body">
                                <h5 class="card-title">Product 3</h5>
                                <p class="card-text">Price: $400</p>
                                <p class="card-text">Gender: Unisex</p>
                                <p class="card-text">Color: Green</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        priceRange.addEventListener('input', () => {
            priceValue.textContent = `$${priceRange.value}`;
        });

        const applyFilters = document.getElementById('applyFilters');
        applyFilters.addEventListener('click', () => {
            const maxPrice = parseInt(priceRange.value);
            const selectedGender = document.querySelector('input[name="gender"]:checked')?.value || '';
            const selectedColors = Array.from(document.querySelectorAll('.btn[data-color].active'))
                .map(btn => btn.getAttribute('data-color'));

            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price'));
                const gender = card.getAttribute('data-gender');
                const color = card.getAttribute('data-color');

                if (
                    price <= maxPrice &&
                    (!selectedGender || gender === selectedGender) &&
                    (selectedColors.length === 0 || selectedColors.includes(color))
                ) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        const colorButtons = document.querySelectorAll('.btn[data-color]');
        colorButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.toggle('active');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
