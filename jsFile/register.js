// document
//   .getElementById("register_submit")
//   .addEventListener("click", register_valid);

function register_valid() {
  // console.log("go");
  // alert("GO");
  let x = document.getElementById("exampleInputPassword1").value;
  let y = document.getElementById("exampleInputPassword2").value;

  // console.log(x);

  if (!/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(x)) {
    // console.log("not regex");
    document.getElementById("alertPassword").innerText =
      "password must contain uppercase,lowercase,number, and length between 6~16";
    return false;
  } else if (x != y) {
    document.getElementById("alert").innerText =
      "The passwords entered twice are inconsistent";
    return false;
  } else {
    document.getElementById("alertPassword").innerText = "";
    document.getElementById("alert").innerText = "";

    // const xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("POST", "../register.php?validate=success");
    // xmlhttp.send();

    // console.log("success");
    // alert("success");

    // let success = "success1";

    // $.post(
    //   "register.php",
    //   {
    //     validate: "success",
    //   },
    //   function (data, status) {
    //     alert(
    //       data.substr(data.indexOf('onsubmit="return')) + "\nStatus: " + status
    //     );
    //     // console.log(data);
    //   }
    // );

    $.ajax({
      url: "register_process.php",
      method: "POST",
      data: $("#signup_form").serialize(),
      success: function (data) {
        // alert(data);
        // alert(data.substr(data.indexOf('onsubmit="return')) + "\nStatus: ");
        // $("html").html(
        //   <div class="alert alert-success w-75 mx-5 my-3" role="alert">
        //     register success ! redirecting ...
        //   </div>
        // );

        // if (data == "passed") {
        //   console.log("received");
        //   alert("received");
        // } else {
        //   console.log("not received");
        //   alert("not received");
        // }

        $("#alert_head").html(data);
      },
    });
    // preventDefault();
    return false;
  }
}
