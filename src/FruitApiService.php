<?php

namespace MyFruit;

class FruitApiService extends BaseApiService
{
    public function getFruitList()
    {
        $endpoint = '/api/v1/list';
        // 发送GET请求获取水果列表
        $response = $this->sendRequest('GET', $endpoint);

        // 记录请求和响应
        $this->logRequest('GET', $endpoint);
        $this->logResponse($response);

        // 返回响应数据
        return $response;
    }

    public function buyFruit($id, $qty)
    {
        $endpoint = '/api/v1/buy';
        $params = ['id' => $id, 'qty' => $qty];

        // 发送请求
        $response = $this->sendRequest('GET', $endpoint, $params);

        // 记录请求和响应
        $this->logRequest('GET', $endpoint, $params);
        $this->logResponse($response);

        // 返回响应数据
        return $response;
    }
	
}
