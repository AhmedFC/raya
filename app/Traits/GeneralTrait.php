<?php

namespace App\Traits;

use App\Models\Major\Major;
use App\Models\Category\Category;
use App\Models\CreationYear\CreationYear;
use App\Models\FuelType\FuelType;
use App\Models\GeerboxType\GeerboxType;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($msg)
    {
        return response()->json([
            'status' => false,
            'message' => $msg
        ]);
    }

    public function returnErrorValidation($msg)
    {

        return response()->json(['message' =>$msg], 400);
    }


    public function get_category($id,$sub_categories)
    {
        //dd($id);
        $major = Major::where('id', $id)->first();
        $categories = Category::where('major_id', $id)->get();
        $fuel_types = FuelType::get();
        $creation_years = CreationYear::get();
        $geerbox_types = GeerboxType::get();

        $text = "";
        $text .=
            "<label class='form-label' for='mahara'>";
        $text .= __('messages.categories');
        $text .= "</label>
                        <select class='selectpicker' name='category_id'";
        $text .= "onchange = 'subCategory(this)'";
        //$text .= sub_category(this);

        $text .= " title='";
        $text .= __('messages.categories');
        $text .= "' aria-label='Default select example'>


        ";
        foreach ($categories as $item) {
            $text .=
                '
                            <option value=' . $item->id . '>' . $item->title . '</option>
        ';
        }
        $text .= "</select>";

        $counter = "";
        $counter .= "<label class='form-label' for='service'> * ". __('messages.counter') ."</label>
                        <input required type='number' name='counter' class='form-control' value=' old('counter') ' id='text'>
                       ";
        $fuel_type = "";
        $fuel_type = "<label class='form-label' for='mahara'> ". __('messages.fuel_types') ."</label>
                        <select class='selectpicker' name='fuel_type_id' id='fuel_type_id' title='". __('messages.fuel_types').
        "' aria-label='Default select example'>
                           ";
                        foreach ($fuel_types as $item) {
            $fuel_type .=
                '
                            <option value=' . $item->id . '>' . $item->title . '</option>
        ';
        }
        $fuel_type .= "</select>";

        $creation_year = "";
        $creation_year = "<label class='form-label' for='mahara'> " . __('messages.creation_year') . "</label>
                        <select class='selectpicker' name='creation_year_id' id='creation_year_id' title='" . __('messages.creation_year') .
        "' aria-label='Default select example'>
                           ";
        foreach ($creation_years as $item) {
            $creation_year .=
                '
                            <option value=' . $item->id . '>' . $item->year . '</option>
        ';
        }
        $creation_year .= "</select>";

        $geerbox_type = "";
        $geerbox_type = "<label class='form-label' for='mahara'> " . __('messages.geerbox_types') . "</label>
                        <select class='selectpicker' name='geerbox_type_id' id='geerbox_type_id' title='" . __('messages.geerbox_types') .
        "' aria-label='Default select example'>
                           ";
        foreach ($geerbox_types as $item) {
            $geerbox_type .=
                '
                            <option value=' . $item->id . '>' . $item->title . '</option>
        ';
        }
        $geerbox_type .= "</select>";


        if($major->has_children == 1 && $major->id == 1){
            return response([
                'text'=>$text ,
                'id'=>$id ,
                'counter'=>$counter ,
                'fuel_type' => $fuel_type,
                'creation_year' => $creation_year,
                'geerbox_type' => $geerbox_type
              ]) ;
        }elseif($major->has_children == 1){
            return response(['text'=>$text]);
        }

    }

    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'message' => $msg
        ];
    }

    public function returnData($data, $msg)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
            'data' => $data
        ]);
    }

    public function returnErrorDataNull($errNum = 'S000', $msg = "تم إرجاع القسم بنجاح")
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'message' => $msg,
            'data' => null
        ]);
    }
    public function returnErrorDataEmpty($errNum = 'S000', $msg = "تم إرجاع القسم بنجاح")
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'message' => $msg,
            'data' => []
        ]);
    }


    //////////////////
    public function returnValidationError($validator)
    {
        return $this->returnErrorValidation($validator->errors()->first());
    }

    public function returnValidationErrorData($code = "E001", $validator)
    {
        return $this->returnErrorDataEmpty($code, $validator->errors()->first());
    }

    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E001';

        else if ($input == "fullName")
            return 'E001';

        else if ($input == "password")
            return 'E002';

        else if ($input == "old_password")
            return 'E002';

        else if ($input == "new_password")
            return 'E002';

        else if ($input == "mobile")
            return 'E003';

        else if ($input == "id_number")
            return 'E004';

        else if ($input == "birth_date")
            return 'E005';

        else if ($input == "agreement")
            return 'E006';

        else if ($input == "email")
            return 'E007';

        else if ($input == "city_id")
            return 'E008';

        else if ($input == "insurance_company_id")
            return 'E009';

        else if ($input == "activation_code")
            return 'E010';

        else if ($input == "code")
            return 'E010';

        else if ($input == "longitude")
            return 'E011';

        else if ($input == "latitude")
            return 'E012';

        else if ($input == "id")
            return 'E013';

        else if ($input == "promocode")
            return 'E014';

        else if ($input == "doctor_id")
            return 'E015';

        else if ($input == "payment_method" || $input == "payment_method_id")
            return 'E016';

        else if ($input == "day_date")
            return 'E017';

        else if ($input == "specification_id")
            return 'E018';

        else if ($input == "importance")
            return 'E019';

        else if ($input == "type")
            return 'E020';

        else if ($input == "message")
            return 'E021';

        else if ($input == "reservation_no")
            return 'E022';

        else if ($input == "reason")
            return 'E023';

        else if ($input == "branch_no")
            return 'E024';

        else if ($input == "name_en")
            return 'E025';

        else if ($input == "name_ar")
            return 'E026';

        else if ($input == "gender")
            return 'E027';

        else if ($input == "nickname_en")
            return 'E028';

        else if ($input == "nickname_ar")
            return 'E029';

        else if ($input == "rate")
            return 'E030';

        else if ($input == "price")
            return 'E031';

        else if ($input == "information_en")
            return 'E032';

        else if ($input == "information_ar")
            return 'E033';

        else if ($input == "street")
            return 'E034';

        else if ($input == "branch_id")
            return 'E035';

        else if ($input == "insurance_companies")
            return 'E036';

        else if ($input == "photo")
            return 'E037';

        else if ($input == "logo")
            return 'E038';

        else if ($input == "working_days")
            return 'E039';

        else if ($input == "insurance_companies")
            return 'E040';

        else if ($input == "reservation_period")
            return 'E041';

        else if ($input == "nationality_id")
            return 'E042';

        else if ($input == "commercial_no")
            return 'E043';

        else if ($input == "nickname_id")
            return 'E044';

        else if ($input == "reservation_id")
            return 'E045';

        else if ($input == "attachments")
            return 'E046';

        else if ($input == "summary")
            return 'E047';

        else if ($input == "user_id")
            return 'E048';

        else if ($input == "mobile_id")
            return 'E049';

        else if ($input == "paid")
            return 'E050';

        else if ($input == "use_insurance")
            return 'E051';

        else if ($input == "doctor_rate")
            return 'E052';

        else if ($input == "provider_rate")
            return 'E053';

        else if ($input == "message_id")
            return 'E054';

        else if ($input == "hide")
            return 'E055';

        else if ($input == "checkoutId")
            return 'E056';

        else if ($input == "phone")
            return 'E057';

        else if ($input == "amount")
            return 'E058';

        else if ($input == "squad_id")
            return 'E059';

        else if ($input == "section_id")
            return 'E060';

        else if ($input == "subject_id")
            return 'E061';


        else if ($input == "reason_id")
            return 'E062';


        else if ($input == "question_id")
            return 'E063';

        else if ($input == "major_id")
            return 'E064';

        else if ($input == "state_id")
            return 'E065';

        else if ($input == "city_id")
            return 'E066';
        else if ($input == "category_id")
            return 'E067';

        else if ($input == "sub_category_id")
            return 'E068';

        else if ($input == "creation_year_id")
            return 'E069';

        else if ($input == "geerbox_type_id")
            return 'E070';

        else if ($input == "fuel_type_id")
            return 'E071';

        else if ($input == "counter")
            return 'E072';

        else if ($input == "advertise_id")
            return 'E073';

        // else if ($input == "amount")
        //     return 'E074';

        else
            return "";
    }
}
