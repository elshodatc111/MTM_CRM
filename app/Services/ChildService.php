<?php
namespace App\Services;

use App\Models\Childreen;
use Illuminate\Http\Request;
use App\Services\ChildService;
use App\Models\User;
use App\Models\Guruh;
use App\Models\GuruhChildren;
use App\Models\Relatives;
use App\Models\ChildrenComment;
use App\Models\Paymart;
use App\Models\Moliya;

class ChildService{

    public function getPaymart(int $id){
        $Paymart = Paymart::where('children_id',$id)->get();
        $array = [];
        foreach ($Paymart as $key => $value) {
            $array[$key]['id'] = $value->id;
            $array[$key]['amount'] = $value->amount;
            $array[$key]['type'] = $value->type;
            $array[$key]['status'] = $value->status;
            $array[$key]['discription'] = $value->discription;
            $array[$key]['created_at'] = $value->created_at;
            $array[$key]['meneger'] = User::find($value->user_id)->name;
        }
        return $array;
    }

    public function discountStore(array $data){
        $amount = str_replace(" ","",$data['amount']);
        $Childreen = Childreen::find($data['children_id']);
        $Childreen->balans = $Childreen->balans + $amount;
        Paymart::create([
            'children_id' => $data['children_id'],
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'type' => 'chegirma',
            'status' => 'chegirma',
            'discription' => $data['comment'],
        ]);
        return $Childreen->save();
    }

    public function refundStore(array $data){
        $children_id = $data['children_id'];
        $kassa_naqt = $data['kassa_naqt'];
        $kassa_plastik = str_replace(" ","",$data['kassa_plastik']);
        $amount = str_replace(" ","",$data['amount']);
        $type = $data['type'];
        $comment = $data['comment'];
        if($type == 'naqt' AND $kassa_naqt<=$amount){
            return 'false';
        }
        if($type == 'plastik' AND $kassa_plastik<=$amount){
            return 'false';
        }
        $Childreen = Childreen::find($data['children_id']);
        $Childreen->balans = $Childreen->balans - $amount;
        $Childreen->save();
        $Moliya = Moliya::first();
        if($data['type']=='naqt'){
            $Moliya->kassa_naqt = $Moliya->kassa_naqt - $amount;
        }else{
            $Moliya->kassa_plastik = $Moliya->kassa_plastik - $amount;
        }
        $Moliya->save();
        Paymart::create([
            'children_id' => $data['children_id'],
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'type' => $data['type'],
            'status' => 'qaytarildi',
            'discription' => $data['comment'],
        ]);
        return 'true';
    }

    public function getKassa(){
        $Kassa = Moliya::first();
        return [
            'kassa_naqt' => $Kassa['kassa_naqt'],
            'kassa_plastik' => $Kassa['kassa_plastik'],
        ];
    }

    public function PaymartStory(array $data){
        $amount = str_replace(" ","",$data['amount']);
        $Moliya = Moliya::first();
        if($data['type']=='naqt'){
            $Moliya->kassa_naqt = $Moliya->kassa_naqt + $amount;
        }else{
            $Moliya->kassa_plastik = $Moliya->kassa_plastik + $amount;
        }
        $Moliya->save();
        $Childreen = Childreen::find($data['children_id']);
        $Childreen->balans = $Childreen->balans + $amount;
        $Childreen->save();
        return Paymart::create([
            'children_id' => $data['children_id'],
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'type' => $data['type'],
            'status' => 'tulov',
            'discription' => $data['discription'],
        ]);
    }

    public function commentStore(array $data){
        return ChildrenComment::create([
            'children_id' => $data['children_id'],
            'description' => $data['description'],
            'meneger_id' => auth()->user()->id,
        ]);
    }

    public function getComments(int $id){
        $ChildrenComment = ChildrenComment::where('children_id',$id)->get();
        $array = [];
        foreach ($ChildrenComment as $key => $value) {
            $array[$key]['id'] = $value->id;
            $array[$key]['description'] = $value->description;
            $array[$key]['meneger'] = User::find($value->meneger_id)->name;
            $array[$key]['created_at'] = $value->created_at;
        }
        return $array;
    }

    public function addRelatives(array $data){
        return Relatives::create([
            'children_id' => $data['child_id'],
            'kim' => $data['kim'],
            'name' => $data['name'],
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'],
            'user_id' => auth()->user()->id,
        ]); 
    }

    public function deleteRelatives($id){
        $Relatives = Relatives::find($id);
        return $Relatives->delete();
    }

    public function getRelatives(int $id){
        $Relatives = Relatives::where('children_id',$id)->get();
        $array = [];
        foreach ($Relatives as $key => $value) {
            $array[$key]['id'] = $value->id;
            $array[$key]['kim'] = $value->kim;
            $array[$key]['name'] = $value->name;
            $array[$key]['phone1'] = $value->phone1;
            $array[$key]['phone2'] = $value->phone2;
            $array[$key]['meneger'] = User::find($value['user_id'])->name;
        }
        return $array;
    }

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
            'guruh_id' => $GuruhChildren==null?"null":$GuruhChildren['guruh_id'],
            'guruh' => $GuruhChildren==null?"null":Guruh::find($GuruhChildren['guruh_id'])->name,
            'start' => $GuruhChildren==null?"null":$GuruhChildren['start_date'],
            'meneger' =>$GuruhChildren==null?"null": User::find($GuruhChildren['start_user_id'])->name,
            'about' => $GuruhChildren==null?"null":$GuruhChildren['start_description'],
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

    public function childUpdate(array $data){
        $child = Childreen::findOrFail($data['id']);
        return $child->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'birthday' => $data['birthday'],
            'description' => $data['description'],
        ]);
    }

    public function newGroup(int $id){
        $Guruh = Guruh::get();
        $array = [];
        foreach ($Guruh as $key => $value) {
            $GuruhChildren = GuruhChildren::where('guruh_id',$value->id)->where('children_id',$id)->where('status','true')->first();
            if($GuruhChildren){}
            else{
                $array[$key]['guruh_id'] = $value->id;
                $array[$key]['name'] = $value->name;
            }
        }
        return $array;
    }

    public function changeGroups(array $data){
        $GuruhChildren = GuruhChildren::where('children_id',$data['id'])->where('status','true')->first();
        $GuruhChildren->end_date = date("Y-m-d");
        $GuruhChildren->end_description = $data['end_description'];
        $GuruhChildren->end_user_id = auth()->user()->id;
        $GuruhChildren->status = 'false';
        $GuruhChildren->save();
        return GuruhChildren::create([
            'guruh_id' => $data['guruh_id'],
            'children_id' => $data['id'],
            'start_date' => date("Y-m-d"),
            'start_description' => $data['end_description'] ?? '',
            'start_user_id' => auth()->user()->id,
            'end_date' =>  date("Y-m-d"),
            'end_description' => ' ', 
            'end_user_id' => auth()->user()->id,
            'status' => 'true',
        ]);
    }
 // "id" => "12"
 // "end_description" => "sfsfdsdfs"
    public function LeaveKindergartenRequest(array $data){
        //dd($data);
        $GuruhChildren = GuruhChildren::where('children_id',$data['id'])->where('status','true')->first();
        $GuruhChildren->end_date = date("Y-m-d");
        $GuruhChildren->end_description = $data['end_description'];
        $GuruhChildren->end_user_id = auth()->user()->id;
        $GuruhChildren->status = 'false';
        $GuruhChildren->save();
        $Childreen = Childreen::find($data['id']);
        $Childreen->status = 'cancel';
        return $Childreen->save();
    }


}
