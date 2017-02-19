<?php

namespace Torlax;

class Messenger
{
    public static function createMessage($message, $newline = true)
    {
        if ($newline === false) {
            return $message;
        }

        return "$message\n";
    }
}
