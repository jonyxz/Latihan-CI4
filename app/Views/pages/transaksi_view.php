<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;


if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Tanggal</th> 
	<th scope="col">Nama</th>
	<th scope="col">Total Harga</th>
	<th scope="col">Ongkir</th>
	<th scope="col">Status</th> 
	
	</tr>
</thead>
<tbody>
	<?php foreach($transaksi as $index => $transaction): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?= $transaction['created_date'] ?></td>
	<td><?= $transaction['username'] ?></td> 
	<td><?= number_to_currency($transaction['total_harga'],'IDR')?></td> 
	<td><?= $transaction['ongkir'] ?> </td>
	<td>
		<form method="post" action="<?=base_url('transaksi/edit/'.$transaction['id'])?>)">
		<?php
		if ($transaction['status']==0){
			echo form_hidden('id',$transaction['id']);
			echo form_hidden('status',1);
			?>
			<button type="submit" class="btn btn-danger">Diproses</button>
		<?php
		}else if ($transaction['status']==1){
			echo form_hidden('id',$transaction['id']);
			echo form_hidden('status',2);?>
			<button type="submit" class="btn btn-warning">Dikirim</button>
<?php
		}else{
			echo form_hidden('id',$transaction['id']);
		?>
		<p class="btn btn-success">Selesai</p>
		<?php } ?>
		</form>
	</td>
	
	<?php endforeach;?>
	</tr>
	
</tbody>
</table>
<!-- End Table with stripped rows -->

<?= $this->endSection() ?>