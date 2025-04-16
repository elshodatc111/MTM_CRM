<?php
namespace App\Services;

use App\Models\Childreen;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guruh;
use App\Models\GuruhChildren;
use App\Services\ChildService;

class ChildService{

    public function getFilteredChildren(Request $request){
        $query = Childreen::query()->where('status', 'true');
        if ($request->filled('search')) {
            $request->validate([
                'search' => 'string|max:100',
            ]);
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
    }

    public function getCanceledChildren(Request $request){
        $query = Childreen::query()->where('status', 'cancel');
        if ($request->filled('search')) {
            $request->validate([
                'search' => 'string|max:100',
            ]);
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
    }


    public function getAboutChildren($id){
        return Childreen::query()->where('id', $id)->firstOrFail();
    }

    public function getAboutGroupChildren($id){
        $GuruhChildren = GuruhChildren::where('children_id',$id)->where('status','true')->first();
        return [
            'guruh_id' => $GuruhChildren['guruh_id'],
            'guruh' => Guruh::find($GuruhChildren['guruh_id'])->name,
            'start' => $GuruhChildren['start_date'],
            'meneger' => User::find($GuruhChildren['start_user_id'])->name,
            'about' => $GuruhChildren['start_description'],
        ];
    }

    public function getHistoryGroupChildren($id){
        $History = GuruhChildren::where('children_id',$id)->get();
        $array = [];
        foreach ($History as $key => $value) {
            $array[$key]['guruh_id'] = $value->guruh_id;
            $array[$key]['guruh_name'] = Guruh::find($value['guruh_id'])->name;
            $array[$key]['start_date'] = $value->start_date;
            $array[$key]['start_description'] = $value->start_description;
            $array[$key]['start_user_id'] = User::find($value['start_user_id'])->name;
            if($value->status !== 'true'){
                $array[$key]['end_date'] = $value->end_date;
                $array[$key]['end_description'] = $value->end_description;
                $array[$key]['end_user_id'] = User::find($value['end_user_id'])->name;
            }else{
                $array[$key]['end_date'] = " ";
                $array[$key]['end_description'] = " ";
                $array[$key]['end_user_id'] = " ";
            }
            $array[$key]['status'] = $value->status;
        }
        return $array;
    }


}
