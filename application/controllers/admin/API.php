<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Account");
    $this->load->model("M_DocumentManagement");
    $this->load->model("M_Marketing");
    $this->load->model("M_Sales");
    $this->load->model("M_Payroll");
    $this->load->model("M_Human");
    $this->load->model("M_Production");
    $this->load->model("M_Accounting");
    $this->load->model("M_Purchasing");
    $this->load->model("M_Inventory");


  }

  public function account($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Account->secret_key ;
      $secret_iv = $this->M_Account->secret_iv ;

      if (strtolower($mode) == "data") {
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $query = $this->db->get("account");
          if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $value) {
              $data[$key]["account_id"] = encrypt_decrypt("encrypt", $value["account_id"], $secret_key, $secret_iv);
            }
            echo json_encode($data);
          } else {
            echo json_encode(false);
          }
        }
      } 
      
      elseif (strtolower($mode) == "update") {
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $post = $this->input->post();
          if ( !empty($post["id"]) && !empty($post["isactive"]) ) {
            $isactive = "true";
            if ($post["isactive"] == "true") {
              $isactive = "false";
            }
            $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
            $account = $this->db->get_where("account", array("account_id" => $id) )->row_array();
            if ($account["account_level"] != "root") {
              $this->db->where("account_id", $id);
              if($this->db->update("account", array("account_isactive"=>$isactive)) ){
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
                "message" => "Root user cannot be disabled",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
          echo json_encode($response);
        }
      }

      elseif (strtolower($mode) == "delete"){
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $post = $this->input->post();
          if (!empty($post["id"])) {
            $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
            $account = $this->M_Account->getById($id);
            if ($account != null){
              $oldpath = "./uploads/account/".$account["account_image"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              $this->db->where("account_id", $id);
              if($this->db->delete("account")){
                $response = array(
                  "status" => "success",
                  "message" => "Success delete data",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete data",
                );
              }
            } else {
              $response = array(
                "status" => "error",
                "message" => "Data not found!",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
          echo json_encode($response);
        }
      }

      elseif (strtolower($mode) == "delete-img"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $account = $this->M_Account->getById($id);
          if ($account != null){
            if ($account["account_image"] != "default.png") {
              $oldpath = "./uploads/account/".$account["account_image"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              if ($this->db->update("account", array("account_image" => "default.png"))){
                $this->M_Auth->refreshSession($id);
                $response = array(
                  "status" => "success",
                  "message" => "Success delete image",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete image",
                );
              }
            } else {
              $response = array(
                "status" => "success",
                "message" => "Success delete image",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function documentmanagement($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_DocumentManagement->secret_key ;
      $secret_iv = $this->M_DocumentManagement->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("document_management");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["no_surat"] = encrypt_decrypt("encrypt", $value["no_surat"], $secret_key, $secret_iv);
            $data[$key]["id_original"] = ($value["no_surat"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $documentmanagement = $this->M_DocumentManagement->getById($id);
          if ($documentmanagement != null){
            $this->db->where("no_surat", $id);
            if($this->db->delete("document_management")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

//MARKETING

  public function marketing($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Marketing->secret_key ;
      $secret_iv = $this->M_Marketing->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("marketing");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["kode_marketing"] = encrypt_decrypt("encrypt", $value["kode_marketing"], $secret_key, $secret_iv);
            $data[$key]["id_original"] = ($value["kode_marketing"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $marketing = $this->M_Marketing->getById($id);
          if ($marketing != null){
            $this->db->where("kode_marketing", $id);
            if($this->db->delete("marketing")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

//SALES
  
  public function sales($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Sales->secret_key ;
      $secret_iv = $this->M_Sales->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("sales");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["kode_penjualan"] = encrypt_decrypt("encrypt", $value["kode_penjualan"], $secret_key, $secret_iv);
            $data[$key]["id_original"] = ($value["kode_penjualan"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $sales = $this->M_Sales->getById($id);
          if ($sales != null){
            $this->db->where("kode_penjualan", $id);
            if($this->db->delete("sales")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  
  public function payroll($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Payroll->secret_key ;
      $secret_iv = $this->M_Payroll->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->query("select kode_payroll, bulan, tahun, gaji_perjam, gaji_perjam * jam_kerja * 26 as gaji_perbulan, nama_pegawai from payroll left join human on payroll.human_id_pegawai = human.id_pegawai");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["kode_payroll"] = encrypt_decrypt("encrypt", $value["kode_payroll"], $secret_key, $secret_iv); // Ini
            $data[$key]["id_original"] = ($value["kode_payroll"]);
            $data[$key]["gaji_perjam"] = rupiah($value["gaji_perjam"]);
            $data[$key]["gaji_perbulan"] = rupiah($value["gaji_perbulan"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["kode_payroll"])) {
          $kode_payroll = encrypt_decrypt("decrypt", $post["kode_payroll"], $secret_key, $secret_iv);
          $payroll = $this->M_Payroll->getById($kode_payroll);
          if ($payroll != null){
            $this->db->where("kode_payroll", $kode_payroll);
            if($this->db->delete("payroll")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function production($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Production->secret_key ;
      $secret_iv = $this->M_Production->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->query("select * from production left join inventory ON production.inventory_kode_bahan = inventory.kode_bahan");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["kode_produksi"] = encrypt_decrypt("encrypt", $value["kode_produksi"], $secret_key, $secret_iv);
            $data[$key]["kode_original"] = $value["kode_produksi"];
            $data[$key]["biaya_produksi"] = rupiah($value["biaya_produksi"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["kode_produksi"])) {
          $kode_produksi = encrypt_decrypt("decrypt", $post["kode_produksi"], $secret_key, $secret_iv);
          $production = $this->M_Production->getById($kode_produksi);
          if ($kode_produksi != null){
            $oldpath = "./uploads/production/".$production["gambar_produksi"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              $this->db->where("kode_produksi", $kode_produksi);
              if($this->db->delete("production")){
                $response = array(
                  "status" => "success",
                  "message" => "Success delete data",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete data",
                );
              }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }

      elseif (strtolower($mode) == "delete-img"){
        $post = $this->input->post();
        if (!empty($post["kode_produksi"])) {
          $kode_produksi = encrypt_decrypt("decrypt", $post["kode_produksi"], $secret_key, $secret_iv);
          $production = $this->M_Production->getById($kode_produksi);
          if ($production != null){
            if ($production["gambar_produksi"] != "default.png") {
              $oldpath = "./uploads/production/".$production["gambar_produksi"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              if ($this->db->update("production", array("gambar_produksi" => "default.png"))){
                $this->M_Auth->refreshSession($id);
                $response = array(
                  "status" => "success",
                  "message" => "Success delete image",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete image",
                );
              }
            } else {
              $response = array(
                "status" => "success",
                "message" => "Success delete image",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function accounting($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Accounting->secret_key ;
      $secret_iv = $this->M_Accounting->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->query("select id_accounting, tanggal_accounting, biaya_marketing + biaya_produksi + total_harga + gaji_perbulan as pengeluaran, harga_jual * jumlah_produkterjual as pemasukan, keterangan from accounting, marketing, sales, production, purchasing, payroll where accounting.marketing_kode_marketing = marketing.kode_marketing AND accounting.sales_kode_penjualan = sales.kode_penjualan AND accounting.production_kode_produksi = production.kode_produksi AND accounting.purchasing_id_vendor = purchasing.id_vendor AND accounting.payroll_kode_payroll = payroll.kode_payroll");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["id_accounting"] = encrypt_decrypt("encrypt", $value["id_accounting"], $secret_key, $secret_iv);
            $data[$key]["id_original"] = $value["id_accounting"];
            $data[$key]["pengeluaran"] = rupiah($value["pengeluaran"]);
            $data[$key]["pemasukan"] = rupiah($value["pemasukan"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id_accounting"])) {
          $id_accounting = encrypt_decrypt("decrypt", $post["id_accounting"], $secret_key, $secret_iv);
          $accounting = $this->M_Accounting->getById($id_accounting);
          if ($accounting != null){
            $this->db->where("id_accounting", $id_accounting);
            if($this->db->delete("accounting")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }


  public function human($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Human->secret_key ;
      $secret_iv = $this->M_Human->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("human");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["id_pegawai"] = encrypt_decrypt("encrypt", $value["id_pegawai"], $secret_key, $secret_iv);
            $data[$key]["id_original"] = ($value["id_pegawai"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $human = $this->M_Human->getById($id);
          if ($human != null){
            $this->db->where("id_pegawai", $id);
            if($this->db->delete("human")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function inventory($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Inventory->secret_key ;
      $secret_iv = $this->M_Inventory->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("inventory");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["kode_bahan"] = encrypt_decrypt("encrypt", $value["kode_bahan"], $secret_key, $secret_iv); // Ini
            $data[$key]["id_original"] = ($value["kode_bahan"]);
            //$data[$key]["commodity_price"] = rupiah($value["commodity_price"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["kode_bahan"])) {
          $kode_bahan = encrypt_decrypt("decrypt", $post["kode_bahan"], $secret_key, $secret_iv);
          $inventory = $this->M_Inventory->getById($kode_bahan);
          if ($inventory != null){
            $this->db->where("kode_bahan", $kode_bahan);
            if($this->db->delete("inventory")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function purchasing($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Purchasing->secret_key ;
      $secret_iv = $this->M_Purchasing->secret_iv ;
  
      if (strtolower($mode) == "data") {
        $query = $this->db->query("select id_vendor, nama_vendor, alamat_vendor, tanggal_beli, jumlah_bahan, harga_satuan, jumlah_bahan * harga_satuan as total_harga, nama_bahan from purchasing left join inventory on purchasing.inventory_kode_bahan = inventory.kode_bahan");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["id_vendor"] = encrypt_decrypt("encrypt", $value["id_vendor"], $secret_key, $secret_iv); // Ini
            $data[$key]["id_original"] = ($value["id_vendor"]);
            $data[$key]["harga_satuan"] = rupiah($value["harga_satuan"]);
            $data[$key]["total_harga"] = rupiah($value["total_harga"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 
  
      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $purchasing = $this->M_Purchasing->getById($id);
          if ($purchasing != null){
            $this->db->where("id_vendor", $id);
            if($this->db->delete("purchasing")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

}
?>