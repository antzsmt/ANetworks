<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {


  public function getTimestamp()
  {
    $date = new DateTime();
    $date = $date->getTimestamp();
    return $date;
  }

  public function getUsernameID($id)
  {
    return $this->db->query("SELECT username FROM ac_users WHERE id = '".$id."'")->row_array()['username'];
  }

  public function getEmailID($id)
  {
    return $this->db->query("SELECT email FROM ac_users WHERE id = '".$id."'")->row_array()['email'];
  }

  public function getPermission($id)
  {
      return $this->db->query("SELECT permission FROM ac_ranks WHERE id = '".$id."'")->row_array()['permission'];
  }

  public function getRankinfo()
  {
      $username = $this->session->userdata('ac_sess_username');
      return $this->db->query("SELECT permission FROM ac_ranks WHERE username = '$username'");
  }


  public function getIDAccount()
  {
    $account = $_POST['username'];
    $qq = $this->db->query("SELECT id FROM ac_users WHERE username = '".$account."'");
    $query = $qq->row();
    if ($qq->num_rows() > 0)
        return $query->id;
    else
        return "0";
  }


  public function arraySession($id)
  {
  $data = array
  (
    'ac_sess_username' => $this->getUsernameID($id),
    'ac_sess_id'		=> $this->getIDAccount(),
    'ac_sess_rank' => $this->getPermission($id),
    'logged_in' => TRUE
  );
    return $this->sessionConnect($data);
  }

  public function getPasswordAccountID($id)
  {
    $qq = $this->db->query("SELECT password FROM ac_users WHERE id = '".$id."'")->row();
    return $qq->password;
  }

  public function sessionConnect($data)
  {
    $this->session->set_userdata($data);
    redirect(base_url(),'refresh');
  }

  public function getExpansion($expansion)
  {
    
  }

}
