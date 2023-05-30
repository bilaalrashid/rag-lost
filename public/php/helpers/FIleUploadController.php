<?php

class FileUploadController {

  /**
   * Validates an uploaded file is an image.
   * 
   * @param  string  $form_name         [The name of the form field the file was uploaded to]
   * @param  string  $target_directory  [The directory to move the file to]
   * @return ?string                    [The name of the uploaded file, or null if the file was invalid]
   */
  static function validate_single_image($form_name, $target_directory) {
    $file = $_FILES[$form_name];

    // Check we've uploaded a file
    if (!empty($file) && $file['error'] == UPLOAD_ERR_OK) {
      $tmp_file_name = $file['tmp_name'];

      // Be sure we're definitely dealing with an upload
      if (is_uploaded_file($tmp_file_name) === false) {
        return null;
      }

      // Don't trust the user-supplied MIME type, read it directly from the file
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime_type = finfo_file($finfo, $tmp_file_name);
      finfo_close($finfo);

      $valid_mime_types = array("image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif");

      // Check MIME type
      if (!array_key_exists($mime_type, $valid_mime_types)) {
        return null;
      }

      $file_size = filesize($tmp_file_name);
      $max_file_size = 5000000; // 5MB

      // Check if file is empty
      if ($file_size == 0) {
        return null;
      }

      // Check file is less than maximum size
      if ($file_size > $max_file_size) {
        return null;
      }

      $ext = $valid_mime_types[$mime_type];
      $file_name = round(microtime(true)) . mt_rand() . "." . $ext;
      $target_destination = $target_directory . "/" . $file_name;

      // Create target directory if it doesn't exist
      if (!file_exists($target_directory)) {
        mkdir($target_directory, 0777, true);
      }

      // Move file from temp directory
      $success = move_uploaded_file($tmp_file_name, $target_destination);
      if ($success) {
        return $file_name;
      }
    }

    return null;
  }

}
