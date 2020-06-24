<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Human extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Human");
  }

  public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "human-table";
      $this->load->view('admin/human/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "human-add";

      $this->form_validation->set_rules($this->M_Human->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Human->insert());
        redirect(site_url("admin/human/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/human/add.php', $data);
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
        $data["sidebar"] = "human-add";
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Human->secret_key ;
        $secret_iv = $this->M_Human->secret_iv ;
        $id_pegawai = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["human"] = $this->M_Human->getById($id_pegawai);

        if ($data["human"] == null) {
          redirect(site_url("admin/human/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Human->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Human->update($id_pegawai));
            redirect(site_url("admin/human/edit"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/human/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/human/table"),"refresh");
      }
    }
  }
}
