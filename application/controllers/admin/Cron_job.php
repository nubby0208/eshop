<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron_job extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'upload']);
        $this->load->helper(['url', 'language', 'file']);
        $this->load->model(['Promo_code_model']);
    }

    public function settle_cashback_discount()
    {
        return $this->Promo_code_model->settle_cashback_discount();
    }
}
