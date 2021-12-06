<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-poll"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-star-of-life mr-2"></i> Matrik Keputusan </h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $key) : ?>
							<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->kodeAlternatif ?></td>
							<?php foreach ($kriteria as $key) : ?>
								<td>
									<?php
									$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
									echo $data_pencocokan['nilai'];
									?>
								</td>
							<?php endforeach ?>
						</tr>
					<?php
						$no++;
					endforeach
					?>
					<tr align="center" class="bg-light">
						<th colspan="2">Nilai Kriteria Maksimal</th>
						<?php foreach ($kriteria as $key) : ?>
							<th>
								<?php
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								echo $min_max['max'];
								?>
							</th>
						<?php endforeach ?>
					</tr>
					<tr align="center" class="bg-light">
						<th colspan="2">Nilai Kriteria Minimal</th>
						<?php foreach ($kriteria as $key) : ?>
							<th>
								<?php
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								echo $min_max['min'];
								?>
							</th>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-star-of-life mr-2"></i> Bobot Kriteria</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<?php foreach ($kriteria as $key) : ?>
							<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriteria as $key) : ?>
							<td>
								<?php
								echo $key->bobot;
								?>
							</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-star-of-life mr-2"></i> Utilitas</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriteria as $key) : ?>
							<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
						<th>Si</th>
						<th>Ki</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$total = 0;
					$Ki = 0;
					$Si = 0;
					$PreSi = 0;
					$trigger = 0;
					?>
							<tr align="center">
								<td><?=$no?></td>
								<td align="left">A0</td>
								<?php	foreach($kriteria as $key) { ?>
										<td>
										<?php
											$sum_alternatif = 0;
											$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
											$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
											$x = $data_pencocokan['nilai'];
											if(stripos($key->sifat,"benefit") !== false){
												foreach ($alternatif as $keyss) {
													$m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
													$sum_alternatif = $sum_alternatif + $m['nilai'];
												};
												$A = $min_max['max'];
												$sum_alternatif = $sum_alternatif + $A = $min_max['max'];
											}
											else if(stripos($key->sifat,"cost")  !== false){
												foreach ($alternatif as $keyss) {
													$m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
													$sum_alternatif = 1/($sum_alternatif + $m['nilai']);
												};
												$A = $min_max['min'];
												$sum_alternatif = $sum_alternatif + $A = $min_max['max'];
											}
											$hasil= @(round(($A)/($sum_alternatif),4));
											$z =  $key->bobot;
											$hasil = $hasil * $z;
											$total = $total + $hasil;
											$PreSi = $total;
											echo $hasil;
										?>
										</td>
								<?php	} ?>
								<td><?php echo $total; ?></td>
								<td></td>
							</tr>
					<?php
					$no++;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->kodeAlternatif ?></td>
							<?php foreach ($kriteria as $key) : ?>
								<td>
									<?php
									$sum_alternatif = 0;
									$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
									$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
									$x = $data_pencocokan['nilai'];
									if(stripos($key->sifat,"benefit") !== false){
										foreach ($alternatif as $keyss) {
											$m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
											$sum_alternatif = $sum_alternatif + $m['nilai'];
										};
										$A = $min_max['max'];
										$sum_alternatif = $sum_alternatif + $A;
										$hasil= @(round(($x)/($sum_alternatif),4));
									}
									else if(stripos($key->sifat,"cost")  !== false){
										foreach ($alternatif as $keyss) {
											$m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
											$sum_alternatif = 1/($sum_alternatif + $m['nilai']);
										};
										$A = $min_max['min'];
										$sum_alternatif = 1/($sum_alternatif + $A);
										$hasil= @(round((1/$x)/($sum_alternatif),4));
									}
									$z =  $key->bobot;
									$hasil = $hasil * $z;
									$total = $total + $hasil;
									echo $hasil;
									?>
								</td>
							<?php endforeach ?>
							<?php $Si = $total - $PreSi; ?>
							<td><?php echo $total; ?></td>
							<td>
								<?php 
									echo $Si;
								?>
							</td>
						</tr>

					<?php
						$no++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>