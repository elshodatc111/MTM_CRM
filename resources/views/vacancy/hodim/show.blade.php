@extends('layouts.app02')

@section('title', 'Hodimlar Jurnali')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hodimlar Jurnali</h1>
        </div>
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
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vacancy_hodim') }}">Hodimlar Jurnali</a></li>
                <li class="breadcrumb-item">Hodim haqida</li>
            </ol>
        </nav>
        <!-- Card for Table -->
         <div class="container-fluid mb-3">
            @if($hodim->status==='new')
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">Yangi</div>
                </div>
            @elseif($hodim->status==='pedding')
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100">Ko'rib chiqlilmoqda</div>
                </div>
            @elseif($hodim->status==='cancel')
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Bekor qilindi</div>
                </div>
            @else 
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Qabul qilindi</div>
                </div>
            @endif
         </div>
        
        
        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Hodim</h6>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-striped table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <th style="text-align:left;">FIO</th>
                                        <td style="text-align:right;">{{ $hodim->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Yashash manzili</th>
                                        <td style="text-align:right;">{{ $hodim->addres }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Telefon raqami</th>
                                        <td style="text-align:right;">{{ $hodim->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Tug'ilgan kuni</th>
                                        <td style="text-align:right;">{{ $hodim->birthday }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Oldingi ish joyi</th>
                                        <td style="text-align:right;">{{ $hodim->worked }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Oldingi ish haqida</th>
                                        <td style="text-align:right;">{{ $hodim->worked_comment }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Royhatga olindi</th>
                                        <td style="text-align:right;">{{ $hodim->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row px-3">
                    @if($hodim->status==='new' OR $hodim->status==='pedding')
                        <button type="button" class="btn btn-primary col-lg-4 mb-2" data-toggle="modal" data-target="#comments">
                            Izoh qoldirish
                        </button>
                        @if(auth()->user()->type==='admin')
                            <button type="button" class="btn btn-danger col-lg-4 mb-2" data-toggle="modal" data-target="#canceks">
                                Bekor qilish
                            </button>
                            <button type="button" class="btn btn-success col-lg-4 mb-2" data-toggle="modal" data-target="#successes">
                                Ishga olish
                            </button>
                        @endif
                    @endif
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Hodim haqida izohlar</h6>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-striped table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Izoh</th>
                                        <th>Izoh vaqti</th>
                                        <th>Meneger</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($comment as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->comment }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Izohlar mavjud emas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Meneger -->
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
                    <form method="POST" action="{{ route('vacancy_hodim_comment') }}">
                        @csrf
                        <input type="hidden" name="vacancy_id" value="{{ $hodim->id }}">
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
    <div class="modal fade" id="canceks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bekor qilish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_hodim_cancel') }}">
                        @csrf
                        <input type="hidden" name="vacancy_id" value="{{ $hodim->id }}">
                        <div class="form-group">
                            <label for="comment">Bekor qilish sababi</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Bekor qilish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ishga olish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_hodim_success') }}">
                        @csrf
                        <input type="hidden" name="vacancy_id" value="{{ $hodim->id }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Hodim lavozimi</label>
                            <select name="type" class="form-control" id="type" required>
                                <option value="">Tanlang...</option>
                                <option value="tarbiyachi">Tarbiyachi</option>
                                <option value="kichik_tarbiyachi">Yordamchi Tarbiyachi</option>
                                <option value="techer">O'qituvchi</option>
                                <option value="oshpaz">Oshpaz</option>
                                <option value="qarovul">Qarovul</option>
                                <option value="bogbon">Bog'bod</option>
                                <option value="farrosh">Farrosh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="decription">Hodim haqida</label>
                            <textarea class="form-control" id="decription" name="decription" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Ishga olish</button>
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
