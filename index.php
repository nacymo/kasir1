<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Kasir</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<div class="wrapper">
		<span class="bg-animate"></span>
		<div class="form-box login">
			<h2>Login</h2>
			<?php 
							if(isset($_GET['pesan'])){
							if($_GET['pesan']=="gagal"){
							echo '<script>
							alert("Username dan password anda salah");
							</script>';
		}
	}
	?>
			<form method="post" action="cek_login.php">
				<div class="input-box">
					<input type="text" name="username" autocomplete="off" required>
					<label>Username</label>
					<i class="bx bxs-user"></i>
				</div>
				<div class="input-box">
					<input type="password" name="password" required>
					<label>Password</label>
					<i class="bx bxs-lock-alt"></i>
				</div>
				<button class="btn" type="submit">Login</button>
			</form>
		</div>
		<div class="info-text login">
			<h2>Selamat Datang</h2>
			<br>
			<p>Aplikasi kasir ini dibuat untuk memenuhi UPK RPL tahun 2024</p>
		</div>
	</div>
</body>
</html>