<?php
abstract class EBasicEnum {
    private static $constCache = NULL;
    
    /**
     * Give all the constants of a class.
     * @return type The constants of the class.
     */
    private static function getConstants() {
        if (self::$constCache === NULL) {
            $reflect = new ReflectionClass(get_called_class());
            self::$constCache = $reflect->getConstants();
        }
        return self::$constCache;
    }
    
    /**
     * Give the name of the enum value $i
     * @param int $i the value which we desire the name
     * @return string|NULL the existing name, NULL otherwise
     */
    public static function getNameEnum($i) {
        
        $constants = self::getConstants();
        $keys = array_map('strtolower', array_keys($constants));
        return ucfirst($keys[$i]);
        
    }
    
    /**
     * Donne la valeur de l'enum en fonction d'un nom en paramètre.
     * @param string $name Le nom dont on souhaite la valeur.
     * @param bool $strict Indique s'il faut respecter la casse.
     * @return int|bool La valeur du nom
     */
    public static function getValueEnum($name, $strict = false) {
        $constants = self::getConstants();
        if ($strict) {
            return array_search(strtolower($name), $keys, true);
        }
        $keys = array_map('strtolower', array_keys($constants));
        return array_search(strtolower($name), $keys);
    }
    
    /**
     * Indique si le nom passé en paramètre est correct pour l'enum ou non.
     * @param string $name Le nom dont on souhaite vérifier sa présence.
     * @param bool $strict Indique s'il faut respecter la casse.
     * @return bool True si le nom existe, false sinon
     */
    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();
        if ($strict) {
            return array_key_exists($name, $constants);
        }
        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * Indique si la valeur existe ou pas dans l'enum
     * @param int $value La valeur dont on souhaite vérifier la présence
     * @return bool True si la valeur existe, false sinon.
     */
    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }
}
?>