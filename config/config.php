<?php

namespace config;

class Config {

    public $APP_VERSION = "1.0.0";

    public $TIMEZONE = "+3:00";

    public $DATABASE_DRIVER = "pdo_mysql";
    public $DATABASE_HOST = "localhost";
    public $DATABASE_USER = "root";
    public $DATABASE_PASSWORD = "";
    public $DATABASE_NAME = "magazord_db";

}

require_once "./utils/RenderView.php";
require_once "./utils/Validations.php";