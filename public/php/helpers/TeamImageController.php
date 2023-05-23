<?php

class TeamImageController {

  static function cropTeamImage(string $directory, string $original_file_name): ?string {
    // Load image 
    $original_image_data = imagecreatefromstring(file_get_contents($directory . "/" . $original_file_name));

    // Crop to square
    $smallest_size = min(imagesx($original_image_data), imagesy($original_image_data));
    $square_image = imagecrop($original_image_data, ['x' => 0, 'y' => 0, 'width' => $smallest_size, 'height' => $smallest_size]);

    // Remove original image from memory
    imagedestroy($original_image_data);

    // Resize to 1024x1024
    $resized = imagecreatetruecolor(1024, 1024);
    imagecopyresized($resized, $square_image, 0, 0, 0, 0, 1024, 1024, $smallest_size, $smallest_size);

    // Remove square image from memory
    imagedestroy($square_image);

    // Save image as PNG for consistent format
    $output_file_name = "team_image_" . round(microtime(true)) . mt_rand() . ".png";
    $success = imagepng($resized, $directory . "/" . $output_file_name);
    imagedestroy($resized);

    if ($success) {
      unlink($directory . "/" . $original_file_name);
      return $output_file_name;
    }
    
    return null;
  }

  static function createPinImage(string $directory, string $team_image_name, string $team_color): ?string {
    // Load image
    $original_image_data = imagecreatefromstring(file_get_contents($directory . "/" . $team_image_name));
    $original_width = imagesx($original_image_data);

    // Resize to just under 512x512 (border will fill the rest later)
    $target_width = 512;
    $border_width = 15;
    $inner_width = $target_width - $border_width;
    $resized = imagecreatetruecolor($inner_width, $inner_width);
    imagecopyresized($resized, $original_image_data, 0, 0, 0, 0, $inner_width, $inner_width, $original_width, $original_width);

    // Remove original image from memory
    imagedestroy($original_image_data);

    // Crop to circle
    $width = imagesx($resized);
    $circle_image = imagecreatetruecolor($width, $width);
    imagealphablending($circle_image, true);
    imagecopyresampled($circle_image, $resized, 0, 0, 0, 0, $width, $width, $width, $width);
    $mask = imagecreatetruecolor($width, $width);

    $transparent = imagecolorallocate($mask, 255, 0, 0); // I don't understand this variable name choice, but the code works
    imagecolortransparent($mask, $transparent);
    imagefilledellipse($mask, $width / 2, $width / 2, $width, $width, $transparent);

    $red = imagecolorallocate($mask, 0, 0, 0); // I don't understand this variable name choice either, but the code works
    imagecopy($circle_image, $mask, 0, 0, 0, 0, $width, $width);
    imagecolortransparent($circle_image, $red);
    imagefill($circle_image, 0, 0, $red);

    // Remove original image from memory
    imagedestroy($resized);

    // Convert hex to rgb
    list($r, $g, $b) = sscanf($team_color, "#%02x%02x%02x");

    // Add border
    $border_image = imagecreatetruecolor($width + $border_width, $width + $border_width);
    $border_colour = imagecolorallocate($border_image, $r, $g, $b);
    $transparent = imagecolorallocatealpha($border_image, 0, 0, 0, 127);
    imagefill($border_image, 0, 0, $transparent);
    imagefilledellipse($border_image, ($width + $border_width) / 2, ($width + $border_width) / 2, $width + $border_width, $width + $border_width, $border_colour);
    imagecolortransparent($border_image, $border_colour);
    imagecopymerge($border_image, $circle_image, $border_width / 2, $border_width / 2, 0, 0, $width, $width, 100);
    imagecolortransparent($border_image, $transparent);

    // Remove circle image from memory
    imagedestroy($circle_image);    

    // Save image as PNG for consistent format
    $output_file_name = "team_pin_" . round(microtime(true)) . mt_rand() . ".png";
    $success = imagepng($border_image, $directory . "/" . $output_file_name);
    imagedestroy($border_image);

    if ($success) {
      return $output_file_name;
    }

    return null;
  }

}
