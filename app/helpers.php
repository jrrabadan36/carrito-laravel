<?php 

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encrypt')) {
    function encrypt($value) {
        return Crypt::encryptString($value);
    }
}

if (!function_exists('decrypt')) {
    function decrypt($value) {
        return Crypt::decryptString($value);
    }
}