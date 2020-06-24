<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Marketing2 extends CI_Model {
  private $table = "marketing"; // table in database
  public $secret_key = "MarketingKey" ; // random character
  public $secret_iv = "MarketingIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_kodemarketing_',
              'label' => 'Kode Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_namamarketing_',
              'label' => 'Nama Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_targetmarketing_',
              'label' => 'Target Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_biayamarketing_',
              'label' => 'Biaya Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_kodeproduksi_',
              'label' => 'Kode Produksi',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

    );
  }

  public function getById($kode_marketing){
    return $this->db->get_where($this->table, array("kode_marketing" => $kode_marketing) )->row_array();
  }

  public function getAll($fields=null) {
    if($fields != null){
      $this->db->select($fields);
    }

    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "kode_marketing"              => htmlspecialchars($post["_kodemarketing_"]),
        "nama_marketing"              => htmlspecialchars($post["_namamarketing_"]),
        "target_marketing"            => htmlspecialchars($post["_targetmarketing_"]),
        "biaya_marketing"             => htmlspecialchars($post["_biayamarketing_"]),
        "production_kode_produksi"    => htmlspecialchars($post["_kodeproduksi_"]),
      );

      $data = $this->security->xss_clean($data);
      if($this->db->insert($this->table, $data)){
        $response = array(
          "status" => "success",
          "message" => "Success insert data",
        );
      } else {
        $response = array(
          "status" => "error",
          "message" => "Failed insert data",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;
  }

  public function update($kode_marketing){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "kode_marketing"              => htmlspecialchars($post["_kodemarketing_"]),
        "nama_marketing"              => htmlspecialchars($post["_namamarketing_"]),
        "target_marketing"            => htmlspecialchars($post["_targetmarketing_"]),
        "biaya_marketing"             => htmlspecialchars($post["_biayamarketing_"]),
        "production_kode_produksi"    => htmlspecialchars($post["_kodeproduksi_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("kode_marketing", $kode_marketing);
      if($this->db->update($this->table, $data)){
        $response = array(
          "status" => "success",
          "message" => "Success update data",
        );
      } else {
        $response = array(
          "status" => "error",
          "message" => "Failed update data",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;
  }

}
?>