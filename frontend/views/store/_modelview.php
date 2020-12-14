<?php
use \frontend\models\Store;
$result = ( Store::OutputIdStore($name));
if (!empty($result))
foreach ($result as $item){
echo "<a href=''>$item</a>";
}
else echo " Нет девайсов";

