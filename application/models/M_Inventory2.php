<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Inventory2 extends CI_Model {
  private $table = "inventory"; // table in database
  public $secret_key = "InventoryKey" ; // random character
  public $secret_iv = "InventoryIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_kodebahan_',
              'label' => 'Kode Bahan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_tanggal_',
              'label' => 'Tanggal',
              'rules' => 'required|trim|alpha_numeric_spaces'),

      array(  'field' => '_namabahan_',
              'label' => 'Nama Bahan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_stokmasuk_',
              'label' => 'Stok Masuk',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_stokkeluar_',
              'label' => 'Stok Keluar',
              'rules' => 'required|trim|numeric|min_length[31|max_length[11]'),

    );
  }

  public function getById($kode_bahan){
    return $this->db->get_where($this->table, array("kode_bahan" => $kode_bahan) )->row_array();
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
        "kode_bahan"           => htmlspecialchars($post["_kodebahan_"]),
        "tanggal"              => htmlspecialchars($post["_tanggal_"]),
        "nama_bahan"           => htmlspecialchars($post["_namabahan_"]),
        "stok_masuk"           => htmlspecialchars($post["_stokmasuk_"]),
        "stok_keluar"          => htmlspecialchars($post["_stokkeluar_"]),
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

  public function update($kode_bahan){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "kode_bahan"           => htmlspecialchars($post["_kodebahan_"]),
        "tanggal"              => htmlspecialchars($post["_tanggal_"]),
        "nama_bahan"           => htmlspecialchars($post["_namabahan_"]),
        "stok_masuk"           => htmlspecialchars($post["_stokmasuk_"]),
        "stok_keluar"          => htmlspecialchars($post["_stokkeluar_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("kode_bahan", $kode_bahan);
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