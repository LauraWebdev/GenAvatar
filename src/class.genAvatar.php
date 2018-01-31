<?php
  class GenAvatar {
    private $hash = null;
    private $image = null;
    private $patternSize = 8;

    function __construct($hash = null) {
      $this->hash = $hash;
    }

    function generate($size, $colorOne, $colorTwo) {
      $image = @imagecreate($size, $size);
      $pattern = @imagecreate($this->patternSize, $this->patternSize);

      $colorOneRGB = $this->hex2rgb($colorOne);
      $colorTwoRGB = $this->hex2rgb($colorTwo);

      $background = imagecolorallocate($pattern, $colorOneRGB[0], $colorOneRGB[1], $colorOneRGB[2]);
      $pixel = imagecolorallocate($pattern, $colorTwoRGB[0], $colorTwoRGB[1], $colorTwoRGB[2]);

      for ($iX=0; $iX < $this->patternSize; $iX++) {
        for ($iY=0; $iY < $this->patternSize; $iY++) {
          mt_srand(crc32($this->hash.$iX.$iY));
          if(mt_rand(0,5) == 0) {
            imagefilledrectangle($pattern, $iX, $iY, $iX+1, $iY+1, $pixel);
          }
        }
      }

      imagecopyresampled($image, $pattern, 0,0,0,0,$size, $size, $this->patternSize, $this->patternSize);

      return imagepng($image);
    }

    function hex2rgb($hex) {
      $hex = str_replace("#", "", $hex);

      switch (strlen($hex)) {
        case 1:
          $hex = $hex.$hex;

        case 2:
          $r = hexdec($hex);
          $g = hexdec($hex);
          $b = hexdec($hex);
          break;

        case 3:
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
          break;

        default:
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
          break;
      }

      $rgb = array($r, $g, $b);
      return $rgb;
    }
  }
?>
