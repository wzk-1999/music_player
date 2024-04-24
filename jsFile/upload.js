function upload_music() {
  //   var formData = new FormData(this);
  var formData = new FormData($("#upload_form")[0]);
  // alert(formData.get("playlist"));
  // alert(formData.playlist);
  // mimeType: "multipart/form-data",
  //   $.post("upload_process.php", formData, function (data) {
  //     alert("success");
  //     if (data == "upload_success") {
  //       $("#alert_head").html(
  //         '<div class="alert alert-primary w-75 mx-5 my-3" role="alert">upload successful, redirecting ...</div>'
  //       );

  //       setTimeout(function () {
  //         window.location.href = "view_music.php";
  //       }, 1500);
  //     } else {
  //       $("#alert_head").html(data);
  //     }
  //     // console.log(data);
  //   });

  $.ajax({
    url: "upload_process.php",
    method: "POST",
    data: formData,
    success: function (data) {
      //   alert("success");
      if (data == "upload_success") {
        $("#alert_head").html(
          '<div class="alert alert-primary w-75 mx-5 my-3" role="alert">upload successful, redirecting ...</div>'
        );

        setTimeout(function () {
          window.location.href = `view_music.php?playlist=${formData.get(
            "playlist"
          )}`;
        }, 1500);
      } else {
        $("#alert_head").html(data);
      }
      // console.log(data);
    },
    error: function () {
      alert("upload failed, please contact developer.");
    },
    cache: false,
    contentType: false,
    processData: false,
  });

  return false;
}

function add_new_playlist() {
  $("#alert_head").html(
    '<div class="alert alert-info alert-dismissible fade show w-75 mx-5" id="add_new_playlist" role="alert">Needs<strong> add new playlist ?</strong> click <a href="#" class="alert-link" data-bs-target="#exampleModal" data-bs-toggle="modal">here</a>!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
  );
}

function remove_alert() {
  $("#add_new_playlist").addClass("d-none");
}

$("#add_playlist").on("submit", function () {
  // event.preventDefault();
  // $("#exampleModal").addClass("d-none");
  $("#cancel").click();

  $.ajax({
    url: "add_playlist.php",
    method: "POST",
    data: $("#add_playlist").serialize(),
    success: function (data) {
      // var temp = data;
      // if (data.indexOf("alert-success") > -1) {
      //   window.location.reload();
      // }
      $("#alert_head").html(data);

      // setTimeout(window.location.reload(), 2000);
      // setTimeout((window.location.href = "upload.php"), 2000);
    },
  });

  // $("#close").click;
});
