<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<div class="row">
    <?php foreach ($produks as $index => $produk) : ?>
        <div class="col-lg-4">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $produk['id']);
            echo form_hidden('nama', $produk['nama']);
            if($produk['diskon']==0){
                echo form_hidden('hrg', $produk['hrg']);
            }else{
                echo form_hidden('hrg', $produk['hargadiskon']);
            }
            echo form_hidden('foto', $produk['foto']);
            ?>
            <div class="card">
                <div class="card-body">
                    <?php
                    if($produk['diskon']!=0):
                        ?>
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">
                        Diskon<br><?= $produk['diskon']?>%
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <?php endif;?>
                    <img src="<?php echo base_url() . "public/img/" . $produk['foto'] ?>" alt="..." class="card-img-top">
                    <h5 class="card-title"><?php echo $produk['nama'] ?><br>
                    <?php 
                        if($produk['diskon']==0){
                            echo number_to_currency($produk['hrg'], 'IDR');
                        }else{
                            ?>
                            <s class="text-secondary">
                                <?php echo number_to_currency($produk['hrg'], 'IDR');?>
                            </s>
                                <?php echo number_to_currency($produk['hargadiskon'], 'IDR');
                        }
                    ?></h5>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>