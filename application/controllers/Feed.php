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
