$(function () {
  $("#signupBtn").on("click", function (e) {
    e.preventDefault();

    const formData = $("#registerForm").serialize();
    $.ajax({
      method: "POST",
      url: "/auth/register_handler.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log(response.message);
          setTimeout(() => {
            window.location.href = "index.php";
          }, 2000);
        } else {
          console.log("error: ", response.message);
        }
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });
});
