<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

   //Logical Algorithm

	 	public function auth_login(){

					// $countUser["auth"] = $this->Imugmodel->cek_user($this->input->post("user"), $this->input->post("password"));
					// $countUser["personal_data"] = $this->Imugmodel->get_user($this->input->post("user"), $this->input->post("password"));

					$countUser  = $this->Imugmodel->cek_user($this->input->post("user"), $this->input->post("password"));
					$takeUser  = $this->Imugmodel->get_user($this->input->post("user"), $this->input->post("password"));

					if($countUser>0){
						  $this->session->set_userdata("sess_email", $takeUser->users_email);
						  $this->session->set_userdata("sess_id", $takeUser->users_id);
						  $this->session->set_userdata("sess_logged", "logged");

							$this->dash();
					}
					else{
							$this->index();
					}


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

	//=====================

}
