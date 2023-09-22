<?php
$db = new PDO("mysql:host=localhost;dbname=ogrenci_kayit;charset=utf8","root","password");
if ($_POST[isim] and $_POST[soyisim] and $_POST[no] and $_POST[sinif]) {
    $query = $db -> prepare("INSERT INTO ogrenciler SET isim = ?, soyisim = ?, no = ?, sinif =?");
	$query -> execute(array("$_POST[isim]","$_POST[soyisim]","$_POST[no]","$_POST[sinif]"));
}

if($_GET["type"] = "delete"){

	$delId = $_GET["id"];
	$isDeleted = $_GET["isDeleted"];
	$delQuery = $db ->prepare("DELETE FROM ogrenciler WHERE id = :id");
	$delete = $delQuery -> execute(array('id' => $delId));

	if($isDeleted > 0 ){
		header( 'Location: /ogrenci_kayit/' );
	}
}




?>

<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>İlk PHP Uygulamam</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<h1 class="text-center text-primary">Öğrenci Kayıt Uygulaması</h1>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="background-color: lightblue; border: 1px  solid blue; padding: 15px;">
				<form method="post">
					<div class="form-group">
						<label>İsim:</label>
						<input type="text" name="isim" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Soyisim:</label>
						<input type="text" name="soyisim" class="form-control" required>
					</div>
					<div class="form-group">
						<label>No:</label>
						<input type="text" name="no" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Sınıf:</label>
						<select class="form-control" name="sinif">
							<option value="" disabled selected>Lütfen bir sınıf seçiniz</option>
							<option value="9">9.  Sınıf</option>
							<option value="10">10.  Sınıf</option>
							<option value="11">11.  Sınıf</option>
							<option value="12">12.  Sınıf</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" value="Kaydet" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
		<hr>
		<h4 class="text-center text-danger"><b>Güncel Sınıf Listesi</b></h4>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			  <table class="table table-bordered table striped">
				<thead>
					<th>#</th>
					<th>İsim</th>
					<th>Soyisim</th>
					<th width="75">No</th>
					<th width="100">Sınıf</th>
					<th width="100"></th>
				</thead>
				<tbody>
					<?php 
					$select = $db -> query("SELECT * FROM ogrenciler ORDER BY id ASC", PDO::FETCH_ASSOC);
					if($select -> rowCount()){
						$sira = 1;
						foreach ($select as $row) {

							$id = trim($row["id"]);
							$isim = trim($row["isim"]);
							$soyisim = trim($row["soyisim"]);
							$no = trim($row["no"]);
							$sinif = trim($row["sinif"]);
							?>
								<tr>
									<td><?=$sira?></td>
									<td><?=$isim?></td>
									<td><?=$soyisim?></td>
									<td><?=$no?></td>
									<td><?=$sinif?></td>
									<td class="text-center">
										<a href="?type=delete&id=<?=$id?>&isDeleted=1" class="btn btn-danger">Sil</a>
									</td>
								</tr>
							<?php
							$sira++;
						}
					}
					?>
				</tbody>
			</table>	
			</div>
		</div>
	</div>
</body>
</html>