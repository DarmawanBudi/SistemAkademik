<?php
	if(isset($_POST['submit']))
	{
		include 'koneksidb.php';

		$username =  $_POST['username'];
		$pass = $_POST['password'];

		echo $username;
		echo $pass;

		$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE username = '".$username."' AND password = '".$pass."' "); 

		$data = mysqli_fetch_array($query);
		$user_login = $data['username'];
		$id_role = $data['id_role'];


		if (mysqli_num_rows($query)>0) 
		{
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['id_role'] = $id_role;

			echo "berhasil login";
			if ($id_role == 'admin') 
			{
				header('location: admin/admin.php');
			}
			elseif ($id_role == 'staff') 
			{
				header('location: nasabah/staff.php');
			}
		} 
		else 
		{
			echo "Username / password anda salah";
		}
	}
?>
