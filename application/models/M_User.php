<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_User extends CI_Model {

	function getuser(){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $this->db->where("statusanggota = 'anggota'");
        $query = $this->db->get('tb_anggota');
    	return $query->result();
    }

    function getjumlahwilayah($id){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $this->db->where('id_korwil', $id);
        $query = $this->db->get('tb_anggota');
        return $query->result();
    }

    function get_listuser($id){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $this->db->where("statusanggota != 'menunggu konfirmasi'");
        $this->db->group_start();
        $this->db->like('nama', $id);
        $this->db->or_like('noanggota', $id);
        $this->db->group_end();
        $query = $this->db->get('tb_anggota');
        return $query->result();
    }

    function getall(){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        // $this->db->join('tb_korwil', 'tb_korwil.id_korwil = tb_anggota.id_korwil');
        $query = $this->db->get('tb_anggota');
        return $query->result();
    }

    function getaktif(){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $this->db->where("statusanggota != 'menunggu konfirmasi'");
        $this->db->where("statusanggota != 'tidak aktif'");
        $query = $this->db->get('tb_anggota');
        return $query->result();
    }



    function getnama($ida){
        $where = array(
            'id_anggota' => $ida
        );
        return $this->db->get_where('tb_anggota',$where)->result();
    }

    function cek_user($kode){
        $this->db->select('*');
        $where = array(
            'username' => $kode
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->result();
    }

     public function upload(){
        $file_name = $this->input->post('foto');
        $path= FCPATH.'images';
        //echo $path;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['remove_space'] = TRUE;
        $config['width']= '3000';
        $config['height']= '4000';
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->initialize($config);
        if($this->upload->do_upload('foto')){ // Lakukan upload dan Cek jika proses upload berhasil
           $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else{
            $return = array('result' => 'failed', 'error' => $this->upload->display_errors());
            return $return; 
        }
    
    }

    public function uploadfile(){
        $file_name = $this->input->post('filekt');
        $path= FCPATH.'karyatulis';
        //echo $path;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'pdf|docs|doc';
        $config['max_size'] = '10240';
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->initialize($config);
        if($this->upload->do_upload('filekt')){ // Lakukan upload dan Cek jika proses upload berhasil
           $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else{
            $return = array('result' => 'failed', 'error' => $this->upload->display_errors());
            return $return; 
        }
    
    }
    
    function selectmax(){
        $this->db->select_max('id_anggota');
        $result = $this->db->get('tb_anggota');
        return $result->result();
    }

    function tambahdata($upload, $uploadfile){
        $user = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'id_kota' => $this->input->post('kota'),
            'id_provinsi' => $this->input->post('prov'),
            'id_kecamatan' => $this->input->post('kecamatan'),
            'email' => $this->input->post('email'),
            'tlp' => $this->input->post('tlp'),
            'tempatlahir' => $this->input->post('tempatlahir'),
            'tgllahir' => $this->input->post('tgllahir'),
            'facebook' => $this->input->post('fb'),
            'instagram' => $this->input->post('ig'),
            'twitter' => $this->input->post('tw'),
            'youtube' => $this->input->post('yt'),
            'foto' => $upload['file']['file_name'],
            'tglupdate' => date('Y-m-d h:i:s'),
            'tglregistrasi' => date('Y-m-d'),
            'latarbelakang' => $this->input->post('latarbelakang'),
            'institusi' => $this->input->post('institusi')
        );
        
        return $this->db->insert('tb_anggota', $user);

        $this->db->select_max('id_anggota');
        $res1 = $this->db->get('tb_anggota');
        if($res1->num_rows()>0){
            $res2 = $res1->result_array();
            $result = $res2[0]['id_anggota'];

            $user = array(
            'id_anggota' => $a,
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => date('Y-m-d'),
            'file' =>$uploadfile['file']['file_name']
            );
            
            $this->db->insert('tb_karyatulis', $user);
        } else {
            $user = array(
            'id_anggota' => '1',
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => date('Y-m-d'),
            'file' =>$uploadfile['file']['file_name']
        );
        
        $this->db->insert('tb_karyatulis', $user);
        }
    }

    function daftarulang($upload){
        $user = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'id_kota' => $this->input->post('kota'),
            'id_provinsi' => $this->input->post('prov'),
            'id_kecamatan' => $this->input->post('kecamatan'),
            'email' => $this->input->post('email'),
            'tlp' => $this->input->post('tlp'),
            'tempatlahir' => $this->input->post('tempatlahir'),
            'tgllahir' => $this->input->post('tgllahir'),
            'facebook' => $this->input->post('fb'),
            'instagram' => $this->input->post('ig'),
            'twitter' => $this->input->post('tw'),
            'youtube' => $this->input->post('yt'),
            'foto' => $upload['file']['file_name'],
            'tglupdate' => date('Y-m-d h:i:s'),
            'tglregistrasi' => date('Y-m-d'),
            'latarbelakang' => $this->input->post('latarbelakang'),
            'institusi' => $this->input->post('institusi')
        );
        
        return $this->db->insert('tb_anggota', $user);

        $this->db->select_max('id_anggota');
        $res1 = $this->db->get('tb_anggota');
        if($res1->num_rows()>0){
            $res2 = $res1->result_array();
            $result = $res2[0]['id_anggota'];

            $user = array(
            'id_anggota' => $a,
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => date('Y-m-d'),
            'file' =>$uploadfile['file']['file_name']
            );
            
            $this->db->insert('tb_karyatulis', $user);
        } else {
            $user = array(
            'id_anggota' => '1',
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => date('Y-m-d'),
            'file' =>$uploadfile['file']['file_name']
        );
        
        $this->db->insert('tb_karyatulis', $user);
        }
    }

    function karyatulisregistrasi($uploadfile, $a){
        $user = array(
            'id_anggota' => $a,
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => date('Y-m-d'),
            'file' =>$uploadfile['file']['file_name']
        );
        
        $this->db->insert('tb_karyatulis', $user);
    }

    function tambahregis($upload){
        $user = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'id_kota' => $this->input->post('kota'),
            'id_provinsi' => $this->input->post('prov'),
            'id_kecamatan' => $this->input->post('kecamatan'),
            'email' => $this->input->post('email'),
            'tlp' => $this->input->post('tlp'),
            'tempatlahir' => $this->input->post('tempatlahir'),
            'tgllahir' => date('Y-m-d', strtotime($this->input->post('tgllahir'))),
            'facebook' => $this->input->post('fb'),
            'instagram' => $this->input->post('ig'),
            'twitter' => $this->input->post('tw'),
            'youtube' => $this->input->post('yt'),
            'foto' => $upload['file']['file_name'],
            'tglupdate' => date('Y-m-d h:i:s'),
            'tglregistrasi' => date('Y-m-d'),
            'latarbelakang' => $this->input->post('latarbelakang1').'/'.$this->input->post('latarbelakang2').'/'.$this->input->post('latarbelakang3'),
            'institusi' => $this->input->post('institusi'),
            'namapanggilan' =>$this->input->post('namapanggilan'),
            'username' => $this->input->post('namapanggilan'),
            'statusanggota' => 'anggota',
            'password' =>$this->input->post('namapanggilan').date('Y', strtotime($this->input->post('tgllahir'))),
        );
        
        return $this->db->insert('tb_anggota', $user);
    }

    function tambahkaryatulis(){
        $user = array(
            'id_anggota' => $this->input->post('noanggota'),
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => $this->input->post('tgl'),
        );
        
        $this->db->insert('tb_karyatulis', $user);
    }

    function editkt(){
        $user = array(
            'karyatulis' => $this->input->post('karyatulis'),
            'tglpublish' => $this->input->post('tgl'),

        );
        $where = array(
            'id_anggota' =>  $this->input->post('noanggota'),
            'id_karyatulis' =>  $this->input->post('idkt'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_karyatulis',$user);
    }

     function mengundurkandiri(){
        $user = array(
            'alasan' => $this->input->post('resign'),
            'statusanggota' => 'tidak aktif',
            'tglnonaktif' => date('Y-m-d'),
        );
        $where = array(
            'id_anggota' =>  $this->input->post('noanggota'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }

    function nonaktif(){
        $user = array(
            'statusanggota' => 'tidak aktif',
            'tglnonaktif' => date('Y-m-d'),
        );
        $where = array(
            'id_anggota' =>  $this->input->post('noanggota'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }

    function aktif(){
        $user = array(
            'statusanggota' => 'anggota',
            'tglnonaktif' => '',
            'alasan' => '',
        );
        $where = array(
            'id_anggota' =>  $this->input->post('noanggota'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }

    function getspek($iduser){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $where = array(
            'tb_anggota.id_anggota' => $iduser
        );
        $query = $this->db->get_where('tb_anggota', $where);
    	return $query->result();
    }

    function getkaryatulis($iduser){
        $where = array(
            'id_anggota' => $iduser
        );
        $query = $this->db->get_where('tb_karyatulis', $where);
        return $query->result();
    }

    function geteditkt($iduser){

        $this->db->join('tb_anggota', 'tb_anggota.id_anggota = tb_karyatulis.id_anggota');
        $where = array(
            'id_karyatulis' => $iduser
        );
        $query = $this->db->get_where('tb_karyatulis', $where);
        return $query->result();
    }

    function edit(){
        $user = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'id_kota' => $this->input->post('kota'),
            'id_provinsi' => $this->input->post('prov'),
            'id_kecamatan' => $this->input->post('kecamatan'),
            'email' => $this->input->post('email'),
            'tlp' => $this->input->post('tlp'),
            'tempatlahir' => $this->input->post('tempatlahir'),
            'tgllahir' => $this->input->post('tgllahir'),
            'facebook' => $this->input->post('facebook'),
            'instagram' => $this->input->post('instagram'),
            'twitter' => $this->input->post('twitter'),
            'youtube' => $this->input->post('youtube'),
            'latarbelakang' => $this->input->post('latarbelakang'),
            'institusi' => $this->input->post('institusi'),
            'statusanggota' => $this->input->post('aktivasi'),
            'alasan' => $this->input->post('reason'),
            'id_user' => $this->session->userdata('id_user'),
            'tglupdate' => date('Y-m-d h:i:s'),
        );

        $where = array(
            'id_anggota' =>  $this->input->post('id'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }

    function konfirm($id, $a){
        
        $user = array(
            'noanggota' => $a,
            'statusanggota' => 'anggota',
            'id_korwil' => $this->input->post('korwil'),
            'id_user' => $id,
            'tglupdate' => date('Y-m-d h:i:s'),
        );

        $where = array(
            'id_anggota' =>  $this->input->post('idanggota'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }   

    function noanggota($kode){
        
        $user = array(
            'noanggota' => $kode,
            'id_korwil' => $this->input->post('korwil')
        );

        $where = array(
            'nik' =>  $this->input->post('nik'),
        );
        
        $this->db->where($where);
        $this->db->update('tb_anggota',$user);
    }   

    public function save($a){
        $kar = $this->input->post('kar');
        $karya = explode('/', $kar);
        foreach ($karya as $key) {
            if ($key != "0"){
            $barangb = explode("_", $key);
            $data = array('karyatulis'=>$barangb[2],
            'id_anggota' => $a,
            'jenis'=>$barangb[1], 
            'penerbit'=>$barangb[3],  
            'tglpublish'=>$barangb[0]);

            $this->db->insert('tb_karyatulis', $data);
            }
        }   
      }
    
    function dataanggota(){
        $query = $this->db->get('tb_anggota');
        return $query->num_rows();
    } 

    function dataaktif(){
        $where = array(
            'statusanggota !=' => 'menunggu konfirmasi',
            'statusanggota != ' => 'tidak aktif',
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->num_rows();
    } 

    function datanonaktif(){
        $where = array(
            'statusanggota' => 'tidak aktif',
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->num_rows();
    } 

    function datakaryatulis(){
        $query = $this->db->get('tb_karyatulis');
        return $query->num_rows();
    } 

    function listkaryatulis(){
        $this->db->order_by('tglpublish', 'DESC');
        return $this->db->get('tb_karyatulis', 10)->result();
    } 

    function datawaiting(){
        $where = array(
            'statusanggota' => 'menunggu konfirmasi',
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->result();
    } 

     function listanggota($a){
        $where = array(
            'id_korwil' => $a,
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->result();
        
    }

     function getkorwilmutasi($iduser){
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_anggota.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id_kota = tb_anggota.id_kota');
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_anggota.id_kecamatan');
        $this->db->join('tb_korwil', 'tb_korwil.id_korwil = tb_anggota.id_korwil');
        $where = array(
            'tb_anggota.id_anggota' => $iduser
        );
        $query = $this->db->get_where('tb_anggota', $where);
        return $query->result();
    }


}