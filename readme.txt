Created by hussam khadijeh
00962797725449
hussam_ib_88@hotmail.com

to test this api , you must create an array of boarding cards using class Travel ,
after that using travels array create an instant from sortTravels class.
finally call sortAll function.

example :

$travels=array();
$travels[]=new Travel("Barcelona","Gerona Airport","bus");
$travels[]=new Travel("Stockholm","New York JFK","plane","SK22","7B","22");
$travels[]=new Travel("Madrid","Barcelona","train","78A","45B");
$travels[]=new Travel("Gerona Airport","Stockholm","plane","SK455","3A","45B","344");
$sort=new sortTravels($travels);
$sort->sortAll();