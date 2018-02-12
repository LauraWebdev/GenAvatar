<?php
  include('class.genAvatar.php');

  # Set header for image display in browser
  header("Content-type: image/png");

  # generate a hash based on the current time if no hash was provided
  if(isset($_GET['hash'])) {
    $hash = $_GET['hash'];
  } else {
    $hash = time();
  }

  # create a new GenAvatar instance with the provided hash
  $ga = new GenAvatar($hash);

  # generate and return a GenAvatar if color1, colo2 and size are set
  if(isset($_GET['color1']) && isset($_GET['color2']) && isset($_GET['size'])) {
    echo $ga->generate($_GET['size'], $_GET['color1'], $_GET['color2']);
  }
?>
