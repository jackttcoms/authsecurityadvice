<?php

// Features include: dimentions, max file size, watermarking images (soon)

class Uploader
{
    const ERR_EMPTY_FILE    = 1;
    const ERR_INVALID_EXT   = 2;
    const ERR_INVALID_TYPE  = 3;
    const ERR_LONG_SIZE     = 4;
    const ERR_SMALL_SIZE    = 5;
    const ERR_UNKNOWN_ERROR = 6;
    const ERR_NOT_AN_IMAGE  = 7;
    const ERR_MAX_DIMENSION = 8;
    const ERR_MIN_DIMENSION = 9;

    /**
     * Error ID
     * @var int
     */
    private $error = null;

    /**
     * The file array
     * @var array
     */
    private $file = null;

    /**
     * Default error messages
     * @var array
     */
    private $error_messages = array(
        self::ERR_EMPTY_FILE    => "No file selected.",
        self::ERR_INVALID_EXT   => "Invalid file extension.",
        self::ERR_INVALID_TYPE  => "Invalid file mime type.",
        self::ERR_LONG_SIZE     => "File size is too large.",
        self::ERR_SMALL_SIZE    => "File size is too small.",
        self::ERR_UNKNOWN_ERROR => "Unknown error occurred.",
        self::ERR_NOT_AN_IMAGE  => "The selected file must be an image.",
        self::ERR_MAX_DIMENSION => "The dimensions of the file is too large.",
        self::ERR_MIN_DIMENSION => "The dimensions of the file is too small."
    );

    /**
     * Customized error messages
     * @var array
     */
    public $custom_error_messages = null;

    /**
     * @var array
     */
    public $extensions = null;

    /**
     * @var array
     */
    public $disallowed_extensions = null;

    /**
     * @var array
     */
    public $types = null;

    /**
     * @var array
     */
    public $disallowed_types = null;

    /**
     * @var int
     */
    public $max_size = null;

    /**
     * @var int
     */
    public $min_size = null;

    /**
     * @var string
     */
    public $path = null;

    /**
     * @var string
     */
    public $name = null;

    /**
     * @var array
     */
    public $max_image_dimensions = null;

    /**
     * @var array
     */
    public $min_image_dimensions = null;

    /**
     * @var boolean
     */
    public $encrypt_name = false;

    /**
     * @var boolean
     */
    public $must_be_image = false;

    /**
     * @var boolean
     */
    public $override = false;

    /**
     * Set the file array ($_FILES or equivalent of this)
     * @param array $file
     */
    function __construct($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Allowed file extensions (example: png, gif, jpg)
     * @param array $extensions
     * @return $this
     */
    public function allowed_extensions($extensions)
    {
        $this->extensions = (is_array($extensions)) ? $extensions : null;
        return $this;
    }

    /**
     * Disallowed file extensions (example: html, php, dmg)
     * @param array $extensions
     * @return $this
     */
    public function disallowed_extensions($extensions)
    {
        $this->disallowed_extensions = (is_array($extensions)) ? $extensions : null;
        return $this;
    }

    /**
     * Allowed mime types (example: image/png, image/jpeg)
     * @param array $types
     * @return $this
     */
    public function allowed_types($types)
    {
        $this->types = (is_array($types)) ? $types : null;
        return $this;
    }

    /**
     * Disallowed mime types
     * @param array $types
     * @return $this
     */
    public function disallowed_types($types)
    {
        $this->disallowed_types = (is_array($types)) ? $types : null;
        return $this;
    }

    /**
     * Maximum file size in MB
     * @param int $size
     * @return $this
     */
    public function max_size($size)
    {
        $this->max_size = (is_numeric($size)) ? $size : null;
        return $this;
    }

    /**
     * Minimum file size in MB
     * @param int $size
     * @return $this
     */
    public function min_size($size)
    {
        $this->min_size = (is_numeric($size)) ? $size : null;
        return $this;
    }

    /**
     * Maximum dimensions of the image
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function max_image_dimensions($width = null, $height = null)
    {
        if (is_array($width) && isset($width[1])) {
            $this->max_image_dimensions = array($width[0], $width[1]);
        } else {
            $this->max_image_dimensions = array($width, $height);
        }
        return $this;
    }

    /**
     * Minimum dimensions of the image
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function min_image_dimensions($width = null, $height = null)
    {
        if (is_array($width) && isset($width[1])) {
            $this->min_image_dimensions = array($width[0], $width[1]);
        } else {
            $this->min_image_dimensions = array($width, $height);
        }
        return $this;
    }

    /**
     * Override (write over) the file with the same name
     * @return $this
     */
    public function override()
    {
        $this->override = true;
        return $this;
    }

    /**
     * The path where files will be uploaded
     * @param string $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Rename the uploaded file (example: foo)
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Encrypt file name to hide the original name
     * @return $this
     */
    public function encrypt_name()
    {
        $this->encrypt_name = true;
        return $this;
    }

    /**
     * Verify that the file is an image
     * @return $this
     */
    public function must_be_image()
    {
        $this->must_be_image = true;
        return $this;
    }

    /**
     * Set custom error messages
     * @param array $errors
     * @return $this
     */
    public function error_messages($errors)
    {
        $this->custom_error_messages = (is_array($errors)) ? $errors : null;
        return $this;
    }

    /**
     * Get error message
     * @param string $error_id
     * @return string
     */
    public function get_error_message($error_id)
    {
        if ($this->custom_error_messages !== null && isset($this->custom_error_messages[$error_id])) {
            return $this->custom_error_messages[$error_id];
        }
        return $error_id ? $this->error_messages[$error_id] : null;
    }

    /**
     * Get file name
     * @return string
     */
    public function get_name()
    {
        if ($this->name === null) {
            $this->name = pathinfo($this->file["name"], PATHINFO_FILENAME);
        }

        if ($this->encrypt_name) {
            $this->name = sha1($this->name . "-" . rand(10000, 99999) . "-" . time());
            $this->encrypt_name = false;
        }

        return $this->name . "." . $this->get_ext($this->file["name"]);
    }

    /**
     * Check the file can be uploaded
     * @return boolean
     */
    public function check()
    {
        if (!is_array($this->file) || $this->error !== null) {
            return false;
        }

        # Standard validations
        if (!isset($this->file["name"]) || !isset($this->file["tmp_name"]) || !isset($this->file["type"]) || !isset($this->file["size"]) || !isset($this->file["error"])) {
            $this->error = self::ERR_EMPTY_FILE;
        } else if (strlen($this->file["name"]) == 0 || strlen($this->file["tmp_name"]) == 0 || strlen($this->file["type"]) == 0 || $this->file["size"] == 0) {
            $this->error = self::ERR_EMPTY_FILE;
        } else if ($this->extensions !== null && !in_array($this->get_ext($this->file["name"]), $this->extensions)) {
            $this->error = self::ERR_INVALID_EXT;
        } else if ($this->disallowed_extensions !== null && in_array($this->get_ext($this->file["name"]), $this->disallowed_extensions)) {
            $this->error = self::ERR_INVALID_EXT;
        } else if ($this->types !== null && !in_array($this->file["type"], $this->types)) {
            $this->error = self::ERR_INVALID_TYPE;
        } else if ($this->disallowed_types !== null && in_array($this->file["type"], $this->disallowed_types)) {
            $this->error = self::ERR_INVALID_TYPE;
        } else if ($this->max_size !== null && $this->file["size"] > $this->mb_to_byte($this->max_size)) {
            $this->error = self::ERR_LONG_SIZE;
        } else if ($this->min_size !== null && $this->file["size"] < $this->mb_to_byte($this->min_size)) {
            $this->error = self::ERR_SMALL_SIZE;
        } else if ($this->file["error"] == 1 || $this->file["error"] == 2) {
            $this->error = self::ERR_LONG_SIZE;
        } else if ($this->file["error"] == 4) {
            $this->error = self::ERR_EMPTY_FILE;
        } else if ($this->file["error"] > 0) {
            $this->error = self::ERR_UNKNOWN_ERROR;
        }

        # Image validations
        if ($this->error === null) {
            if ($this->max_image_dimensions !== null || $this->min_image_dimensions !== null) {
                $image_dimensions = getimagesize($this->file["tmp_name"]);
                if (!$image_dimensions) {
                    $this->error = self::ERR_NOT_AN_IMAGE;
                }
                if ($this->error === null && $this->max_image_dimensions !== null) {
                    for ($i = 0; $i <= 1; $i++) {
                        if (isset($this->max_image_dimensions[$i]) && is_numeric($this->max_image_dimensions[$i]) && $image_dimensions[$i] > $this->max_image_dimensions[$i]) {
                            $this->error = self::ERR_MAX_DIMENSION;
                        }
                    }
                }
                if ($this->error === null && $this->min_image_dimensions !== null) {
                    for ($i = 0; $i <= 1; $i++) {
                        if (isset($this->min_image_dimensions[$i]) && is_numeric($this->min_image_dimensions[$i]) && $image_dimensions[$i] < $this->min_image_dimensions[$i]) {
                            $this->error = self::ERR_MIN_DIMENSION;
                        }
                    }
                }
            } else if ($this->must_be_image) {
                // If the file must be an image and getimagesize() didn't check the file, we need to use exif_imagetype instead of getimagesize for the performance.
                if (!exif_imagetype($this->file["tmp_name"])) {
                    $this->error = self::ERR_NOT_AN_IMAGE;
                }
            }
        }

        # Check if there is error
        if ($this->error === null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get error if exists
     * @param $with_message boolean (optional)
     * @return string
     */
    public function get_error($with_message = true)
    {
        return $with_message ? $this->get_error_message($this->error) : $this->error;
    }

    /**
     * Upload the file.
     * @param $upload_function string (optional)
     * @return boolean
     */
    public function upload($upload_function = "move_uploaded_file")
    {
        if ($this->check()) {
            if (!file_exists($this->get_path())) {
                @mkdir($this->get_path(), 0777, true);
            }
            $filepath = $this->get_path($this->get_name());
            if ($this->override === false && $this->encrypt_name === false && file_exists($filepath)) {
                $fileinfo = pathinfo($filepath);
                $filename = $fileinfo['filename'];
                $fileextn = $fileinfo['extension'];
                $number = 2;
                do {
                    $filepath = $this->get_path($filename . (($number) ? "_{$number}" : "") . "." . $fileextn);
                    $number++;
                } while (file_exists($filepath));
                $this->name = pathinfo($filepath, PATHINFO_FILENAME);
            }
            @$upload_function($this->file["tmp_name"], $filepath);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the full path
     * @return string
     */
    public function get_path($filename = null)
    {
        $path = null;
        if ($this->path !== null) {
            $path = rtrim($this->path, "/") . "/";
        }
        if ($filename !== null) {
            $filename = rtrim($filename, "/");
        }
        return $path . $filename;
    }

    /**
     * Get extension by filename
     * @param string $filename
     * @return string
     */
    public static function get_ext($filename)
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    /**
     * Calculate the bytes
     * @param int $filesize
     * @return int
     */
    public static function mb_to_byte($filesize)
    {
        return $filesize * pow(1024, 2);
    }

    /**
     * Create multiple file array
     * @param array $file_array
     * @return array
     */
    public static function multiple_file_array($file_array)
    {
        $files = array();
        foreach ($file_array as $files_key => $files_array) {
            foreach ($files_array as $i => $val) {
                $files[$i][$files_key] = $val;
            }
        }
        return $files;
    }
}