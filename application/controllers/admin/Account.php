<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Account");
  }
  
  public function checkFileImg(){
    if (!empty($_FILES)) {
			$phpFileUploadErrors = array(
				0 => 'There is no error, the file uploaded with success',
				1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
				2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
				3 => 'The uploaded file was only partially uploaded',
				4 => 'No file was uploaded',
				6 => 'Missing a temporary folder',
				7 => 'Failed to write file to disk.',
				8 => 'A PHP extension stopped the file upload.',
			);
			$typeFileImg = array("image/jpeg","image/png","image/jpeg","image/x-icon");
      $sizeAllowed = 1024000; // 1MB

      if ($_FILES['_image_']['error'] == 4) {
        return TRUE;
      } elseif ($_FILES['_image_']['error'] == 0) {
        if (in_array($_FILES['_image_']['type'], $typeFileImg) == FALSE) {
          $this->form_validation->set_message('checkFileImg', 'The filetype you are attempting to upload is not allowed.');
          return FALSE;
        } elseif($_FILES['_image_']['size'] > $sizeAllowed){
          $this->form_validation->set_message('checkFileImg', 'The file you are attempting to upload is larger than the permitted size.');
          return FALSE;
        } else {
          return TRUE;
        }
      } else {
        $this->form_validation->set_message('checkFileImg', $phpFileUploadErrors[$_FILES['_image_']['error']]);
        return FALSE;
      }  
		} else {
      return TRUE;
    }
  }

  public function profile(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Account->secret_key ;
      $secret_iv = $this->M_Account->secret_iv ;
      $data["session"] = $sess;
      $data["sidebar"] = NULL;
      $data["account"] = $this->M_Account->getById($sess["id"]);
      $data["encrypt_id"] = encrypt_decrypt("encrypt", $data["account"]["account_id"], $secret_key, $secret_iv);
      $this->load->view("admin/account/profile.php", $data);
    }
  }

  public function editprofile(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["account"] = $this->M_Account->getById($sess["id"]);
      if ($data["account"] == null) {
        redirect(site_url("admin/dashboard/logout"),"refresh");
      } else {
        $secret_key = $this->M_Account->secret_key ;
        $secret_iv = $this->M_Account->secret_iv ;
        $data["session"] = $sess;
        $data["sidebar"] = NULL;
        $data["encrypt_id"] = encrypt_decrypt("encrypt", $sess["id"], $secret_key, $secret_iv);

        $this->form_validation->set_rules($this->M_Account->rules($this->input->post()));
        if ($this->form_validation->run() === TRUE) {
          $this->session->set_flashdata("notif", $this->M_Account->update($sess["id"]));
          $this->M_Auth->refreshSession($sess["id"]);
          redirect(site_url("admin/account/editprofile"),"refresh");

        } else {
          $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
          if ($this->session->flashdata('notif')) {
            $data['notif'] = $this->session->flashdata('notif');
          }
          $this->load->view("admin/account/editprofile.php", $data);
        }
      }
    }
	}

	public function table(){
    $sess = $this->M_Auth->session(array("root"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "account-table";
      $this->load->view("admin/account/table.php", $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "account-add";
      $this->form_validation->set_rules($this->M_Account->rules($this->input->post()));
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Account->insert());
        redirect(site_url("admin/account/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view("admin/account/add.php", $data);
      }
    }
  }
  
  public function edit($encrypt_id=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      if ($encrypt_id != null) {
        $secret_key = $this->M_Account->secret_key ;
        $secret_iv = $this->M_Account->secret_iv ;
        $account_id = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["account"] = $this->M_Account->getById($account_id);

        if (($sess["level"] != "root" && $account_id != $sess["id"]) || $data["account"] == null) {
          redirect(site_url("admin/account/table"),"refresh");
        } else {
          $data["session"] = $sess;
          $data["sidebar"] = "account-edit";
          $data["encrypt_id"] = $encrypt_id;

          $this->form_validation->set_rules($this->M_Account->rules($this->input->post()));
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Account->update($account_id));
            if ($sess["id"] == $account_id) {
              $this->M_Auth->refreshSession($account_id);
            }
            redirect(site_url("admin/account/edit/$encrypt_id"),"refresh");

          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata('notif')) {
              $data['notif'] = $this->session->flashdata('notif');
            }
            $this->load->view("admin/account/edit.php", $data);
          }
        }
      } else {
        redirect(site_url("admin/account/table"),"refresh");
      }
    }
	}
}

?>