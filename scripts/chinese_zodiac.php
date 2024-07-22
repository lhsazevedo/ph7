<?
/*
 * Years to chinese Zodiac
 */
 function getChineseZodiac($year){
 
  // Chinese Zodiac Animals
  $animals = Array
  (
    'Monkey',  // Years 0, 12, 1200, 2004...
    'Rooster',
    'Dog',
    'Boar',
    'Rat',
    'Ox',
    'Tiger',
    'Rabit',
    'Dragon',
    'Snake',
    'Horse',
    'Lamb'
  );

  // Number of animals and years in a calendar rotation
  $numAnimals = count($animals);

  // Years left until full rotation of calender
  $yearOffset= round($year) % $numAnimals;
 
  return $animals[$yearOffset]; 
}
 echo "Years to chinese Zodiac\n";
 echo "1985 ==> ",getChineseZodiac(1985).PHP_EOL;
 echo "1999 ==> ",getChineseZodiac(1999).PHP_EOL;
 echo "2012 ==> ",getChineseZodiac(2012).PHP_EOL;
 if( count($argv) > 0 && is_numeric($argv[0]) ){
  /* Test with the given number */
  echo "$argv[0] ==> ",getChineseZodiac($argv[0]).PHP_EOL;
 }
?>