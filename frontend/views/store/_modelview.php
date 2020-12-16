<? /** @var class $devices */
if ($devices) : ?>
    <?php foreach ($devices as $device) : ?>
        <a href='device/index?DeviceSearch[id]=<?=$device->id?>' target="_blank" ><?=$device->store?></a>
    <?php endforeach; ?>

<? else : ?>
    <span>Нет девайсов</span>
<? endif ?>


