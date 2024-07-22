<?
/* Custom JSON implementation - found somewhere in the web
 */
 class custom_json {

    /**
     * Convert array to javascript object/array
     * @param array $array the array
     * @return string
     */
    public static function encode($array)
    {

        // determine type
        if(is_numeric(key($array))) {

            // indexed (list)
            $output = '[';
            for($i = 0, $last = (sizeof($array) - 1); isset($array[$i]); ++$i) {
                if(is_array($array[$i])) $output .= self::encode($array[$i]);
                else  $output .= self::_val($array[$i]);
                if($i !== $last) $output .= ',';
            }
            $output .= ']';

        } else {

            // associative (object)
            $output = '{';
            $last = sizeof($array) - 1;
            $i = 0;
            foreach($array as $key => $value) {
                $output .= '"'.$key.'":';
                if(is_array($value)) $output .= self::encode($value);
                else  $output .= self::_val($value);
                if($i !== $last) $output .= ',';
                ++$i;
            }
            $output .= '}';

        }

        // return
        return $output;

    }

    /**
     * [INTERNAL] Format value
     * @param mixed $val the value
     * @return string
     */
    private static function _val($val)
    {
        if(is_string($val)) return '"'.rawurlencode($val).'"';
        elseif(is_int($val)) return sprintf('%d', $val);
        elseif(is_float($val)) return sprintf('%F', $val);
        elseif(is_bool($val)) return ($val ? 'true' : 'false');
        else  return 'null';
    }

}

// prints ["apple","banana","blueberry"]
var_dump( custom_json::encode(array('apple', 'banana', 'blueberry')) );

// prints {"name":"orange","type":"fruit"}
var_dump( custom_json::encode(array('name' => 'orange', 'type' => 'fruit')) );

// prints: ** try it yourself, cannot post long lines here **
$big_test = array(
    array(
        'name' => array('John', 'Smith'),
        'age' => 27,
        'sex' => 0,
        'height' => 180.53,
        'is_human' => true,
        'string' => 'Hello',
    ),
    array(
        'name' => array('Green', 'Alien'),
        'age' => 642,
        'sex' => null,
        'height' => 92.21,
        'is_human' => false,
        'string' => '?????!', // test utf8 here
    )
);

echo custom_json::encode($big_test);
/*
 * Should output

string(30 '["apple","banana","blueberry"]')
string(32 '{"name":"orange","type":"fruit"}')
[{"name":["John","Smith"],"age":27,"sex":0,"height":180.530000,"is_human":true,"string":"Hello"},{"name":["Green","Alien"],"age":642,"sex":null,"height":92.210000,"is_human":false,"string":"%E3%81%93%E3%82%93%E3%81%AB%E3%81%A1%E3%81%AF%EF%BC%81"}]
*/
?>