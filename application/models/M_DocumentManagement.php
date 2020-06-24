<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DocumentManagement extends CI_Model {
  private $table = "document_management"; // table in database
  public $secret_key = "DocumentManagementKey" ; // random character
  public $secret_iv = "DocumentManagementIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_nosurat_',
              'label' => 'No Surat',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_jenissurat_',
              'label' => 'Jenis Surat',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_pengirimsurat_',
              'label' => 'Pengirim Surat',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[45]'),

      array(  'field' => '_tujuansurat_',
              'label' => 'Tujuan Surat',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[45]'),
    );
  }

  public function getById($id){
    return $this->db->get_where($this->table, array("no_surat" => $id) )->row_array();
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
        "no_surat"        => htmlspecialchars($post["_nosurat_"]),
        "jenis_surat"     => htmlspecialchars($post["_jenissurat_"]),
        "pengirim_surat"  => htmlspecialchars($post["_pengirimsurat_"]),
        "tujuan_surat"    => htmlspecialchars($post["_tujuansurat_"]),
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
        "no_surat"        => htmlspecialchars($post["_nosurat_"]),
        "jenis_surat"     => htmlspecialchars($post["_jenissurat_"]),
        "pengirim_surat"  => htmlspecialchars($post["_pengirimsurat_"]),
        "tujuan_surat"    => htmlspecialchars($post["_tujuansurat_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("no_surat", $id);
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