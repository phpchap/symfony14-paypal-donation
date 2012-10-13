<?php

// get the first part of the domain
$url = explode(".", $_SERVER['HTTP_HOST']);
$domain = $url[0];

// depending on the domain, switch the symfony environment
switch($domain) {
  
  // dev (debug on)
  case 'dev': 
    $env = "dev";
    $debug = true;
  break;

  // stage (debug off)
  case 'stage': 
    $env = "stage";
    $debug = false;
  break;
  
  // live (debug off)
  case 'live':
  case 'www':   
    $env = "live";
    $debug = false;
  break;

  // local (debug off)
  case 'local':   
    $env = "local";
    $debug = false;
  break;

  // default
  default:
    mail('phpchap@gmail.com', 'regal egg cups domain error', print_r($_REQUEST, true));
    $env = 'live';
    $debug = false;
  break;
}


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', $env, $debug);
sfContext::createInstance($configuration)->dispatch();
