<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Perhitungan_model');
        }

        public function index()
        {
            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}
			$data = [
                'page' => "Perhitungan",
                'kriteria'=> $this->Perhitungan_model->get_kriteria(),
                'alternatif'=> $this->Perhitungan_model->get_alternatif()
            ];
			
            $this->load->view('Perhitungan/perhitungan', $data);
        }
		
		public function hasil()
        {
            $kriteria = $this->Perhitungan_model->get_kriteria();
            $alternatif = $this->Perhitungan_model->get_alternatif();
			foreach($alternatif as $keys){

            }
			$this->Perhitungan_model->hapus_hasil();
            $no = 1;
            $total = 0;
            $Ki = 0;
            $Si = 0;
            $PreSi = 0;
            $trigger = 0;
			foreach($kriteria as $key) {
                $sum_alternatif = 0;
                $data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
                $min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
                $x = $data_pencocokan['nilai'];
                if(stripos($key->sifat,"benefit") !== false){
                    foreach ($alternatif as $keyss) {
                        $m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
                        $sum_alternatif = $sum_alternatif + $m['nilai'];
                    };
                    $A = $min_max['max'];
                    $sum_alternatif = $sum_alternatif + $A = $min_max['max'];
                }
                else if(stripos($key->sifat,"cost")  !== false){
                    foreach ($alternatif as $keyss) {
                        $m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
                        $sum_alternatif = 1/($sum_alternatif + $m['nilai']);
                    };
                    $A = $min_max['min'];
                    $sum_alternatif = $sum_alternatif + $A = $min_max['max'];
                }
                $hasil= @(round(($A)/($sum_alternatif),4));
                $z =  $key->bobot;
                $hasil = $hasil * $z;
                $total = $total + $hasil;
                $PreSi = $total; 
        	} 
			
            $no++;
            foreach ($alternatif as $keys) : 
                
                foreach ($kriteria as $key) : 
                        $sum_alternatif = 0;
                        $data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
                        $min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
                        $x = $data_pencocokan['nilai'];
                        if(stripos($key->sifat,"benefit") !== false){
                            foreach ($alternatif as $keyss) {
                                $m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
                                $sum_alternatif = $sum_alternatif + $m['nilai'];
                            };
                            $A = $min_max['max'];
                            $sum_alternatif = $sum_alternatif + $A;
                            $hasil= @(round(($x)/($sum_alternatif),4));
                        }
                        else if(stripos($key->sifat,"cost")  !== false){
                            foreach ($alternatif as $keyss) {
                                $m = $this->Perhitungan_model->data_nilai($keyss->id_alternatif, $key->id_kriteria);
                                $sum_alternatif = 1/($sum_alternatif + $m['nilai']);
                            };
                            $A = $min_max['min'];
                            $sum_alternatif = 1/($sum_alternatif + $A);
                            $hasil= @(round((1/$x)/($sum_alternatif),4));
                        }
                        $z =  $key->bobot;
                        $hasil = $hasil * $z;
                        $total = $total + $hasil;
                        echo $hasil;
                endforeach;
                $Si = $total - $PreSi; 
                $no++;

                $hasil_akhir = [
					'id_alternatif' => $keys->id_alternatif,
					'nilai' => $Si
				];
                $result = $this->Perhitungan_model->insert_nilai_hasil($hasil_akhir);
            endforeach;

			$data = [
                'page' => "Hasil",
				'hasil'=> $this->Perhitungan_model->get_hasil()
            ];
			
            $this->load->view('Perhitungan/hasil', $data);
        }
    
    }
    
    