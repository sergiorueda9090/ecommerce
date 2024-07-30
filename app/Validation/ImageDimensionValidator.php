<?php

namespace App\Validation;

class ImageDimensionValidator{

    public function validateImageDimensions(string $str, string $fields, array $data, string &$error = null): bool{
        
        $image = \Config\Services::image()
            ->withFile($data[$fields])
            ->getProperties(true);

        if ($image['width'] != 170 || $image['height'] != 170) {
            $error = 'The image dimensions should be 170px by 170px. Given dimensions are ' . $image['width'] . 'px by ' . $image['height'] . 'px.';
            return false;
        }

        return true;
    }

}
