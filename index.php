<?php

require_once __DIR__ . '/vendor/autoload.php';

use MyFruit\FruitApiService;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// 创建日志记录器
$logger = new Logger('name');
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::WARNING));

// 创建Guzzle HTTP客户端实例
$client = new Client([
    // 配置基础URI，如果API有一个基础URL，可以在这里设置
    'base_uri' => 'http://fruit.test',
]);

// 实例化FruitApiService
$fruitService = new FruitApiService($client, $logger);

// 调用getFruitList方法获取水果列表
$response = $fruitService->getFruitList();

// 输出结果
echo "<pre>";
print_r($response);
echo "</pre>";