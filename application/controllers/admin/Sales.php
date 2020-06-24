<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Sales");
    $this->load->model("M_Marketing");
    $this->load->model("M_Production");
  }

  public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "sales-table";

      // proses pengambilan data Marketing
      $data["marketing"] = $this->M_Marketing->getAll(); //proses dilakukan di model

      // proses pengambilan data Production
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

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

      // proses pengambilan data Marketing
      $data["marketing"] = $this->M_Marketing->getAll(); //proses dilakukan di model

      // proses pengambilan data Production
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model


      $this->form_validation->set_rules($this->M_Sales->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Sales->insert());
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

        // proses pengambilan data Marketing
        $data["marketing"] = $this->M_Marketing->getAll(); //proses dilakukan di model

        // proses pengambilan data Production
        $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model


        $secret_key = $this->M_Sales->secret_key ;
        $secret_iv = $this->M_Sales->secret_iv ;
        $no_surat = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["sales"] = $this->M_Sales->getById($no_surat);

        if ($data["sales"] == null) {
          redirect(site_url("admin/sales/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Sales->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Sales->update($no_surat));
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
