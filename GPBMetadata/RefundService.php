<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: RefundService.proto

namespace GPBMetadata;

class RefundService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
RefundService.protoRefundService"b
HelloRequest
name (	
userID (
txid (
orderID (
refundAddress (	"!
HelloResponse
greeting (	"�
RefundRequest
name (	
userID (
txid (
orderID (
refundAddress (	

accessHash (	
unixTime ("(
RefundResponse
refundResponse (	2X
GreetingServiceE
greeting.RefundService.HelloRequest.RefundService.HelloResponse2]
RefundServiceL
refundRequest.RefundService.RefundRequest.RefundService.RefundResponsebproto3'
        , true);

        static::$is_initialized = true;
    }
}

