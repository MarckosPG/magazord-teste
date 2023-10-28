<?php

namespace src\Controller;

use utils\RenderView;

class HomeController extends RenderView {

    public function index () {
        $viewBag = [];
        $this->loadView("home", $viewBag);
    }

}