<?php

namespace mywebshop\tools;

require ("../config.php");
require ("../components/handlers/Database.php");
use \PDO;
$date = new \DateTime();

$user = CONFIG['db.user'];
$password = CONFIG['db.password'];
$dbhost = CONFIG['db.host'];
$dbh = new PDO("mysql:host=$dbhost;dbname=", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;",PDO::ATTR_PERSISTENT => true));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dir    = 'C:\xampp\htdocs\mywebshop\db\dumps\\';
$files1 = array_values(array_diff(scandir($dir), array('..', '.')));

foreach ($files1 as $file){
    if(strpos($file, '.sql') !== false)
        $fileparts = explode("_", $file);
        echo "Creating schema for ".$fileparts[0]."\n";
        if(!in_array($fileparts[0], array("information_schema", "mysql", "performance_schema"))){
            $sql = "CREATE DATABASE ".$fileparts[0];
            $sth = $dbh->prepare($sql);
            $sth->execute();

            $mysqlDatabaseName =$fileparts[0];
            $mysqlUserName ='root';
            $mysqlPassword ='';
            $mysqlHostName ='localhost';
            $mysqlImportFilename =$dir.$file;

            $command="C:\\xampp\\mysql\\bin\\mysql -h " .$mysqlHostName .' -u ' .$mysqlUserName .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
            exec($command,$output,$worked);
            switch($worked){
                case 0:
                    echo 'The data from the file <b>' .$mysqlImportFilename .'</b> were successfully imported into the database <b>' .$mysqlDatabaseName .'</b>';
                    break;
                case 1:
                    echo 'An error occurred during the import. Please check if the file is in the same folder as this script. Also check the following data again:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Dateiname:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
                    break;
            }
        }

}



