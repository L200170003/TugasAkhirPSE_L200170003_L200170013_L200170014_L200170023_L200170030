<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing2 extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Purchasing2");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "purchasing-table";
      $this->load->view('admin/purchasing/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "purchasing-add";
      // proses pengambilan data Purchasing
      $data["purchasing"] = $this->M_Purchasing2->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Purchasing2->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Purchasing2->insert());
        redirect(site_url("admin/purchasing/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/purchasing/add.php', $data);
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
        $data["sidebar"] = "purchasing-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Purchasing2->secret_key ;
        $secret_iv = $this->M_Purchasing2->secret_iv ;
        $id_vendor = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["purchasing"] = $this->M_Purchasing2->getById($id_vendor);

        if ($data["purchasing"] == null) {
          redirect(site_url("admin/purchasing/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Purchasing2->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Purchasing2->update($id_vendor));
            redirect(site_url("admin/purchasing/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/purchasing/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/purchasing/table"),"refresh");
      }
    }
	}
}
