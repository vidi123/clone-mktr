<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
  }
  
  $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");
  $id = $_GET["id"];
  $sqlGet = "SELECT * FROM dividen WHERE id = $id";
  $query = mysqli_query($koneksi_db, $sqlGet);
  $datas = mysqli_fetch_assoc($query);
  // var_dump($datas);
  if(isset($_POST["submit"])){
    // var_dump($_POST);
    $jenis = htmlspecialchars($_POST["jenis-dividen"]);
    $distribusi = htmlspecialchars($_POST["distribusi"]);
    $nilai = htmlspecialchars($_POST["nilai-saham"]);
    if(strlen($jenis) == 0 || strlen($distribusi) == 0 || strlen($nilai) == 0){
        echo "<script>
        alert('Tidak boleh ada data yang kosong!');
        window.location.href = 'tambah-dividen.php';
        </script>";
        die;        
    }
    $sql = "UPDATE dividen SET jenis = '$jenis', distribusi = '$distribusi', nilai = '$nilai' WHERE id = $id;";
    $query = mysqli_query($koneksi_db, $sql);
    if($query){
        echo "<script>
        alert('Data Berhasil Diedit!');
        window.location.href = 'info-pemegang-saham.php';
        </script>";
    }
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
        position: relative;
      }
      .container .sidebar-wrapper {
        position: absolute;
        height: -webkit-fill-available;
        display: flex;
        flex-direction: row-reverse;
      }
      .container .sidebar-wrapper details {
        text-align: center;
        padding: 8px;
        height: fit-content;
        background: #013a08;
      }
      .container .sidebar-wrapper details[open] {
        padding: 5px;
      }
      .container .sidebar-wrapper details[open] ~ .sidebar {
        display: block;
      }
      .container .sidebar-wrapper details[open] summary {
        padding-inline: 5px;
        padding-block: 10px;
      }
      .container .sidebar-wrapper details summary {
        list-style: none;
      }
      .container .sidebar-wrapper details summary div {
        width: 23px;
        height: 4px;
        background-color: goldenrod;
        border-radius: 50px;
        margin-block: 3px;
      }
      .container .sidebar-wrapper details[open] summary div:nth-child(1) {
        transform: rotate(45deg);
      }
      .container .sidebar-wrapper details[open] summary div:nth-child(2) {
        display: none;
      }
      .container .sidebar-wrapper details[open] summary div:nth-child(3) {
        transform: rotate(135deg);
        margin-top: -7px;
      }
      /* Sidebar */

      .container .sidebar {
        width: 100%;
        min-height: 100vh;
        background-color: #01440a;
        padding-inline: 10px;
        padding-block: 15px;
        box-sizing: border-box;
        display: none;
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
      .container .sidebar .menus .menu-wrap .sub-label a.this-page {
        color: goldenrod;
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
        width: 100%;
        margin: auto;
        min-height: 100vh;
        padding-top: 50px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }
      .container .content form {
        width: 95%;
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      .container .content form .input-wrap {
        display: flex;
        flex-direction: column;
        gap: 5px;
      }
      .container .content form .input-wrap .tanggal-wrap{
        display: flex;
        gap: 12px;
      }
      .container .content form label {
        font-size: 21px;
      }
      .container .content form input {
        height: 30px;
        padding-inline: 10px;
        color: #013a08;
        border: 1px solid #013a08;
        border-radius: 7px;
      }
      .container .content form input:focus {
        outline: none;
      }
      .container .content form input#file {
        width: 300px;
        height: fit-content;
        padding-block: 10px;
      }
      .container .content form input#deskripsi {
        height: 50px;
      }
      .container .content form select {
        height: 30px;
        padding-inline: 10px;
        color: #013a08;
        border: 1px solid #013a08;
        border-radius: 7px;
      }
      .container .content form button {
        width: 150px;
        height: 35px;
        border-radius: 7px;
        background-color: #01440a;
        color: white;
        font-size: 16px;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      @media (min-width: 1000px) {
        .container .sidebar-wrapper {
          width: 20%;
          position: static;
        }
        .container .sidebar {
          display: block;
        }
        .container .sidebar-wrapper details {
          display: none;
        }
        .container .content {
          width: 80%;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="sidebar-wrapper">
       <details>
          <summary>
            <div></div>
            <div></div>
            <div></div>
          </summary>
        </details>
      <div class="sidebar">
        <div class="logo">
          <div class="logo-img">
            <img src="../img/cropped-logo_mktr.png" alt="logo" />
          </div>
          <span>PT. Menthobi Karyatama Raya Tbk</span>
        </div>
        <div class="menus">
          <input
            type="radio"
            name="menu"
            class="input-menu"
            id="menu-1"
            checked
          />
          <input type="radio" name="menu" class="input-menu" id="menu-2" />
          <a href="./index.html">Dashboard</a>
          <div class="menu-wrap">
            <label for="menu-1">Hubungan Investor</label>
            <div class="sub-label sublab-1">
              <a href="./info-pemegang-saham.php" class="this-page"
                >Informasi Pemegang Saham
              </a>
              <a href="">Informasi Keuangan </a>
            </div>
          </div>
          <div class="menu-wrap">
            <label for="menu-2">Berita & Galeri</label>
            <div class="sub-label sublab-2">
              <a href="">Berita</a>
              <a href="">Galeri</a>
            </div>
          </div>
          <a href="" class="karir">Karir</a>
          <a href="./logout.php" class="karir">Logout</a>
        </div>
      </div>
    </div>
      <div class="content">
        <h1>Edit Data Dividen</h1>
        <form action="" method="post">
          <div class="input-wrap">
            <label for="jenis-dividen">Jenis Dividen</label>
            <input type="text" name="jenis-dividen" id="jenis-dividen" autocomplete="off" value="<?= $datas['jenis']?>"/>
          </div>
          <div class="input-wrap">
            <label for="distribusi">Distribusi</label>
            <input type="text" name="distribusi" id="distribusi" autocomplete="off" value="<?= $datas['distribusi']?>"/>
          </div>
          <div class="input-wrap">
            <label for="nilai-saham">Nilai Saham</label>
            <input type="text" name="nilai-saham" id="nilai-saham" autocomplete="off" value="<?= $datas['nilai']?>"/>
          </div>
          <button name="submit">Submit</button>
        </form>
      </div>
    </div>
  </body>
</html>
