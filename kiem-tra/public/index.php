

<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'nhanvien';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerFile = __DIR__ . '/../app/controllers/' . ucfirst($controller) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    $controllerInstance = new $controllerClass();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        echo "Không tìm thấy action!";
    }
} else {
    echo "Không tìm thấy controller!";
}
?>