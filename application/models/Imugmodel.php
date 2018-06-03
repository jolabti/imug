<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imugmodel extends CI_Model {

	  public function cek_user($email, $password){

          $this->db->where("users_email", trim($email));
          $this->db->where("users_password", trim($password));

          return $this->db->get("imug_users")->num_rows();


    }
	  public function get_user($email, $password){

          $this->db->where("users_email", trim($email));
          $this->db->where("users_password", trim($password));

          return $this->db->get("imug_users")->row();


    }
		public function get_user_total(){

					$this->db->where("users_role_id",2);
		      return $this->db->get("imug_users")->num_rows();
		}
		public function get_chat_total(){


		      return $this->db->get("imug_personal_chat")->num_rows();
		}


    public function post_chat($pcuserid,$pctextchat){





            $data = array(
              'pc_id' =>"" ,
              'pc_user_id' =>$pcuserid ,
              'pc_text_chat' =>$pctextchat ,
              'pc_status' =>1

            );

	            $this->db->insert("imug_personal_chat", $data);

    }


		public function post_temp_chat($data){

				  $this->db->insert("imug_personal_chat", $data);
		}

    public function get_chat_communication(){
            $this->db->select('*');
            $this->db->from('imug_personal_chat');
            $this->db->join('imug_users', 'imug_personal_chat.pc_user_id = imug_users.users_id');
						$this->db->order_by("imug_personal_chat.pc_time", "desc");
						$this->db->limit(5);
            $q = $this->db->get();
            return $q->result();
    }



}
