@extends('layouts.app01')

@section('title', 'Noaktiv bolalar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Noaktiv bolalar</h1>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Bosh sahifa</a></li>
            <li class="breadcrumb-item active">Noaktiv bolalar</li>
        </ol>
    </nav>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <ul class="nav nav-tabs nav-justified mb-4" id="bolalarTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ route('child') }}" class="nav-link" id="aktiv-tab" data-bs-toggle="tab" data-bs-target="#aktiv">Aktiv bolalar</a>
                </li>
                <li class="nav-item " role="presentation">
                    <a href="{{ route('nochild') }}" class="nav-link bg-primary text-white active" id="noaktiv-tab" data-bs-toggle="tab" data-bs-target="#noaktiv">Tark etgan bolalar</a>
                </li>
            </ul>
            <form action="{{ route('nochild') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Qidiruv..." value="{{ request('search') }}">
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Ro'yhatga olindi</th>
                            <th>Balans</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Childreen as $index => $child)
                            <tr>
                                <td>{{ $Childreen->firstItem() + $index }}</td>
                                <td class="text-start" style="text-align:left"><a href="{{ route('child_show_no',$child->id) }}">{{ $child->name }}</a></td>
                                <td>{{ $child->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if ($child->balans >= 0)
                                        <span class="text-success">{{ number_format($child->balans, 0, '.', ' ') }} so'm</span>
                                    @else   
                                        <span class="text-danger">{{ number_format($child->balans, 0, '.', ' ') }} so'm</span>
                                    @endif    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">Ma'lumot topilmadi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $Childreen->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
@endpush
