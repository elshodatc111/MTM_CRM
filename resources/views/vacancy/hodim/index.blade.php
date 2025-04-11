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

        <!-- Card for Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Vakansiyalar Jadvali (Hodimlar)</h6>
                <!-- Yangi meneger qo‘shish tugmasi -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMenegerModal">
                    Yangi Vakansiya Qo‘shish
                </button>
            </div>
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ism</th>
                                <th>Lavozimi</th>
                                <th>Telefon raqam</th>
                                <th>Status</th>
                                <th>Ishga olindi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hodimlar as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td style="text-align:left"><a href="#">{{ $item->name }}</a></td>
                                    <td>
                                        @if ($item->type == 'oshpaz')
                                            <span class="badge badge-warning">Oshpaz</span>
                                        @elseif ($item->type == 'qarovul')
                                            <span class="badge badge-info">Qarovul</span>
                                        @elseif ($item->type == 'bogbon')
                                            <span class="badge badge-info">Bog'bon</span>
                                        @elseif ($item->type == 'farrosh')
                                            <span class="badge badge-info">Farrosh</span>
                                        @else
                                            <span class="badge badge-success">O'qituvchi</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->status == 'new')
                                            <span class="badge badge-info">Yangi</span>
                                        @elseif ($item->status == 'pedding')
                                            <span class="badge badge-warning">Kutilmoqda</span>
                                        @elseif ($item->status == 'cancel')
                                            <span class="badge badge-danger">Bekor qilindi</span>
                                        @else
                                            <span class="badge badge-success">Ishga olindi</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Hech narsa topilmadi</td>
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
                    <form method="POST" action="{{ route('vacancy_hodim_create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">FIO</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Yashash manzili</label>
                            <input type="text" class="form-control" id="addres" name="addres" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon raqami</label>
                            <input type="text" class="form-control phone" id="phone" value="+998" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Tug'ilgan kuni</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        <div class="form-group">
                            <label for="worked">Oldingi ish joyi</label>
                            <textarea class="form-control" id="worked" name="worked" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Lavozim</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Tanlang...</option>
                                <option value="oshpaz">Oshpaz</option>
                                <option value="qarovul">Qarovul</option>
                                <option value="bogbon">Bog'bon</option>
                                <option value="farrosh">Farrosh</option>
                                <option value="techer">O'qituvchi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Hodim haqida</label>
                            <textarea class="form-control" id="decription" name="decription" required></textarea>
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
