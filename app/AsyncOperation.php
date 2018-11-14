<?php
/**
 * Created by PhpStorm.
 * User: miljanrakita
 * Date: 11/10/18
 * Time: 7:49 PM
 */

namespace App;


class AsyncOperation extends \Thread
{

    public function __construct($arg) {
        $this->arg = $arg;
    }

    public function run() {
        if ($this->arg) {
            $item = $this->arg;

            $response = file_get_contents("https://mediately.co/api/v4/drugs/rs?query=$item&page=1&search=all");
            $resp =  json_decode($response, true)['drugs'];

            foreach ($resp as $i) {

                if (Medicine::where('registration_id', $i['registration_id'])->first()) continue;

                $med = new Medicine();
                $med->slug = $i['slug'];
                $med->uuid = $i['uuid'];
                $med->registration_id = $i['registration_id'];
                $med->insurance_list = $i['insurance_list'];
                $med->registered_name = $i['registered_name'];
                $med->pharmaceutical_form = $i['pharmaceutical_form'];
                $med->insurance_list_desc = $i['insurance_list_desc'];
                $med->issuing_desc = $i['issuing_desc'];
                $med->license_holder = $i['license_holder'];
                $med->active_ingredient = $i['active_ingredient'];
                $med->producer = $i['producer'];
                $med->save();
            }
        }
    }
}