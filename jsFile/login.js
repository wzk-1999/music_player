function showPassWord() {
  var x = document.getElementById("exampleInputPassword1");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("eye").classList.add("d-none");
    document.getElementById("eye-slash").classList.remove("d-none");
  } else {
    x.type = "password";
    document.getElementById("eye-slash").classList.add("d-none");
    document.getElementById("eye").classList.remove("d-none");
  }
}

// function sendSubmit() {
//   console.log("go");
//   $.post(
//     "login.php",
//     {
//       submit: "Y",
//     },
//     function () {
//       alert("success");
//     }
//   );
// }
