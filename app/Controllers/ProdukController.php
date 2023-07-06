<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;

		class ProdukController extends BaseController
		{
			protected $produk;

			function __construct()
			{
				helper('form');
				$this->validation = \Config\Services::validation();
				$this->produk = new ProdukModel();
			}

			public function index()
			{
				$data['produks'] = $this->produk->findAll();
				return view('pages/produk_view', $data);
			}

			public function create()
			{
				$data = $this->request->getPost();
				$validate = $this->validation->run($data, 'barang');
				$errors = $this->validation->getErrors();

				if(!$errors){
					$dataForm = [ 
						'nama' => $this->request->getPost('nama'),
						'hrg' => $this->request->getPost('harga'),
						'stok' => $this->request->getPost('jumlah'),
						'ket' => $this->request->getPost('keterangan')
					];
			
					$dataFoto = $this->request->getFile('foto');
			
					if ($dataFoto->isValid()){
						$fileName = $dataFoto->getRandomName();
						$dataFoto->move('public/img/', $fileName);
						$dataForm['foto'] = $fileName;
					}  
			
					$this->produk->insert($dataForm); 
			
					return redirect('produk')->with('success','Data Berhasil Ditambah');
				}else{
					return redirect('produk')->with('failed',implode("<br>",$errors));
				}    
			}

			public function edit($id)
			{
				$data = $this->request->getPost();
				$validate = $this->validation->run($data, 'barang');
				$errors = $this->validation->getErrors();

				if(!$errors){
					$dataForm = [
						'nama' => $this->request->getPost('nama'),
						'hrg' => $this->request->getPost('harga'),
						'diskon' => $this->request->getPost('diskon'),
						'stok' => $this->request->getPost('jumlah'),
						'ket' => $this->request->getPost('keterangan')
					];

					$diskon = $dataForm['diskon'];
					if ($diskon != 0) {
						$hargaAwal = $dataForm['hrg'];
						$hargaDiskon = $hargaAwal - ($hargaAwal * $diskon / 100);
						$dataForm['hargadiskon'] = $hargaDiskon;
					} else {
						$dataForm['hargadiskon'] = $dataForm['hrg'];
					}
					
					$session = \Config\Services::session();
					$session->setFlashData('success', 'Data berhasil disimpan');

					if($this->request->getPost('check')){
						$dataFoto = $this->request->getFile('foto');
						if ($dataFoto->isValid()){
							$fileName = $dataFoto->getRandomName();
							$dataFoto->move('public/img/', $fileName);
							$dataForm['foto'] = $fileName;
						}             
					}

					$this->produk->update($id, $dataForm);

					return redirect('produk')->with('success','Data Berhasil Diubah');
				}else{
					return redirect('produk')->with('failed',implode("",$errors));
				}
				
			}

			public function delete($id)
			{
				$dataProduk = $this->produk->find($id);
				unlink("public/img/".$dataProduk['foto']);	

				$this->produk->delete($id);

				return redirect('produk')->with('success','Data Berhasil Dihapus');
			}
		}