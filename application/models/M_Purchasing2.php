<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Purchasing2 extends CI_Model {
  private $table = "purchasing"; // table in database
  public $secret_key = "PurchasingKey" ; // random character
  public $secret_iv = "PurchasingIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_idvendor_',
              'label' => 'ID Vendor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_jumlahbahan_',
              'label' => 'Jumlah Bahan',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_hargasatuan_',
              'label' => 'Harga Satuan',
              'rules' => 'required|trim|numeric|min_length[3]|max_length[10]'),

      array(  'field' => '_totalharga_',
              'label' => 'Total Harga',
              'rules' => 'required|trim|numeric|min_length[3]|max_length[10]'),

      array(  'field' => '_namavendor_',
              'label' => 'Nama Vendor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),
      
      array(  'field' => '_alamatvendor_',
              'label' => 'Alamat Vendor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_kodebahan_',
              'label' => 'Kode Bahan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

    );
  }

  public function getById($id_vendor){
    return $this->db->get_where($this->table, array("id_vendor" => $id_vendor) )->row_array();
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
        "id_vendor"              => htmlspecialchars($post["_id_vendor_"]),
        "nama_vendor"            => htmlspecialchars($post["_namavendor_"]),
        "alamat_vendor"          => htmlspecialchars($post["_alamatvendor_"]),
        "tanggal_beli"           => date("Y-m-d"),
        "harga_satuan"           => htmlspecialchars($post["_hargasatuan_"]),
        "jumlah_bahan"           => htmlspecialchars($post["_jumlahbahan_"]),
        "total_harga"            => htmlspecialchars($post["_totalharga_"]),
        "inventory_kode_bahan"   => htmlspecialchars($post["_kodebahan_"]),
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

  public function update($id_vendor){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "id_vendor"              => htmlspecialchars($post["_id_vendor_"]),
        "nama_vendor"            => htmlspecialchars($post["_namavendor_"]),
        "alamat_vendor"          => htmlspecialchars($post["_alamatvendor_"]),
        "tanggal_beli"           => date("Y-m-d"),
        "harga_satuan"           => htmlspecialchars($post["_hargasatuan_"]),
        "jumlah_bahan"           => htmlspecialchars($post["_jumlahbahan_"]),
        "total_harga"            => htmlspecialchars($post["_totalharga_"]),
        "inventory_kode_bahan"   => htmlspecialchars($post["_kodebahan_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("id_vendor", $id_vendor);
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