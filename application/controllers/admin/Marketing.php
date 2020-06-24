<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Marketing");
    $this->load->model("M_Production");
  }

  public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "marketing-table";

      // proses pengambilan data Marketing
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

      $this->load->view('admin/marketing/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "marketing-add";
      // proses pengambilan data Marketing
      $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

      $this->form_validation->set_rules($this->M_Marketing->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Marketing->insert());
        redirect(site_url("admin/marketing/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/marketing/add.php', $data);
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
        $data["sidebar"] = "marketing-add";
        $data["encrypt_id"] = $encrypt_id;
        // proses pengambilan data Marketing
        $data["production"] = $this->M_Production->getAll(); //proses dilakukan di model

        $secret_key = $this->M_Marketing->secret_key ;
        $secret_iv = $this->M_Marketing->secret_iv ;
        $no_surat = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["marketing"] = $this->M_Marketing->getById($no_surat);

        if ($data["marketing"] == null) {
          redirect(site_url("admin/marketing/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Marketing->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Marketing->update($no_surat));
            redirect(site_url("admin/marketing/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/marketing/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/marketing/table"),"refresh");
      }
    }
  }
}
