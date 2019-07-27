<?//echo session_id();?>
<div class="container">
    <?if(empty($arResult["USER"])):?>
    <form>
        <?if (!$USER->IsAuthorized()):?>
        <div class="form-group">
            <label for="name"><?=$arResult["FIELDS"]["IMYA"]["NAME"]?></label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Введите имя">
        </div>
        <div class="form-group">
            <label for="family"><?=$arResult["FIELDS"]["FAMILIYA"]["NAME"]?></label>
            <input type="text" class="form-control" id="family" placeholder="Введите фамилию">
        </div>
        <?else:?>
            <div class="form-group">

                <input type="hidden" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Введите имя" value="<?=$USER->GetFirstName();?>">
            </div>
            <div class="form-group">

                <input type="hidden" class="form-control" id="family" placeholder="Введите фамилию" value="<?=$USER->GetLastName();?>">
            </div>



        <?endif?>
        <div class="form-group">
            <label for="sex"><?=$arResult["DATA"]["FIELDS"]["POL"]["NAME"]?></label>
            <select id="sex" class="form-control">
                <?foreach ($arResult["DATA"]["FIELDS"]["POL"]["enum"] as $key=>$enum) :?>
                <option data-id="<?=$key?>"><?=$enum?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="career">Ваш род деятельности?</label>
            <div id="career">
                <div class="row">
                    <div class="col">
                        <?foreach ($arResult["DATA"]["FIELDS"]["ROD_DEYATELNOSTI"]["career"] as $career):?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?=$career["ID"]?>">
                            <label class="custom-control-label" for="<?=$career["ID"]?>"><?=$career["NAME"]?></label>
                        </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="age">Сколько вам лет?</label>
            <select id="age" class="form-control">
                <?foreach ($arResult["DATA"]["FIELDS"]["AGE"]["enum"] as $key=>$age):?>
                <option data-id="<?=$key?>"><?=$age?></option>
                <?endforeach;?>
            </select>
        </div>
        <button type="button" id="button" class="btn btn-primary" data-target="#exampleModal"><!--data-toggle="modal"--> Отправить</button>
    </form>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Успех</h5>

                </div>
                <div class="modal-body">
                    Результаты опроса учтены. Хотите ли вы посмотреть результаты опроса?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="home">Вернуться на главную</button>
                    <button type="button" class="btn btn-primary" id="results">Посмотреть результаты опроса</button>
                </div>
            </div>
        </div>
    </div>
    <?else:?>
        <div class="alert alert-primary" role="alert">
        Вы уже проходили данный опрос
        </div>


    <?endif;?>
</div>


