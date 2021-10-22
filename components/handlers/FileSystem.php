<?php

namespace mywebshop\components\handlers;

class FileSystem
{

    public $name;
    public $size;
    public $filepath;

    public function __construct($filepath = "")
    {
        $this->filepath = $filepath;
        $this->setName(basename($this->filepath));
    }

    public function fileExists($source){
        return file_exists($source);
    }

    public function fileReadFileToArray($source){
        return file($source);
    }
    public function opencsv($source)
    {
        $file = fopen($source, "r");
        //fgetcsv(file, length, separator, enclosure)
        $data = fgetcsv($file);
        fclose($file);

        return $data;
    }

    public function copy($source, $destination)
    {
        return copy($source, $destination);
    }

    public function directoryName($source)
    {
        return dirname($source);
    }

    public function writeFile(string $source, string $text): void
    {
        file_put_contents($source,$text, FILE_APPEND);
    }

    /**
     * The fopen function does something entirely different—it opens a file descriptor, which functions as a stream to read or write the file. ... 
     * file_get_contents — Reads entire file contents into a string. fopen — Opens a file handle that can be manipulated with other library functions,
     * but does no reading or writing itself.3 Ιουν 2014
     *
     * @param [string] $source     
     * @return string
     */
    public function readFile(string $source): string
    {
        $file = fopen($source, 'r');
        $line = "";
        //Output lines until EOF is reached
        while (!feof($file)) {
            $line .= fgets($file);
        }

        fclose($file);

        return $line;
    }
    /**
     * @param [string] $source     
     * @return string
     */

    public function readFileContents(string $source): string{
        return file_get_contents($source);
    }




    public function diskFreeSpaceToBytes($source)
    {
        return disk_free_space($source);
    }
    public function diskFreeSpaceToKiloBytes($source)
    {
        return $this->convertSize(disk_free_space($source), 'KB');
    }
    public function diskFreeSpaceToKiloMegaBytes($source)
    {
        return $this->convertSize(disk_free_space($source), 'MB');
    }
    public function diskFreeSpaceToKiloMegaGigabytes($source)
    {
        return $this->convertSize(disk_free_space($source), 'GB');
    }
    public function diskFreeSpaceToKiloMegaTerabytes($source)
    {
        return $this->convertSize(disk_free_space($source), 'TB');
    }

    public function diskTotalSpaceToBytes($source)
    {
        return disk_total_space($source);
    }
    public function diskTotalSpaceToKiloBytes($source)
    {
        return $this->convertSize(disk_total_space($source), 'KB');
    }
    public function diskTotalSpaceToKiloMegaBytes($source)
    {
        return $this->convertSize(disk_total_space($source), 'MB');
    }
    public function diskTotalSpaceToKiloMegaGigabytes($source)
    {
        return $this->convertSize(disk_total_space($source), 'GB');
    }
    public function diskTotalSpaceToKiloMegaTerabytes($source)
    {
        return $this->convertSize(disk_total_space($source), 'TB');
    }

    //Assuming the value is in bytes
    public function convertSize($value, $size)
    {
        if ($size == 'KB') {
            return $value / 1024;
        } else if ($size == 'MB') {
            return ($value / 1024) / 1024;
        } else if ($size == 'GB') {
            return (($value / 1024) / 1024) / 1024;
        } else if ($size == 'TB') {
            return ((($value / 1024) / 1024) / 1024) / 1024;
        }
    }


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of filepath
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * Set the value of filepath
     *
     * @return  self
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }


}
