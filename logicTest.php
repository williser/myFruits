<?php

function isValidString(string $s): bool {
    $stack = [];
    $brackets = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];

    foreach (str_split($s) as $char) {
        if (array_key_exists($char, $brackets)) {
            $topElement = array_pop($stack) ?? '#'; // Handle empty stack
            if ($brackets[$char] != $topElement) {
                return false;
            }
        } else {
            array_push($stack, $char);
        }
    }

    return empty($stack);
}
