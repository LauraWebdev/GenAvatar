<?php
  class GenAvatar {
    private $hash = null;
    private $image = null;
    private $patternSize = 8;

    # Set hash for generation
    function __construct($hash = null) {
      $this->hash = $hash;
    }

    function generate($size, $colorOne, $colorTwo, $patternSize = 8) {
	  $this->patternSize = $patternSize;
      $this->image = @imagecreate($size, $size);
      $pattern = @imagecreate($this->patternSize, $this->patternSize);

      # Convert hex color codes to rgb arrays
      $colorOneRGB = $this->hex2rgb($colorOne);
      $colorTwoRGB = $this->hex2rgb($colorTwo);

      # Set ImageColors based on the colorOne and colorTwo parameters
      $background = imagecolorallocate($pattern, $colorOneRGB[0], $colorOneRGB[1], $colorOneRGB[2]);
      $pixel = imagecolorallocate($pattern, $colorTwoRGB[0], $colorTwoRGB[1], $colorTwoRGB[2]);

      # Traverse through every possible pixel on the canvas
      for ($iX=0; $iX < $this->patternSize; $iX++) {
        for ($iY=0; $iY < $this->patternSize; $iY++) {
          # change the random salt to a combination of hash, x position and y position
          mt_srand(crc32($this->hash.$iX.$iY));

          # fill pixel with color if a random value between 0 and 5 is 0. This means there is a 1-4 chance for filling a pixel (~20%)
          if(mt_rand(0,5) == 0) {
            imagefilledrectangle($pattern, $iX, $iY, $iX+1, $iY+1, $pixel);
          }
        }
      }

      # resize the finished canvas to the needed width/height
      imagecopyresampled($this->image, $pattern, 0,0,0,0,$size, $size, $this->patternSize, $this->patternSize);

      # return the image data
      return imagepng($this->image);
    }

    # function to convert hex colors to rgb arrays
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
