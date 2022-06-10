<div class="row" id="body-row">
	<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
		<ul class="list-group">
			<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
				<small>MENU</small>
			</li>
			<a href="?hal=home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-start align-items-center">
					<span class="fas fa-home fa-fw mr-3"></span>
					<span class="menu-collapsed">Beranda</span>
				</div>
			</a>
			<a href="?hal=profiluser" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-start align-items-center">
					<span class="fa fa-user fa-fw mr-3"></span>
					<span class="menu-collapsed">Profil Peserta</span>
				</div>
			</a>
			<a href="?hal=soal" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-start align-items-center">
					<span class="fa fa-file fa-fw mr-3"></span>
					<span class="menu-collapsed">Soal</span>
				</div>
			</a>
			<a href="http://localhost/psikotes/peserta/logout.php" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-start align-items-center">
					<span class="fa fa-sign-out-alt fa-fw mr-3"></span>
					<span class="menu-collapsed">Keluar</span>
				</div>
			</a>
		</ul>
	</div> <!-- End Sidebar -->

	<!-- MAIN -->
	<div class="col">
		<div id="page-wrapper">
			<div class="container-fluid mt-3">
				<div class="row">
					<div class="col-lg-12">
						<!--   <h3 class="page-header"> Peraturan </h3> -->

					</div>

				</div>

				<div class="row">
					<div class="col-lg-12">

						<div class="card-header bg-info text-white">
							Soal
						</div>
						<div class="card-body">

							<?php

							if (empty($_SESSION[username]) and empty($_SESSION[passuser])) {
								echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
								echo "<a href=index.php><b>LOGIN</b></a></center>";
							} else {
								//Lakukan Pengecekan Apakah Sudah Pernah Mengerjakan Soal atau belum
								$cek = mysql_num_rows(mysql_query("SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'"));
								if ($cek > 0) {
									$tampil = mysql_query("SELECT * FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'");
									$t = mysql_fetch_array($tampil);
									$username =  ucwords($_SESSION['username']);;

									echo "<h3 align='center' style='border:0';><b>$username</b> telah menyelesaikan Tes Psikotes Online</h3>";
									echo "<br><div align='center'>
		 <table><tr><th colspan=3>Hasil Tes Psikotes Online Anda</th></tr>
		 <tr><td>Jumlah Jawaban Benar</td><td> : $t[benar]</td>";
									$qry = mysql_query("SELECT nilai_min FROM tbl_pengaturan_tes");
									$hasil = mysql_fetch_array($qry);
									$cek = $hasil['nilai_min'];
									if ($t[score] >= $cek) {
										echo "<td rowspan='4'><h1 class='ml-5 text-success'>LULUS</h1></td></tr>";
									} else {
										echo "<td rowspan='4'><h1 class='ml-5 text-danger'>TIDAK LULUS</h1></td></tr>";
									}
									echo "
		 <tr><td>Jumlah Jawaban Salah</td><td> : $t[salah]</td></tr>
		 <tr><td>Jumlah Jawaban Kosong</td><td>: $t[kosong]</td></tr>
		 <tr><td><b>Nilai anda            </td><td>: $t[score]</b></td></tr></table></div>";
								} else {
									echo '<table><tr><th><i class"fas fa-clock"></i>Waktu Tersisa</th></tr>
		 <tr><td align=center><span style="font-size:18px"><span id="menit"></span>:<span id="detik"></span></span> </td></tr></table>';
									echo "<div style='width:100%; border: 1px solid #EBEBEB; overflow:scroll;height:700px;'>";
									echo '<table class="table" border="0">';

									include "../config/koneksi.php";
									$hasil = mysql_query("select * from tbl_soal WHERE aktif='Y' ORDER BY RAND ()");
									$jumlah = mysql_num_rows($hasil);
									$urut = 0;
									while ($row = mysql_fetch_array($hasil)) {
										$id = $row["id_soal"];
										$pertanyaan = $row["soal"];
										$pilihan_a = $row["a"];
										$pilihan_b = $row["b"];
										$pilihan_c = $row["c"];
										$pilihan_d = $row["d"];
										$pilihan_e = $row["e"];
							?>
										<form name="form1" method="post" action="?hal=jawaban">
											<input type="hidden" name="id[]" value=<?php echo $id; ?>>
											<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
											<tr>
												<td width="17">
													<font color="#000000"><?php echo $urut = $urut + 1; ?></font>
												</td>
												<td width="430">
													<font color="#000000"><?php echo "$pertanyaan"; ?></font>
												</td>
											</tr>
											<?php
											if (!empty($row["gambar"])) {
												echo "<tr><td></td><td><img src='../foto/$row[gambar]' width='300' hight='300' class='img-thumbnail'></td></tr>";
											}
											?>
											<tr>
												<td height="21">
													<font color="#000000">&nbsp;</font>
												</td>
												<td>
													<font color="#000000">
														A. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="A">
														<?php echo "$pilihan_a"; ?></font>
												</td>
											</tr>
											<tr>
												<td>
													<font color="#000000">&nbsp;</font>
												</td>
												<td>
													<font color="#000000">
														B. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="B">
														<?php echo "$pilihan_b"; ?></font>
												</td>
											</tr>
											<tr>
												<td>
													<font color="#000000">&nbsp;</font>
												</td>
												<td>
													<font color="#000000">
														C. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="C">
														<?php echo "$pilihan_c"; ?></font>
												</td>
											</tr>
											<tr>
												<td>
													<font color="#000000">&nbsp;</font>
												</td>
												<td>
													<font color="#000000">
														D. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="D">
														<?php echo "$pilihan_d"; ?></font>
												</td>
											</tr>
											<tr>
												<td>
													<font color="#000000">&nbsp;</font>
												</td>
												<td>
													<font color="#000000">
														E. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="D">
														<?php echo "$pilihan_e"; ?></font>
												</td>
											</tr>

										<?php
									}
										?>
										<tr>
											<td>&nbsp;</td>
											<td><input class="btn btn-success" type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
										</tr>
										</table>
										</form>
										</p>
						</div>
						<?php
									$qry = mysql_query("SELECT * FROM tbl_pengaturan_tes");
									$r = mysql_fetch_array($qry);
						?>

						<?php
									$data = mysql_query("SELECT waktu FROM tbl_pengaturan_tes");
									$waktu = mysql_fetch_array($data);
						?>
						<script>
							var detik = 05;
							var menit = Number('<?= $waktu['waktu'] ?>');
							console.log(menit);
							if (sessionStorage.getItem("menit") && sessionStorage.getItem("detik")) {
								menit = sessionStorage.getItem("menit");
								//menit = Number('<?= $waktu['waktu'] ?>');
								//console.log('test');
								detik = sessionStorage.getItem("detik");
							} else {
								menit = Number('<?= $waktu['waktu'] ?>');
								detik = 0;
								sessionStorage.setItem("menit", Number('<?= $waktu['waktu'] ?>'));
								sessionStorage.setItem("detik", 5);
							}
							//document.counter.d2.value='30' 

							function display() {
								if (menit == 0 && detik == 0) {
									menit = Number('<?= $waktu['waktu'] ?>');
									detik = 5;
									sessionStorage.setItem("menit", Number('<?= $waktu['waktu'] ?>'));
									sessionStorage.setItem("detik", 5);
									alert('Waktu habis, klik OK untuk melihat hasil tes anda.');
									document.form1.submit.click();
									// alert('Waktu habis, klik OK untuk melihat hasil tes anda.');
									// location.href="?hal=jawaban";
								}

								if (detik <= 0) {
									detik = 60;
									menit -= 1;
								}
								if (menit <= -1) {
									detik = 0;
									menit += 1;
								}
								if (menit <= 0 && detik <= 0) {
									sessionStorage.clear();
								} else
									detik -= 1


								sessionStorage.setItem("menit", menit);
								sessionStorage.setItem("detik", detik);

								detik = "" + detik
								menit = "" + menit
								var pad = "00"
								document.getElementById("menit").innerHTML = pad.substring(0, pad.length - menit.length) + menit;
								document.getElementById("detik").innerHTML = pad.substring(0, pad.length - detik.length) + detik;
								//document.counter.d2.value=menit;
								//document.counter.d3.value=detik;
								setTimeout("display()", 1000)
							}
							display()
						</script>
				<?php }
							} ?>

					</div>

				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


</div>
</div>