<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?> 
<div class="row">
	<?php foreach($produks as $index=>$produk): ?> 
	<div class="col-lg-4">
		<div class="card">
			<img src="<?php echo base_url()."public/img/".$produk['foto'] ?>" class="card-img-top" alt="...">
			<div class="card-body">
				<h5 class="card-title"><?php echo $produk['nama'] ?></h5>
				<h6 class="carf-title"><?php echo $produk['hrg'] ?></h6>
			</div>
		</div> 
	</div>
	<?php endforeach ?> 
</div>
<?= $this->endSection() ?>