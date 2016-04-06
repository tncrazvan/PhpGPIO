<?php
class GPIO{
    public static 
            $IN="in",
            $OUT="out";
    private $value,
            $flow,
            $BCM_Pin;
    public function __construct($BCM_Pin,$flow=null){
            $BCM_Pin = intval($BCM_Pin);
            shell_exec("echo \"$BCM_Pin\" >> /sys/class/gpio/export");	
            /*
                Assigning pin and setting it in floating 
                status (you can't read nor 0 or 1 from your pin at this point).
                With 3.3v this should give somewhere in between 1.2v and 1.3v on the pin 
                not sure about it, it could change depending on your Pi version.
                I haven't checked what's the floating status using 5V.
                You can check it yourself though :)
            */
            $this->BCM_Pin=$BCM_Pin;
            $this->value=null;
            if(!is_null($flow)){
                $this->setFlow($flow);
            }else{
                $this->flow=null;
            }
    }

    public function setFlow($flow){		/*set flow direction (input/output)*/
            switch($flow){
                    case "in":
                    case "input":
                            shell_exec("echo \"in\" >> /sys/class/gpio/gpio$this->BCM_Pin/direction");
                            $this->flow = "in";
                            break;
                    case "out":
                    case "output":
                            shell_exec("echo \"out\" >> /sys/class/gpio/gpio$this->BCM_Pin/direction");
                            $this->flow = "out";
                            break;
                    default:
                            /*
                                    throw an exception or something
                            */
                            //throw new Exceptin();
                            break;
            }
    }

    public function setValue($value){
            if(is_numeric($value)){
                    $value = intval($value);
                    shell_exec("echo \"$value\" >> /sys/class/gpio/gpio$this->BCM_Pin/value");
                    $this->value = $value;
            }
    }

    public function setHigh(){
            $this->setValue(1);
    }

    public function setLow(){
            $this->setValue(0);
    }
    public function getFlow(){
            return $this->flow;
    }
    public function getDirection(){
            $this->getFlow();
    }
    public function getValue(){
            return $this->value;
    }

    public function getBCM_Pin(){
            return $this->BCM_Pin;
    }
    public function getPin(){
            return $this->getBCM_Pin();
    }

    public static function clear(){
        $pins=array(
            new GPIO(7, "out"),
            new GPIO(17, "out"),
            new GPIO(18, "out"),
            new GPIO(21, "out"),
            new GPIO(27, "out"),
            new GPIO(22, "out"),
            new GPIO(23, "out"),
            new GPIO(24, "out"),
            new GPIO(25, "out"),
        );
        foreach($pins as $item){
            $item->setLow();
        }
    }
}