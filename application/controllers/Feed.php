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

					$pc_text_chat = $this->input->post("chatboard");
					$userID = $this->session->userdata("sess_id");

					if($textChat==""){

						$result["message"]="Chat kosong";

					}
					else if($this->session->userdata('sess_email')==""){

						$result["message"]="Auth time out";

					}
					else {
						$data = array(
							"pc_id"=>"",
							"pc_user_id"=>$userID,
							"pc_text_chat"=>$pc_text_chat,
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



					 echo json_encode($result);
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
