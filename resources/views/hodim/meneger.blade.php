@extends('layouts.app')

@section('title', 'Menegerlar')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menegerlar</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Menegerlar Jadvali</h6>
                <!-- Yangi meneger qo‘shish tugmasi -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMenegerModal">
                    Yangi Meneger Qo‘shish
                </button>
            </div>
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ism</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Status</th>
                                <th>Ishga olindi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($User as $meneger)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align:left"><a href="">{{ $meneger->name }}</a></td>
                                    <td>{{ $meneger->email }}</td>
                                    <td>{{ $meneger->phone }}</td>
                                    <td>
                                        @if ($meneger->status=='true')
                                            <span class="badge badge-success">Aktiv</span>
                                        @elseif ($meneger->status=='delete')
                                            <span class="badge badge-danger">Bo'shatilgan</span>
                                        @elseif ($meneger->status=='pedding')
                                            <span class="badge badge-danger">Tatilda</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $meneger->created_at }}
                                    </td>
                                </tr>
                            @endforeach
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
                    <h5 class="modal-title" id="exampleModalLabel">Yangi Meneger Qo‘shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('hodim_create') }}">
                        @csrf
                        <input type="hidden" name="type" value="meneger">
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
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Meneger haqida</label>
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
@endpush
