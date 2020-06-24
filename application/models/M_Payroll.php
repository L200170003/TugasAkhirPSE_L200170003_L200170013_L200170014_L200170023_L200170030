<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Payroll extends CI_Model {
  private $table = "payroll"; // table in database
  public $secret_key = "PayrollKey" ; // random character
  public $secret_iv = "PayrollIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_kodepayroll_',
              'label' => 'Kode Payroll',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

      array(  'field' => '_bulan_',
              'label' => 'Bulan',
              'rules' => 'required|trim|alpha_numeric_spaces'),

      array(  'field' => '_tahun_',
              'label' => 'Tahun',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[4]|max_length[4]'),

      array(  'field' => '_gajiperjam_',
              'label' => 'Gaji Per Jam',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_idpegawai_',
              'label' => 'ID Pegawai',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[1]|max_length[10]'),

    );
  }

  public function getById($kode_payroll){
    return $this->db->get_where($this->table, array("kode_payroll" => $kode_payroll) )->row_array();
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
        "kode_payroll"           => htmlspecialchars($post["_kodepayroll_"]),
        "bulan"                  => htmlspecialchars($post["_bulan_"]),
        "tahun"                  => htmlspecialchars($post["_tahun_"]),
        "gaji_perjam"            => htmlspecialchars($post["_gajiperjam_"]),
        "human_id_pegawai"       => htmlspecialchars($post["_idpegawai_"]),
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

  public function update($kode_payroll){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "kode_payroll"           => htmlspecialchars($post["_kodepayroll_"]),
        "bulan"                  => htmlspecialchars($post["_bulan_"]),
        "tahun"                  => htmlspecialchars($post["_tahun_"]),
        "gaji_perjam"            => htmlspecialchars($post["_gajiperjam_"]),
        "human_id_pegawai"       => htmlspecialchars($post["_idpegawai_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("kode_payroll", $kode_payroll);
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