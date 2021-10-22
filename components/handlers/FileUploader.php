<?php

namespace mywebshop\components\handlers;

class FileUploader
{
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function upload()
    {

        $target_file = $this->path . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image        
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        //melita.jpg 4.882 KB, 4,7MB        
        // Check file size in bits
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function multiupload()
    {
        if (isset($_POST['submit'])) {
            // Count total files
            $countfiles = count($_FILES['file']['name']);

            // Looping all files
            for ($i = 0; $i < $countfiles; $i++) {
                $filename = $_FILES['file']['name'][$i];

                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $this->path . $filename);
            }
        }
    }

        /**
         * Get the value of path
         */ 
        public function getPath()
        {
                return $this->path;
        }

        /**
         * Set the value of path
         *
         * @return  self
         */ 
        public function setPath($path)
        {
                $this->path = $path;

                return $this;
        }
}
