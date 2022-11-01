<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost","root","","dbtricket");
	return $db;
}

// getInitial digunakan untuk mengambil data kereta
function getTrain(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM kereta
						 ORDER BY train_kode");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// getInitial digunakan untuk mengambil data kereta
function gettPemesanan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM pemesanan
						 ORDER BY order_number");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah produk
function getDataKelas($id_class){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM kelas k WHERE id_class='$id_class'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// getInitial digunakan untuk mengambil data kereta
function getClass(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM kelas
						 ORDER BY id_class");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data account
function getDataAcc($id_account){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM account					
			WHERE id_account='$id_account'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah produk
function getDataKereta($train_kode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM kereta WHERE train_kode='$train_kode'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataStasiunAwal($initial_kode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM stasiun_awal WHERE initial_kode='$initial_kode'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// getInitial digunakan untuk mengambil data stasiun awal
function getInitial(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM stasiun_awal
						 ORDER BY initial_kode");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataStasiunAKhir($final_kode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM stasiun_akhir WHERE final_kode='$final_kode'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getFinal(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM stasiun_akhir
						 ORDER BY final_kode");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataJadwal($id_schedule){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM jadwal WHERE id_schedule='$id_schedule'");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getAccount(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM account
						 ORDER BY id_account");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getJadwal(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM jadwal
						 ORDER BY id_schedule");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah produk
function getDataSchedule($id_schedule){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT p.id_schedule, p.hari, p.initial_kode, p.final_kode, p.departure_time, p.arrival_time, p.train_kode, k.station_name station_namea, l.station_name station_nameb, m.train_name
			FROM jadwal p 
			JOIN stasiun_awal k ON p.initial_kode=k.initial_kode 
			JOIN stasiun_akhir l ON p.final_kode=l.final_kode 
			JOIN kereta m ON p.train_kode=m.train_kode 
			ORDER BY id_schedule");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
// digunakan untuk mengambil data sebuah produk
function getDataSchedulea($id_schedule){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT p.id_schedule, p.hari, p.initial_kode, p.final_kode, p.departure_time, p.arrival_time, p.train_kode
			FROM jadwal p WHERE id_schedule='$id_schedule'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
// digunakan untuk mengambil data sebuah produk
function getDataPemesanan($order_number){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT p.order_number, p.order_date, l.id_account, l.nama nama_customer, m.id_schedule, m.hari harih, m.departure_time waktu_berangkat, p.payment_code
			FROM pemesanan p JOIN account l ON p.id_account=l.id_account 
			JOIN jadwal m ON p.id_schedule=m.id_schedule				
			WHERE p.order_number='$order_number'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// Digunakan untuk mengambil data sebuah customer
function getDataCustomer($id_customer){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM customer WHERE id_customer='$id_customer'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function banner(){
	?>
<div id="banner"><h1>PT. Kereta Api</h1>
</div>
	<?php
}

function navigator(){
	?>
<div id="navigator">
| <a href="view_pemesanan.php">Pemesanan</a> 
| <a href="view_jadwal.php">Jadwal</a> 
| <a href="view_kereta.php">Kereta</a> 
| <a href="view_customer.php">Customer</a> 
| <a href="view_kelas.php">Kelas</a> 
| <a href="view_stasiunawal.php">Stasiun Awal</a> 
| <a href="view_stasiunakhir.php">Stasiun Akhir</a> 
| <a href="logout.php">Logout</a>
| 
</div>
	<?php
}

function navigatoruser(){
	?>
<div id="navigator">
| <a href="view_pemesananuser.php">Pemesanan</a> 
| <a href="view_jadwaluser.php">Jadwal</a> 
| <a href="view_keretauser.php">Kereta</a>  
| <a href="view_kelasuser.php">Kelas</a> 
| <a href="view_stasiunawaluser.php">Stasiun Awal</a> 
| <a href="view_stasiunakhiruser.php">Stasiun Akhir</a> 
| <a href="logout.php">Logout</a>
| 
</div>
	<?php
}

function showError($message){
	?>
<div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
<?php echo $message;?>
</div>
	<?php
}
?>