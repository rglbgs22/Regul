<?php

class Users_model extends CI_Model
{
    private $_table = "users";

    public function create($data){
        try {
            $this->db->insert($this->_table,$data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    
    public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('username', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // periksa role-nya
            $role = $user->role;

            // jika password benar dan dia admin
            if($isPasswordTrue){ 
                if ($role === 'owner' || $role === 'kasir' || $role === 'customer') {
                    // login sukses yay!
                    $this->session->set_userdata(['user_logged' => $user]);
                    $this->_updateLastLogin($user->user_id);
                    return $role;
                }else{
		            return false;
                }
            }
        }
        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }
}
?>