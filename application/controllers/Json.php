<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Json extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode(
            array(
                'success' => true,
                'message' => 'online',
            )
        );
    }
    public function get()
    {
        // $json  = file_get_contents(base_url('json'));
        // $data = json_decode($json, TRUE);

        // var_dump($data);
    }
}
