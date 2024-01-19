<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
    die;
  }

  $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");
  
  $id = $_GET["id"];
  $sqlGet = "SELECT * FROM berita WHERE id = $id";
  $query = mysqli_query($koneksi_db, $sqlGet);
  $datas = mysqli_fetch_assoc($query);
  if(isset($_POST["submit"])){
    function update(){
      global $koneksi_db;
      global $id;
      global $datas;
      $tanggal = htmlspecialchars($_POST["tanggal"]);
      $bulan = htmlspecialchars($_POST["bulan"]);
      $tahun = htmlspecialchars($_POST["tahun"]);
      $judul = htmlspecialchars($_POST["judul"]);
      $deskripsi = htmlspecialchars($_POST["deskripsi"]);
      $tmpGambar = $_FILES["file-gambar"]["tmp_name"];
      $gambar = $_FILES["file-gambar"]["name"];
      $gambarLama = $datas["gambar"];
      
       // validasi input
       if( $_FILES["file-gambar"]["error"] === 4 ){
        $gambar = $gambarLama;
      } else{
        $ekstensiGambarValid = ["jpg", "jpeg", "png"];
        $ekstensiGambarFile = explode(".", $gambar);
        $ekstensiGambarFile = strtolower(end($ekstensiGambarFile));
        if(!in_array($ekstensiGambarFile, $ekstensiGambarValid)){
            echo "<script>
            alert('Format file pada bagian Upload Gambar harus diantara .jpg, .jpeg, .png!');
            </script>";
            return false;
        }
      }
      $sql = "UPDATE berita SET gambar = '$gambar', judul = '$judul', deskripsi = '$deskripsi', tanggal = '$tanggal', bulan = '$bulan', tahun = '$tahun' WHERE id = $id";
      $query = mysqli_query($koneksi_db, $sql);
      if($query){
        move_uploaded_file($tmpGambar, "./files_img/" . $gambar);
        echo "<script>
        alert('Data Berhasil Diupdate!');
        window.location.href = './berita.php';
        </script>";
      }
    }
    if(!update()){
    }
      echo "<script>
      alert('Gagal mengedit RUPS!');
      window.location.href = './edit-berita.php?id=$id';
      </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Data- MKTR</title>
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
      .container .content form input:focus,.container .content form textarea:focus {
        outline: none;
      }
      .container .content form input#file {
        width: 300px;
        height: fit-content;
        padding-block: 10px;
      }
      .container .content form #deskripsi {
        padding-inline: 10px;
        padding-block: 10px;
        box-sizing: border-box;
        height: 150px;
        color: #013a08;
        border: 1px solid #013a08;
        border-radius: 7px;
        resize: none;
      }
      .container .content form .file-upload{
        display: flex;
        align-items: center;
        gap: 10px 
      }
      .container .content form .file-upload label {
        width: 100px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        color: #013a08;
        border: 1px solid #013a08;
        border-radius: 7px;
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
          />
          <input type="radio" name="menu" class="input-menu" id="menu-2" checked/>
          <a href="./index.php">Dashboard</a>
          <div class="menu-wrap">
            <label for="menu-1">Hubungan Investor</label>
            <div class="sub-label sublab-1">
              <a href="./info-pemegang-saham.php"
                >Informasi Pemegang Saham
              </a>
              <a href="./info-keuanga.php">Informasi Keuangan </a>
            </div>
          </div>
          <div class="menu-wrap">
            <label for="menu-2">Berita</label>
            <div class="sub-label sublab-2">
              <a href="./berita.php" class="this-page">Berita</a>
            </div>
          </div>
          <a href="" class="karir">Karir</a>
          <a href="./logout.php" class="karir">Logout</a>
        </div>
      </div>
    </div>
      <div class="content">
        <h1>Edit Data RUPS</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="input-wrap">
            <label for="tanggal">Tanggal</label>
            <div class="tanggal-wrap">
              <input type="number" name="tanggal" id="tanggal" min="1" max="31" value="<?= $datas['tanggal']?>">
              <select name="bulan" id="bulan" value="<?= $datas['bulan']?>">
                <option class="opsi" value="Januari">Januari</option>
                <option class="opsi" value="Februari">Februari</option>
                <option class="opsi" value="Maret">Maret</option>
                <option class="opsi" value="April">April</option>
                <option class="opsi" value="Mei">Mei</option>
                <option class="opsi" value="Juni">Juni</option>
                <option class="opsi" value="Juli">Juli</option>
                <option class="opsi" value="Agustus">Agustus</option>
                <option class="opsi" value="September">September</option>
                <option class="opsi" value="Oktober">Oktober</option>
                <option class="opsi" value="November">November</option>
                <option class="opsi" value="Desember">Desember</option>
              </select>
              <input type="number" name="tahun" id="tahun" min="2000" max="2099" value="<?= $datas['tahun']?>">
            </div>
          </div>
          <div class="input-wrap">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" autocomplete="off" value="<?= $datas['judul']?>"/>
          </div>
          <div class="input-wrap">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi"><?= $datas['deskripsi']?></textarea>
          </div>
          <div class="input-wrap">
            <label for="file-gambar">Upload File PDF</label>
            <span>Format file (.jpg, .jpeg, .png)</span>
            <div class="file-upload">
                <input type="file" name="file-gambar" id="file-gambar" value="<?= $datas["gambar"]?>" hidden/>
                <label for="file-gambar">Pilih File</label>
                <span class="nama-gambar"><?= $datas["gambar"]?></span>
            </div>
          </div>
          <button name="submit">Submit</button>
        </form>
      </div>
    </div>
    <script>
      const options = document.querySelectorAll(".opsi");
      const file = document.querySelector("#file-gambar");
      const namaGambar = document.querySelector(".nama-gambar");
      file.addEventListener("change", (e)=>{
        if(e.target.files.length == 1){
            let gambarFile = e.target.files[0];
            namaGambar.textContent = gambarFile.name;
        } else{
            namaGambar.textContent = "<?= $datas["gambar"]?>";
        }
    });
    </script>
  </body>
</html>
