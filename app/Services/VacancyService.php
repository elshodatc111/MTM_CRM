<?php
namespace App\Services;

use App\Models\VacanseHodim;
use App\Http\Requests\StoreVacancyRequest;

class VacancyService
{
    public function create(StoreVacancyRequest $request): VacanseHodim
    {
        return VacanseHodim::create([
            'name' => strtoupper($request->name),
            'addres' => $request->addres,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'description' => $request->decription,
            'type' => $request->type,
            'status' => 'new',
            'worked' => $request->worked,
            'worked_comment' => '',
        ]);
    }
}
