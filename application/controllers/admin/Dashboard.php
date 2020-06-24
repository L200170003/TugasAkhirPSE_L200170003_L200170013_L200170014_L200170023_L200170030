<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
	}

  public function index(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      $data = array();
      $this->form_validation->set_rules($this->M_Auth->rules());

      if ($this->form_validation->run() === TRUE) {
        $login = $this->M_Auth->login();
        if ($login["status"] == "success") {
          redirect(site_url("admin/dashboard/home"),"refresh");
        } else {
          $this->session->set_flashdata("notif", $login);
          redirect(site_url("admin/dashboard"),"refresh");
        }

      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata('notif')) {
          $data['notif'] = $this->session->flashdata('notif');
        }
        $this->load->view('admin/home/login.php', $data); 
      }

    } else {
      redirect(site_url("admin/dashboard/home"),"refresh");
    }
  }

  public function home(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "dashboard";
      $this->load->view('admin/home/dashboard.php', $data);
    }
  }

  public function logout(){
    $this->M_Auth->logout();
  }
}

?>