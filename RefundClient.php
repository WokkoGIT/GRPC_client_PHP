<?php
require dirname(__FILE__).'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$hostname = "localhost:8083";

$name = "PHP client";
$txid = 456789;
$userID = 5678;
$orderID = 16875465;
$refundAddress = "3HWDCmMg4s7NdPvbKZi6AvMZEf1RzMpKUn";

//CLIENT_SECRET_KEY - верный код, имеющий доступ к возврату средств.
//WRONG_KEY - код без доступа к возврату
$access_KEY = getenv("CLIENT_SECRET_KEY");


//Сервер PHP не поддерживает обработку двух сервисов одновременно

function greet($hostname,$name,$txid,$userID,$orderID,$refundAddress):void {
    $client = new \RefundService\GreetingServiceClient($hostname, [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]);

    $request = new RefundService\HelloRequest();
    $request ->setName($name)
        ->setUserID($userID)
        ->setOrderID($orderID)
        ->setTxid($txid)
        ->setRefundAddress($refundAddress);

    list($response, $status) = $client->greeting($request)->wait();
    if ($status->code !== Grpc\STATUS_OK) {
        echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
        exit(1);
    }
    echo $response->getGreeting() . PHP_EOL;
}

function refund ($hostname,$name,$txid,$userID,$orderID,$refundAddress,$access_KEY): void {

    $client = new \RefundService\RefundServiceClient($hostname, [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]);

    $request = new \RefundService\RefundRequest();
    $request
        ->setName($name)
        ->setUserID($userID)
        ->setOrderID($orderID)
        ->setTxid($txid)
        ->setRefundAddress($refundAddress)
        ->setAccessKey($access_KEY);

    list($refundResponse, $status) = $client->refundRequest($request)->wait();
    if ($status->code !== Grpc\STATUS_OK) {
        echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
        exit(1);
    }
    echo $refundResponse->getRefundResponse() . PHP_EOL;
}

//Проверка коннекта к серверу
greet($hostname,$name,$txid,$userID,$orderID,$refundAddress);

//Запрос на возврат транзакции
refund($hostname, $name,$txid,$userID,$orderID,$refundAddress,$access_KEY);