<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Accounting extends CI_Model {
  private $table = "accounting"; // table in database
  public $secret_key = "AccountingKey" ; // random character
  public $secret_iv = "AccountingIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_idaccounting_',
              'label' => 'Id Accounting',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_keterangan_',
              'label' => 'Keterangan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[0]|max_length[45]'),

      array(  'field' => '_kodemarketing_',
              'label' => 'Kode Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),
        
      array(  'field' => '_kodepenjualan_',
              'label' => 'Kode Penjualan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_kodeproduksi_',
              'label' => 'Kode Produksi',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_idvendor_',
              'label' => 'Id Vendor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_kodepayroll_',
              'label' => 'Kode Payroll',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),
        
    );
  }

  public function getById($id_accounting){
    return $this->db->get_where($this->table, array("id_accounting" => $id_accounting) )->row_array();
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
        "id_accounting"             => htmlspecialchars($post["_idaccounting_"]),
        "tanggal_accounting"        => date("Y-m-d"),
        "keterangan"                => htmlspecialchars($post["_keterangan_"]),
        "marketing_kode_marketing"  => htmlspecialchars($post["_kodemarketing_"]),
        "sales_kode_penjualan"      => htmlspecialchars($post["_kodepenjualan_"]),
        "production_kode_produksi"  => htmlspecialchars($post["_kodeproduksi_"]),
        "purchasing_id_vendor"      => htmlspecialchars($post["_idvendor_"]),
        "payroll_kode_payroll"      => htmlspecialchars($post["_kodepayroll_"]),
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

  public function update($id_accounting){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "id_accounting"             => htmlspecialchars($post["_idaccounting_"]),
        "tanggal_accounting"        => htmlspecialchars($post["_tanggalaccounting_"]),
        "keterangan"                => htmlspecialchars($post["_keterangan_"]),
        "marketing_kode_marketing"  => htmlspecialchars($post["_kodemarketing_"]),
        "sales_kode_penjualan"      => htmlspecialchars($post["_kodepenjualan_"]),
        "production_kode_produksi"  => htmlspecialchars($post["_kodeproduksi_"]),
        "purchasing_id_vendor"      => htmlspecialchars($post["_idvendor_"]),
        "payroll_kode_payroll"      => htmlspecialchars($post["_kodepayroll_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("id_accounting", $id_accounting);
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