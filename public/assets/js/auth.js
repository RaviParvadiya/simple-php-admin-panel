$(function () {
  // Debounce helper function to prevent spamming requests
  function debounce(func, delay) {
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }

  let isValidating = false;

  // ========================================
  // VALIDATION FUNCTIONS
  // ========================================

  // Debounced username validation
  const checkUsername = debounce(function () {
    const username = $("#registerForm #exampleInputtext1").val().trim(); // avoid $(this) - inside debounce loose context

    // Skip validation if field is empty
    if (username.length === 0) return;

    isValidating = true; // Set flag when validation starts

    $.ajax({
      url: "/simple/auth/check_user.php",
      method: "GET",
      data: { username },
      dataType: "json",
      success: function (response) {
        if (response.status === "exists") {
          $("#usernameError").text(response.message);
          $("#exampleInputtext1").addClass("is-invalid");
        } else {
          $("#usernameError").text("");
          $("#exampleInputtext1").removeClass("is-invalid");
        }
        isValidating = false; // Clear flag when done
      },
      error: function () {
        isValidating = false; // Clear flag on error too
      },
      complete: function () {
        isValidating = false; // Clear flag on error too
      },
    });
  }, 500);

  // Debounced email validation
  const checkEmail = debounce(function () {
    const email = $("#registerForm #exampleInputEmail1").val().trim();

    if (email.length === 0) return;

    isValidating = true;

    $.ajax({
      url: "/simple/auth/check_user.php",
      method: "GET",
      data: { email },
      dataType: "json",
      success: function (response) {
        if (response.status === "exists") {
          $("#emailError").text(response.message);
          $("#exampleInputEmail1").addClass("is-invalid");
        } else {
          $("#emailError").text("");
          $("#exampleInputEmail1").removeClass("is-invalid");
        }
        isValidating = false;
      },
      error: function () {
        isValidating = false; // Clear flag on error too
      },
      complete: function () {
        isValidating = false; // Clear flag on error too
      },
    });
  }, 500);

  // Immediate feedback to clear error UI as user types
  $("#registerForm #exampleInputtext1").on("input", function () {
    $("#usernameError").text("");
    $(this).removeClass("is-invalid");
    checkUsername(); // call the debounced version
  });

  // Also validate on blur for extra safety
  $("#registerForm #exampleInputtext1").on("blur", checkUsername);

  $("#registerForm #exampleInputEmail1")
    .on("input", function () {
      $("#emailError").text("");
      $(this).removeClass("is-invalid");
      checkEmail();
    })
    .on("blur", checkEmail);

  // ========================================
  // REGISTRATION HANDLER
  // ========================================

  $("#signupBtn").on("click", function (e) {
    e.preventDefault();

    // Prevent submission if validation is in progress
    if (isValidating) {
      console.log("Please wait for validation to complete");
      return false;
    }

    // Check if there are any existing validation errors
    if (
      $("#exampleInputtext1").hasClass("is-invalid") ||
      $("#exampleInputEmail1").hasClass("is-invalid")
    ) {
      console.log("Please fix validation errors before submitting");
      return false;
    }

    // clear any previous errors and styles
    $("#usernameError, #emailError, #passwordError").text("");
    $(
      "#exampleInputtext1, #exampleInputEmail1, #exampleInputPassword1"
    ).removeClass("is-invalid");

    const formData = $("#registerForm").serialize();

    $.ajax({
      method: "POST",
      url: "/simple/auth/register_handler.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log(response.message);
          setTimeout(() => {
            window.location.href = "authentication-login.php";
          }, 500);
        } else {
          if (response.message.username) {
            $("#usernameError").text(response.message.username);
            $("#exampleInputtext1").addClass("is-invalid");
          }
          if (response.message.email) {
            $("#emailError").text(response.message.email);
            $("#exampleInputEmail1").addClass("is-invalid");
          }
          if (response.message.password) {
            $("#passwordError").text(response.message.password);
            $("#exampleInputPassword1").addClass("is-invalid");
          }
        }
      },
      error: function () {
        console.log("Error sending request");
      },
    });
  });

  // ========================================
  // LOGIN HANDLER
  // ========================================

  $("#loginBtn").on("click", function (e) {
    e.preventDefault();

    const formData = $("#loginForm").serialize();
    $.ajax({
      method: "POST",
      url: "/simple/auth/login_handler.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log("Success: ", response.message);
          setTimeout(() => {
            window.location.href = "index.php";
          }, 500);
        } else {
          console.log("Error: ", response.message);
        }
      },
      error: function () {
        console.log("Error sending request");
      },
    });
  });
});
