<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="apple-touch-icon" sizes="180x180"
    href="/php_projects/music_player/images/redketchup/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32"
    href="/php_projects/music_player/images/redketchup/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16"
    href="/php_projects/music_player/images/redketchup/apple-touch-icon.png" />
  <link rel="manifest" href="/php_projects/music_player/images/redketchup/site.webmanifest" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>
    <?php echo basename($_SERVER['PHP_SELF'], ".php"); ?> · Music
  </title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-music text-info"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/php_projects/music_player/admin/admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/php_projects/music_player/upload.php">Upload</a>
        </li>
        <?php if (isset($_SESSION["uid"])) {
          echo '<li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          >' . $_SESSION["uid"] . '</a
        >
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          ';
          include 'playlists.php';

          //            echo mysqli_num_rows($result);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              //                        echo $row['playlist'];
              echo "
          <li>
            <a class='dropdown-item'
            href='/php_projects/music_player/view_music.php?playlist=$row[0]'>$row[0]</a></li>";
            }
            echo '<li><hr class="dropdown-divider"></li>';
          }
          echo '<li>
            <a
              class="dropdown-item"
              href="/php_projects/music_player/logout.php"
              >log out</a
            >
          </li>
      </ul>
  </li>';
        } else {
          echo '
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Guest
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a
                class="dropdown-item"
                href="/php_projects/music_player/login.php#"
                >log in</a
              >
            </li>
          </ul>
        </li>
        ';
        } ?>

        <li class="nav-item ms-2">
          <a class="nav-link" href="/php_projects/music_player/view_music.php" tabindex="-1">View</a>
        </li>
      </ul>
      <form class="d-flex" action="/php_projects/music_player/view_music.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="song_name" />
        <button class="btn btn-outline-success w-50" type="submit">Search&nbsp;by&nbsp;song&nbsp;name</button>
      </form>
    </div>
  </div>
</nav>