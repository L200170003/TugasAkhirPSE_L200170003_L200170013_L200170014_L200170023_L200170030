<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account extends CI_Model {
  private $table = "account"; // table in database
  public $secret_key = "AccountKey" ; // random character
  public $secret_iv = "AccountIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules($post = array()) {
    // $post is input post
    // dynamic rules, according to the existing input

    $rules = array();
    if (isset($post["_name_"])) {
      $rules[] = array( 'field' => '_name_',
                        'label' => 'Name',
                        'rules' => 'required|trim|alpha_numeric_spaces|min_length[4]|max_length[20]');
    }
    
    if (isset($post["_username_"])) {
      $rules[] = array( 'field' => '_username_',
                        'label' => 'Username',
                        'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[12]|is_unique[account.account_username]',
                        'errors' => array('is_unique' => 'This %s already exists.'));
    }

    if (isset($post["_password_"])) {
      $rules[] = array( 'field' => '_password_',
                        'label' => 'Password',
                        'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[20]');
    }

    if (isset($post["_passconf_"])) {
      $rules[] = array( 'field' => '_passconf_',
                        'label' => 'Confirm Password',
                        'rules' => 'required|trim|matches[_password_]');
    }

    if (isset($post["_level_"])) {
      $rules[] =  array( 'field' => '_level_',
                        'label' => 'Level',
                        'rules' => 'required|trim|alpha|in_list[root,admin,user]');
    }

    if (isset($post["_checkfile_"])) {
      $rules[] = array( 'field' => '_checkfile_',
                        'label' => 'Image',
                        'rules' => 'callback_checkFileImg');
    }

    return $rules;
  
  }

  public function getById($id){
    return $this->db->get_where($this->table, array("account_id" => $id) )->row_array();
  }

  public function getAll($fields=null) {
    if($fields != null){
      $this->db->select($fields);
    }

    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

  public function uploadImage($oldpath=null, $name="_image_"){
    if( file_exists($_FILES[$name]['tmp_name']) ){
      $config['upload_path']          = './uploads/account/';
      $config['allowed_types']        = 'jpg|png|jpeg';
      $config['max_size']             = 1024; // 1MB
      $config['max_width']            = 1920; // pixel
      $config['max_height']           = 1080; // pixel
      $config['overwrite']            = TRUE;
      $config['encrypt_name']         = TRUE;
      $config['remove_spaces']		    = TRUE;
  
      $this->load->library("upload", $config);
      if ( ! $this->upload->do_upload($name)){
        $response = array(
          "status" => "error",
          "message" => $this->upload->display_errors()
        );
      }else{
        if ($oldpath != null) {
          if (file_exists($oldpath)) {
            unlink($oldpath);
          }
        }

        $response = array(
          "status" => "success",
          "message" => "Image uploaded successfully.",
          "data" => $this->upload->data()
        );
      }

    } else {
      $response = array(
        "status" => "empty",
        "message" => "Choose file to upload."
      );
    }

    return $response;
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $check = $this->db->get_where($this->table, array("account_username"=>htmlspecialchars($post["_username_"])))->num_rows();
      if ($check > 0) {
        $response = array(
          "status" => "error",
          "message" => "This username already exists",
        );

      } else {
        if ($post["_password_"] === $post["_passconf_"]) {
          $uploadimg = $this->uploadImage();
          if ($uploadimg["status"] == "error") {
            $response = array(
              "status" => "error",
              "message" => $uploadimg["message"],
            );

          } else {
            date_default_timezone_set('Asia/Jakarta');
            $data = array(
              "account_id"           => NULL,
              "account_name"         => htmlspecialchars($post["_name_"]),
              "account_username"     => strtolower(htmlspecialchars($post["_username_"])),
              "account_password"     => password_hash(strtolower($post["_password_"]), PASSWORD_BCRYPT, array('cost'=>8)),
              "account_lastpassword" => password_hash(strtolower($post["_password_"]), PASSWORD_BCRYPT, array('cost'=>8)),
              "account_isactive"     => "true",
              "account_createat"     => date("Y-m-d H:i:s"),
              "account_modifyat"     => date("Y-m-d H:i:s"),
              "account_level"        => strtolower(htmlspecialchars($post["_level_"])),
              "account_image"        => "default.png",
            );
            if ($uploadimg["status"] == "success") {
              $data["account_image"] = $uploadimg["data"]["file_name"];
            }

            $data = $this->security->xss_clean($data);
            if($this->db->insert($this->table, $data)){
              $response = array(
                "status" => "success",
                "message" => "Success insert data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed insert data",
              );
            }
          } 
        } else {
          $response = array(
            "status" => "error",
            "message" => "Confirm password must be correct!",
          );
        }
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }

    return $response;
  }

  public function update($id){
    $post = $this->input->post();
    if (!empty($post)){

      if (!empty($post["_username_"])) {
        $check = $this->db->get_where($this->table, array("account_username"=>htmlspecialchars($post["_username_"])))->num_rows();
        if ($check > 0) {
          $username = array(
            "status" => "error",
            "message" => "This username already exists",
          );
        } else {
          $username = TRUE;
        }
      } else {
        $username = TRUE;
      }

      if (!empty($post["_password_"]) && !empty($post["_passconf_"])) {
        if ($post["_password_"] === $post["_passconf_"]) {
          $password = TRUE;
        } else {
          $password = array(
            "status" => "error",
            "message" => "Confirm password must be correct!",
          );
        }
      } else {
        $password = TRUE;
      }

      if ($username == TRUE && $password == TRUE) {
        $account = $this->getById($id);
        if ($account["account_image"] != "default.png") {
          $oldpath = "./uploads/account/".$account["account_image"];
        } else {
          $oldpath = NULL;
        } 
        $uploadimg = $this->uploadImage($oldpath);

        if ($uploadimg["status"] == "error") {
          $response = array(
            "status" => "error",
            "message" => $uploadimg["message"],
          );

        } else {
          date_default_timezone_set('Asia/Jakarta');
          $data = array(
            "account_name"         => htmlspecialchars($post["_name_"]),
            "account_lastpassword" => $account["account_password"],
            "account_modifyat"     => date("Y-m-d H:i:s")
          );

          if ($uploadimg["status"] == "success") {
            $data["account_image"] = $uploadimg["data"]["file_name"];
          }
          if (!empty($post["_username_"])) {
            $data["account_username"] = strtolower(htmlspecialchars($post["_username_"]));
          }
          if (!empty($post["_password_"]) && !empty($post["_passconf_"])) {
            $data["account_password"] = password_hash(strtolower($post["_password_"]), PASSWORD_BCRYPT, array('cost'=>8));
          }
          if (!empty($post["_level_"])) {
            $data["account_level"] = strtolower(htmlspecialchars($post["_level_"]));
          }

          $data = $this->security->xss_clean($data);
          $this->db->where("account_id", $id);
          if($this->db->update($this->table, $data)){
            $response = array(
              "status" => "success",
              "message" => "Success update data",
            );
          } else {
            $response = array(
              "status" => "error",
              "message" => "Failed update data",
            );
          }
        }
      } else {
        if ($username != TRUE) {
          $response = $username;
        } else {
          $response = $password;
        }
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;
  }

  public function delete($id){
    return $this->db->delete($this->table, array("account_id" => $id) );
  }

}
?>