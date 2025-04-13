@extends('layouts.app02')

@section('title', 'Vakansiya')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vakansiya</h1>
        </div>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vacancy_child') }}">Bolalar jo'rnali</a></li>
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
        
        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bola haqida (
                            @if($VacancyChild['status'] == 'new')
                                <span class="text-primary">Yangi</span>
                            @elseif($VacancyChild['status'] == 'pedding')
                                <span class="text-warning">Kutilmoqda</span>  
                            @elseif($VacancyChild['status'] == 'cancel')
                                <span class="text-danger">Bekor qilindi</span> 
                            @elseif($VacancyChild['status'] == 'success')
                                <span class="text-success">Qabul qilindi</span> 
                            @endif
                        )</h6>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-striped table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <th style="text-align:left;">FIO</th>
                                        <td style="text-align:right;">{{ $VacancyChild['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Manzili</th>
                                        <td style="text-align:right;">{{ $VacancyChild['address'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Tug'ilgan kuni</th>
                                        <td style="text-align:right;">{{ $VacancyChild['birthday'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Telefon raqam</th>
                                        <td style="text-align:right;">{{ $VacancyChild['phone1'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Qo'shimcha telefon raqam</th>
                                        <td style="text-align:right;">{{ $VacancyChild['phone2'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Bola maqsadi</th>
                                        <td style="text-align:right;">{{ $VacancyChild['description'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;">Ro'yhatga olindi</th>
                                        <td style="text-align:right;">{{ $VacancyChild['created_at'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row text-center ml-2">
                    @if($VacancyChild['status'] == 'new' || $VacancyChild['status'] == 'pedding')
                        <button type="button" class="btn btn-primary col-lg-4 m-1 mb-2" data-toggle="modal" data-target="#comments">Izoh qoldirish</button>
                        <button type="button" class="btn btn-danger col-lg-3 m-1 mb-2" data-toggle="modal" data-target="#cancels">Bekor qilish</button>
                        <button type="button" class="btn btn-success col-lg-4 m-1 mb-2" data-toggle="modal" data-target="#success">Qabul qilish</button>
                    @endif
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bola haqida izohlar</h6>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-striped table-hover" width="100%" cellspacing="0" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Izoh</th>
                                        <th>Izoh vaqti</th>
                                        <th>Meneger</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($VacancyChild['comments'] as $key => $comment)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $comment['comment'] }}</td>
                                            <td>{{ $comment['created_at'] }}</td>
                                            <td>{{ $comment['user']['name'] }}</td>
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
                    <form method="POST" action="{{ route('vacancy_child_comment_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="{{ $VacancyChild['id'] }}">
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
    <div class="modal fade" id="cancels" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bekor qilish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_cancel_create') }}">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="{{ $VacancyChild['id'] }}">
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
    <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Qabul qilish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <input type="hidden" name="vacancy_child_id" value="{{ $VacancyChild['id'] }}">
                        <div class="form-group">
                            <label for="comment">Qabul qilinadigan guruh</label>
                            <select name="" id="" class="form-control">
                                <option value="">Tanlang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Qabul qilish sababi</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Saqlash</button>
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
