<?php

class Admin extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('status');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('info_model');
        $this->load->model('teachers_model');
    }

    public function index() {
        redirect(site_url('admin/results'));
    }

    public function results() {
        $this->auth_check();

        $categories = array(
            '10_sci' => 'X MIPA',
            '10_soc' => 'X IPS',
            '11_sci' => 'XI MIPA',
            '11_soc' => 'XI IPS',
            '12_sci' => 'XII MIPA',
            '12_soc' => 'XII IPS'
        );

        $winners = array();
        foreach ($categories as $id => $name) {
            $winner = $this->teachers_model->get_winner($id);

            $key = 'voters_'.$id;

            $winners[$id] = array();
            $winners[$id]['name'] = $winner->name;
            $winners[$id]['score'] = $winner->$key;
        }

        $this->data['categories'] = $categories;
        $this->data['winners'] = $winners;

        $this->render('templates/header');
        $this->render('admin/results');
        $this->render('templates/footer');
    }

    public function auth() {
        if (isset($this->session->gurfav_admin_auth)) {
            redirect(site_url('admin'));
        }

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            $password = $this->input->post('password');

            if (md5($password) === $this->info_model->get('password')) {
                $this->session->gurfav_admin_auth = TRUE;
                redirect(site_url('admin'));
            } else {
                $this->data['status'] = status_failure('Sorry lur dudu kui password e');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }
        $this->render('templates/header');
        $this->render('admin/auth');
        $this->render('templates/footer');
    }

    public function logout() {
        $this->auth_check();

        unset($_SESSION['gurfav_admin_auth']);
        redirect(site_url('admin'));
    }

    private function auth_check() {
        if (!isset($this->session->gurfav_admin_auth)) {
            redirect(site_url('admin/auth'));
        }
    }

    private function render($page) {
        $this->load->view($page, $this->data);
    }

}

?>
