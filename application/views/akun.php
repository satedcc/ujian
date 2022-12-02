<div id="contentwrapper">
	<div id="contentcolumn">
		<div class="innertube">
			<div class="sub-header">
				<div>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Pages</a></li>
						<li class="breadcrumb-item"><a href="#">Account</a></li>
						<li class="breadcrumb-item active" aria-current="page">Account Update</li>
					</ol>
					<h2>WELCOME, <?= $this->session->userdata('nama') ?></h2>
				</div>
				<div class="date">
					<h2 id="jam"><?= date('H:i:s') ?></h2>
				</div>
			</div>
			<div class="body">
				<div class="row">
					<div class="col-md m-auto">
						<?= $this->session->flashdata('message'); ?>
						<form action="<?= base_url('akun/save') ?>" method="post" enctype="multipart/form-data">
							<div class="card">
								<div class="card-body">
									<div class="alert alert-warning">
										<h3>IMPORTANT !</h3>
										<p>Please complete the following personal data</p>
									</div>
									<div class="form-group">
										<label for="nama">No. Registration</label>
										<input type="text" name="regis" id="regis" placeholder="number registration" disabled value="<?= $akun->no_regist ?>">
										<input type="text" name="id" id="id" value="<?= $akun->id_regis ?>" hidden>
									</div>
									<div class="form-group">
										<label for="nama">NIK</label>
										<input type="number" name="nik" id="nik" placeholder="NIK KTP" value="<?= $akun->nik ?>">
										<input type="text" name="validasi_nik" id="validasi_nik" hidden>
									</div>
									<div class="form-group">
										<label for="nama">Full Name</label>
										<input type="text" name="nama" id="nama" placeholder="full name" value="<?= $akun->nama_lengkap ?>">
									</div>
									<div class="form-group">
										<label for="nama">Qualified</label>
										<select name="qualified" id="qualified">
											<?php foreach ($qua as $q) : ?>
												<?php if ($akun->id_qua == $q->id_qua) : ?>
													<option value="<?= $q->id_qua ?>" selected><?= $q->nama_qualified ?></option>
												<?php else : ?>
													<option value="<?= $q->id_qua ?>"><?= $q->nama_qualified ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="tempat">Birth</label>
										<div class="form-row">
											<input type="text" name="tempat" id="place" placeholder="place" value="<?= $akun->tempat_lhr ?>">
											<input type="text" name="tanggal" id="date" placeholder="birth" value="<?= $akun->tgl_lahir ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="nomor">Phone Number</label>
										<input type="text" name="nomor" id="nomor" placeholder="phone number" value="<?= $akun->nomor_peserta ?>">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" disabled name="email" id="email" placeholder="email address" value="<?= $akun->email_peserta ?>">
									</div>
									<div class="form-group">
										<label for="alamat">Address</label>
										<textarea name="alamat" id="alamat" rows="10" placeholder="address"><?= $akun->alamat_peserta ?></textarea>
									</div>
									<div class="form-group">
										<label for="nama">Gender</label>
										<select name="jk" id="jk">
											<option value="L" <?php if ($akun->jk == "L") echo "selected" ?>>Laki-laki</option>
											<option value="P" <?php if ($akun->jk == "P") echo "selected" ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label for="nama">Display Picture</label>
										<input type="file" name="file" id="file" accept="image/png, image/gif, image/jpeg" />
										<?php if ($akun->file_photo != "") : ?>
											<img src="<?= base_url() ?>profile/<?= $akun->file_photo ?>" alt="" style="width: 20%;margin: 10px 0;">
										<?php endif; ?>
									</div>
									<div class="form-group">
										<button class="btn btn-main btn-block btn-lg">Update Data</button>
										<button type="button" class="btn btn-dark btn-block btn-lg" onclick="history.back()">Back</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("body").on("keyup", "#nik", function(e) {
			$("input[name='validasi_nik']").val("Y")
		});
		$('#date').datepicker({
			dateFormat: "dd/mm/yy",
			maxDate: new Date(),
		});
	});
</script>