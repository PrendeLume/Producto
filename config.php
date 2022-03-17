<?php
$config = Com\Daw2\Core\Config::getInstance();

$config->set('APP_FOLDER', '../app/');
$config->set('DEFAULT_NAMESPACE', 'Com\Daw2\\');
$config->set('CONTROLLERS_NAMESPACE', $config->get('DEFAULT_NAMESPACE').'Controllers\\');
$config->set('MODELS_NAMESPACE', $config->get('DEFAULT_NAMESPACE').'Models\\');
$config->set('VIEWS_FOLDER', $config->get('APP_FOLDER').'Views/');
$config->set('DATA_FOLDER', $config->get('APP_FOLDER').'Data/');

$config->set('DEFAULT_CONTROLLER', 'Inicio');
$config->set('DEFAULT_ACTION', 'index');

$config->set('LOGIN_CONTROLLER', 'UsuarioSistema');
$config->set('LOGIN_ACTION', 'login');

$config->set('DEBUG', TRUE);

$config->set('dbhost', 'localhost');
$config->set('dbname', 'demoud4');
$config->set('dbuser', 'root');
$config->set('dbpass', '');
$config->set('dbcharset', 'utf8mb4');
$config->set('emulado', false);