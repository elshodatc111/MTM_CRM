@extends('layouts.app02')

@section('title', 'Aktiv bolalar')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bola haqida</h1>
        </div>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('child') }}">Aktiv bolalar</a></li>
                <li class="breadcrumb-item">Bola haqida</li>
            </ol>
        </nav>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul> 
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Bola haqida</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="qarindoshlar-tab" data-toggle="tab" href="#qarindoshlar" role="tab"
                        aria-controls="qarindoshlar" aria-selected="false">Yaqin qarindoshlari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="guruhlari-tab" data-toggle="tab" href="#guruhlari" role="tab"
                        aria-controls="guruhlari" aria-selected="false">Guruhlar tarixi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tulovlar-tab" data-toggle="tab" href="#tulovlar" role="tab"
                        aria-controls="tulovlar" aria-selected="false">To'lovlari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="davomadTarixi-tab" data-toggle="tab" href="#davomadTarixi" role="tab"
                        aria-controls="davomadTarixi" aria-selected="false">Davomad tarixi</a>
                    </li>
                </ul>
                <div class="tab-content pt-3 border-top mt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-lg-4">
                                <h5 class="text-primary w-100 text-center mb-3">{{ $about['name'] }}</h5>
                                <table class="table table-sm table-bordered table-striped" style="font-size: 16px;">
                                    <tbody>
                                        <tr><th>Yashash manzili</th><td style="text-align:right">{{ $about['address'] }}</td></tr>
                                        <tr><th>Tug'ilgan kuni</th><td style="text-align:right">{{ $about['birthday'] }}</td></tr>
                                        <tr><th>Ro'yhatga olindi</th><td style="text-align:right">{{ $about['created_at'] }}</td></tr>
                                        <tr><th>Oxirgi yangilanish</th><td style="text-align:right">{{ $about['updated_at'] }}</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4"> 
                                <h5 class="text-primary w-100 text-center mb-3">Balans: 
                                    @if($about['balans']>0)
                                        <span class="text-success">{{ number_format($about['balans'], 0, ',', ' ') }}
                                    @elseif($about['balans']==0)
                                        {{ number_format($about['balans'], 0, ',', ' ') }}       
                                    @else
                                        <span class="text-danger">{{ number_format($about['balans'], 0, ',', ' ') }}
                                    @endif
                                    so'm</h5>
                                <table class="table table-sm table-bordered table-striped" style="font-size: 16px;">
                                    <tbody>
                                        <tr><th>Guruh</th><td style="text-align:right">
                                            @if($groupabout['guruh']=='null')
                                                <p class="text-danger p-0 m-0">Bizni tark etdi</p>
                                            @else
                                                <a href="{{ route('groups_show', $groupabout['guruh_id'] )}}">{{ $groupabout['guruh'] }}</a>
                                            @endif
                                        </td></tr>
                                        <tr><th>Ro'yhatga olindi</th><td style="text-align:right">{{ $groupabout['start'] }}</td></tr>
                                        <tr><th>Menejer</th><td style="text-align:right">{{ $groupabout['meneger'] }}</td></tr>
                                        <tr><th>Ro'yhatga olish haqida</th><td style="text-align:right">{{ $groupabout['about'] }}</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-success w-100 mb-1" data-toggle="modal" data-target="#paymart">
                                    <i class="fas fa-money-bill-wave"></i> To‘lov qilish
                                </button>
                                <button type="button" class="btn btn-danger w-100 mb-1" data-toggle="modal" data-target="#paymart_return">
                                    <i class="fas fa-undo-alt"></i> To‘lovni qaytarish
                                </button>
                                @if(auth()->user()->status !=='admin')
                                <button type="button" class="btn btn-warning text-white w-100 mb-1" data-toggle="modal" data-target="#add_chegirma">
                                    <i class="fas fa-tags"></i> Chegirma kiritish
                                </button>
                                @endif
                                @if($groupabout['guruh']!=='null')
                                <button type="button" class="btn btn-primary w-100 mb-1" data-toggle="modal" data-target="#group_change">
                                    <i class="fas fa-sync-alt"></i> Guruhni almashtirish
                                </button>
                                <button type="button" class="btn btn-secondary w-100 mb-1" data-toggle="modal" data-target="#group_end">
                                    <i class="fas fa-sign-out-alt"></i> Bog‘chani tark etdi
                                </button>
                                <button type="button" class="btn btn-outline-dark w-100 mb-1" data-toggle="modal" data-target="#edit">
                                    <i class="fas fa-edit"></i> Tahrirlash
                                </button>
                                <button type="button" class="btn btn-outline-info w-100 mb-1" data-toggle="modal" data-target="#comments">
                                    <i class="fas fa-comment-dots"></i> Izoh qoldirish
                                </button>
                                @endif
                            </div>
                            <div class="col-12">
                                <hr>
                                <h5 class="text-primary w-100 mb-3">Bola haqida qoldirilgan izohlar</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center" style="font-size: 12px;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Izoh</th>
                                                <th>Izoh vaqti</th>
                                                <th>Meneger</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($comments as $item)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['created_at'] }}</td>
                                                    <td>{{ $item['meneger'] }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan=4 class="text-center">Ma'lumot topilmadi.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="qarindoshlar" role="tabpanel" aria-labelledby="qarindoshlar-tab">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="text-primary w-100 mb-3">Bolaning yaqin qarindoshlari</h5>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-outline-info w-100 mb-1" data-toggle="modal" data-target="#vasiy">
                                    <i class="fas fa-plus"></i> Yangi qo'shish
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center" style="font-size: 12px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Kim</th>
                                        <th>FIO</th>
                                        <th>Telefon raqami</th>
                                        <th>Qo'shimcha telefon raqami</th>
                                        <th>Meneger</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Relatives as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['kim'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['phone1'] }}</td>
                                            <td>{{ $item['phone2'] }}</td>
                                            <td>{{ $item['meneger'] }}</td>
                                            <td>
                                                <form action="{{ route('groups_delete_relatives') }}" method="post">
                                                    @csrf 
                                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                    <button type="submit" class="btn btn-danger px-1 py-0"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty      
                                        <tr>
                                            <td colspan=7 class="text-center">Malumot topilmadi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="guruhlari" role="tabpanel" aria-labelledby="guruhlari-tab">
                        <h5 class="text-primary w-100 mb-3">Guruhlar tarixi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center" style="font-size: 12px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Guruh</th>
                                        <th>Guruhga qo'shildi</th>
                                        <th>Izoh</th>
                                        <th>Meneger</th>
                                        <th>Guruhdan o'chirildi</th>
                                        <th>Guruhdan o'chirish sababi</th>
                                        <th>Meneger</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($groupHistory as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['guruh_name'] }}</td>
                                            <td>{{ $item['start_date'] }}</td>
                                            <td>{{ $item['start_description'] }}</td>
                                            <td>{{ $item['start_user_id'] }}</td>
                                            <td>{{ $item['end_date'] }}</td>
                                            <td>{{ $item['end_description'] }}</td>
                                            <td>{{ $item['end_user_id'] }}</td>
                                            <td>
                                                @if($item['status'] == 'true')
                                                    Aktiv 
                                                @else
                                                    Tark etgan 
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan=9 class="text-center">Malumot topilmadi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tulovlar" role="tabpanel" aria-labelledby="tulovlar-tab">
                        <h5 class="text-primary w-100 mb-3">To'lovlar</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center" style="font-size: 12px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>To'lov summasni</th>
                                        <th>To'lov turi</th>
                                        <th>To'lov vaqti</th>
                                        <th>Meneger</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="davomadTarixi" role="tabpanel" aria-labelledby="davomadTarixi-tab">
                        <h5 class="text-primary w-100 mb-3">Davomad tarixi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center" style="font-size: 12px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Guruh</th>
                                        <th>Davomad vaqti</th>
                                        <th>To'lov summasi</th>
                                        <th>Davomad Statusi</th>
                                        <th>Meneger</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Meneger -->
    
    <div class="modal fade" id="paymart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To'lov qilish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <input type="hidden" name="child_id" value="#">
                        <div class="form-group">
                            <label for="comment">Izoh matni</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymart_return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To'lov qaytarish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <input type="hidden" name="child_id" value="#">
                        <div class="form-group">
                            <label for="comment">Izoh matni</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_chegirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chegirma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <input type="hidden" name="child_id" value="#">
                        <div class="form-group">
                            <label for="comment">Izoh matni</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="group_change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guruhni almashtirish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_change_group') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="guruh_id">Yangi guruhni tanlang</label>
                            <select required name="guruh_id" class="form-control">
                                <option value="">Tanlang...</option>
                                @foreach($newGroup as $item)
                                <option value="{{ $item['guruh_id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="end_description">Guruhni almashtirish haqida</label>
                            <textarea class="form-control" id="end_description" name="end_description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="group_end" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tark etish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_end') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="end_description">Bog'chani tark etish haqida</label>
                            <textarea class="form-control" id="end_description" name="end_description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Taxrirlash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_child_update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="name">FIO</label>
                            <input type="text" required name="name"  value="{{ $about['name'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Yashash manzili</label>
                            <input type="text" required name="address"  value="{{ $about['address'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Tug'ilgan kuni</label>
                            <input type="date" required name="birthday"  value="{{ $about['birthday'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Bola haqida</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $about['description'] }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Izoh qoldirsih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('child_comments') }}">
                        @csrf
                        <input type="hidden" name="children_id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="description">Izoh matni</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vasiy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi vasiy kiritish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_add_relatives') }}">
                        @csrf
                        <input type="hidden" name="child_id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="kim">Yangi vasiy kim (Otasi,Onasi,Yaqin qarindoshi)</label>
                            <input type="text" required name="kim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">FIO</label>
                            <input type="text" required name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone1">Telefon raqami</label>
                            <input type="text" required name="phone1" value="+998" class="form-control phone">
                        </div>
                        <div class="form-group">
                            <label for="phone2">Qo'shimcha telefon raqami</label>
                            <input type="text" required name="phone2" value="+998" class="form-control phone">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    

@endsection

@push('scripts')
    <!-- Bootstrap Modal JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    
@endpush
