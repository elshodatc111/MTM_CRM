@extends('layouts.app01')

@section('title', 'Guruhlar')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Guruhlar</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item">Guruhlar</li>
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
                <h6 class="m-0 font-weight-bold text-primary">Guruhlar</h6>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMenegerModal">
                    Yangi Guruh
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:12px;">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">#</th>
                                <th rowspan="2" class="text-center align-middle">Guruh</th>
                                <th rowspan="2" class="text-center align-middle">Bolalar soni</th>
                                <th colspan="3" class="text-center align-middle">To'lovlar</th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">Guruh narxi</th>
                                <th class="text-center align-middle">Tarbiyachiga(%)</th>
                                <th class="text-center align-middle">Yardamchi tarbiyachiga(%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($group as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('groups_show', $item['id']) }}">{{ $item['name'] }}</a>
                                    </td>
                                    <td class="text-center">{{ $item['user_count'] }}</td>
                                    <td class="text-center">{{ $item['amount'] }} so'm</td>
                                    <td class="text-center">{{ $item['katta_tarbiyachi'] }}%</td>
                                    <td class="text-center">{{ $item['kichik_tarbiyachi'] }}%</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Ma'lumotlar mavjud emas</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Yangi Guruh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('groups_create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Guruh nomi</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Guruh narxi</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="katta_tarbiyachi">Tarbiyachiga to'lov (Barcha to'lovlardan %)</label>
                            <input type="number" min=0 max=100 class="form-control" name="katta_tarbiyachi" required>
                        </div>
                        <div class="form-group">
                            <label for="kichik_tarbiyachi">Yordamchi tarbiyachiga to'lov (Barcha to'lovlardan %)</label>
                            <input type="number" min=0 max=100 class="form-control" name="kichik_tarbiyachi" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Saqlash</button>
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

@endsection

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
@endpush
