@extends('layouts.app01')

@section('title', 'Vakansiya')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vakansiya</h1>
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
                <li class="breadcrumb-item">Vakansiyalar</li>
            </ol>
        </nav>

        <!-- Card for Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Bolalar Jurnali</h6>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMenegerModal">
                    Yangi Bola Qo‘shish
                </button>
            </div>
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>FIO</th>
                                <th>Yashash manzili</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Bizdan nima xohlamoqda</th>
                                <th>Status</th>
                                <th>Qiziqish bildirhan vaqt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($VacancyChild as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align:left">
                                        <a href="{{ route('vacancy_child_show',$item['id']) }}}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->birthday }}</td>
                                    <td>{{ $item->description }} </td>
                                    <td>
                                        @if ($item->status == 'new')
                                            <span class="badge badge-primary">Yangi</span>
                                        @elseif ($item->status == 'pedding')
                                            <span class="badge badge-warning">Kutilmoqda</span>
                                        @elseif ($item->status == 'success')
                                            <span class="badge badge-success">Qabul qilingan</span>
                                        @else
                                            <span class="badge badge-danger">Rad etilgan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Ma'lumotlar mavjud emas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal for Add Meneger -->
    <div class="modal fade" id="addMenegerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi Vakansiya Qo‘shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vacancy_child_create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">FIO</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Yashash manzili</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone1">Telefon raqami</label>
                            <input type="text" class="form-control phone" id="phone1" value="+998" name="phone1" required>
                        </div>
                        <div class="form-group">
                            <label for="phone2">Qoshimcha telefon raqami</label>
                            <input type="text" class="form-control phone" id="phone2" value="+998" name="phone2" required>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Tug'ilgan kuni</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Bizdan nima xohlamoqda</label>
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
