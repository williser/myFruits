<?php

namespace MyFruit;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

abstract class BaseApiService
{
    protected Client $client;
    protected LoggerInterface $logger;

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    protected function sendRequest(string $method, string $uri, array $params = [])
    {
        try {
            $options = $method === 'GET' ? ['query' => $params] : ['json' => $params];
            $response = $this->client->request($method, $uri, $options);

            // 由于日志记录移到了外部方法，此处不再自动记录请求
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // 错误处理逻辑
            $this->logger->error("HTTP request failed: " . $e->getMessage());
            return null;
        }
    }

    protected function logRequest(string $method, string $uri, array $params = [])
    {
        // 实现具体的请求日志记录逻辑，此处为简化版本
        $logMessage = sprintf("[%s] %s Request to %s with params %s\n",
            date('Y-m-d H:i:s'),
            $method,
            $uri,
            json_encode($params)
        );
        // 假设logger已经设置为文件日志或其他
        $this->logger->info($logMessage);
    }

    protected function logResponse($response)
    {
        // 实现具体的响应日志记录逻辑
        $logMessage = sprintf("[%s] Response: %s\n",
            date('Y-m-d H:i:s'),
            json_encode($response)
        );
        $this->logger->info($logMessage);
    }
}
