<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

   //Logical Algorithm

	 	public function auth_login(){

					$countUser  = $this->Imugmodel->cek_user($this->input->post("user"), $this->input->post("password"));
					$takeUser  = $this->Imugmodel->get_user($this->input->post("user"), $this->input->post("password"));

					if($countUser>0){
						  $this->session->set_userdata("sess_email", $takeUser->users_email);
						  $this->session->set_userdata("sess_id", $takeUser->users_id);
						  $this->session->set_userdata("sess_role_id", $takeUser->users_role_id);
						  $this->session->set_userdata("sess_logged", "logged");

								if($this->session->userdata("sess_role_id")==1){

											$this->dashmin();

								}
								else if ($this->session->userdata("sess_role_id")==2){

											$this->dash();
								}

					}
					else {

							 $datanewUser = array(
								 "users_id" => "",
								 "users_email" => trim($this->input->post("user")),
								 "users_password" => trim($this->input->post("password")),
								 "users_role_id" => 2,
								 "users_join_date" => date('Y-m-d'),
								 "users_status" => 1
							 );

							 $this->newUser($datanewUser);
					}



		}

		public function newUser($data=array()){

					 $q = $this->Imugmodel->post_new_user($data);
					 $this->dash();

		}

		public function testsesrole(){

				echo $this->session->userdata("sess_role_id");
		}

		public function logout(){
          $this->session->sess_destroy();
					redirect('/');
		}

		public function post_chat_api(){


					$userID = $this->session->userdata("sess_id");

					if($this->input->post('chatboard')==""){

						$result["message"]="Chat kosong";

					}
					else if($this->session->userdata('sess_email')==""){

						$result["message"]="Auth time out";

					}
					else {
						$data = array(
							"pc_id"=>"",
							"pc_user_id"=>$userID,
							"pc_text_chat"=>$this->input->post('chatboard'),
							"pc_status"=>1
						);

						$this->Imugmodel->post_temp_chat($data);
					  $result["message"]="Chat Terkirim";
					}
					echo json_encode($result);
		}


		public function post_chat_random(){


					$userID = $this->session->userdata("sess_id");

					if($this->input->post('chatboard')==""){

						$result["message"]="Chat kosong";

					}
					else if($this->session->userdata('sess_email')==""){

						$result["message"]="Auth time out";

					}
					else {

						for($i=1;$i<=1000;$i++){

							$data = array(
								"pc_id"=>"",
								"pc_user_id"=>$userID,
								"pc_text_chat"=>$this->input->post('chatboard'),
								"pc_status"=>1
							);

							$this->Imugmodel->post_temp_chat($data);

							if($i==1000){

									$result["message"]="Chat Terkirim";
							}
						}

						 echo json_encode($result);

					}
		}

		public function post_chat_json(){

					 if($this->session->userdata("sess_email")!=""){
						   $result["message"] = "Anda berhasil login";
					 }
					 else{
						    $result["message"] = "Silahkan login terlebih dahulu !";
								redirect("/");
					 }
					 echo json_encode($result);
		}

		public function gen_qrcode($text){

						$this->load->library('ciqrcode');

						$params['data'] = $text;
						$params['level'] = 'H';
						$params['size'] = 10;
						$params['savename'] = FCPATH.$text.'.png';
						$this->ciqrcode->generate($params);

						echo '<img src="'.base_url().$text.'.png" />';
		}

		public function get_show_all_chat(){

						$q= $this->Imugmodel->get_chat_communication();

						echo json_encode($q);


		}
		public function get_java_all_chat(){

						$q['data']= $this->Imugmodel->get_chat_communication();

						echo json_encode($q);


		}


	 //================

	 //View Mechanism

	public function index()
	{
		if($this->session->userdata("sess_email")!=""){
			redirect("feed/dash");
		}
		else{
			$this->load->view('adm/v_adm_login');
		}


	}

	public function dash(){
		if($this->session->userdata("sess_email")==""){
			redirect("/");
		}
		else{
			$param["em"] = $this->session->userdata("sess_email");
			$this->load->view('cl/v_header');
			$this->load->view('cl/v_chat_board', $param);
			$this->load->view('cl/v_footer');
		}
	}

	public function dashmin(){
			if($this->session->userdata("sess_email")==""){
				redirect('/');
			}
			else if(($this->session->userdata("sess_email")!="") && $this->session->userdata("sess_role_id")==1){

						$this->load->view('adm/v_adm_dash');


			}
			else {

				 	$q["message"] = "You are not authenticate";
					echo json_encode($q);
			}

			// $this->load->view('adm/v_adm_dash');

			// public function add_posting(){
			// 			$posting = $this->input->post("nama_textfield");
			// 			$gambar = "filename.jpg";
			// 			$data =  array(
			// 				'post_id' => "" ,
			// 				'posting' => $posting ,
			// 				'waktu' => "" ,
			// 				'id_user' => $this->session->userdata('sess_id_user') ,
			// 				'urlgambar' => $gambar
			// 			);
			//
			// 			$this->Imugmodel->insert_posting($data);
			//
			//
			//
			//
			// }



	}

	//=====================

	public function api_chat_total(){

		 $q["total"] = $this->Imugmodel->get_chat_total();

		 echo json_encode($q);
	}
	public function api_user_total(){

		 $q["total"] = $this->Imugmodel->get_user_total();

		 echo json_encode($q);
	}

	public function api_user_datas(){

		 $q["data"] = $this->Imugmodel->get_user_data();
		 $q["message"] = "ok";

		 echo json_encode($q);

	}


	public function tampil_data(){

		$q = $this->Imugmodel->get_chat_communication();
		echo json_encode($q);

	}
	//=====================

	public function api_login($username,$password){


		 //echo $username." ".$password;
		$data="";
		$countUser  = $this->Imugmodel->cek_user($username, $password);
		$takeUser  = $this->Imugmodel->get_user( $username, $password);

		if($countUser>0){
																																//namafield
					$this->session->set_userdata("sess_email", $takeUser->users_email);
					$this->session->set_userdata("sess_id", $takeUser->users_id);
					$this->session->set_userdata("sess_role_id", $takeUser->users_role_id);
					$this->session->set_userdata("sess_logged", "logged");

					$data["message"]= "ok";
					$data["response"]="200";
					$data["email_resp"] = $this->session->userdata("sess_email");
					$data["id_resp"] = $this->session->userdata("sess_id");

		}
		else{

					$data["message"]= "failed";
					$data["response"]="404";
					$data["email_resp"] = $this->session->userdata("sess_email");
					$data["id_resp"] = $this->session->userdata("sess_id");


		}

		echo json_encode($data);




	}

}
