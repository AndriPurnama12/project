<?php
session_start();
$host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'login';
  $conn = mysqli_connect($host, $user, $pass, $db);
  if($conn){
    //echo "koneksi berhasil";
  }
  mysqli_select_db($conn,$db);
if (isset($_SESSION['session_username'])) {
    $username = $_SESSION['session_username'];
    $sql2 = "SELECT * FROM user WHERE username = '$username'";
    $q2 = mysqli_query($conn, $sql2);
    $r2 = mysqli_fetch_array($q2);

    if ($r2['username'] = 'admin') {
        header("location: /engineer/admin/"); 
        exit();
    }
} else {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("location: /engineer/login.php"); // Redirect ke halaman login jika belum login
    exit();
}
$conn->close();
include 'koneksip21.php';

$query = "SELECT MAX(RIGHT(kode, 4)) AS max_kode FROM fpmuclean";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($hasil);
$kode_barang = $data['max_kode'];

$kode_barang++;
$kode_barang = sprintf("%04s", $kode_barang);

$kode_otomatis = "FUC21" . $kode_barang;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULTRASONIC CLEANER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
     <!-- NAVBAR -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-secondary text-light fixed-top" >
        <div class="container-fluid">
          <a class="navbar-brand" href="/engineer/ProductionEngineering">Prod-Eng's Page</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/engineer/ProductionEngineering">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Produksi 1
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/engineer/ProductionEngineering/produksi11/">Produksi 1.1</a></li>
                  <li><a class="dropdown-item" href="/engineer/ProductionEngineering/produksi12/">Produksi 1.2</a></li>                  
                </ul>
              </li> 
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Produksi 2
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/engineer/ProductionEngineering/produksi21/">Produksi 2.1</a></li>
                  <li><a class="dropdown-item" href="/engineer/ProductionEngineering/produksi23/">Produksi 2.3</a></li>                  
                </ul>
              </li>                         
            </ul>
          </div>
        </div>
    </nav>
    <!-- nav end -->
    <!--layout  -->
    <div class="container-fluid" style="height: 100%">             
      <div class="row text-center align-items-center text-bg-dark mt-3">
         <div class="col-12" style="height: 20vh; margin-top: 30px">
           <h1 class="mt-5">FORM PM ULTRASONIC CLEANER</h1>              
         </div>            
      </div>
      <h4 class="row text-center" style="margin-top:5px; margin-left: 10px;">Form Perbaikan</h4>
        <p style="margin-left: 9px">Isi form untuk permintaaan perbaikan ke staff teknik</p>
      <div class="card" style="margin: 25px;">        
        <form class="row g-3" style="margin: 10px;" method="post" name="form-user" action="prosesp21.php" autocomplete="off">
          <div class="col-md-12">
            <label class="form-label"><h6>Tanggal</h6></label>
            <input type="date" name="tanggal" class="form-control" >
            <input type="hidden" name="kode" required="required" value="<?php echo $kode_otomatis ?>" readonly>
          </div>    
          <div class="col-12 mt-3">
            <label for="no_uclean" class="form-label"><h6>Nomor Mesin</h6></label>
            <select id="no_uclean" name="no_uclean"class="form-select" required>
              <option selected>pilih nomor mesin</option>
              <option value="Ultrasonic Cleaner 1">Ultrasonic Cleaner  1</option>
            </select>
          </div>       
          <table class="table table-light table-bordered borderes-light">
            <thead class="table table-secondary">
              <tr>
                <th scope="col">Part</th>
                <th scope="col">Kondisi</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                  <th scope="row">Silinder</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox"  name="silinder" value="OK">
                      <label class="form-check-label" >OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox"  name="silinder" value="Tidak OK">
                      <label class="form-check-label" >Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Solenoid</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox"  name="solenoid" value="OK">
                      <label class="form-check-label" >OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox"  name="solenoid" value="Tidak OK">
                      <label class="form-check-label" >Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Selang Angin</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="selang" value="OK">
                      <label class="form-check-label" >OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="selang" value="Tidak OK">
                      <label class="form-check-label" >Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Fitting & Speed Control</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="fit_speed" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="fit_speed" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Sensor</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="sensor" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="sensor" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">FRL</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="frl" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="frl" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Tekanan Angin</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="angin" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="angin" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Panel Box Utama</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="panel" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="panel" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Tombol</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="tombol" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="tombol" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Switch</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="switch" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="switch" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>                   
                  </td>
                </tr>
                <tr>
                  <th scope="row">Thermocontrol</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="thermocontrol" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="thermocontrol" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Rangkaian Kabel</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="kabel" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="kabel" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Layar HMI</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="hmi" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="hmi" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Box Control</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="box" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="box" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Baut - Baut Pengikat</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="baut" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="baut" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Linear Motion</th>
                  <td>
                    Block:
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="motion[]" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="motion[]" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    Rail:
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="motion[]" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="motion[]" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>                      
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Pelumasan</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="pelumasan" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="pelumasan" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Cyl-Head Connector</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="konektor" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="konektor" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Body Mesin</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="body" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="body" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Bak Washing</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="bak_wash" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="bak_wash" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Bak Rinsing</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="bak_rins" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="bak_rins" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Dryer Tube</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="dryer" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="dryer" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Thermocouple</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="thermocouple" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="thermocouple" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Heater</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="heater" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="heater" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Electrical Air Generator</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="air_generator" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="air_generator" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Unit Generator</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="generator" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="generator" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Traffo</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="traffo" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="traffo" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Voltmeter Traffo</th>
                  <td>
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" name="volt" value="OK">
                      <label class="form-check-label">OK</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="volt" value="Tidak OK">
                      <label class="form-check-label">Tidak OK</label>
                    </div>
                  </td>
                </tr>
            </tbody>
          </table>
          <div class="col-md-12 mt-2">
            <label class="form-label"><h6>Catatan</h6></label>
            <input type="text" class="form-control" name="catatan">
          </div>      
          <div class="col-12 mt-4">
            <button type="submit" name="submit"  class="btn btn-primary"><h6>Kirim</h6></button>
          </div>
        </form>   
        </div>
        <div class="mt-4 mb-2" >
              <a href="/engineer/ProductionEngineering/produksi21/ultrasonic" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i></a> 
          </div>  
   </div>    
   </div>           
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="fungsi.js"></script>
</body>
</html>