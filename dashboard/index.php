<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
    die;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - MKTR</title>
    <script
      src="https://kit.fontawesome.com/ba965b16bb.js"
      crossorigin="anonymous"
    ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&family=Nunito:wght@300;400&family=Roboto&display=swap"
      rel="stylesheet"
    />
    <link
      rel="shortcut icon"
      href="../img/cropped-logo_mktr.png"
      type="image/x-icon"
    />
    <style>
      * {
        padding: 0;
        margin: 0;
        font-family: "Roboto", sans-serif;
      }
      .container {
        width: 100%;
        display: flex;
      }
      /* Sidebar */

      .container .sidebar {
        width: 20%;
        min-height: 100vh;
        background-color: #01440a;
        padding-inline: 10px;
        padding-block: 15px;
        box-sizing: border-box;
      }
      .container .sidebar .logo {
        font-weight: 600;
        font-size: 15px;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }
      .container .sidebar .logo .logo-img {
        width: 20%;
      }
      .container .sidebar .logo .logo-img img {
        width: 100%;
      }
      .container .sidebar .menus {
        margin-top: 25px;
      }
      .container .sidebar .menus input {
        display: none;
      }
      .container .sidebar .menus .menu-wrap label {
        color: white;
        font-size: 18px;
        background-color: #01500b;
        width: 100%;
        height: 30px;
        display: flex;
        align-items: center;
        padding-inline: 9px;
        box-sizing: border-box;
        cursor: pointer;
      }
      .container
        .sidebar
        .menus
        #menu-1:checked
        ~ .menu-wrap
        .sub-label.sublab-1 {
        display: flex;
      }
      .container
        .sidebar
        .menus
        #menu-2:checked
        ~ .menu-wrap
        .sub-label.sublab-2 {
        display: flex;
      }
      .container .sidebar .menus .menu-wrap .sub-label {
        background-color: #013a08;
        display: none;
        flex-direction: column;
        gap: 5px;
        padding-inline: 23px;
        padding-block: 7px;
      }
      .container .sidebar .menus .menu-wrap .sub-label a {
        color: white;
        text-decoration: none;
      }
      .container .sidebar .menus > a {
        color: white;
        text-decoration: none;
        font-size: 18px;
        background-color: #01500b;
        width: 100%;
        height: 30px;
        display: flex;
        align-items: center;
        padding-inline: 9px;
        box-sizing: border-box;
      }

      /* Content */
      .container .content {
        width: 80%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-block: 20px;
        box-sizing: border-box;
      }
      .container .deskripsi {
        width: 97%;
        border: 1px solid #013a08;
        border-radius: 10px;
        color: #013a08;
        padding-inline: 15px;
        padding-block: 7px;
        box-sizing: border-box;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <div class="logo">
          <div class="logo-img">
            <img src="../img/cropped-logo_mktr.png" alt="logo" />
          </div>
          <span>PT. Menthobi Karyatama Raya Tbk</span>
        </div>
        <div class="menus">
          <input type="radio" name="menu" class="input-menu" id="menu-1" />
          <input type="radio" name="menu" class="input-menu" id="menu-2" />
          <a href="./index.php">Dashboard</a>
          <div class="menu-wrap">
            <label for="menu-1">Hubungan Investor</label>
            <div class="sub-label sublab-1">
              <a href="./info-pemegang-saham.php">Informasi Pemegang Saham </a>
              <a href="./info-keuangan.php">Informasi Keuangan </a>
            </div>
          </div>
          <div class="menu-wrap">
            <label for="menu-2">Berita</label>
            <div class="sub-label sublab-2">
              <a href="./berita.php">Berita</a>
            </div>
          </div>
          <a href="" class="karir">Karir</a>
          <a href="./logout.php" class="karir">Logout</a>
        </div>
      </div>
      <div class="content">
        <div class="deskripsi">
          <h1>Selamat datang di halaman dashboard admin!</h1>
          <p>
            Anda dapat menambah, mengatur, menghapus data web MKTR dengan
            memilih menu di sidebar
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
