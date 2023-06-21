<?php namespace App\Models;

		use CodeIgniter\Model;

		class ProdukModel extends Model
		{
			protected $table = 'brg'; 
			protected $primaryKey = 'id';
			protected $allowedFields = [
				'nama','jenis','hrg','ket','foto','stok'
			];  
		}