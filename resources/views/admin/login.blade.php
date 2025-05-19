<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login to Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print"
        onload="this.onload=null;this.media='all';">
    <style>
        /* Success Toast */
        .toast-success {
            background-color: #115234 !important;
            /* Bootstrap success green */
            color: #ffffff !important;
        }

        /* Error Toast */
        .toast-error {
            background-color: #451318 !important;
            /* Bootstrap danger red */
            color: #ffffff !important;
        }

        /* Warning Toast */
        .toast-warning {
            background-color: #4a3c14 !important;
            /* Bootstrap warning yellow */
            color: #000000 !important;
        }

        /* Optional: Close button color for all toasts */
        .toast-close-button {
            color: #ffffff !important;
            opacity: 1;
        }

        .toast-warning .toast-close-button {
            color: #000000 !important;
        }

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

        /* Position the eye icon */
        .field-icon {
            position: absolute;
            top: 45px;
            right: 10px;
            cursor: pointer;
            color: #aaa;
            font-size: 0.8rem;
            user-select: none;
            transition: color 0.3s ease;
        }

        .field-icon:hover {
            color: #000;
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
                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="example@email.com" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2 position-relative">
                        <label for="password" class="form-label text-muted">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="••••••••" />
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <a href="#" class="text-decoration-none text-primary">Forgot password?</a>
                    </div> --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login text-white">LOGIN</button>
                    </div>
                </form>


                <div class="login-footer text-center mt-4">
                    Go back to Home <a href="#" class="text-primary text-decoration-none">Home</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.getAttribute('type') === 'password') {
                    input.setAttribute('type', 'text');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.setAttribute('type', 'password');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    @if (session()->has('success') || session()->has('error') || session()->has('warning'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-right",
                    closeButton: true,
                    timeOut: 5000
                };

                let successMessage = "{{ session('success') }}";
                let errorMessage = "{{ session('error') }}";
                let warningMessage = "{{ session('warning') }}";

                if (successMessage) {
                    toastr.success(successMessage);
                }

                if (errorMessage) {
                    toastr.error(errorMessage);
                }

                if (warningMessage) {
                    toastr.warning(warningMessage);
                }
            });
        </script>
    @endif

</body>

</html>
