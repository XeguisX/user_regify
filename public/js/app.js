function resetPasswordFields() {
    $("#password").attr("type", "password");
    $("#confirmPassword").attr("type", "password");
    $("#icon-password").removeClass("fa-eye").addClass("fa-eye-slash");
    $("#icon-confirm-password").removeClass("fa-eye").addClass("fa-eye-slash");
}

function removeImageBtn() {
    $("#userImage").attr(
        "src",
        "https://static.vecteezy.com/system/resources/thumbnails/005/346/410/small_2x/close-up-portrait-of-smiling-handsome-young-caucasian-man-face-looking-at-camera-on-isolated-light-gray-studio-background-photo.jpg"
    );
    $("#removeImageBtn").hide();
    $("#imageFile").val("");
}

function resetForm() {
    $("#userForm")[0].reset();
    $("#cancelUpdate").hide();
    $("#member_since").text("---");
    $("#username_title").text("@james");
    $("#full_name_title").text("Jamed Allan");
    resetPasswordFields();
    removeImageBtn();
}

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

function formatDate(date) {
    var date = new Date(date);
    var monthInitials = date
        .toLocaleString("es", { month: "short" })
        .toUpperCase();
    var formatDate =
        date.getDate() + " - " + monthInitials + " - " + date.getFullYear();

    return formatDate;
}

$(document).ready(function () {
    function fillTable(data) {
        var table = $("#usersTable");

        table.find("tbody").empty();

        data.forEach(function (row) {
            var formattedDate = formatDate(row.created_at);

            var newRow =
                "<tr>" +
                "<td>" +
                row.id +
                "</td>" +
                "<td>" +
                row.username +
                "</td>" +
                "<td>" +
                row.full_name +
                "</td>" +
                "<td>" +
                row.email +
                "</td>" +
                "<td>" +
                formattedDate +
                "</td>" +
                "<td>" +
                (row.facebook_username
                    ? row.facebook_username
                    : '<i class="fa-solid fa-minus"></i>') +
                "<td>" +
                (row.twitter_username
                    ? row.twitter_username
                    : '<i class="fa-solid fa-minus"></i>') +
                "</td>" +
                "<td>" +
                '<i class="fa-solid fa-pen-to-square clickable"></i>' +
                "</td>" +
                "<td>" +
                '<i class="fa-solid fa-trash-alt clickable" id="delete-user" ></i>' +
                "</td>" +
                '<td class="hidden">' +
                (row.profile_image ? row.profile_image : "") +
                "</td>" +
                "</tr>";

            table.find("tbody").append(newRow);
        });
    }

    $("#usersTable").on("click", ".fa-pen-to-square", function () {
        var fila = $(this).closest("tr");

        var idUsuario = fila.find("td:eq(0)").text();
        var username = fila.find("td:eq(1)").text();
        var fullName = fila.find("td:eq(2)").text();
        var email = fila.find("td:eq(3)").text();
        var member_since = fila.find("td:eq(4)").text();
        var facebook_username = fila.find("td:eq(5)").text();
        var twitter_username = fila.find("td:eq(6)").text();
        var path_image = fila.find("td:hidden").text();

        $("#userForm")[0].reset();
        $("#user_id").val(idUsuario);
        $("#username").val(username);
        $("#username_title").text("@" + username);
        $("#full_name").val(fullName);
        $("#full_name_title").text(fullName);
        $("#email").val(email);
        $("#confirmEmail").val(email);
        $("#member_since").text(member_since);
        $("#facebook_username").val(facebook_username);
        $("#twitter_username").val(twitter_username);

        if (path_image) {
            $("#userImage").attr("src", path_image);
        } else {
            $("#userImage").attr(
                "src",
                "https://static.vecteezy.com/system/resources/thumbnails/005/346/410/small_2x/close-up-portrait-of-smiling-handsome-young-caucasian-man-face-looking-at-camera-on-isolated-light-gray-studio-background-photo.jpg"
            );
        }

        $("#cancelUpdate").show();

        var posicion = $("#pt-m").offset().top;
        $("html, body").animate({ scrollTop: posicion }, "slow");
    });

    function getData() {
        var routeGetuser = baseUrl("users");

        $.ajax({
            url: routeGetuser,
            method: "GET",
            dataType: "json",
            success: function (data) {
                if (data && data.length > 0) {
                    fillTable(data);
                } else {
                    var table = $("#usersTable");
                    table.find("tbody").empty();
                }
            },
            error: function (error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    getData();

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

    $("#confirmEmail").on("input", function () {
        validateEmails();
    });

    $("#email").on("input", function () {
        validateEmails();
    });

    $("#password").on("input", function () {
        validatePasswords();
    });

    $("#confirmPassword").on("input", function () {
        validatePasswords();
    });

    function showSwalError(message) {
        Swal.fire({
            icon: "error",
            title: "An error has occurred...",
            timer: 4000,
            text: message,
        });
    }

    function handleSuccess(response) {
        getData();
        resetForm();
        const userName = response.user.username;

        Swal.fire({
            title: "Success!",
            text: `User '${userName}' saved successfully.`,
            icon: "success",
            timer: 4000,
        });
    }

    function handleError(error) {
        if (error.responseJSON && error.responseJSON.errors) {
            const validationErrors = error.responseJSON.errors;
            const errorEmail = validationErrors.email
                ? validationErrors.email[0]
                : "";
            const errorUsername = validationErrors.username
                ? validationErrors.username[0]
                : "";

            let errorMessage = "";
            if (errorUsername && errorEmail) {
                errorMessage =
                    "The user and email exist, please correct the fields";
            } else if (errorUsername) {
                errorMessage = "The user exists, please correct the field";
            } else {
                errorMessage = "The email exists, please correct the field";
            }

            showSwalError(errorMessage);
        } else {
            showSwalError("An error occurred. The server did not respond.");
        }
    }

    $("#userForm").submit(function (event) {
        event.preventDefault();
        validateEmails();
        validatePasswords();
        if (isValidateEmail && isValidatePassword) {
            Swal.fire({
                title: "Loading...",
                text: "Please wait",
                icon: "info",
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => Swal.showLoading(),
            });

            const route = baseUrl("users");
            const token = $("#token").val();
            const formData = new FormData(this);

            $.ajax({
                url: route,
                headers: { "X-CSRF-TOKEN": token },
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: handleSuccess,
                error: handleError,
            });
        }
    });

    $("#usersTable").on("click", "#delete-user", function () {
        var fila = $(this).closest("tr");
        var idUsuario = fila.find("td:eq(0)").text();

        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
        }).then((result) => {
            if (result.isConfirmed) {
                var route = baseUrl("users") + "/" + idUsuario;
                var token = $("#token").val();

                $.ajax({
                    url: route,
                    headers: { "X-CSRF-TOKEN": token },
                    type: "DELETE",
                    dataType: "json",
                    success: function (response) {
                        Swal.fire(
                            "Deleted!",
                            "The user has been deleted.",
                            "success"
                        );
                        getData();
                    },
                    error: function (error) {
                        showSwalError("Unable to delete the user.");
                    },
                });
            }
        });
    });
});
