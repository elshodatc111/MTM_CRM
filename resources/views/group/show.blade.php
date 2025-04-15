@extends('layouts.app02')

@section('title', 'Guruh haqida')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Guruh haqida</h1>
        </div>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Guruhlar</a></li>
                <li class="breadcrumb-item">Guruh haqida</li>
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
        
        <div class="card shadow mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs row" id="myTab" role="tablist">
                    <li class="nav-item col-lg-3 col-6 text-center">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#guruh" role="tab" aria-controls="guruh" aria-selected="true">Guruh haqida</a>
                    </li>
                    <li class="nav-item col-lg-3 col-6 text-center">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#bolalar" role="tab" aria-controls="bolalar" aria-selected="false">Guruh bolalari</a>
                    </li>
                    <li class="nav-item col-lg-3 col-6 text-center">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#davomad" role="tab" aria-controls="davomad" aria-selected="false">Bolalar davomad</a>
                    </li>
                    <li class="nav-item col-lg-3 col-6 text-center">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tarbiyachi" role="tab" aria-controls="tarbiyachi" aria-selected="false">Tarbiyachilar tarixi</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="guruh" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="text-primary mb-3">Guruh ma'lumotlari</h6>
                                    <table class="table table-sm table-bordered table-striped" style="font-size: 13px;">
                                        <tbody>
                                            <tr><th>Guruh</th><td class="text-end">{{ $about['name'] }}</td></tr>
                                            <tr><th>Guruh narxi</th><td class="text-end">{{ $about['amount'] }} so'm</td></tr>
                                            <tr><th>Tarbiyachiga to'lov</th><td class="text-end">{{ $about['katta_amount'] }} %</td></tr>
                                            <tr><th>Yordamchi tarbiyachiga to'lov</th><td class="text-end">{{ $about['kichik_amount'] }} %</td></tr>
                                            <tr><th>Guruh ochilgan vaqt</th><td class="text-end">{{ $about['created_at'] }}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="text-success mb-3">Guruh tarkibi</h6>
                                    <table class="table table-sm table-bordered table-striped" style="font-size: 13px;">
                                        <tbody>
                                            <tr><th>Bolalar soni</th><td class="text-end">{{ $about['bolalar'] }}</td></tr>
                                            <tr><th>Tarbiyachi</th><td class="text-end">{{ $about['katta_tarbiyachi'] }}</td></tr>
                                            <tr><th>Yordamchi tarbiyachi</th><td class="text-end">{{ $about['kichik_tarbiyachi'] }}</td></tr>
                                            <tr><th>Meneger</th><td class="text-end">{{ $about['meneger'] }}</td></tr>
                                            <tr><th>Yangilangan vaqt</th><td class="text-end">{{ $about['updated_at'] }}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @if($about['katta_tarbiyachi']=='Tanlanmagan')
                                            <button class="btn btn-outline-primary w-100 mb-1" data-toggle="modal" data-target="#yangitarbiyachi"> <i class="fa fa-user-plus"></i> Tarbiyachi biriktirish</button>
                                        @else
                                            <button class="btn btn-outline-primary w-100 mb-1" data-toggle="modal" data-target="#changertarbiyachi"> <i class="fa fa-repeat"></i> Tarbiyachini almashtirish</button>
                                        @endif
                                        @if($about['kichik_tarbiyachi']=='Tanlanmagan')
                                            <button class="btn btn-outline-success w-100 mb-1" data-toggle="modal" data-target="#yangiyordamchitarbiyachi"> <i class="fa fa-user-plus"></i> Yordamchi tarbiyachini biriktirish</button>
                                        @else
                                            <button class="btn btn-outline-success w-100 mb-1" data-toggle="modal" data-target="#changeyordamchitarbiyachi"> <i class="fa fa-repeat"></i> Yordamchi tarbiyachini almashtirish</button>
                                        @endif
                                        <button class="btn btn-outline-warning w-100 mb-1" data-toggle="modal" data-target="#taxrirlash"> <i class="fa fa-pencil-square-o"></i> Guruhni tahrirlash</button>
                                        <button class="btn btn-outline-danger w-100 mb-1" data-toggle="modal" data-target="#ochirishchild"> <i class="fa fa-user-times"></i> Guruhdan bolani o'chirish</button>
                                        <button class="btn btn-outline-info w-100 mb-1" data-toggle="modal" data-target="#izohqoldirish"> <i class="fa fa-commenting"></i> Guruh haqida izoh qoldirish</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive mb-3">
                                <h5>Guruh haqida izohlar</h5>
                                <table class="table table-bordered text-center" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Izoh matni</th>
                                            <th>Izoh vaqti</th>
                                            <th>Meneger</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>---</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bolalar" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive mb-3">
                        <h5>Guruh aktiv bolalar</h5>
                        <table class="table table-bordered text-center" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FIO</th>
                                    <th>Guruhga qo'shildi</th>
                                    <th>Izoh</th>
                                    <th>Meneger</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-3">
                        <h5>Guruhni tark etgan bolalar</h5>
                        <table class="table table-bordered text-center" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FIO</th>
                                    <th>Guruhga qo'shildi</th>
                                    <th>Izoh</th>
                                    <th>Meneger</th>
                                    <th>Guruhga tark etdi</th>
                                    <th>Izoh</th>
                                    <th>Meneger</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="davomad" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="table-responsive mb-3">
                        <h5>Joriy oy uchun davomad</h5>
                        <table class="table table-bordered text-center" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>F.I.O</th>
                                    <th>12-Apr</th>
                                    <th>13-Apr</th>
                                    <th>14-Apr</th>
                                    <th>15-Apr</th>
                                    <th>16-Apr</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="student-name">Aliyev Alisher</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="absent">❌</td>
                                    <td class="present">✅</td>
                                    <td class="absent">❌</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="student-name">Karimova Madina</td>
                                    <td class="absent">❌</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mb-3">
                        <h5>O'tgan oy uchun davomad</h5>
                        <table class="table table-bordered text-center" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>F.I.O</th>
                                    <th>12-Apr</th>
                                    <th>13-Apr</th>
                                    <th>14-Apr</th>
                                    <th>15-Apr</th>
                                    <th>16-Apr</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="student-name">Aliyev Alisher</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="absent">❌</td>
                                    <td class="present">✅</td>
                                    <td class="absent">❌</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="student-name">Karimova Madina</td>
                                    <td class="absent">❌</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                    <td class="present">✅</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="tarbiyachi" role="tabpanel" aria-labelledby="contact-tab">
                    
                    <div class="table-responsive mt-3">
                        <h5>Tarbiyachilar tarixi</h5>
                        <table class="table table-bordered text-center" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FIO</th>
                                    <th>Guruhga qo'shildi</th>
                                    <th>Izoh</th>
                                    <th>Meneger</th>
                                    <th>Guruhga tark etdi</th>
                                    <th>Izoh</th>
                                    <th>Meneger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tarbiyachiHistory as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align:left"><a href="{{ $item['user_id'] }}">{{ $item['tarbiyachi'] }}</a></td>
                                    <td>{{ $item['start_date'] }}</td>
                                    <td>{{ $item['start_description'] }}</td>
                                    <td>{{ $item['start_meneger'] }}</td>
                                    <td>{{ $item['end_date'] }}</td>
                                    <td>{{ $item['end_description'] }}</td>
                                    <td>{{ $item['end_meneger_id'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=8 class="text-center">Ma'lumotlar topilmadi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="yangitarbiyachi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tarbiyachi biriktirish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_add_attach') }}">
                        @csrf
                        <input type="hidden" name="guruh_id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="comment">Tarbiyachini tanlang</label>
                            <select name="user_id" required class="form-control">
                                <option value="">Tanlang ...</option>
                                @foreach($katta_tarbiyachi as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_description">Biriktirish haqida</label>
                            <textarea class="form-control" id="start_description" name="start_description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changertarbiyachi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tarbiyachi yangilash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_comment_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="#">
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
    <div class="modal fade" id="yangiyordamchitarbiyachi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yordamchi tarbiyachi biriktirish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_add_attach') }}">
                        @csrf
                        <input type="hidden" name="guruh_id" value="{{ $about['id'] }}">
                        <div class="form-group">
                            <label for="comment">Tarbiyachini tanlang</label>
                            <select name="user_id" required class="form-control">
                                <option value="">Tanlang ...</option>
                                @foreach($kichikTarbiyachi as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_description">Biriktirish haqida</label>
                            <textarea class="form-control" id="start_description" name="start_description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changeyordamchitarbiyachi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yordamchi tarbiyachi yangilash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_comment_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="#">
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
    <div class="modal fade" id="taxrirlash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Taxrirlash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="form-group">
                            <label for="name">Guruh nomi</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $about['name'] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Guruh narxi</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ number_format($about['amount'], 0, '.', ' ') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="katta_tarbiyachi">Tarbiyachiga to'lov (Barcha to'lovlardan %)</label>
                            <input type="number" min=0 max=100 class="form-control" name="katta_tarbiyachi" value="{{ $about['katta_amount'] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kichik_tarbiyachi">Yordamchi tarbiyachiga to'lov (Barcha to'lovlardan %)</label>
                            <input type="number" min=0 max=100 class="form-control" name="kichik_tarbiyachi" value="{{ $about['kichik_amount'] }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">O'zgarishlarni saqlash</button>
                    </form>
                    <script>
                        const amountInput = document.getElementById('amount');
                        amountInput.addEventListener('input', function (e) {
                            let value = this.value.replace(/\s/g, ''); 
                            value = value.replace(/\D/g, ''); 
                            if (value.length > 1 && value.startsWith('0')) {
                                value = value.replace(/^0+/, '');
                            }
                            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                            this.value = formattedValue;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ochirishchild" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">bolani o'chirish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_comment_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="#">
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
    <div class="modal fade" id="izohqoldirish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Izoh qoldirish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_comment_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="#">
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
