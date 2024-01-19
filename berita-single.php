<?php
 $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");
 $id = $_GET["id"];
 $sql = "SELECT * FROM berita WHERE id = $id";
 $query = mysqli_query($koneksi_db, $sql);
 $data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Berita - Menthobi Karyatama Raya Tbk</title>
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
      href="./img/cropped-logo_mktr.png"
      type="image/x-icon"
    />
    <style>
      * {
        padding: 0px;
        margin: 0px;
        font-family: "Roboto", sans-serif;
      }
      header {
        width: 100%;
        height: 50px;
        background-color: #01440a;
        display: none;
        justify-content: flex-end;
      }
      header .header {
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px;
      }
      .header form {
        display: flex;
      }
      .header form button {
        background: transparent;
        border: none;
        font-size: 16px;
        color: white;
        cursor: pointer;
      }
      header form input {
        width: 150px;
        padding: 5px 20px;
        box-sizing: border-box;
        background: transparent;
        border: none;
        color: #49bb49;
        font-size: 100%;
        font-weight: 600;
      }
      header form input::placeholder {
        color: rgba(255, 255, 255, 0.219);
      }
      header form input:focus {
        outline: none;
      }
      header .language {
        width: 50%;
        height: 20px;
        display: flex;
        gap: 10px;
      }
      .language a img {
        width: 100%;
        height: 100%;
      }

      nav {
        position: sticky;
        top: 0px;
        z-index: 99;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      nav .logo {
        width: 255px;
        box-sizing: border-box;
        font-size: 12px;
        font-weight: 600;
        color: #01440a;
        display: flex;
        align-items: center;
        gap: 20px;
      }
      nav .logo img {
        width: 47px;
      }
      nav .logo details {
        text-align: center;
      }
      nav .logo details summary {
        list-style: none;
      }
      nav .logo details summary div {
        width: 23px;
        height: 4px;
        background-color: goldenrod;
        border-radius: 50px;
        margin-block: 3px;
      }
      nav .logo details[open] summary div:nth-child(1) {
        transform: rotate(45deg);
      }
      nav .logo details[open] summary div:nth-child(2) {
        display: none;
      }
      nav .logo details[open] summary div:nth-child(3) {
        transform: rotate(135deg);
        margin-top: -7px;
      }
      nav .logo details .hamburger-menu {
        position: absolute;
        left: 0px;
        right: 0px;
        margin-top: 20px;
        padding-block: 15px;
        background-color: white;
        font-size: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }
      nav .logo details .hamburger-menu a {
        text-decoration: none;
        color: black;
      }
      nav .logo details .hamburger-menu a:hover {
        color: goldenrod;
      }
      nav .logo details .hamburger-menu details[open] > summary {
        color: goldenrod;
      }
      nav .logo .hamburger-menu ul li {
        list-style: none;
      }
      .hamburger-menu details ul > details {
        margin-bottom: 10px;
      }
      .hamburger-menu details ul {
        display: flex;
        margin-top: 10px;
        flex-direction: column;
        gap: 15px;
      }
      nav .logo .language > div {
        display: flex;
      }
      nav .logo .language > div > a > img {
        width: 25px;
        height: fit-content;
        border-radius: 3px;
        border: 1px solid #01440a;
      }
      /* navbar desktop */
      nav .nav-desktop {
        height: 68px;
        font-size: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-left: 40px;
      }
      .nav-desktop a {
        text-decoration: none;
        color: black;
      }
      .nav-desktop a:hover {
        color: goldenrod;
      }
      .nav-desktop ul li {
        list-style: none;
        font-size: 14px;
        font-weight: 600;
        padding-block: 10px;
      }
      .nav-desktop ul li:hover {
        display: flex;
      }
      .nav-desktop .drop-wrap {
        position: relative;
      }
      .nav-desktop .drop-wrap:hover > span {
        color: #ffc050;
        display: block;
        width: 100%;
      }
      .nav-desktop .drop-wrap:hover > ul {
        display: flex;
      }
      .nav-desktop .drop-wrap ul {
        z-index: 999;
        position: absolute;
        width: 220px;
        background-color: white;
        display: none;
        flex-direction: column;
        padding-left: 25px;
        padding-top: 17px;
      }
      .nav-desktop .drop-wrap ul:hover {
        display: flex;
      }
      .nav-desktop .drop-wrap ul li:hover span {
        color: #ffc050;
      }
      .nav-desktop .drop-wrap ul li ul {
        width: 250px;
      }
      .nav-desktop .drop-wrap ul li:hover ul {
        display: flex;
        padding-top: 0;
        margin-top: -10px;
        left: 245px;
      }
      nav .saham {
        width: 100px;
        margin-left: 50px;
      }
      nav > .language {
        margin-left: 15px;
        display: none;
      }
      nav > .language > div {
        display: flex;
      }
      nav > .language > div > a > img {
        width: 25px;
        height: fit-content;
        border-radius: 3px;
        border: 1px solid #01440a;
      }

      .container {
        width: 100%;
        padding-bottom: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 25px;
      }
      .container h1 {
        width: 90%;
        text-align: center;
      }
      .container > div {
        width: 90%;
      }
      .container .foto-berita img {
        width: 100%;
        border-radius: 10px;
      }
      .container .isi-berita {
        text-align: justify;
      }

      /* footer */
      footer {
        background-color: #01440a;
        color: white;
      }
      footer .wrapper {
        width: 70%;
        margin: auto;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
      }
      footer .wrapper img {
        width: 60px;
        height: 60px;
        display: flex;
        margin-right: 100px;
        margin-block: 25px;
      }
      footer .wrapper ul {
        display: flex;
      }
      footer .wrapper ul li {
        width: 25%;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      footer .wrapper ul li h3 {
        font-size: 15px;
        margin-bottom: 15px;
      }
      footer .wrapper ul li a {
        color: white;
        text-decoration: none;
      }
      footer .wrapper ul li .sosmed {
        margin: auto;
        display: flex;
        gap: 10px;
      }
      footer .wrapper ul li .sosmed a {
        width: 35px;
        height: 35px;
        background-color: white;
        border-radius: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      footer .copyright {
        background-color: #073a0b;
        height: 70px;
        padding-inline: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* Responsif */
      /* mobile */
      @media (max-width: 767px) {
        header .header {
          width: 75%;
        }
        nav .logo {
          width: 80%;
          justify-content: space-between;
        }
        nav .saham {
          width: 80%;
          margin-left: 0px;
        }
      }
      @media (min-width: 300px) {
      }
      /* tablet */
      @media (max-width: 1000px) {
        nav {
          flex-direction: column;
        }
        nav .nav-desktop {
          display: none;
        }

        footer .wrapper {
          width: 60%;
          align-items: center;
        }
        footer .wrapper img {
          margin-right: 0px;
          margin-block: 30px;
        }
        footer .wrapper ul {
          flex-direction: column;
          gap: 25px;
        }
        footer .wrapper ul li {
          width: 100%;
        }
      }
      @media (min-width: 768px) {
        .container .foto-berita {
          width: 70%;
        }
        .container h1,
        .container .isi-berita {
          width: 80%;
        }
      }
      /* desktop */
      @media (min-width: 1000px) {
        nav .logo details {
          display: none;
        }
        
        nav .logo {
          width: 275px;
        }
        nav .logo details {
          display: none;
        }
        nav .logo .language > div {
          display: none;
        }
        nav > .language {
          display: flex;
        }
      }
    </style>
  </head>
  <body>
    <header>
      <div class="header">
        <form action="" method="get">
          <input type="text" class="searchbar" placeholder="Search..." />
          <button><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <div class="language">
          <a href="" class="lang-IDN"
            ><img
              src="https://mktr.co.id/wp-content/plugins/gtranslate/flags/svg/id.svg"
              alt="idn"
          /></a>
          <a href="" class="lang-ENG"
            ><img
              src="https://mktr.co.id/wp-content/plugins/gtranslate/flags/svg/en.svg"
              alt="eng"
          /></a>
        </div>
      </div>
    </header>
    <nav>
      <div class="logo">
        <img src="./img/cropped-logo_mktr.png" alt="logo" />
        <span>PT Menthobi Karyatama Raya Tbk</span>
        <details>
          <summary>
            <div></div>
            <div></div>
            <div></div>
          </summary>
          <div class="hamburger-menu">
            <a href="./index.html">BERANDA</a>
            <details>
              <summary>TENTANG KAMI &#9660;</summary>
              <ul>
                <a href="./SEKILASPERUSAHAAN.html">
                  <li>Sekilas Perusahaan</li>
                </a>
                <a href="./VMBudayaKerja.html">
                  <li>Visi Misi & Budaya Kerja</li>
                </a>
                <details>
                  <summary>Manajemen Organisasi &#9660;</summary>
                  <ul>
                    <a href="./manajemen.html#manajemen">
                      <li>Manajemen</li>
                    </a>
                    <a href="./manajemen.html#KA">
                      <li>Komite Audit</li>
                    </a>
                    <a href="./manajemen.html#KNR">
                      <li>Komite Nominasi dan Renumarasi</li>
                    </a>
                    <a href="./manajemen.html#SP">
                      <li>Sekretaris Perusahaan</li>
                    </a>
                  </ul>
                </details>
                <details>
                  <summary>Tata Kelola Perusahaan &#9660;</summary>
                  <ul>
                    <a href="./tata-kelola.html#audit-internal">
                      <li>Audit Internal</li>
                    </a>
                    <a href="./tata-kelola.html#manajemen-resiko">
                      <li>Manajemen Resiko</li>
                    </a>
                    <a href="./tata-kelola.html#pedoman-etika-bisnis">
                      <li>Pedoman Etika Bisnis & Etika Kerja</li>
                    </a>
                  </ul>
                </details>
              </ul>
            </details>
            <details>
              <summary>BERKELANJUTAN &#9660;</summary>
              <ul>
                <a href="./konservasi-hutan.html#konservasi"
                  ><li>Konservasi Hutan</li></a
                >
                <a href="./konservasi-hutan.html#SNS"
                  ><li>Standar dan Sertifikasi</li></a
                >
                <a href="./konservasi-hutan.html#CSR"><li>CSR</li></a>
                <a href="./konservasi-hutan.html#RP"><li>Rantai Pasok</li></a>
                <a href="./konservasi-hutan.html#PM"><li>Plasma</li></a>
              </ul>
            </details>
            <details>
              <summary>HUBUNGAN INVESTOR &#9660;</summary>
              <ul>
                <details>
                  <summary>Informasi Pemegang Saham &#9660;</summary>
                  <ul>
                    <a href="./informasi-pemegang-saham.php#struktur">
                      <li>Struktur Kepemilikan</li>
                    </a>
                    <a href="./informasi-pemegang-saham.php#dividen">
                      <li>Dividen</li>
                    </a>
                    <a href="./informasi-pemegang-saham.php#rups">
                      <li>RUPS</li>
                    </a>
                  </ul>
                </details>
                <details>
                  <summary>Informasi Keuangan &#9660;</summary>
                  <ul>
                    <a href="./informasi-keuangan.php#harga">
                      <li>Harga Saham</li>
                    </a>
                    <a href="./informasi-keuangan.php#LK">
                      <li>Laporan Kuartalan</li>
                    </a>
                    <a href="./informasi-keuangan.php#LT">
                      <li>Laporan Tahunan</li>
                    </a>
                    <a href="./informasi-keuangan.php#PROSPEKTUS">
                      <li>Prospektus</li>
                    </a>
                  </ul>
                </details>
              </ul>
            </details>
            <details>
              <summary class="AB">AKTIFITAS BISNIS &#9660;</summary>
              <ul>
                <a href="./aktifitas-bisnis.html#MML"
                  ><li>PT Menthobi Makmur Lestari</li></a
                >
                <a href="./aktifitas-bisnis.html#MHL"
                  ><li>PT Menthobi Hijau Lestari</li></a
                >
                <a href="./aktifitas-bisnis.html#MTR"
                  ><li>PT Menthobi Transitian Raya</li></a
                >
                <a href="./aktifitas-bisnis.html#MAR"
                  ><li>PT Menthobi Agro Raya</li></a
                >
              </ul>
            </details>
            <details>
              <summary>BERITA & GALLERY &#9660;</summary>
              <ul>
                <a href="./berita.php"><li>Berita</li></a>
                <a href="./foto-video-aktifitas.html" class="foto-video"
                  ><li>Foto & Video Aktifitas</li></a
                >
              </ul>
            </details>
            <a href="">KARIR</a>
          </div>
        </details>
        <div class="language">
          <div class="gtranslate_wrapper"></div>
        </div>
      </div>
      <div class="nav-desktop">
        <a href="./index.html" class="beranda">BERANDA</a>
        <div class="drop-wrap">
          <span>TENTANG KAMI &#9660;</span>
          <ul>
            <a href="./SEKILASPERUSAHAAN.html">
              <li>Sekilas Perusahaan</li>
            </a>
            <a href="./VMBudayaKerja.html">
              <li>Visi Misi & Budaya Kerja</li>
            </a>
            <li>
              <span>Manajemen Organisasi ►</span>
              <ul>
                <a href="./manajemen.html#manajemen">
                  <li>Manajemen</li>
                </a>
                <a href="./manajemen.html#KA">
                  <li>Komite Audit</li>
                </a>
                <a href="./manajemen.html#KNR">
                  <li>Komite Nominasi dan Renumarasi</li>
                </a>
                <a href="./manajemen.html#SP">
                  <li>Sekretaris Perusahaan</li>
                </a>
              </ul>
            </li>
            <li>
              <span>Tata Kelola Perusahaan ►</span>
              <ul>
                <a href="./tata-kelola.html#audit-internal">
                  <li>Audit Internal</li>
                </a>
                <a href="./tata-kelola.html#manajemen-resiko">
                  <li>Manajemen Resiko</li>
                </a>
                <a href="./tata-kelola.html#pedoman-etika-bisnis">
                  <li>Pedoman Etika Bisnis & Etika Kerja</li>
                </a>
              </ul>
            </li>
          </ul>
        </div>
        <div class="drop-wrap">
          <span>BERKELANJUTAN &#9660;</span>
          <ul>
            <a href="./konservasi-hutan.html#konservasi"
              ><li>Konservasi Hutan</li></a
            >
            <a href="./konservasi-hutan.html#SNS"
              ><li>Standar dan Sertifikasi</li></a
            >
            <a href="./konservasi-hutan.html#CSR"><li>CSR</li></a>
            <a href="./konservasi-hutan.html#RP"><li>Rantai Pasok</li></a>
            <a href="./konservasi-hutan.html#PM"><li>Plasma</li></a>
          </ul>
        </div>
        <div class="drop-wrap">
          <span>HUBUNGAN INVESTOR &#9660;</span>
          <ul>
            <li>
              <span>Informasi Pemegang Saham ►</span>
              <ul>
                <a href="./informasi-pemegang-saham.php#struktur">
                  <li>Struktur Kepemilikan</li>
                </a>
                <a href="./informasi-pemegang-saham.php#dividen">
                  <li>Dividen</li>
                </a>
                <a href="./informasi-pemegang-saham.php#rups">
                  <li>RUPS</li>
                </a>
              </ul>
            </li>
            <li>
              <span>Informasi Keuangan ►</span>
              <ul>
                <a href="./informasi-keuangan.php#harga">
                  <li>Harga Saham</li>
                </a>
                <a href="./informasi-keuangan.php#LK">
                  <li>Laporan Kuartalan</li>
                </a>
                <a href="./informasi-keuangan.php#LT">
                  <li>Laporan Tahunan</li>
                </a>
                <a href="./informasi-keuangan.php#PROSPEKTUS">
                  <li>Prospektus</li>
                </a>
              </ul>
            </li>
          </ul>
        </div>
        <div class="drop-wrap">
          <span class="AB">AKTIFITAS BISNIS &#9660;</span>
          <ul>
            <a href="./aktifitas-bisnis.html#MML"
              ><li>PT Menthobi Makmur Lestari</li></a
            >
            <a href="./aktifitas-bisnis.html#MHL"
              ><li>PT Menthobi Hijau Lestari</li></a
            >
            <a href="./aktifitas-bisnis.html#MTR"
              ><li>PT Menthobi Transitian Raya</li></a
            >
            <a href="./aktifitas-bisnis.html#MAR"
              ><li>PT Menthobi Agro Raya</li></a
            >
          </ul>
        </div>
        <div class="drop-wrap">
          <span>BERITA & GALLERY &#9660;</span>
          <ul>
            <a href="./berita.php"><li>Berita</li></a>
            <a href="./foto-video-aktifitas.html"
              ><li>Foto & Video Aktifitas</li></a
            >
          </ul>
        </div>
        <a href="">KARIR</a>
      </div>
      <div class="saham">
        <iframe
          scrolling="no"
          allowtransparency="true"
          frameborder="0"
          src="https://www.tradingview-widget.com/embed-widget/ticker-tape/?locale=id#%7B%22symbols%22%3A%5B%7B%22description%22%3A%22%22%2C%22proName%22%3A%22IDX%3AMKTR%22%7D%5D%2C%22showSymbolLogo%22%3Afalse%2C%22colorTheme%22%3A%22light%22%2C%22isTransparent%22%3Atrue%2C%22displayMode%22%3A%22regular%22%2C%22width%22%3A%22100%25%22%2C%22height%22%3A44%2C%22utm_source%22%3A%22mktr.co.id%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22ticker-tape%22%2C%22page-uri%22%3A%22mktr.co.id%2Findex.php%2Ffoto-video-aktifitas%2F%22%7D"
          title="ticker tape TradingView widget"
          lang="en"
          style="
            user-select: none;
            box-sizing: border-box;
            display: block;
            height: 44px;
            width: 100%;
          "
        ></iframe>
      </div>
      <div class="language">
        <div class="gtranslate_wrapper"></div>
      </div>
    </nav>

    <div class="container">
      <div class="foto-berita">
        <img
          src="./dashboard/files_img/<?= $data['gambar']?>"
          alt="<?= $data['judul']?>"
        />
      </div>
      <h1>
      <?= $data['judul']?>
      </h1>
      <div class="isi-berita">
        <p>
        <?= $data['deskripsi']?>
        </p>
      </div>
    </div>

    <footer>
      <div class="wrapper">
        <img src="./img/cropped-logo_mktr.png" alt="logo" />
        <ul>
          <li>
            <h3>INFORMASI PEMEGANG SAHAM</h3>
            <a href="./informasi-pemegang-saham.html#struktur"
              >Struktur Kepemilikan</a
            >
            <a href="./informasi-pemegang-saham.html#dividen">Dividen</a>
            <a href="./informasi-pemegang-saham.html#rups">Rups</a>
            <a href="./informasi-pemegang-saham.html#">Penunjang Pasar Modal</a>
          </li>
          <li>
            <h3>LAPORAN KEUANGAN</h3>
            <a href="./informasi-keuangan.html#LK">Laporan Kuartalan</a>
            <a href="./informasi-keuangan.html#LT">Laporan Tahunan</a>
            <a href="./informasi-keuangan.html#PROSPEKTUS">Prospektus</a>
          </li>
          <li>
            <h3>BERKELANJUTAN</h3>
            <a href="./konservasi-hutan.html#konservasi">Konservasi Hutan</a>
            <a href="./konservasi-hutan.html#SNS">Standar dan Sertifikasi</a>
            <a href="./konservasi-hutan.html#CSR">CSR</a>
            <a href="./konservasi-hutan.html#RP">Rantai Pasok</a>
            <a href="./konservasi-hutan.html#PM">Plasma</a>
          </li>
          <li>
            <h3>PT. Menthobi Karyatama Raya Tbk</h3>
            <p>
              Wisma Maktour Lt. 4 Jalan Otista Raya No.80 Jakarta Timur 13330
              Indonesia
            </p>
            <span>Ikuti Kami :</span>
            <div class="sosmed">
              <a
                href="https://m.facebook.com/p/PT-Menthobi-Karyatama-Raya-Tbk-100081064625604/"
                target="_blank"
                ><i class="fa-brands fa-facebook" style="color: #4267b2"></i
              ></a>
              <a
                href="https://instagram.com/mktr.id?igshid=MzRlODBiNWFlZA=="
                target="_blank"
                ><i class="fa-brands fa-instagram" style="color: orangered"></i
              ></a>
              <a
                href="https://www.linkedin.com/company/mktr/about/"
                target="_blank"
                ><i class="fa-brands fa-linkedin" style="color: #4267b2"></i
              ></a>
              <a href="https://www.youtube.com/@mktr5433" target="_blank"
                ><i class="fa-brands fa-youtube" style="color: red"></i
              ></a>
            </div>
          </li>
        </ul>
      </div>
      <div class="copyright">
        <span
          >PT. Menthobi Karyatama Raya Tbk @Copyright 2023 All Right
          Reserved</span
        >
      </div>
    </footer>
    <script>
      window.gtranslateSettings = {
        default_language: "",
        languages: ["id", "en"],
        wrapper_selector: ".gtranslate_wrapper",
      };
    </script>
    <script
      src="https://cdn.gtranslate.net/widgets/latest/flags.js"
      defer
    ></script>
  </body>
</html>
