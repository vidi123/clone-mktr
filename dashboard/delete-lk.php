<?php
  session_start();
  if(!$_SESSION["login"]){
    header("Location: ../index.html");
    die;
  }
  
  $koneksi_db = mysqli_connect("localhost", "root", "", "mktr_db");

  $id = $_GET["id"];
  $sql = "DELETE FROM lk WHERE id = $id";
  $query = mysqli_query($koneksi_db, $sql);
  if($query){
    echo "<script>
    alert('Data Berhasil Dihapus!');
    window.location.href = 'info-keuangan.php';
    </script>";
  }
?>