<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Sales2 extends CI_Model {
  private $table = "sales"; // table in database
  public $secret_key = "SalesKey" ; // random character
  public $secret_iv = "SalesIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_kodepenjualan_',
              'label' => 'Kode Penjualan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_ppn_',
              'label' => 'PPN',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_hargajual_',
              'label' => 'Harga Jual',
              'rules' => 'required|trim|numeric|min_length[3]|max_length[10]'),

      array(  'field' => '_jumlahprodukterjual_',
              'label' => 'Jumlah Produk Terjual',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_kodedistributor_',
              'label' => 'Kode Distributor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_namadistributor_',
              'label' => 'Nama Distributor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),
      
      array(  'field' => '_alamatdistributor_',
              'label' => 'Alamat Distributor',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_kodemarketing_',
              'label' => 'Kode Marketing',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_kodeproduksi_',
              'label' => 'Kode Produksi',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

    );
  }

  public function getById($kode_penjualan){
    return $this->db->get_where($this->table, array("kode_penjualan" => $kode_penjualan) )->row_array();
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
        "kode_penjualan"              => htmlspecialchars($post["_kodepenjualan_"]),
        "ppn"                         => htmlspecialchars($post["_ppn_"]),
        "harga_jual"                  => htmlspecialchars($post["_hargajual_"]),
        "jumlah_produkterjual"        => htmlspecialchars($post["_jumlahprodukterjual_"]),
        "kode_distributor"            => htmlspecialchars($post["_kodedistributor_"]),
        "nama_distributor"            => htmlspecialchars($post["_namadistributor_"]),
        "alamat_distributor"          => htmlspecialchars($post["_alamatdistributor_"]),
        "marketing_kode_marketing"    => htmlspecialchars($post["_kodemarketing_"]),
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

  public function update($kode_penjualan){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "kode_penjualan"              => htmlspecialchars($post["_kodepenjualan_"]),
        "ppn"                         => htmlspecialchars($post["_ppn_"]),
        "harga_jual"                  => htmlspecialchars($post["_hargajual_"]),
        "jumlah_produkterjual"        => htmlspecialchars($post["_jumlahprodukterjual_"]),
        "kode_distributor"            => htmlspecialchars($post["_kodedistributor_"]),
        "nama_distributor"            => htmlspecialchars($post["_namadistributor_"]),
        "alamat_distributor"          => htmlspecialchars($post["_alamatdistributor_"]),
        "marketing_kode_marketing"    => htmlspecialchars($post["_kodemarketing_"]),
        "production_kode_produksi"    => htmlspecialchars($post["_kodeproduksi_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("kode_penjualan", $kode_penjualan);
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