<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll2 extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Payroll2");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "payroll-table";
      $this->load->view('admin/payroll/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "payroll-add";
      // proses pengambilan data Payroll
      $data["payroll"] = $this->M_Payroll2->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Payroll2->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Payroll2->insert());
        redirect(site_url("admin/payroll/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/payroll/add.php', $data);
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
        $data["sidebar"] = "payroll-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Payroll2->secret_key ;
        $secret_iv = $this->M_Payroll2->secret_iv ;
        $kode_payroll = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["payroll"] = $this->M_Payroll2->getById($kode_payroll);

        if ($data["payroll"] == null) {
          redirect(site_url("admin/payroll/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Payroll2->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Payroll2->update($kode_payroll));
            redirect(site_url("admin/payroll/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/payroll/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/payroll/table"),"refresh");
      }
    }
	}
}
