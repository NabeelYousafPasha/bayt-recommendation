<?php

if(!function_exists('encryptId')){
    /**
     * @param int $id
     * @return string
     */
    function encryptId(int $id): string
    {
        return \Illuminate\Support\Facades\Crypt::encrypt($id);
    }
}

if(!function_exists('decryptId')){
    /**
     * @param string $id
     * @return string
     */
    function decryptId(string $id): string
    {
        return \Illuminate\Support\Facades\Crypt::decrypt($id);
    }
}
