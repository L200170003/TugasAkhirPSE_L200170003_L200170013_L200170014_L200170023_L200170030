<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
  private $table = "account";
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_username_',
              'label' => 'Username',
              'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[12]'),

      array(  'field' => '_password_',
              'label' => 'Password',
              'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[20]'),
    );
  }

  public function login() {
    $post = $this->input->post();
    if (!empty($post["_username_"]) && !empty($post["_password_"])) {
      $username = strtolower($post["_username_"]);
      $password = strtolower($post["_password_"]);

      $getUser = $this->db->get_where($this->table, array("account_username" => $username));
      if ($getUser->num_rows() > 0) {
        $user = $getUser->row_array();
        if ($user["account_isactive"] == "true") {
          if (password_verify($password, $user["account_password"])) {
            $data = [
                "id" => $this->encryption->encrypt($user["account_id"]),
                "name" => $this->encryption->encrypt($user["account_name"]),
                "username" => $this->encryption->encrypt($user["account_username"]),
                "level" => $this->encryption->encrypt($user["account_level"]),
                "image" => $this->encryption->encrypt($user["account_image"]),
            ];
            $this->session->set_userdata($data);
            $response = array(
              "status" => "success",
              "message" => "Login successful!",
            );
          } else {
            $response = array(
              "status" => "error",
              "message" => "Wrong password!",
            );
          }

        } else {
          $response = array(
            "status" => "error",
            "message" => "This username has not been activated!",
          );
        }
      } else {
        $response = array(
          "status" => "error",
          "message" => "Username not found!",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Enter data correctly!",
      );
    }
    return $response;
  }

  public function session($levels=array()){
    $session = $this->session->userdata();
    if (!empty($session)) {
      if (!empty($session["id"]) && !empty($session["name"]) && !empty($session["username"]) && !empty($session["level"]) && !empty($session["image"])) {
        $id = $this->encryption->decrypt($session["id"]);
        $name = $this->encryption->decrypt($session["name"]);
        $username = $this->encryption->decrypt($session["username"]);
        $level = $this->encryption->decrypt($session["level"]);
        $image = $this->encryption->decrypt($session["image"]);
        if (in_array($level, $levels, TRUE)) {
          $data = [
            "id"        => $id,
            "name"      => $name,
            "username"  => $username,
            "level"     => $level,
            "image"     => $image,
          ];
          return $data;
        } else {
          return FALSE;
        }
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  public function refreshSession($id){
    $user = $this->db->get_where($this->table, array("account_id"=>$id))->row_array();
    $data = [
      "id" => $this->encryption->encrypt($user["account_id"]),
      "name" => $this->encryption->encrypt($user["account_name"]),
      "username" => $this->encryption->encrypt($user["account_username"]),
      "level" => $this->encryption->encrypt($user["account_level"]),
      "image" => $this->encryption->encrypt($user["account_image"]),
    ];
    $this->session->set_userdata($data);
    // header("Refresh:0");
  }

  public function logout() {
      $arr = ["id","name","username","level","image"];
      $this->session->unset_userdata($arr);
      $this->session->sess_destroy();
      redirect(site_url("admin/dashboard"),"refresh");
  }

}
?>