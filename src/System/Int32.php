<?php

namespace System;

require_once("Object.php");
require_once("ArgumentException.php");
require_once("ArgumentNullException.php");
require_once("FormatException.php");
require_once("TypeCode.php");

/**
 * Represents a 32-bit signed integer.
 * @access public
 * @final
 * @package System
 * @name Int32
 */
final class Int32 extends Object {

    /**
     * Represents the largest possible value of an System.Int32. This field is constant.
     */
    const MaxValue = 2147483647;
    
    /**
     * Represents the smallest possible value of System.Int32. This field is constant.
     */
    const MinValue = -2147483647;
    
    public function __construct($value) {
        if(!is_numeric($value)) throw new ArgumentException("Cannot implicitly convert type to int");
        if($value > self::MaxValue || $value < self::MinValue) throw new OverflowException("represents a number less than System.Int32.MinValue or greater than System.Int32.MaxValue.");
        $this->properties['value'] = array('value' => $value, 'readOnly' => false);
    }

    /**
     * Compares this instance to a specified 32-bit signed integer and returns an indication of their relative values.
     * @param value: An integer to compare.
     * @return A signed number indicating the relative values of this instance and value.
     */
    public function compareTo($value) {
        if($this->value < $value) return -1;
        if($this->value > $value) return 1;
        return 0;
    }


    /*
     * Returns a value indicating whether this instance is equal to a specified System.Int32 value.
     *
     * @param obj: An System.Int32 value to compare to this instance.
     *
     * @return true if obj has the same value as this instance; otherwise, false.
     */
    public function equals($obj) {
        if($obj instanceof Int32) return $this->equals($obj->value);
        return is_int($obj) && $this->value == $obj;
    }


    /*
     * Returns the hash code for this instance.
     *
     * @return A 32-bit signed integer hash code.
     */
    public function getHashCode() {
        return $this->value;
    }


    /*
     * Returns the System.TypeCode for value type System.Int32.
     *
     * @return The enumerated constant, System.TypeCode.Int32.
     */
    public function getTypeCode() {
        /** @noinspection PhpUndefinedClassInspection */
        return Code::int32();
    }

    /*
     * Converts the string representation of a number to its 32-bit signed integer equivalent.
     *
     * @param s: A string containing a number to convert.
     *
     * @return A 32-bit signed integer equivalent to the number contained in s.
     */
    public static function parse($s) {
        if(is_null($s)) throw new ArgumentNullException("s is null.");
        if(strpos($s, ".") != false) throw new FormatException("s is not in the correct format.");
        return new Int32((int)$s);
    }

    /*
     * Converts the string representation of a number to its 32-bit signed integer equivalent. A return value indicates whether the conversion succeeded.
     *
     * @param s: A string containing a number to convert.
     * @param result: When this method returns, contains the 32-bit signed integer value equivalent to the number contained in s, if the conversion succeeded, or zero if the conversion failed
    */
    public static function tryParse($s, $result) {
        try {
            $result = self::parse($s);
            return new Int32($result);
        } catch(Exception $ex) {
            return new Int32(0);
        }
    }
}
?>