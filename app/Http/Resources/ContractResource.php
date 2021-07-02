<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        /*return [
            'id'=>$this->id,
            'employee_type'=>$this->employee_type,
            'start_date'=>$this->start_date,
            'employee_id'=>$this->employee_id,
            'employee'=> (new EmployeeResource($this->employee)),
        ];*/
       $defaultData=parent::toArray($request);
        $additonalData=[
            'employee'=>$this->employee,
        ];

        return array_merge($defaultData,$additonalData);
    }
}
