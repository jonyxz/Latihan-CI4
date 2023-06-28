<?php

		namespace App\Controllers;

		use App\Models\UserModel;

		class UserController extends BaseController
		{
			protected $user;

			function __construct()
			{
				helper('form');
                
				$this->user = new UserModel();
			}

			public function index()
			{
				$data['users'] = $this->user->findAll();
				return view('pages/user_view', $data);
			}

			public function edit($id)
			{
				$data = $this->request->getPost();

				if($data){
                    if($data){
                        if($data['rolekey']==false){
                            $dataForm = [
                                'status' => $this -> request -> getPost('status')
                            ];
                        }else{
                            $dataForm = [
                                'role' => $this -> request -> getPost('role'),
                                'email' => $this -> request -> getPost('email')
                                
                            ];
                        }
                    }
					$this->user->update($id, $dataForm);

					return redirect('user')->with('success','Data Berhasil Diubah');
				}else{
					return redirect('user')->with('failed','Data Gagal Diubah');
				}
				
			}

			public function delete($id)
			{
				$dataProduk = $this->user->find($id);
				
				$this->user->delete($id);

				return redirect('user')->with('success','Data Berhasil Dihapus');
			}
			

		}
