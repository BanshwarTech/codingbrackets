<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login to Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(32deg, rgba(61, 0, 166, 1) 0%, rgba(0, 0, 0, 1) 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            height: 80vh;
        }

        .login-left {
            background: #e9f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-left img {
            max-width: 100%;
            height: 70vh;
        }

        .login-right {
            padding: 3rem 2rem;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1f3bb3;
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #1f3bb3;
        }

        .btn-login {
            background-color: #1f3bb3;
            border: none;
            border-radius: 30px;
            padding: 10px;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #1731a8;
        }

        .login-footer {
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row login-container mx-auto">
            <!-- Left: Illustration -->
            <div class="col-md-6 login-left">
                <img src="{{ asset('login_image.png') }}" alt="Login Illustration">
            </div>

            <!-- Right: Login Form -->
            <div class="col-md-6 login-right m-auto">
                <h2 class="login-title">Login to Dashboard</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="example@email.com" />
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label text-muted">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="••••••••" />
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none text-primary">Forgot password?</a>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login text-white">LOGIN</button>
                    </div>
                </form>
                <div class="login-footer text-center mt-4">
                    Don’t have an account? <a href="#" class="text-primary text-decoration-none">Sign up.</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
