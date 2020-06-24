<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentManagement extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_DocumentManagement");
  }

  public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "documentmanagement-table";
      $this->load->view('admin/documentmanagement/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "documentmanagement-add";

      $this->form_validation->set_rules($this->M_DocumentManagement->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_DocumentManagement->insert());
        redirect(site_url("admin/documentmanagement/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/documentmanagement/add.php', $data);
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
        $data["sidebar"] = "documentmanagement-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_DocumentManagement->secret_key ;
        $secret_iv = $this->M_DocumentManagement->secret_iv ;
        $no_surat = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["documentmanagement"] = $this->M_DocumentManagement->getById($no_surat);

        if ($data["documentmanagement"] == null) {
          redirect(site_url("admin/documentmanagement/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_DocumentManagement->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_DocumentManagement->update($no_surat));
            redirect(site_url("admin/documentmanagement/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/documentmanagement/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/documentmanagement/table"),"refresh");
      }
    }
  }
}
