#!/usr/bin/php
<?php
/*Traffic lights sample*/
require_once './GPIO.php'; //include GPIO
$green = new GPIO(18, "out"); //setup pin 18 output
$yellow = new GPIO(4, "out"); //setup pin 4 output
$red = new GPIO(17, "out"); //setup pint 17 output
GPIO::clear();   //set all pins to low

/*+++++++++++++++++++++++++
NOTE: pin numbers do not match with the phisical ones, 
the board mode is set to BCM, check the BCM pin numbers
to make sure you get them right.
EDIT: BCM sheet added as .jpg, check master branch.
+++++++++++++++++++++++++++*/


while(true){
  $green->setHigh();  //sets pin voltage to high (aka light up green led)
  sleep(5); //sleep for 5 seconds
  $green->setLow(); //sets pin voltage to low (aka light off green led)
  $yellow->setHigh();
  sleep(3);
  $yellow->setLow();
  $red->setHigh();
  sleep(5);
  $red->setLow();
}
?>
