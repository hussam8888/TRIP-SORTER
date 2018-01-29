<?php
/**
 * Created by Hussam Khadijeh.
 * User: hussam
 * Date: 28/01/2018
 * Time: 11:36 م
 * 00962797725449
 * hussam_ib_88@hotmail.com
 */

class Travel{
    private $fromLocation='';
    private $toLocation='';
    private $travelID='';
    private $seat='';
    private $type='';//plan or train or bus
    private $gate='';
    private $counter='';

    function __construct($from,$to,$type,$id='',$seat='',$gate='',$counter=''){
        $this->fromLocation=$from;
        $this->toLocation=$to;
        $this->type=$type;
        $this->travelID=$id;
        $this->seat=$seat;
        $this->gate=$gate;
        $this->counter=$counter;
    }

    public function getFromLocation(){
        return $this->fromLocation;
    }
    public function getToLocation(){
        return $this->toLocation;
    }
    public function getTravelType(){
        return $this->type;
    }
    public function getTravelID(){
        return $this->travelID;
    }
    public function getTravelSeat(){
        return $this->seat;
    }
    public function getTravelGate(){
        return $this->gate;
    }
    public function getTravelcounter(){
        return $this->counter;
    }

}
class sortTravels{
    private $travels=array();
    private $fromArray=array();
    private $toArray=array();
    private $finalArray=array();
    private $TravelsCount=0;

    function __construct($travels){
        $this->TravelsCount=count($travels);
        $this->travels=$travels;
        foreach ($this->travels as $travel){
            $this->fromArray[$travel->getFromLocation()]=$travel;
            $this->toArray[$travel->getToLocation()]=$travel;
        }
    }

    private function getStartLocation(){
        foreach ($this->fromArray as $from=>$travel){
            if(!array_key_exists($from,$this->toArray)){
                return $travel;
            }
        }
    }
    private function getNext($toLocation){
        return $this->fromArray[$toLocation];
    }
    function sortAll(){
        $this->finalArray[]=$this->getStartLocation();
        while (count($this->finalArray)<$this->TravelsCount){
            $this->finalArray[]= self::getNext($this->finalArray[count($this->finalArray)-1]->getToLocation());
        }
        self::toHTML();
    }
    private function toHTML(){
        $html='';
        $i=1;
        foreach ($this->finalArray as $travel){
            if($travel->getTravelID()!=''){
                $travelID=$travel->getTravelID()." ";
            }else{
                $travelID="";
            }
            if($travel->getTravelGate()!=''){
                $travelGate=" Gate ".$travel->getTravelGate().", ";
            }else{
                $travelGate="";
            }
            if($travel->getTravelSeat()!=''){
                $seat=" Set in seat ".$travel->getTravelSeat().".";
            }else{
                $seat=" No seat assignment.";
            }
            switch ($travel->getTravelType()){
                case "plane" :
                    $html.=$i.". From ".$travel->getFromLocation()." , take flight ".$travelID." to ".$travel->getToLocation().". ".$travelGate.$seat;
                    if($travel->getTravelCounter()!=''){
                        $html.="Baggage drop at ticket counter ".$travel->getTravelCounter().".";
                    }else{
                        $html.="Baggage will we automatically transferred from your last leg.";
                    }
                    break;
                case "train":
                    $html.=$i.". Take train ".$travelID."from ".$travel->getFromLocation()." to ".$travel->getToLocation().".".$seat;
                    break;
                case "bus":
                    $html.=$i.". Take the airport bus from ".$travel->getFromLocation()." to ".$travel->getToLocation().".".$seat;
                    break;
            }
            $html.="<br>";
            $i++;
        }
        $html.=$i.". You have arrived at your final destination.";
        echo $html;
    }

}


//test result
$travels=array();
$travels[]=new Travel("Barcelona","Gerona Airport","bus");
$travels[]=new Travel("Stockholm","New York JFK","plane","SK22","7B","22");
$travels[]=new Travel("Madrid","Barcelona","train","78A","45B");
$travels[]=new Travel("Gerona Airport","Stockholm","plane","SK455","3A","45B","344");
$sort=new sortTravels($travels);
$sort->sortAll();
?>

