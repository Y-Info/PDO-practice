<?php

class DB {

    /**
     * @var DB
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {
    }

    public static function executeRequest(string $request): array
    {
        $db = self::getInstance();
        try {
            $stm = $db->prepare($request);
            $stm->execute();
            return($stm->fetchAll(PDO::FETCH_ASSOC));
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return DB
     */
    public static function getInstance() {

        if(empty(self::$_instance)) {

            $db_info = array(
                "db_host" => "localhost",
                "db_port" => "3306",
                "db_user" => "user",
                "db_pass" => "password",
                "db_name" => "api_agenda",
                "db_charset" => "UTF-8"
            );

            try {
                self::$_instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$_instance->query('SET NAMES utf8');
                self::$_instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }

        }

        return self::$_instance;
    }


}

?>