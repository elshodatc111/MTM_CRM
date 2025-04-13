@extends('layouts.app01')

@section('title', 'Hodimlar Jurnali')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hodimlar Jurnali</h1>
        </div>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item">Hodimlar Jurnali</li>
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
                <h6 class="m-0 font-weight-bold text-primary">Hodimlar Jurnali</h6>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMenegerModal">
                    Yangi Hodim Qo‘shish
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('vacancy_hodim') }}" method="get" class="mb-3">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Qidiruv..." 
                            value="{{ request('search') }}" 
                        >
                    </form>

                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:12px;">
                        <thead>
                            <tr class="text-center">
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
                                    <td class="text-center">{{ $hodimlar->firstItem() + $key }}</td>
                                    <td style="text-align:left">
                                        <a href="{{ route('vacancy_hodim_show', $item->id) }}">{{ $item->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        @switch($item->type)
                                            @case('oshpaz')
                                                <span class="badge badge-warning">Oshpaz</span>
                                                @break
                                            @case('qarovul')
                                                <span class="badge badge-info">Qarovul</span>
                                                @break
                                            @case('bogbon')
                                                <span class="badge badge-info">Bog'bon</span>
                                                @break
                                            @case('farrosh')
                                                <span class="badge badge-info">Farrosh</span>
                                                @break
                                            @default
                                                <span class="badge badge-success">O'qituvchi</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                    <td class="text-center">
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
                                    <td style="text-align:right">{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Hech narsa topilmadi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $hodimlar->links() }}
                    </div>
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
                            <label for="email">Oldingi ish haqida</label>
                            <textarea class="form-control" id="decription" name="decription" required></textarea>
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
