<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Production extends CI_Model {
  private $table = "production"; // table in database
  public $secret_key = "ProductionKey" ; // random character
  public $secret_iv = "ProductionIV"; // random character
  
  public function __construct(){
      parent::__construct();
      $this->load->library('encryption');
  }

  public function rules(){
    return array(
      array(  'field' => '_kodeproduksi_',
              'label' => 'Kode Produksi',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),

      array(  'field' => '_namaproduk_',
              'label' => 'Nama Produk',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[45]'),

      array(  'field' => '_jumlahproduksi_',
              'label' => 'Jumlah Produksi',
              'rules' => 'required|trim|numeric|min_length[1]|max_length[11]'),

      array(  'field' => '_biayaproduksi_',
              'label' => 'Biaya Produksi',
              'rules' => 'required|trim|numeric|min_length[3]|max_length[10]'),

      array(  'field' => '_checkfile_',
              'label' => 'Image',
              'rules' => 'callback_checkFileImg'),

      array(  'field' => '_kodebahan_',
              'label' => 'Nama Bahan',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[10]'),
    );
  }

  public function getById($kode_produksi){
    return $this->db->get_where($this->table, array("kode_produksi" => $kode_produksi) )->row_array();
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

  public function uploadImage($oldpath=null, $name="_image_"){
    if( file_exists($_FILES[$name]['tmp_name']) ){
      $config['upload_path']          = './uploads/production/';
      $config['allowed_types']        = 'jpg|png|jpeg';
      $config['max_size']             = 1024; // 1MB
      $config['max_width']            = 1920; // pixel
      $config['max_height']           = 1080; // pixel
      $config['overwrite']            = TRUE;
      $config['encrypt_name']         = TRUE;
      $config['remove_spaces']		    = TRUE;
  
      $this->load->library("upload", $config);
      if ( ! $this->upload->do_upload($name)){
        $response = array(
          "status" => "error",
          "message" => $this->upload->display_errors()
        );
      }else{
        if ($oldpath != null) {
          if (file_exists($oldpath)) {
            unlink($oldpath);
          }
        }

        $response = array(
          "status" => "success",
          "message" => "Image uploaded successfully.",
          "data" => $this->upload->data()
        );
      }

    } else {
      $response = array(
        "status" => "empty",
        "message" => "Choose file to upload."
      );
    }

    return $response;
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $uploadimg = $this->uploadImage();
        if ($uploadimg["status"] == "error") {
          $response = array(
            "status" => "error",
            "message" => $uploadimg["message"],
          );

        } else {
          $data = array(
            "kode_produksi"         => htmlspecialchars($post["_kodeproduksi_"]),
            "tanggal_produksi"      => date("Y-m-d"),
            "nama_produk"           => htmlspecialchars($post["_namaproduk_"]),
            "jumlah_produksi"       => htmlspecialchars($post["_jumlahproduksi_"]),
            "biaya_produksi"        => htmlspecialchars($post["_biayaproduksi_"]),
            "gambar_produksi"       => "default.png",
            "inventory_kode_bahan"  => htmlspecialchars($post["_kodebahan_"]),
          );
          if ($uploadimg["status"] == "success") {
            $data["gambar_produksi"] = $uploadimg["data"]["file_name"];
          }

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
        }
      } else {
        $response = array(
          "status" => "error",
          "message" => "Data not found!",
        );
      }
      return $response;
    }

  public function update($kode_produksi){
    $post = $this->input->post();
    if (!empty($post)){

      $production = $this->getById($kode_produksi);
      if ($production["gambar_produksi"] != "default.png") {
        $oldpath = "./uploads/production/".$production["gambar_produksi"];
      } else {
        $oldpath = NULL;
      } 
      $uploadimg = $this->uploadImage($oldpath);

      if ($uploadimg["status"] == "error") {
        $response = array(
          "status" => "error",
          "message" => $uploadimg["message"],
        );

      } else {
        $data = array(
          "kode_produksi"         => htmlspecialchars($post["_kodeproduksi_"]),
          "tanggal_produksi"      => htmlspecialchars($post["_tanggalproduksi_"]),
          "nama_produk"           => htmlspecialchars($post["_namaproduk_"]),
          "jumlah_produksi"       => htmlspecialchars($post["_jumlahproduksi_"]),
          "biaya_produksi"        => htmlspecialchars($post["_biayaproduksi_"]),
          "inventory_kode_bahan"  => htmlspecialchars($post["_kodebahan_"]),
        );

        if ($uploadimg["status"] == "success") {
          $data["gambar_produksi"] = $uploadimg["data"]["file_name"];
        }

        $data = $this->security->xss_clean($data);
        $this->db->where("kode_produksi", $kode_produksi);
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