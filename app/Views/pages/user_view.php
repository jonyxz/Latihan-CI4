<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
	<div class="alert alert-info alert-dismissible fade show" role="alert">
		<?= session()->getFlashData('success') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session()->getFlashData('failed') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<!-- Table with stripped rows -->
<table class="table datatable">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Email</th>
			<th scope="col">Role</th> 
			<th scope="col">Status</th> 
			<th scope="col"></th> 
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $index => $user) : ?>
			<tr>
				<th scope="row"><?= $index + 1 ?></th>
				<td><?= $user['username'] ?></td> 
				<td><?= $user['email'] ?></td> 
				<td><?= $user['role'] ?></td>
				<td>
					<form method="post" action="<?=base_url('user/edit/'.$user['user_id'])?>)">
						<?php
							if ($user['status']==true){
								echo form_hidden('user_id',$user['user_id']);
								echo form_hidden('status',0);
								echo form_hidden('rolekey',false);
						?>
						<button type="submit" class="btn btn-success">Active</button>
						<?php
							}else {
								echo form_hidden('user_id',$user['user_id']);
								echo form_hidden('status',1);
								echo form_hidden('rolekey',false);
							
						?>
						<button type="submit" class="btn btn-warning">Inactive</button>
						<?php 
						}
						?>
					</form>
				</td>
				<td>
					<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['user_id'] ?>">
						Ubah
					</button>
					<a href="<?= base_url('user/delete/'.$user['user_id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini?')">
						Hapus
					</a>
				</td>
			</tr>
			<!-- Edit Modal Begin -->
			<div class="modal fade" id="editModal-<?= $user['user_id'] ?>" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Data</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="<?= base_url('user/edit/'.$user['user_id']) ?>" method="post">
							<?= csrf_field(); ?>
							<div class="modal-body">
								<div class="form-group">
									<label for="username">Username</label>
									<input disabled type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" name="email" class="form-control" id="email" value="<?= $user['email'] ?>" placeholder="Email" required>
								</div>
								<?=form_hidden('rolekey',true) ?>
								<label for="role">Role</label>
								<select name="role" class="form-group form-select" aria-label="Default select example">
									<option <?php if($user['role']=='user') {echo 'selected';}?> value="user">User</option>
									<option <?php if($user['role']=='admin') {echo 'selected';}?> value="admin">Admin</option>
								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Modal End -->
		<?php endforeach; ?>   
	</tbody>
</table>
<!-- End Table with stripped rows -->

<?= $this->endSection() ?>
