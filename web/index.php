<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['testing.demo'] = function () {
    return new \TestingDemo\BasicMathsService();
};
$app['guzzle.client'] = function () {
    return new GuzzleHttp\Client();
};
$app['status.service'] = function ($app) {
    return new \TestingDemo\StatusService($app['guzzle.client']);
};

$numbers = [1,2,3,4,5];

$app->get('/test', function () use ($numbers) {
  $output = '';
  foreach ($numbers as $number) {
    $output .= $number;
    $output .= '<br />';
  }

  return $output;
});

$app->run();
