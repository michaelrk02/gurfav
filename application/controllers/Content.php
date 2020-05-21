<?php

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
    }

    public function teacher_image($height, $name) {
        $name = base64_decode(urldecode($name));

        $origpath = FCPATH.'public/img/teacher/'.$name;
        $path = NULL;
        if (!file_exists($path.'.JPG')) {
            $path = substr($origpath, 0, strlen($origpath) - 2);
        }
        if (!file_exists($path.'.JPG')) {
            $path = $origpath.'.';
        }
        if (!file_exists($path.'.JPG')) {
            redirect(site_url('content/default_image'));
        }
        $path .= '.JPG';
        list($w, $h) = getimagesize($path);
        $width = $height / $h * $w;
        $src = imagecreatefromjpeg($path);
        $dst = imagecreatetruecolor($width, $height);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $w, $h);

        ob_start();
        imagejpeg($dst);
        $data = ob_get_contents();
        ob_end_clean();

        imagedestroy($dst);
        imagedestroy($src);

        $this->output->set_header('Cache-Control: max-age=86400');
        $this->output->set_content_type('image/jpeg');
        $this->output->set_status_header(200);
        $this->output->set_output($data);
    }

    public function file($mime, ...$relpath) {
        $path = FCPATH.implode('/', $relpath);
        if (file_exists($path)) {
            $this->output->set_header('Cache-Control: max-age=86400');
            $this->output->set_content_type($mime);
            $this->output->set_status_header(200);
            $this->output->set_output(file_get_contents($path));

            return;
        }

        $this->output->set_status_header(404);
    }

    public function file_js(...$relpath) {
        return $this->file('text/javascript', ...$relpath);
    }

    public function file_css(...$relpath) {
        return $this->file('text/css', ...$relpath);
    }

    public function file_img_png(...$relpath) {
        return $this->file('image/png', ...$relpath);
    }

    public function file_img_jpeg(...$relpath) {
        return $this->file('image/jpeg', ...$relpath);
    }

    public function default_image() {
        $path = FCPATH.'public/img/default.JPG';
        $data = file_get_contents($path);

        $this->output->set_header('Cache-Control: max-age=86400');
        $this->output->set_content_type('image/jpeg');
        $this->output->set_status_header(200);
        $this->output->set_output($data);
    }

}

?>
