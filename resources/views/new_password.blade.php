<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 50vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1E2A47, #2C3E50);
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: 100vh;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .image-section {
            flex: 1;
            background: url('{{ asset("images/back5.png") }}') no-repeat center center/cover;
            position: relative;
        }

        .form-container {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 30px;
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

        .btn-dark {
            background: linear-gradient(to right, #1E2A47, #2C3E50);
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-dark:hover {
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
            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
        </div>

        <div class="form-container">
        <h3 class="card-title text-center">Reset Password</h3>
            <form action="{{ URL::to('/') }}/UpdateNewPassword" method="POST" id="form1">
                    @csrf
                    <div class="form-group">
                        <label for="password"><b>New Password:</b></label>
                        <input type="password" class="form-control" id="pwd" name="pswd"
                            value="{{ old('password') }}">

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password_confirmation12"><b>Confirm New Password:</b></label>
                        <input type="password" class="form-control" id="password_confirmation12" name="repswd"
                            value="{{ old('password_confirmation') }}">

                    </div>
                    <br>
                    <input type="submit" class="btn btn-dark btn-block" value="Change Password" />
                </form>

        </div>
    </div>
</body>

</html>
