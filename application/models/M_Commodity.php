<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Commodity extends CI_Model {
  private $table = "commodity"; // table in database
  public $secret_key = "CommodityKey" ; // random character
  public $secret_iv = "CommodityIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_name_',
              'label' => 'Name',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_type_',
              'label' => 'Type',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_price_',
              'label' => 'Price',
              'rules' => 'required|trim|numeric|max_length[15]'),
    );
  }

  public function getById($id){
    return $this->db->get_where($this->table, array("commodity_id" => $id) )->row_array();
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
        "commodity_id"    => NULL,
        "commodity_name"  => htmlspecialchars($post["_name_"]),
        "commodity_type"  => htmlspecialchars($post["_type_"]),
        "commodity_price" => htmlspecialchars($post["_price_"]),
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
        "commodity_name"  => htmlspecialchars($post["_name_"]),
        "commodity_type"  => htmlspecialchars($post["_type_"]),
        "commodity_price" => htmlspecialchars($post["_price_"]),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("commodity_id", $id);
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