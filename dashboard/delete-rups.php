<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
    die;
  }
  
  $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");

  var_dump($_GET);
  $id = $_GET["id"];
  $sql = "DELETE FROM rups WHERE id = $id";
  $query = mysqli_query($koneksi_db, $sql);
  if($query){
    echo "<script>
    alert('Data Berhasil Dihapus!');
    window.location.href = 'info-pemegang-saham.php';
    </script>";
  }
?>