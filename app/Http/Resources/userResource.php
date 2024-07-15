<?php

namespace App\Http\Resources;

//use App\Models\City;

use App\Models\ScanTransaction;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "user" => [
            'id' =>  $this->id,
            'firstName' => $this->name ?? "",
                'lastName' => $this->last_name ?? "",
                'companyName' => $this->company_name ?? "",
                'house_number' => $this->house_number ?? "",
                'address_line_2' => $this->address_line_2 ?? "",
                'town' => $this->town ?? "",
                'country' => $this->country ? $this->country->name : '',
                'plan' => $this->plan ? $this->plan->title : '',
            'phone' => $this->phone ?? '',
            'status' => $this->status ,
            'email' => $this->email ?? "",
            'type' => $this->type ?? "",
            'image'   => $this->image_link,
                ],
            "token" =>  $this->api_token,
            "biometric_key" =>  $this->biometric_key
        ];
    }
}
