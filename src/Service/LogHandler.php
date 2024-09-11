<?php

namespace App\Service;

use Cake\Log\LogTrait;
use Psr\Log\LogLevel;

class LogHandler
{
    use LogTrait;

    public static function error($message, array $context = [])
    {
        if (count($context)) {
            $message .= sprintf(' Data: %s', json_encode($context));
        }
        $logHandler = new LogHandler();
        $logHandler->log(
            $message,
            LogLevel::ERROR
        );
    }

    public static function debug($message, array $context = [])
    {
        if (count($context)) {
            $message .= sprintf(' Data: %s', json_encode($context));
        }
        $logHandler = new LogHandler();
        $logHandler->log(
            $message,
            LogLevel::DEBUG
        );
    }

    public static function info($message, array $context = [])
    {
        if (count($context)) {
            $message .= sprintf(' Data: %s', json_encode($context));
        }
        $logHandler = new LogHandler();
        $logHandler->log(
            $message,
            LogLevel::INFO
        );
    }

    public static function warning($message, array $context = [])
    {
        if (count($context)) {
            $message .= sprintf(' Data: %s', json_encode($context));
        }
        $logHandler = new LogHandler();
        $logHandler->log(
            $message,
            LogLevel::WARNING
        );
    }
}
