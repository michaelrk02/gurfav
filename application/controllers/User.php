<?php

class User extends CI_Controller {

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
        redirect(site_url('user/vote_list'));
    }

    public function auth() {
        if (isset($this->session->gurfav_auth)) {
            redirect(site_url('user'));
        }

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            $password = $this->input->post('password');

            if (md5($password) === $this->info_model->get('password')) {
                $this->session->gurfav_auth = TRUE;
                redirect(site_url('user'));
            } else {
                $this->data['status'] = status_failure('Sorry lur dudu kui password e');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }
        $this->render('templates/header');
        $this->render('user/auth');
        $this->render('templates/footer');
    }

    public function vote_list($category = '10_sci', $search = '_', $page = 1) {
        $this->auth_check();

        if ($search === '_') { $search = ''; }
        $search = base64_decode(urldecode($search));

        $items = $this->teachers_model->items;

        $this->data['teachers_all'] = $this->teachers_model->get_all_nofilter();

        $this->data['search'] = $search;
        $this->data['items'] = $items;
        $this->data['teachers'] = $this->teachers_model->get_all($search, $page);
        $this->data['category'] = $category;

        $count = $this->teachers_model->get_all_count($search);
        $this->data['page_max'] = ceil($count / $items);
        $this->data['page_max'] = $this->data['page_max'] == 0 ? 1 : $this->data['page_max'];

        if ($page == 0) { $page = 1; }
        if ($page > $this->data['page_max']) { $page = $this->data['page_max']; }

        $this->data['page'] = $page;

        $this->render('templates/header');
        $this->render('user/vote_list');
        $this->render('templates/footer');
    }

    public function vote($name, $category) {
        $this->auth_check();

        $name = base64_decode(urldecode($name));

        if (!$this->teachers_model->vote($name, $category)) {
            $this->data['status'] = status_failure('Terjadi kesalahan saat voting. Mohon coba lagi');
        }

        $this->data['category'] = $category;

        $this->render('templates/header');
        $this->render('user/vote_finish');
        $this->render('templates/footer');
    }

    public function logout() {
        $this->auth_check();

        unset($_SESSION['gurfav_auth']);
        redirect(site_url('user'));
    }

    private function auth_check() {
        if (!isset($this->session->gurfav_auth)) {
            redirect(site_url('user/auth'));
        }
    }

    private function render($page) {
        $this->load->view($page, $this->data);
    }

}

?>
