<?php

function redirect($url) {
  header('Location: ' . $url);
  die();
}

function md5salt($string) {
  global $config;

  return md5($config['random_salt'] . $string);
}