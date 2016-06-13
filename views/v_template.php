<?php 
echo $this->load->view('main/header');
echo $this->load->view($content);
echo $this->load->view('main/left_menu');
echo $this->load->view('main/right_menu');

?>