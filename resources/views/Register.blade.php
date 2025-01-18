<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1E2A47, #2C3E50); 
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .image-section {
            flex: 1;
            background: url('{{ asset("images/back5.png") }}') no-repeat center center/cover; 
            position: relative;
        }

        .overlay {
           
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .form-section {
            flex: 1;
            padding: 40px;
            /* display: flex; */
            flex-direction: column;
            justify-content: center;
        }

        .form-section h3 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
            color: #2C3E50; 
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating label {
            color: #444; 
            transition: all 0.3s ease;
        }

        .form-floating .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-floating .form-control:focus {
            border-color: #1E2A47;
            box-shadow: 0 0 8px rgba(30, 42, 71, 0.5); 
        }

        .form-floating .form-control:focus~label {
            color: #1E2A47; 
        }

        .btn-primary {
            background: linear-gradient(to right, #1E2A47, #2C3E50); 
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .text-center a {
            color: #1E2A47; 
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: #2C3E50; 
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-section">
            <div class="overlay"></div>
        </div>
        <div class="form-section">
            <h3>Register</h3>
            <form action="{{URL::to('/')}}/register_data" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" name="companyname" class="form-control" id="companyname" placeholder="Company Name">
                    <label for="companyname">Company Name</label>
                    @error('companyname')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    <label for="name">Name</label>
                    @error('name')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    <label for="email">Email</label>
                    @error('email')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="phonenumber" class="form-control" id="phonenumber" placeholder="Phone Number">
                    <label for="phonenumber">Phone Number</label>
                    @error('phonenumber')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="distric" class="form-control" id="distric" placeholder="District">
                    <label for="distric">District</label>
                    @error('distric')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="taluka" class="form-control" id="taluka" placeholder="Taluka">
                    <label for="taluka">Taluka</label>
                    @error('taluka')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="city" class="form-control" id="city" placeholder="City">
                    <label for="city">City</label>
                    @error('city')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                    <label for="address">Address</label>
                    @error('address')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="text-center mt-4">
                Already have an account? <a href="Login">Login</a>
            </p>
        </div>
    </div>
</body>

</html>
