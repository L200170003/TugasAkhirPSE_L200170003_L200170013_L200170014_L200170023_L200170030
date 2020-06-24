<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Payroll");
    $this->load->model("M_Human");
  }

  public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "payroll-table";

      // proses pengambilan data Human
      $data["human"] = $this->M_Human->getAll(); //proses dilakukan di model

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

      // proses pengambilan data Human
      $data["human"] = $this->M_Human->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Payroll->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Payroll->insert());
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

        // proses pengambilan data Human
        $data["human"] = $this->M_Human->getAll(); //proses dilakukan di model

        $secret_key = $this->M_Payroll->secret_key ;
        $secret_iv = $this->M_Payroll->secret_iv ;
        $no_surat = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["payroll"] = $this->M_Payroll->getById($no_surat);

        if ($data["payroll"] == null) {
          redirect(site_url("admin/payroll/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Payroll->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Payroll->update($no_surat));
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
