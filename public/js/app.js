$(document).ready(function () {
    $("#imageFile").change(function () {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);

        $("#userImage").attr("src", url);
        $("#removeImageBtn").show();

        var fileSize = input.files[0].size;
        var maxSize = 1024 * 1024;
        console.log(fileSize);
        if (fileSize > maxSize) {
            Swal.fire({
                title: "Error",
                text: "The selected image exceeds the maximum allowed size of 1 MB.",
                icon: "error",
            });

            removeImageBtn();
        }
    });

    function removeImageBtn() {
        $("#userImage").attr(
            "src",
            "https://static.vecteezy.com/system/resources/thumbnails/005/346/410/small_2x/close-up-portrait-of-smiling-handsome-young-caucasian-man-face-looking-at-camera-on-isolated-light-gray-studio-background-photo.jpg"
        );
        $("#removeImageBtn").hide();
        $("#imageFile").val("");
    }

    $("#removeImageBtn").click(function () {
        removeImageBtn();
    });

    var isValidateEmail;
    var isValidatePassword;

    function validateEmails() {
        var email = $("#email").val();
        var confirmEmail = $("#confirmEmail").val();

        if (email !== confirmEmail) {
            $("#emailError").text("Emails do not match");
            $("#confirmationEmailError").text("Emails do not match");
            isValidateEmail = false;
        } else {
            $("#emailError").text("");
            $("#confirmationEmailError").text("");
            isValidateEmail = true;
        }
    }

    function validatePasswords() {
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        if (password !== confirmPassword) {
            $("#passwordError").text("Passwords do not match");
            $("#confirmationPasswordError").text("Passwords do not match");
            isValidatePassword = false;
        } else {
            $("#passwordError").text("");
            $("#confirmationPasswordError").text("");
            isValidatePassword = true;
        }
    }

    $("#userForm").submit(function () {
        $("#password").attr("type", "password");
        $("#confirmPassword").attr("type", "password");
    });

    function disabledSubmit() {
        if (isValidateEmail && isValidatePassword) {
            $("#saveUser").prop("disabled", false);
        } else {
            $("#saveUser").prop("disabled", true);
        }
    }

    $("#confirmEmail").blur(function () {
        validateEmails();
        disabledSubmit();
    });

    $("#email").blur(function () {
        validateEmails();
        disabledSubmit();
    });

    $("#password").blur(function () {
        validatePasswords();
        disabledSubmit();
    });

    $("#confirmPassword").blur(function () {
        validatePasswords();
        disabledSubmit();
    });

    $("#userForm").submit(function (event) {
        event.preventDefault();
        var route = baseUrl("users");
        var token = $("#token").val();

        var formData = new FormData(this);

        $.ajax({
            url: route,
            headers: { "X-CSRF-TOKEN": token },
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                $("#userForm")[0].reset();
                removeImageBtn();

                var userName = response.user.username;

                Swal.fire({
                    title: "Success!",
                    text: "User '" + userName + "' created successfully.",
                    icon: "success",
                });
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    var validationErrors = error.responseJSON.errors;
                    var errorEmail;
                    var errorUsername;
                    if (validationErrors.username)
                        errorUsername = validationErrors.username[0];
                    if (validationErrors.email)
                        errorEmail = validationErrors.email[0];

                    if (errorUsername && errorEmail) {
                        Swal.fire({
                            icon: "error",
                            title: "An error has occurred...",
                            text: "The user and email exist, please correct the fields",
                        });
                    } else if (errorUsername) {
                        Swal.fire({
                            icon: "error",
                            title: "An error has occurred...",
                            text: "The user exist, please correct the field",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "An error has occurred...",
                            text: "The email exist, please correct the field",
                        });
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "An error has occurred...",
                        text: "The server does not respond",
                    });
                }
            },
        });
    });
});

function togglePassword(inputId, icon) {
    const passwordInput = $("#" + inputId);
    const passwordIcon = $("#" + icon);

    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
        passwordInput.attr("type", "password");
        passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
    }
}
