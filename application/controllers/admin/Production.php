<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Production");
    $this->load->model("M_Inventory2");
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

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "production-table";

      // proses pengambilan data Inventory
      $data["inventory"] = $this->M_Inventory2->getAll(); //proses dilakukan di model
      
      $this->load->view('admin/production/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "production-add";
      // proses pengambilan data Inventory
      $data["inventory"] = $this->M_Inventory2->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Production->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Production->insert());
        redirect(site_url("admin/production/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/production/add.php', $data);
      }
    }
  }
  
  public function edit($encrypt_id=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      if ($encrypt_id != null) {
        $data["session"] = $sess;
        $data["sidebar"] = "production-add";
        $data["encrypt_id"] = $encrypt_id;
        // proses pengambilan data Inventory
        $data["inventory"] = $this->M_Inventory2->getAll(); //proses dilakukan di model

        $secret_key = $this->M_Production->secret_key ;
        $secret_iv = $this->M_Production->secret_iv ;
        $kode_produksi = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["production"] = $this->M_Production->getById($kode_produksi);

        if ($data["production"] == null) {
          redirect(site_url("admin/production/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Production->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Production->update($kode_produksi));
            redirect(site_url("admin/production/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/production/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/production/table"),"refresh");
      }
    }
	}
}
