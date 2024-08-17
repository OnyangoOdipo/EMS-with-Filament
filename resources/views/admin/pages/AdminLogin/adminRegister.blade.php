<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://www.kodeeo.com/backend/assets/css/style.css">
    <link rel="stylesheet" href="https://www.kodeeo.com/backend/assets/css/components.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Panel</title>
    {{-- Style for animation --}}
    <style>
        @keyframes slideFromTopToBottom {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #animated-content {
            animation: slideFromTopToBottom 1s ease-in-out;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            position: relative;
            background-image: url('{{ asset('assets/image/service%203.jpg') }}');
            background-size: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .login-container {
            position: relative;
            z-index: 1;
            color: white;
        }

        .login-card {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-dark" style="background-image: url({{ asset('assets/image/login.jpg') }}); background-size: cover;">
    <div class="overlay">
        <div id="app" class="login-container">
            <section class="section">
                <div class="container mt-5 ">
                    <div class="row" id="animated-content">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="login-brand flex justify-content-center">
                                <img src="{{ asset('assests/image/logo.jpg') }}" alt="logo" width="100"
                                    class="rounded-circle">
                            </div>
                            <div class="card login-card card-primary">
                                <div class="card-header">
                                    <h4>Register</h4>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('admin.register.post') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" tabindex="1" required placeholder="Enter your name">
                                            @error('name')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" tabindex="2" required placeholder="Enter your email">
                                            @error('email')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" tabindex="3" required placeholder="Enter your password">
                                            @error('password')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="4" required placeholder="Confirm your password">
                                            @error('password_confirmation')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select id="role" name="role" class="form-control" tabindex="4" required>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                            @error('role')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="5">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-3 simple-footer text-white fw-bold ">
                                Copyright &copy; EM System 2024 | EMS
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
