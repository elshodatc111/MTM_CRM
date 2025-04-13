@extends('layouts.app01')

@section('title', 'Dam olish kunlari')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dam olish kunlari</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item">Dam olish kunlari</li>
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
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <button type="button" class="btn btn-sm btn-danger w-100 mx-1" data-toggle="modal" data-target="#deleteDays">Arxivni o'chirish</button>
                <button type="button" class="btn btn-sm btn-info w-100 mx-1" data-toggle="modal" data-target="#YangiShanbaKunlari">Yangi shanba kunlarni qo'shish</button>
                <button type="button" class="btn btn-sm btn-warning w-100 mx-1" data-toggle="modal" data-target="#YangiYakshanba">Yangi yakshanba kunlarni qo'shish</button>
                <button type="button" class="btn btn-sm btn-primary w-100 mx-1" data-toggle="modal" data-target="#yangidamkuni">Yangi dam olish kuni</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Dam olish kuni</th>
                                <th>Dam olish kuni haqida</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Days as $day)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($day->days)->format('Y-m-d') }}</td>
                                    <td>{{ $day->description }}</td>
                                    <td>
                                        <form action="{{ route('days.destroy') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{ $day->id }}">
                                            <button type="submit" class="btn btn-danger p-0 px-1"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">Hech narsa topilmadi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteDays" tabindex="-1" role="dialog" aria-labelledby="deleteDays" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('days.delete.archive') }}">
                        @csrf
                        <br>
                        <div class="form-group w-100 text-center">
                            <label for="name">Arxiv Dam olish kunlarni o'chirishni xoxlaysizmi?</label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100"  data-dismiss="modal" aria-label="Close">Bekor qilish</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">O'chirish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="YangiShanbaKunlari" tabindex="-1" role="dialog" aria-labelledby="YangiShanbaKunlari" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('createShanba') }}">
                        @csrf
                        <br>
                        <div class="form-group w-100 text-center">
                            <label for="name">Joriy kundan 1 yil mobaynida barcha <b>shanba</b> kunlarni dam olish kunlari qilib belgilash tasdiqlaysizmi? </label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100"  data-dismiss="modal" aria-label="Close">Bekor qilish</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Tasdiqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="YangiYakshanba" tabindex="-1" role="dialog" aria-labelledby="YangiYakshanba" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('createYakshanba') }}">
                        @csrf
                        <br>
                        <div class="form-group w-100 text-center">
                            <label for="name">Joriy kundan 1 yil mobaynida barcha <b>yakshanba</b> kunlarni dam olish kunlari qilib belgilash tasdiqlaysizmi? </label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100"  data-dismiss="modal" aria-label="Close">Bekor qilish</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Tasdiqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="yangidamkuni" tabindex="-1" role="dialog" aria-labelledby="yangidamkuni" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="yangidamkuni">Yangi dam olish kuni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('crateDamKuni') }}">
                        @csrf
                        <div class="form-group">
                            <label for="days">Dam olish kuni</label>
                            <input type="date" class="form-control" id="days" name="days" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Dam olish kuni haqida</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
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
