<style>
	h2, h1, h3 {
		padding:0;
		margin:0;
	}
	h1 {
		font-size:22px;
		font-weight:bold
	}
	h2 {
		font-size:22px;
		font-weight:normal
	}
	#wrapper {
		width:780px;
		margin:0 auto;
		font-size:15px;
	}
	#ol {
		margin:0
	}
	#header {
		clear:both;
		text-align:center;
	}

	#garis1 {
		border-top:solid 1px white;
		border-right:1px solid white
	}
	#garis2 {
		border-bottom:1px solid black
	}
	#g4 {
		border-right:1px solid black
	}
	#table {
		font-family: Verdana, Arial, Helvetica, sans-serif; 
		font-size: 10pt;
		border-width: 1px;
		border-style: solid;
		border-color: white;
		border-collapse: collapse;
		margin: 10px 0px;
	}
	#table td {
		padding: 0.5em;
	}
	th {
		text-transform: uppercase;
		text-align: center;
		padding: 0.5em;
		border-width: 1px;
		border-style: solid;
		border-color: black;
		border-collapse: collapse;
	}
	td {
		padding: 0.5em;
		vertical-align: top;
		border-width: 1px;
		border-style: solid;
		border-color: #black;
		border-collapse: collapse;
		text-align:center;
	}
	#table2 {
		font-family: Verdana, Arial, Helvetica, sans-serif; 
		font-size: 10pt;
	}
	#table2 tr {
		padding:0px
	}
	#table2 td {
		padding:0px
	}
	.table {
		border:none;
		font-family: Verdana, Arial, Helvetica, sans-serif; 
		font-size: 10pt;
	}
	.table tr {
		border:none;
		text-align:left;
		padding:0px;
	}
	.table td {
		border:none;
		text-align:left;
		padding:0px;}
</style>

<body onLoad="window.print()">
	<div id="wrapper">
		<div style="width:300px;float:right;margin-bottom:8px;"><br/>No</div>
		<div style="text-align:center;clear:both;"><h3>KWITANSI</h3><br/></div>
		<?php
		include "../../config/koneksi.php";
		include "../../config/fungsi_terbilang.php";
		include "../../config/fungsi_indotgl.php";
		function tanggal_indo($tanggal, $cetak_hari = false) {
			$hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			$bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$split = explode('-', $tanggal);
			$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
			
			if ($cetak_hari) {
				$num = date('N', strtotime($tanggal));
				return $hari[$num] . ', ' . $tgl_indo;
			}
			return $tgl_indo;
		}
		$t=mysqli_fetch_array(mysqli_query($link, "SELECT kwitansi.*, nppt.*, tujuan.tujuan FROM kwitansi
			JOIN sppd ON kwitansi.id_sppd = sppd.id_sppd 
			JOIN nppt ON sppd.id_nppt = nppt.id_nppt 
			JOIN tujuan on nppt.id_tujuan = tujuan.id_tujuan WHERE kwitansi.id_kwitansi = $_GET[id];"));
		$data_pegawai = mysqli_query($link, "SELECT sppd.id_sppd, detail_nppt.id_nppt, pegawai.nip, detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
			JOIN sppd ON detail_nppt.id_nppt = sppd.id_nppt WHERE sppd.id_sppd = $t[id_sppd] ORDER BY detail_nppt.status_perintah ASC");
		$pegawai_utama				= mysqli_fetch_array($data_pegawai);
		$lama						= $t['lama'];
		$tgldibuat					= $t['tgl_dibuat'];
		$tot_lumpsum				= $t['lumpsum'];
		$tot_penginapan				= $t['penginapan'];
		$tot_transportasi			= $t['transportasi'];
		$tot_harian					= $t['harian'];
		$tot_lumpsum_rupiah			= number_format($tot_lumpsum,0,'','.');
		$tot_penginapan_rupiah		= number_format($tot_penginapan,0,'','.');
		$tot_transportasi_rupiah	= number_format($tot_transportasi,0,'','.');
		$tot_harian_rupiah			= number_format($tot_harian,0,'','.');
		$lumpsum_rupiah				= number_format($t['lumpsum'],0,'','.');
		$penginapan_rupiah			= number_format($t['penginapan'],0,'','.');
		$transportasi_rupiah		= number_format($t['transportasi'],0,'','.');
		$harian_rupiah				= number_format($t['harian'],0,'','.');
		$total						= $tot_lumpsum + $tot_penginapan + $tot_transportasi + $tot_harian;
		$tot_rupiah					= number_format($total,0,'','.');
		$n							= mysqli_fetch_array(mysqli_query($link, "SELECT * FROM ttdkwitansi"));
		$terbilang					= terbilang($total, $style=3);
		echo "
		<table id='table' width=100%>
			<tr>
				<td width=240 height=170>KODE REKENING
				<br />
				2.02.2.02.01.01.18.5.2.2.15.2</td>
				<td colspan=2 rowspan=2 id='garis1' style='text-align:left'>
					<table class='table' width='100%'>
						<tr>
							<td>Telah Di Terima Dari </td>
							<td>$t[dari]</td>
							</tr>
						<tr>
							<td>Uang Sejumlah </td>
							<td><b>Rp. $tot_rupiah</b><br><i> $terbilang Rupiah</i></td>
						</tr>
						<tr>
							<td>Untuk Keperluan </td>
							<td>$t[untuk]</td>
						</tr>
					</table>
				</td>
			<tr>
				<td height=170>SETUJU BAYAR
					<br />
					Kuasa Pengguna Anggaran
					<br />
					Diskominfo Kabupaten Pasaman
					<br /><br /><br /><br />
					<u>$n[kadis]</u>
					<br />
					NIP. $n[nip_kadis]
				</td>
			</tr>
			<tr>
				<td height=140>LUNAS BAYAR
					<br />
					Bendahara Pengeluaran Pembantu
					<br /><br /><br /><br />
					<u>$n[bendahara]</u>
					<br />
					NIP. $n[nip_bendahara]
				</td>
				<td>Mengetahui
					<br />
					Pejabat Pelaksana Teknis Kegiatan
					<br /><br /><br /><br />
					<u>$n[pptk]</u>
					<br />
					NIP. $n[nip_pptk]
				</td>
				<td>
					<br />
					Yang Menerima 
					<br /><br /><br /><br />
					<u>$pegawai_utama[nama]</u>
					<br />
					NIP. $pegawai_utama[nip]
				</td>
			</tr>
		</table>";
		?>

		<div style="page-break-before:always;"></div>
		<div style="font-family: Arial; text-align: center; font-size: 12pt; font-weight: bold; margin-top: 100px;">
			<br/>
			<br/>
			DAFTAR PEMBAYARAN PERJALANAN DINAS LUAR DAERAH LUAR PROVINSI
			<br/>
			<?php
				echo strtoupper($t['maksud']);
			?>
			<br/>
			<?php
				$tgl_pergi = explode("-", $t['tgl_pergi']);
			?>
			PADA TANGGAL
			<?php
				echo $tgl_pergi[2]." S/D ".strtoupper(tanggal_indo($t['tgl_kembali']))
			?>
			DI
			<?php
				echo strtoupper($t['tujuan'])
			?>
		</div>
		<br/>
		<br/>
		<?php
			$banyak_pegawai = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(id_detail) AS id FROM detail_nppt WHERE id_nppt = $pegawai_utama[id_nppt]"));
			$data_pegawai = mysqli_query($link, "SELECT sppd.id_sppd, detail_nppt.id_nppt, nppt.lama, pegawai.nip, detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan, biaya.* FROM detail_nppt
				JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
				JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
				JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
				JOIN sppd ON detail_nppt.id_nppt = sppd.id_nppt 
				JOIN nppt on sppd.id_nppt = nppt.id_nppt 
				JOIN biaya ON nppt.id_tujuan = biaya.id_tujuan AND pegawai.id_jabatan = biaya.id_jabatan AND pegawai.id_pangkat = biaya.id_pangkat
			WHERE sppd.id_sppd = $t[id_sppd] ORDER BY detail_nppt.status_perintah ASC");
			$jumlah = 0;
			$jumlah_keseluruhan = 0;
			while($pegawai = mysqli_fetch_array($data_pegawai)){
			$jumlah = $pegawai['transportasi'] + ($pegawai['penginapan']*($pegawai['lama']-1)) + ($pegawai['harian']*$pegawai['lama']) + $pegawai['lumpsum'];
			?>
		<table style="font-family: Arial; border: 2px solid black; border-collapse: collapse;">
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Nama</td>
				<td style="border: 2px solid; black; "><?php echo $pegawai['nama']; ?></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Jabatan</td>
				<td style="border: 2px solid; black;"><?php echo $pegawai['jabatan']; ?></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Uang Transportasi</td>
				<td style="border: 2px solid; black; text-align: right;">Rp <?php echo number_format($pegawai['transportasi'] ,0,'','.'); ?></td>		
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Uang Penginapan</td>
				<td style="border: 2px solid; black; text-align: right;">Rp <?php echo number_format($pegawai['penginapan']*($pegawai['lama']-1) ,0,'','.'); ?></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Uang Harian</td>
				<td style="border: 2px solid; black; text-align: right;">Rp <?php echo number_format($pegawai['harian']*$pegawai['lama'] ,0,'','.'); ?></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Uang Lumpsum</td>
				<td style="border: 2px solid; black; text-align: right;">Rp <?php echo number_format($pegawai['lumpsum'] ,0,'','.'); ?></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;"><b>Jumlah</b></td>
				<td style="border: 2px solid; black; text-align: right;"><b>Rp <?php echo number_format($jumlah ,0,'','.'); ?></b></td>
			</tr>
			<tr>
				<td style="border: 2px solid; black; text-align: left;">Tanda Tangan</td>
				<td style="border: 2px solid; black; bold; height: 140px;"></td>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
		$tgl_sekarang = explode(" ", tanggal_indo(date("Y-m-d")));
		$ttd = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM ttdkwitansi"));
		?>
		<div style="margin-top: 30px;text-align: left; width: 250px; float: right; margin-right: -50px; font-family: Arial; font-weight: bold;">
			Lubuk Sikaping, &nbsp
			<?php
				echo $tgl_sekarang[1]." ".$tgl_sekarang[2];
			?>
			<br/>
			Bendahara Pengeluaran
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<u>
				<?php
					echo $ttd['bendahara'];
				?>
			</u>
			<br/>
			NIP.
			<?php
				echo $ttd['nip_bendahara']; 
			?>
		</div>
	</div>
</body>
