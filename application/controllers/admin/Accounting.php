<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Accounting");
    $this->load->model("M_Marketing2");
    $this->load->model("M_Sales2");
    $this->load->model("M_Production");
    $this->load->model("M_Purchasing2");
    $this->load->model("M_Payroll2");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "accounting-table";

      // proses pengambilan data Marketing
      $data["marketing"] = $this->M_Marketing2->getAll(); //proses dilakukan di model

      // proses pengambilan data Sales
      $data["sales"] = $this->M_Sales2->getAll(); //proses dilakukan di model

      // proses pengambilan data Production
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

      // proses pengambilan data Purchasing
      $data["purchasing"] = $this->M_Purchasing2->getAll(); //proses dilakukan di model

      // proses pengambilan data Payroll
      $data["payroll"] = $this->M_Payroll2->getAll(); //proses dilakukan di model

      $this->load->view('admin/accounting/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "accounting-add";

      // proses pengambilan data Marketing
      $data["marketing"] = $this->M_Marketing2->getAll(); //proses dilakukan di model

      // proses pengambilan data Sales
      $data["sales"] = $this->M_Sales2->getAll(); //proses dilakukan di model

      // proses pengambilan data Production
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

      // proses pengambilan data Purchasing
      $data["purchasing"] = $this->M_Purchasing2->getAll(); //proses dilakukan di model

      // proses pengambilan data Payroll
      $data["payroll"] = $this->M_Payroll2->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Accounting->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Accounting->insert());
        redirect(site_url("admin/accounting/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/accounting/add.php', $data);
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
        $data["sidebar"] = "accounting-add";
        $data["encrypt_id"] = $encrypt_id;

        // proses pengambilan data Marketing
        $data["marketing"] = $this->M_Marketing2->getAll(); //proses dilakukan di model

        // proses pengambilan data Sales
        $data["sales"] = $this->M_Sales2->getAll(); //proses dilakukan di model

        // proses pengambilan data Production
        $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

        // proses pengambilan data Purchasing
        $data["purchasing"] = $this->M_Purchasing2->getAll(); //proses dilakukan di model

        // proses pengambilan data Payroll
        $data["payroll"] = $this->M_Payroll2->getAll(); //proses dilakukan di model

        $secret_key = $this->M_Accounting->secret_key ;
        $secret_iv = $this->M_Accounting->secret_iv ;
        $id_accounting = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["accounting"] = $this->M_Accounting->getById($id_accounting);

        if ($data["accounting"] == null) {
          redirect(site_url("admin/accounting/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Accounting->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Accounting->update($id_accounting));
            redirect(site_url("admin/accounting/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/accounting/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/accounting/table"),"refresh");
      }
    }
	}
}
