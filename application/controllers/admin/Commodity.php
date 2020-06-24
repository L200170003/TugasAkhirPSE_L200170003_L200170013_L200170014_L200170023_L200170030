<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Commodity extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Commodity");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "commodity-table";
      $this->load->view('admin/commodity/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "commodity-add";

      $this->form_validation->set_rules($this->M_Commodity->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Commodity->insert());
        redirect(site_url("admin/commodity/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/commodity/add.php', $data);
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
        $data["sidebar"] = "commodity-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Commodity->secret_key ;
        $secret_iv = $this->M_Commodity->secret_iv ;
        $commodity_id = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["commodity"] = $this->M_Commodity->getById($commodity_id);

        if ($data["commodity"] == null) {
          redirect(site_url("admin/commodity/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Commodity->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Commodity->update($commodity_id));
            redirect(site_url("admin/commodity/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/commodity/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/commodity/table"),"refresh");
      }
    }
	}
}
