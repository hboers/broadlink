# Broadlink API PHP7 library 

A PHP 7 library for controlling IR and Wireless 433Mhz controllers 
from [Broadlink](http://www.ibroadlink.com/rm/). 

Details about the protocoll can be found at 
[mjg59/python-broadlink](https://github.com/mjg59/python-broadlink/blob/master/README.md)

Based on the original codes of [ThePHPGuys/broadlink](https://github.com/thephpguys/broadlink)
and [rudestan/broadlink-api](https://github.com/rudestan/broadlink-api)

### Discover devices in network


```php
echo json_encode(\TPG\Broadlink\Broadlink::discover());
```

will produce

```json
[
    {
        "model": "RM2 Pro Plus",
        "name": "Living Room",
        "ip": "192.168.88.15",
        "mac": "34:ea:cc:cc:cc:bc",
        "id": "10026"
        
    },
    {
        "model": "RM2 Pro Plus",
        "name": "Sleeping Room",
        "ip": "192.168.88.14",
        "mac": "34:ea:cc:cc:cc:bf",
        "id": "10026"
    }
]
```

### Use a known device

After discovering you can create a device:


```php
    \TPG\Broadlink\Device\AuthenticatedDevice::authenticate('192.168.88.15','34:ea:cc:cc:cc:bc')
```

### Draft implementation of Broadlink Catalog Cloud

```php
use TPG\Broadlink\Cloud\Catalog;

$catalog = new Catalog('/path/where/you/want/to/save/remotes');
$remotes = $catalog->search('Samsung');

//Download first remote
print_r($remotes[0]->download());

//Or download all found remotes
foreach($remotes as $remote){
    $remote->download();
}
```
