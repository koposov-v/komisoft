<?if ($result_id) : ?>
    <?php foreach ($result_id as $item) : ?>
        <a href='store/index?StoreSearch%5Bid%5D=<?=$item?>&StoreSearch%5Bname%5D=' target="_blank" ><?=$item?></a>
    <?php endforeach; ?>

<? else : ?>
    <span>Нет девайсов</span>
<? endif ?>


