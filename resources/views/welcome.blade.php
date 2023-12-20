<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function baseUrl(url){
          return '{{url('')}}/' + url;
        }
    </script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="container-fluid">
        <div class="pt-m" id="pt-m"></div>
        <form id="userForm" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <center>
                                <h3 id="full_name_title">Jamed Allan</h3>
                                <span id="username_title">@james</span>

                                <div style="padding-top: 8px;">
                                    <div class="rounded-container" id="imageContainer">
                                        <img id="userImage"
                                            src="https://static.vecteezy.com/system/resources/thumbnails/005/346/410/small_2x/close-up-portrait-of-smiling-handsome-young-caucasian-man-face-looking-at-camera-on-isolated-light-gray-studio-background-photo.jpg"
                                            alt="Descripción de la imagen">
                                    </div>
                                </div>

                                <div style="padding-top: 16px"></div>
                                <label for="imageFile" class="btn btn-danger" style="color: #f1f4fd; font-weight: 600">
                                    Upload New Photo <input class="form-control" type="file" id="imageFile"
                                        name="imageFile" style="display: none;">
                                </label>
                                <button id="removeImageBtn" class="btn btn-warning" style="display: none;">
                                    <i class="fas fa-trash"></i>
                                </button>


                                <div style="padding-top: 16px"></div>
                                <div class="card card-border-rounded"
                                    style="background-color: #f1f4fd; border-radius: 4%">
                                    <div class="card-body">
                                        <p>Upload a new avatar, Larger image will be resized automatically.</p>
                                        <p>Maximum upload size is <strong>1 MB</strong></p>
                                    </div>
                                </div>

                                <div style="padding-top: 16px"></div>
                                <p>Member Since: <strong id="member_since">---</strong></p>


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
                                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label for="user_id">ID</label>
                                            <input type="text" class="form-control" id="user_id" name="user_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                placeholder="Enter your full name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Enter your password" required>
                                                <div class="clickable input-group-append"
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
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter your email address" required>
                                            <div id="emailError" class="text-danger"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Choose a username" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    placeholder="Confirm your password" required>
                                                <div class="clickable input-group-append"
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
                                                name="confirmEmail" placeholder="Confirm your email address" required>
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
                                                <input type="text" class="form-control" name="facebook_username"
                                                    id="facebook_username" placeholder="Facebook Username">

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
                                                <input type="text" class="form-control" name="twitter_username"
                                                    id="twitter_username" placeholder="Twitter Username">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding-top: 16px"></div>
                                <button type="submit" class="btn btn-danger" id="saveUser" style="font-weight: 600">
                                    Save Info
                                </button>
                                <button type="button" class="btn btn-warning" id="cancelUpdate" style="display: none"
                                    onclick="resetForm()">
                                    <i class="fa-solid fa-xmark"></i> Cancelar
                                </button>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>

        <div class="pt-m"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card shadow border-0">
                    <div class="card-header border-0">
                        <div style="padding: 24px 24px 0px;">
                            <h2>Registered Users</h2>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table" id="usersTable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Member Since</th>
                                        <th scope="col">
                                            <i class="fa-brands fa-facebook" style="padding: 4"></i>
                                        </th>
                                        <th scope="col">
                                            <i class="fa-brands fa-twitter" style="padding: 4"></i>
                                        </th>
                                        <th scope="col">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </th>
                                        <th scope="col">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </th>
                                        <th class="hidden" scope="col">
                                            image
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="pt-m"></div>


    </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>



</html>