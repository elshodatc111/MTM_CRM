@extends('layouts.app01')

@section('title', 'Kassa')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kassa</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item">Kassa</li>
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
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success text-white">
                        <h6 class="m-0 font-weight-bold w-100 text-center">
                            <i class="fas fa-wallet mr-2"></i> Kassada mavjud
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Naqt</th>
                                    <th>Plastik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($kassa['kassa_naqt'], 0, ',', ' ') }} so'm</td>
                                    <td>{{ number_format($kassa['kassa_plastik'], 0, ',', ' ') }} so'm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning text-dark">
                        <h6 class="m-0 font-weight-bold w-100 text-center">
                            <i class="fas fa-hourglass-half mr-2"></i> Chiqim kutilmoqda
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Naqt</th>
                                    <th>Plastik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($kassa['naqt_chiqim_pedding'], 0, ',', ' ') }} so'm</td>
                                    <td>{{ number_format($kassa['plastik_chiqim_pedding'], 0, ',', ' ') }} so'm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger text-white">
                        <h6 class="m-0 font-weight-bold w-100 text-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Xarajat kutilmoqda
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Naqt</th>
                                    <th>Plastik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($kassa['naqt_xarajat_pedding'], 0, ',', ' ') }} so'm</td>
                                    <td>{{ number_format($kassa['plastik_xarajat_pedding'], 0, ',', ' ') }} so'm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-center">
                            <h6 class="m-0 font-weight-bold text-warning mb-2">
                                <i class="fas fa-clock mr-2"></i> Tasdiqlanish kutilmoqda
                            </h6>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-sm btn-warning text-dark w-100 mb-2" data-toggle="modal" data-target="#kassadanchiqim">
                                <i class="fas fa-arrow-circle-down mr-1"></i> Kassadan chiqim
                            </button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-sm btn-danger w-100 mb-2" data-toggle="modal" data-target="#kassadanxarajat">
                                <i class="fas fa-money-bill-wave mr-1"></i> Kassadan xarajat
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Chiqim turi</th>
                                    <th class="text-center align-middle">Chiqim Summasi</th>
                                    <th class="text-center align-middle">Chiqim haqida</th>
                                    <th class="text-center align-middle">Meneger</th>
                                    <th class="text-center align-middle">Chiqim vaqti</th>
                                    <th class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getMoliyaHistory as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>
                                        @if($item['type'] == 'kassa_chiqim_naqt')
                                            Chiqim(Naqt)   
                                        @elseif($item['type'] == 'kassa_chiqim_pastik') 
                                            Chiqim(Plastik)
                                        @elseif($item['type'] == 'kassa_xarajat_plastik') 
                                            Xarajat(Plastik)
                                        @else
                                            Xarajat(Naqt)
                                        @endif
                                    </td>
                                    <td>
                                        {{ number_format($item['amount'], 0, ',', ' ') }} so'm
                                    </td>
                                    <td>{{ $item['start_description'] }}</td>
                                    <td>{{ $item['meneger'] }}</td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td class="text-center">
                                        <div style="display: flex; gap: 5px;">
                                            <form action="{{ route('kassa_trash') }}" method="post">
                                                @csrf 
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button class="btn btn-danger p-0 px-1"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <form action="{{ route('kassa_success') }}" method="post">
                                                @csrf 
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button class="btn btn-primary p-0 px-1"><i class="fa fa-check"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan=7 class="text-center">Ma'lumot topilmadi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="kassadanchiqim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kassadan chiqim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center">
                            <tr>
                                <th colspan=2>Kassada mavjud</th>
                            </tr>
                            <tr>
                                <td>Naqt</td>
                                <td>Plastik</td>
                            </tr>
                            <tr>
                                <td>{{ number_format($kassa['kassa_naqt'], 0, ',', ' ') }} so'm</td>
                                <td>{{ number_format($kassa['kassa_plastik'], 0, ',', ' ') }} so'm</td>
                            </tr>
                        </table>
                        <form method="POST" action="{{ route('kassa_chiqim') }}">
                            @csrf
                            <input type="hidden" name="kassa_naqt" value="{{ $kassa['kassa_naqt'] }}">
                            <input type="hidden" name="kassa_plastik" value="{{ $kassa['kassa_plastik'] }}">
                            <div class="form-group">
                                <label for="amount">Chiqim summasi</label>
                                <input type="text" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Chiqim turi</label>
                                <select name="type" class="form-control">
                                    <option value="">Tanlang...</option>
                                    <option value="kassa_chiqim_naqt">Naqt</option>
                                    <option value="kassa_chiqim_pastik">Plastik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_description">Chiqim haqida</label>
                                <textarea name="start_description" class="form-control" required></textarea>
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
        <div class="modal fade" id="kassadanxarajat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Kassadan xarajat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center">
                            <tr>
                                <th colspan=2>Kassada mavjud</th>
                            </tr>
                            <tr>
                                <td>Naqt</td>
                                <td>Plastik</td>
                            </tr>
                            <tr>
                                <td>{{ number_format($kassa['kassa_naqt'], 0, ',', ' ') }} so'm</td>
                                <td>{{ number_format($kassa['kassa_plastik'], 0, ',', ' ') }} so'm</td>
                            </tr>
                        </table>
                        <form method="POST" action="{{ route('kassa_xarajat') }}">
                            @csrf
                            <input type="hidden" name="kassa_naqt" value="{{ $kassa['kassa_naqt'] }}">
                            <input type="hidden" name="kassa_plastik" value="{{ $kassa['kassa_plastik'] }}">
                            <div class="form-group">
                                <label for="amount2">Xarajat summasi</label>
                                <input type="text" class="form-control" id="amount2" name="amount" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Xarajat turi</label>
                                <select name="type" class="form-control">
                                    <option value="">Tanlang...</option> 
                                    <option value="kassa_xarajat_naqt">Naqt</option>
                                    <option value="kassa_xarajat_plastik">Plastik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_description">Xarajat haqida</label>
                                <textarea name="start_description" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                        </form>
                        <script>
                            const amountInput2 = document.getElementById('amount2');
                            amountInput2.addEventListener('input', function (e) {
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
