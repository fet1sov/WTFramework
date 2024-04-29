<?php

/**
*   dbEntity.php
*   Abstract class of database entity
*
*   @author fet1sov <prodaugust21@gmail.com>
*/
abstract class DatabaseEntity {
    public function __call($method, $params) {
        $var = lcfirst(substr($method, 3));
        if (strncasecmp($method, "get", 3) === 0) {
            return $this->$var;
        }
        if (strncasecmp($method, "set", 3) === 0) {
            $this->$var = $params[0];
        }
    }

    /**
    * Saving all atributes of model in database
    */
    abstract public function saveData() : void;

    /**
    * Searchs data by any column of model without instance
    * @param mixed $data Data which will be used for the search
    * @param string $column_name Collumn name in database table
    */
    public static function searchDataByField($data, string $column_name) : ?array {
        $stmt = $GLOBALS["dbAdapter"]->prepare("SELECT * FROM `" . strtolower(get_called_class()) . "` WHERE `" . $column_name . "`=?");
        $stmt->bind_param(substr(gettype($data), 0, 1),
            $data
        );
        $stmt->execute();
        $fetchResult = $stmt->get_result();
        $row = $fetchResult->fetch_array(MYSQLI_ASSOC);

        return $row;
    }
}