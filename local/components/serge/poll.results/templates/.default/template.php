<div class="container">
<?foreach ($arResult as $val):?>
    <li class="list-group-item list-group-item-primary"><?=$val["NAME"]?></li>
    <ul class="list-group">
        <?foreach ($val["VARIABLE"] as $result):?>
       <?if (!empty($result["COUNT"])):?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?=$result["NAME"];?>
            <span class="badge badge-primary badge-pill"><?=$result["COUNT"];?></span>
        </li>
        <?endif;?>
        <?endforeach;?>
    </ul>
    <?endforeach;?>
</div>


