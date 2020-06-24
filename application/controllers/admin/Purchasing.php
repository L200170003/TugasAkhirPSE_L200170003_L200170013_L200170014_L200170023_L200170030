<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Purchasing");
    $this->load->model("M_Inventory");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "purchasing-table";

      //proses pengambilan data Inventory
      $data["inventory"] = $this->M_Inventory->getAll();

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

      //proses pengambilan data Inventory
      $data["inventory"] = $this->M_Inventory->getAll();

      $this->form_validation->set_rules($this->M_Purchasing->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Purchasing->insert());
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

        //proses pengambilan data Inventory
        $data["inventory"] = $this->M_Inventory->getAll();

        $secret_key = $this->M_Purchasing->secret_key ;
        $secret_iv = $this->M_Purchasing->secret_iv ;
        $purchasing_id = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["purchasing"] = $this->M_Purchasing->getById($purchasing_id);

        if ($data["purchasing"] == null) {
          redirect(site_url("admin/purchasing/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Purchasing->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Purchasing->update($purchasing_id));
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
