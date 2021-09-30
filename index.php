<?php
require_once 'controllers/routeController.php';
require_once 'controllers/userController.php';

require_once 'models/userModel.php';

$route = new RouteContoller();

$route->index();
