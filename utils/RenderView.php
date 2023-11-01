<?php

namespace utils;

class RenderView {

    public function loadView ($view, $args) {
        extract($args);
        require_once "./src/Views/$view.php";
    }

}