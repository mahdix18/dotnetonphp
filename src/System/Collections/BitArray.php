<?php

namespace System\Collections { 


    use \System\ICloneable as ICloneable;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    
    use \System\Collections\Generic\BitArrayEnumerator as BitArrayEnumerator;

    /**
     * Manages a compact array of bit values, which are represented as Booleans, where true indicates that the bit is on (1) and false indicates the bit is off (0).
     * @access public
     * @name BitArray
     * @package System
     * @subpackage Collections
     */
    class BitArray implements ICollection, ICloneable {

        private $values;

        /**
         * Initializes a new instance of the BitArray class that contains bit values copied from the specified array of Booleans.
         * @access public
         * @throws \System\ArgumentNullException values is null.
         * @throws \System\ArgumentException values contains elements not be boolean.
         * @param array $values An array of Booleans to copy.
         */
        public function __construct($values = array())
        {
         
            if($values == null) 
            {
                throw new ArgumentNullException("values is null.");
            }
            
            foreach($values as $value) 
            {
                if(!is_bool($value)) 
                {
                    throw new ArgumentException("values contains elements not be boolean.");
                }
            }
                
            $this->values = $values;
        }


        /**
         * Performs the bitwise AND operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         * @access public
         * @throws \System\ArgumentException value and the current System.Collections.BitArray do not have the same number of elements.
         * @param \System\BitArray $value The System.Collections.BitArray with which to perform the bitwise AND operation.
         * @return \System\BitArray A System.Collections.BitArray containing the result of the bitwise AND operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         */
        public function andOperator(BitArray $value) 
        {
            if($value->count() != $this->count()) 
            {
                throw new ArgumentException("value and the current System.Collections.BitArray do not have the same number of elements.");
            }

            $b = $value->cloneObject();
            
            for($index = 0; $index < $this->count(); $index++) 
            {
                $result = $this->get($index) && $value->get($index);
                $b->set($index, $result);
            }
            
            return $b;
        }

        /**
         * Creates a new object that is a copy of the current instance.
         * @access public
         * @return Object A new object that is a copy of this instance.
         */
        public function cloneObject() 
        {
            return clone $this;
        }

        /**
         * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or- index greater than size of queue
         * @param int $index The zero-based index in array at which copying begins.
         * @return array The one-dimensional array that is the destination of the elements copied from ICollection. The array must have zero-based indexing.
         */
        public function copyTo($index = 0)
        {
            if($index < 0 || $index > $this->count()) 
            {
                throw new ArgumentOutOfRangeException("index is less than zero. -or- index greater than size of queue");
            }

            $array = array();
            for($i = $index; $i < $this->count(); $i++) 
            {
                $array[] = $this->values[$i];
            }

            return $array;
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() 
        {
            return sizeof($this->values);
        }


        /**
         * Gets the value of the bit at a specific position in the System.Collections.BitArray.
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or- index is greater than or equal to the number of elements in the System.Collections.BitArray.
         * @param int $index The zero-based index of the value to get.
         * @return bool The value of the bit at position index.
         */
        public function get($index) 
        {
            if($index < 0 || $index >= $this->count()) 
            {
                throw new ArgumentOutOfRangeException("index is less than zero. -or- index is greater than or equal to the number of elements in the System.Collections.BitArray.");
            }

            return $this->values[$index];
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return \System\Collections\IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() 
        {
            return new BitArrayEnumerator($this);
        }

        /**
         * Gets a value indicating whether the System.Collections.BitArray is read-only.
         * @return bool This property is always false.
         */
        public function isReadOnly() 
        {
            return false;
        }

        /**
         * Gets or sets the number of elements in the System.Collections.BitArray.
         * @access public
         * @throws \System\ArgumentOutOfRangeException The property is set to a value that is less than zero.
         * @param int $value Gets or sets the number of elements in the BitArray.
         * @return int The number of elements in the System.Collections.BitArray.
         */
        public function length($value = null)
        {
            
            if(is_numeric($value)) 
            {
                if($value < 0) 
                {
                    throw new ArgumentOutOfRangeException("The property is set to a value that is less than zero.");
                }

                for($index = $value; $index < $this->count(); $index++) 
                {
                    unset($this->values[$index]);
                }

                $this->values = array_values($this->values);
            }
            return $this->count();
        }

        /**
         * Inverts all the bit values in the current System.Collections.BitArray, so that elements set to true are changed to false, and elements set to false are changed to true.
         * @access public
         * @return \System\Collections\BitArray The current instance with inverted bit values.
         */
        public function notOperator() 
        {
            
            $b = $this->cloneObject();
            
            for($index = 0; $index < $b->count(); $index++) 
            {
                $b->set($index, !$b->get($index));
            }
                
            return $b;
        }

        /**
         * Performs the bitwise OR operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         * @access public
         * @throws \System\ArgumentException
         * @param \System\Collections\BitArray $value The System.Collections.BitArray with which to perform the bitwise OR operation.
         * @return \System\Collections\BitArray A \System\Collections\BitArray containing the result of the bitwise OR operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         */
        public function orOperator(BitArray $value) 
        {
            if($value->count() != $this->count()) 
            {
                throw new ArgumentException("value and the current System.Collections.BitArray do not have the same number of elements.");
            }

            $b = $this->cloneObject();
            
            for($i = 0; $i < $this->count(); $i++) 
            {
                $b->set($i, ($this->get($i) || $value->get($i)));
            }
            return $b;
        }

        /**
         * Sets the bit at a specific position in the System.Collections.BitArray to the specified value.
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or- index is greater than or equal to the number of elements in the System.Collections.BitArray.
         * @param int $index The zero-based index of the bit to set.
         * @param bool $value The Boolean value to assign to the bit.
         */
        public function set($index, $value) {
            
            if($index < 0 or $index >= $this->count()) 
            {
                throw new ArgumentOutOfRangeException("index is less than zero. -or- index is greater than or equal to the number of elements in the System.Collections.BitArray.");
            }
            
            if(is_bool($value)) 
            {
                $this->values[$index] = $value;
            }
        }

        /**
         * Sets all bits in the System.Collections.BitArray to the specified value.
         * @param $value The Boolean value to assign to all bits.
         */
        public function setAll($value) 
        {
            for($index = 0; $index < $this->count(); $index++)
            {
                $this->set($index, $value);
            }
        }

        /**
         * Performs the bitwise XOR operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         * @access public
         * @throws \System\ArgumentException value and the current System.Collections.BitArray do not have the same number of elements.
         * @param \System\Collections\BitArray $value The System.Collections.BitArray with which to perform the bitwise XOR operation.
         * @return \System\Collections\BitArray A \System\Collections\BitArray containing the result of the bitwise XOR operation on the elements in the current System.Collections.BitArray against the corresponding elements in the specified System.Collections.BitArray.
         */
        public function xorOperator(BitArray $value) 
        {
            if($value->count() != $this->count()) 
            {
                throw new ArgumentException("value and the current System.Collections.BitArray do not have the same number of elements.");
            }

            $b = $this->cloneObject();
            for($index = 0; $index < $this->count(); $index++) 
            {
                $result = $this->get($index) xor $value->get($index);
                $b->set($index, $result);
            }
            return $b;
        }
    }
}
