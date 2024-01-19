<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
    die;
  }

  $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");
  $LK_sql = "SELECT * FROM lk ORDER BY tahun";
  $LK_query = mysqli_query($koneksi_db, $LK_sql);
  $LT_sql = "SELECT * FROM lt ORDER BY tahun";
  $LT_query = mysqli_query($koneksi_db, $LT_sql);
  $prospektus_sql = "SELECT * FROM prospektus";
  $prospektus_query = mysqli_query($koneksi_db, $prospektus_sql);
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
        padding-block: 50px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
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
      .container .content .judul {
        display: flex;
        justify-content: space-between;
      }
      .container .content .judul a {
        width: 150px;
        height: 35px;
        border-radius: 50px;
        background-color: #01440a;
        color: white;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .container .content .tabel {
        width: 97%;
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      .container .content table {
        width: 100%;
        border-collapse: collapse;
      }
      .container .content table thead tr {
        background-color: #01440a;
        color: white;
        border: 1px solid #01440a;
      }
      .container .content table tr td {
        text-align: center;
        padding: 5px;
      }
      .container .content table tbody td {
        border: 1px solid black;
        font-size: 14px;
      }
      .container .content table tbody td .col-desc,
      .container .content table tbody td .col-file {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      .container .content table tbody td a {
        color: black;
        text-decoration: none;
      }

      /* Responsif */
      @media (min-width: 300px) {
        .container {
          position: relative;
        }
      }
      @media (min-width: 768px) {
      }
      @media (min-width: 1000px) {
        .container .sidebar-wrapper {
          width: 20%;
          position: static;
          height: auto;
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
            <a href="./index.php">Dashboard</a>
            <div class="menu-wrap">
              <label for="menu-1">Hubungan Investor</label>
              <div class="sub-label sublab-1">
                <a href="./info-pemegang-saham.php">
                  Informasi Pemegang Saham
                </a>
                <a href="./info-keuangan.php" class="this-page">Informasi Keuangan </a>
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
      </div>
      <div class="content">
        <div class="deskripsi">
          <h1>Pengaturan Informasi Pemegang Saham</h1>
          <p>
            Anda dapat menambah, mengedit, menghapus data Informasi Pemegang
            Saham pada web MKTR dengan fitur dibawah
          </p>
        </div>
        <div class="tabel tabel-1">
          <div class="judul">
            <h2>Laporan Kuartalan</h2>
            <a href="./tambah-lk.php">+ Tambah</a>
          </div>
          <table>
            <thead>
              <tr>
                <td>Tahun</td>
                <td>File PDF</td>
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php while($data = mysqli_fetch_assoc($LK_query)) : ?>
                <tr>
                <td><?= $data["tahun"] ?></td>
                <td>
                  <a href="./files_pdf/<?= $data["file"]?>" class="col-file" target="blank"><?= $data["file"]?></a>
                </td>
                <td><a href="./edit-lk.php?id=<?= $data['id']?>">edit</a></td>
                <td><a href="./delete-lk.php?id=<?= $data['id']?>" onclick="return confirm('Yakin ingin menghapus?')">delete</a></td>
              </tr>
                <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <div class="tabel tabel-2">
          <div class="judul">
            <h2>Laporan Tahunan</h2>
            <a href="./tambah-lt.php">+ Tambah</a>
          </div>
          <table>
            <thead>
              <tr>
                <td>Tahun</td>
                <td>File PDF</td>
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php while($data_LT = mysqli_fetch_assoc($LT_query)) : ?>
                <tr>
                <td><?= $data_LT["tahun"] ?></td>
                <td>
                  <a href="./files_pdf/<?= $data_LT["file_pdf"]?>" class="col-file" target="blank"><?= $data_LT["file_pdf"]?></a>
                </td>
                <td><a href="./edit-lt.php?id=<?= $data_LT['id']?>">edit</a></td>
                <td><a href="./delete-lt.php?id=<?= $data_LT['id']?>" onclick="return confirm('Yakin ingin menghapus?')">delete</a></td>
              </tr>
                <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <div class="tabel tabel-3">
          <div class="judul">
            <h2>Prospektus</h2>
            <a href="./tambah-prospektus.php">+ Tambah</a>
          </div>
          <table>
            <thead>
              <tr>
                <td>Gambar</td>
                <td>File PDF</td>
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php while($data_prospektus = mysqli_fetch_assoc($prospektus_query)) : ?>
                <tr>
                <td>
                  <a href="./files_img/<?= $data_prospektus["gambar"]?>" class="col-file" target="blank"><?= $data_prospektus["gambar"]?></a>
                </td>
                <td>
                  <a href="./files_pdf/<?= $data_prospektus["file_pdf"]?>" class="col-file" target="blank"><?= $data_prospektus["file_pdf"]?></a>
                </td>
                <td><a href="./edit-prospektus.php?id=<?= $data_prospektus['id']?>">edit</a></td>
                <td><a href="./delete-prospektus.php?id=<?= $data_prospektus['id']?>" onclick="return confirm('Yakin ingin menghapus?')">delete</a></td>
              </tr>
                <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
