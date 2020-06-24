<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales2 extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Sales2");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "sales-table";
      $this->load->view('admin/sales/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "sales-add";
      // proses pengambilan data Sales
      $data["sales"] = $this->M_Sales2->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Sales2->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Sales2->insert());
        redirect(site_url("admin/sales/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/sales/add.php', $data);
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
        $data["sidebar"] = "sales-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Sales2->secret_key ;
        $secret_iv = $this->M_Sales2->secret_iv ;
        $kode_penjualan = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["sales"] = $this->M_Sales2->getById($kode_penjualan);

        if ($data["sales"] == null) {
          redirect(site_url("admin/sales/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Sales2->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Sales2->update($kode_penjualan));
            redirect(site_url("admin/sales/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/sales/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/sales/table"),"refresh");
      }
    }
	}
}
