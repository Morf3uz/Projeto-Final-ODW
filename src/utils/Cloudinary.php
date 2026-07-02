<?php

namespace utils;

use Cloudinary\Cloudinary as CloudinarySDK;

class Cloudinary
{
    private static ?CloudinarySDK $instance = null;

    public static function getInstance(): CloudinarySDK
    {
        if (self::$instance === null) {
            self::$instance = new CloudinarySDK([
                'cloud' => [
                    'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                    'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                    'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
                ],
                'url' => [
                    'secure' => true,
                ],
            ]);
        }

        return self::$instance;
    }
}