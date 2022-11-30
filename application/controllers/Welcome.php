<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$essay 	= $this->db->query("(SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='E' AND a.id_ujian='1' ORDER BY RAND() LIMIT 5)
		UNION 
		(SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='M' AND a.id_ujian='1' ORDER BY RAND() LIMIT 8) 
		UNION 
		(SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='H' AND a.id_ujian='1' ORDER BY RAND() LIMIT 8)")->result();


		$no = 1;
		foreach ($essay as $e) {
			echo "$no.  Soal: Type " . $e->type_soal . " (" . $e->jenis_soal . ")<br>";
			$no++;
		}
	}
}
