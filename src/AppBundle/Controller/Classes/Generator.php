<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23. 9. 2017
 * Time: 21:18
 */

namespace AppBundle\Controller\Classes;


class Generator
{
    public function getRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}