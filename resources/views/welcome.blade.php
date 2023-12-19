<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous">
    </script>


    <style>
        body {
            background-color: #f3f0f06e;
        }

        .pt-m {
            padding-top: 64px !important;
        }

        .rounded-container {
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .rounded-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .underline-blue {
            border-bottom: 3px solid #007bff;
            padding-bottom: 4px;
        }

        .form-group {
            padding: 16px 0px 16px;
        }

        .form-group label {
            font-size: 14px;
            padding-bottom: 8px;
            font-weight: 400;
        }

        ::placeholder {
            opacity: 0.6 !important;
        }

        .input-group-append span {
            background-color: transparent !important;
        }

        .input-group-prepend span {
            background-color: transparent !important;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="pt-m"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3">

                <div class="card shadow border-0">
                    <div class="card-body">
                        <center>
                            <h3>Jamed Allan</h3>
                            <span>@james</span>

                            <div style="padding-top: 8px"></div>
                            <div class="rounded-container">
                                <img src="https://static.vecteezy.com/system/resources/thumbnails/005/346/410/small_2x/close-up-portrait-of-smiling-handsome-young-caucasian-man-face-looking-at-camera-on-isolated-light-gray-studio-background-photo.jpg"
                                    alt="Descripción de la imagen">
                            </div>

                            <div style="padding-top: 16px"></div>
                            <button type="button" class="btn btn-danger">Upload New Photo</button>

                            <div style="padding-top: 16px"></div>
                            <div class="card card-border-rounded" style="background-color: #f1f4fd; border-radius: 4%">
                                <div class="card-body">
                                    <p>Upload a new avatar, Larger image will be resized automatically.</p>
                                    <p>Maximum upload size is <strong>1 MB</strong></p>
                                </div>
                            </div>

                            <div style="padding-top: 16px"></div>
                            <p>Member Since: <strong>29 September 2019</strong></p>

                        </center>
                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div class="card shadow border-0">
                    <div class="card-header border-0">
                        <div style="padding: 24px 24px 0px;">
                            <h2>Edit Profile</h2>

                            <div style="padding-top: 16px"></div>

                            <span class="underline-blue">&nbsp; User info &nbsp;</span>
                        </div>

                    </div>
                    <div class="card-body">
                        <div style="padding: 8px 24px 0px;">
                            <form id="userForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="fullName"
                                                placeholder="Enter your full name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Enter your password" required>
                                                <div class="input-group-append"
                                                    onclick="togglePassword('password', 'icon-password')">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-eye-slash" id="icon-password"
                                                            style="padding: 4"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="passwordError" class="text-danger"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter your email address" required>
                                            <div id="emailError" class="text-danger"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Choose a username" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    placeholder="Confirm your password" required>
                                                <div class="input-group-append"
                                                    onclick="togglePassword('confirmPassword', 'icon-confirm-password')">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-eye-slash" id="icon-confirm-password"
                                                            style="padding: 4"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="confirmationPasswordError" class="text-danger"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirmEmail">Confirm Email Address</label>
                                            <input type="email" class="form-control" id="confirmEmail"
                                                placeholder="Confirm your email address" required>
                                            <div id="confirmationEmailError" class="text-danger"></div>
                                        </div>
                                    </div>

                                </div>
                                <div style="padding-top: 16px"></div>

                                <h5>Social Profile</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-brands fa-facebook" style="padding: 4"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" id="facebook-username"
                                                    placeholder="Facebook Username">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-brands fa-twitter" style="padding: 4"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" id="twitter-username"
                                                    placeholder="Twitter Username">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding-top: 16px"></div>
                                <button type="submit" class="btn btn-danger" id="updateInfoButton">Update Info</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>


        </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('js/user-management.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>



</html>