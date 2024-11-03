<?php

declare(strict_types=1);

function encodeStr(string $str): string 
{
    return base64_encode($str);
}


function decodeStr(string $str): bool|string 
{
    return base64_decode($str);
}

decodeStr(encodeStr("Hello world"));