$(document).ready(function () {
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
            $("#updateInfoButton").prop("disabled", false);
        } else {
            $("#updateInfoButton").prop("disabled", true);
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
