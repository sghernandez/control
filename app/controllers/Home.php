<?php 
class Home extends Controller{

    public function __construct() {
        auth();
    }

    public function index()
    {
        $this->view('home/index');
    }

}