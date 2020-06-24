<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Human extends CI_Model {
  private $table = "human"; // table in database
  public $secret_key = "HumanKey" ; // random character
  public $secret_iv = "HumanIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_idpegawai_',
              'label' => 'ID Pegawai',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_namapegawai_',
              'label' => 'Nama Pegawai',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_alamatpegawai_',
              'label' => 'Alamat',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[15]'),

      array(  'field' => '_telppegawai_',
              'label' => 'Telepon',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[15]'),

      array(  'field' => '_jabatanpegawai_',
              'label' => 'Jabatan',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[15]'),

      array(  'field' => '_divisipegawai_',
              'label' => 'Divisi Pegawai',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[15]'),
      
      array(  'field' => '_jamkerja_',
              'label' => 'Jam Kerja',
              'rules' => 'required|trim|numeric|max_length[15]'),
    );
  }

  public function getById($id){
    return $this->db->get_where($this->table, array("id_pegawai" => $id) )->row_array();
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
        "id_pegawai"          => htmlspecialchars($post["_idpegawai_"]),
        "nama_pegawai"        => htmlspecialchars($post["_namapegawai_"]),
        "alamat_pegawai"      => htmlspecialchars($post["_alamatpegawai_"]),
        "telp_pegawai"        => htmlspecialchars($post["_telppegawai_"]),
        "divisi_pegawai"      => htmlspecialchars($post["_divisipegawai_"]),
        "jabatan_pegawai"     => htmlspecialchars($post["_jabatanpegawai_"]),
        "jam_kerja"           => htmlspecialchars($post["_jamkerja_"]),
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

  public function update($id){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "id_pegawai"          => htmlspecialchars($post["_idpegawai_"]),
        "nama_pegawai"        => htmlspecialchars($post["_namapegawai_"]),
        "alamat_pegawai"      => htmlspecialchars($post["_alamatpegawai_"]),
        "telp_pegawai"        => htmlspecialchars($post["_telppegawai_"]),
        "divisi_pegawai"      => htmlspecialchars($post["_divisipegawai_"]),
        "jabatan_pegawai"     => htmlspecialchars($post["_jabatanpegawai_"]),
        "jam_kerja"           => htmlspecialchars($post["_jamkerja_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("id_pegawai", $id);
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