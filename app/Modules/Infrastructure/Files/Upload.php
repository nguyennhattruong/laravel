<?php

namespace App\Modules\Infrastructure\Files;

class Upload
{
    private $_file;
    public $extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
    public $arrOption = array(
        'maxSize' => 10000000,
        'smallWidth' => 500,
        'smallHeight' => 333,
        'smallQuality' => 100,
        'mediumWidth' => 500,
        'mediumHeight' => 333,
        'mediumQuality' => 100,
        'bigWidth' => 1024,
        'bigHeight' => 768,
        'bigQuality' => 100,
        'tempDir' => 'uploads/tmp',
        'bigDir' => '',
        'mediumDir' => '',
        'smallDir' => '',
        'isMedium' => false
    );

    public function __construct($file = NULL, $option = array()) {
        $this->_file = $file;

        // Merge default array and params array
        $this->arrOption = array_merge($this->arrOption, $option);

        // Set dir
        $this->arrOption['tempDir'] = base_path($this->arrOption["tempDir"]);
        $this->arrOption['bigDir'] = base_path($this->arrOption["bigDir"]);
        $this->arrOption['smallDir'] = $this->arrOption["bigDir"] . '/thumbnails';

        $this->init($this->arrOption['tempDir']);

        if ($this->arrOption['isMedium']) {
            $this->arrOption['smallDir'] = $this->arrOption["bigDir"] . '/thumbnails/sm';
            $this->arrOption['mediumDir'] = $this->arrOption["bigDir"] . '/thumbnails/md';
        }
    }

    public function init($path) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public function uploadImage($image) {
        if (trim($image) == '') {
            return false;
        }

        // Big Directory
        if (!is_dir($this->arrOption["bigDir"])) {
            mkdir($this->arrOption["bigDir"]);
        }

        // Small Directory
        if (!is_dir($this->arrOption["smallDir"])) {
            mkdir($this->arrOption["smallDir"]);
        }

        // Medium Directory
        if ($this->arrOption['isMedium']) {
            if (!is_dir($this->arrOption["mediumDir"]))
                mkdir($this->arrOption["mediumDir"]);
        }

        $imageTemp = realpath(base_path('uploads/tmp/' . $image));
        if (file_exists($imageTemp)) {
            $flag = true;
            $fileName = md5(basename($image));
            $fileExt = $this->getExtension($image);
            while ($flag) {
                if (file_exists($this->arrOption["bigDir"] . "/" . $fileName . '.' . $fileExt)) {
                    $flag = true;
                    $fileName = md5(rand() . $fileName);
                } else
                    $flag = false;
            }

            $fileName = $fileName . '.' . $fileExt;

            // Big Image
            $this->createImage($imageTemp, $this->arrOption["bigDir"] . "/" . $fileName, $this->arrOption["bigWidth"], $this->arrOption["bigHeight"], $this->arrOption["bigQuality"], true);

            // Medium Image
            if ($this->arrOption['isMedium']) {
                $this->createImage($imageTemp, $this->arrOption["mediumDir"] . "/" . $fileName, $this->arrOption["mediumWidth"], $this->arrOption["mediumHeight"], $this->arrOption["mediumQuality"]);
            }

            // Small Image
            $this->createImage($imageTemp, $this->arrOption["smallDir"] . "/" . $fileName, $this->arrOption["smallWidth"], $this->arrOption["smallHeight"], $this->arrOption["smallQuality"]);

            // Remove Temp Image
            unlink($imageTemp);

            return $fileName;
        } else
            return false;
    }

    // Upload to tmp folder
    public function uploadTemp() {
        if ($this->isFile()) {
            $flag = true;
            $fileName = md5(basename($this->_file["name"]));
            $fileExt = $this->getExtension($this->_file["name"]);
            while ($flag) {
                if (file_exists($this->arrOption["tempDir"] . "/" . $fileName . '.' . $fileExt)) {
                    $flag = true;
                    $fileName = md5(rand() . $fileName);
                } else
                    $flag = false;
            }
            move_uploaded_file($this->_file['tmp_name'], $this->arrOption["tempDir"] . "/" . $fileName . '.' . $fileExt);
            return $fileName . '.' . $fileExt;
        } else
            return false;
    }

    protected function isFile() {
        return (in_array($this->getExtension($this->_file["name"]), $this->extension) && $this->_file["size"] < $this->arrOption["maxSize"]);
    }

    protected function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i)
            return "";
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    protected function createImage($fileSrc, $fileName, $width, $height, $quality, $isRatio = false) {
        $ext = $this->getExtension($fileSrc);
        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPEG", $ext) || !strcmp("JPG", $ext))
            $img = imagecreatefromjpeg($fileSrc);
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext))
            $img = imagecreatefrompng($fileSrc);
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext))
            $img = imagecreatefromgif($fileSrc);

        $oldX = imagesx($img);
        $oldY = imagesy($img);

        $ratio = $oldX / $width;
        $thumbW = $oldX / $ratio;
        $thumbH = $oldY / $ratio;

        //Size according to ratio
        if ($isRatio) {
            $imgDst = imagecreatetruecolor($thumbW, $thumbH);
            imagecopyresampled($imgDst, $img, 0, 0, 0, 0, $width, $thumbH, $oldX, $oldY);
        } else {
            /* $to_crop_array = array('x' => 0, 'y' => 0, 'width' => $width, 'height' => $height);
             $imgDst = imagecreatetruecolor($thumbW, $thumbH);

             imagecopyresampled($imgDst, $img, 0, 0, 0, 0, $width, $thumbH, $oldX, $oldY);
             $imgDst = imagecrop($imgDst, $to_crop_array);

             // get the color white
             $color = imagecolorallocate($imgDst, 255, 255, 255);

             // fill entire image
             imagefill($imgDst, 0, 0, $color);*/

            $imgDst = imagecreatetruecolor($width, $height);
            imagecopyresampled($imgDst, $img, 0, 0, 0, 0, $width, $height, $oldX, $oldY);
        }

        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            imagepng($imgDst, $fileName, 9);
        } else if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPEG", $ext) || !strcmp("JPG", $ext)) {
            imagejpeg($imgDst, $fileName, $quality);
        } else {
            imagegif($imgDst, $fileName, $quality);
        }

        imagedestroy($imgDst);
        imagedestroy($img);
    }
}
