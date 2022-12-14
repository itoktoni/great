<?php

namespace App\Http\Services;

use App\Dao\Facades\EnvFacades;
use Plugins\Alert;

class CreateSettingService
{
    public function save($data)
    {
        $check = false;
        try {

            EnvFacades::setValue('APP_NAME', $data->name);
            EnvFacades::setValue('APP_TITLE', $data->title);

            Alert::update();

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
