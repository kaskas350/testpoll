<?php


class module1 extends CModule {

    public function __construct()
    {
        $arModuleVersion =[];
        include(__DIR__."/version.php");
        $this->MODULE_ID = "module1";
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = "Тестовый модуль";
        $this->MODULE_DESCRIPTION = "Описание тестового модуля";
        

    }

}