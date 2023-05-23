<?php

class TeamImageController {

  static function cropTeamImage(string $directory, string $original_file_name): ?string {
    // Load image 
    $original_image_data = imagecreatefromstring(file_get_contents($directory . "/" . $original_file_name));

    // Crop to square
    $smallest_size = min(imagesx($original_image_data), imagesy($original_image_data));
    $square_image = imagecrop($original_image_data, ['x' => 0, 'y' => 0, 'width' => $smallest_size, 'height' => $smallest_size]);

    // Save image as PNG for consistent format
    $output_file_name = "team_image_" . round(microtime(true)) . mt_rand() . ".png";
    $success = imagepng($square_image, $directory . "/" . $output_file_name);
    imagedestroy($original_image_data);

    if ($success) {
      unlink($directory . "/" . $original_file_name);
      return $output_file_name;
    }
    
    return null;
  }

}
