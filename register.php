<?php
// session_start();
include 'common/header.php';
include 'common/footer.html';


// echo $_SESSION["validate"];

?>
<html>


<body class="position-relative">
  <div id="alert_head"></div>
  <div class="d-flex justify-content-center mt-5 pt-5">
    <!-- <form action="register.php" name="form" method="post" class="w-50" onsubmit="return register_valid()" -->
    <form name="form" class="w-50" onsubmit="return register_valid()" id="signup_form">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">User name(email)</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
          required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <small id="alertPassword" class="text-danger fst-italic ps-2"></small>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
        <small id="alert" class="text-danger fst-italic ps-2"></small>
        <input type="password" class="form-control" id="exampleInputPassword2" required>
      </div>
      <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">remember password</label>
      </div> -->
      <button type="submit" class="btn btn-primary w-25 d-grid mx-auto">Register</button>
    </form>
  </div>
</body>

<script src="jsFile/register.js"></script>

</html>