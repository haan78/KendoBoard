<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once "./private/vendor/autoload.php";
require_once "./private/lib/Minmi.php";
require_once "./private/db.php";

use \Minmi\Router;
use \Minmi\DefaultJsonRouter;
use \Minmi\Request;


try {
    $dotenv = Dotenv\Dotenv::createImmutable("/etc","dojoservice.env");
    $dotenv->load();
    if (isset($_ENV["MONGO_CONNECTION_STRING"]) ) {
        define("CONSTR",$_ENV["MONGO_CONNECTION_STRING"]);
    } else {
        throw new \Exception("Connection string not found");
    };
} catch ( \Exception $ex ) {
    die($ex->getMessage());
}

function api(Router $r): void {
    $r->add("/takim/@tarih",function(Request $req) {
        $t = $req->params()["tarih"];
        $dblink = Db::link(CONSTR);
        return Db::takim($dblink,$t);        
    });
}

$router  = new DefaultJsonRouter();
api($router);
$router->execute();



