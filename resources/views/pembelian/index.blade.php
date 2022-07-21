<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data Pembelian
                        <a href="{{ route('pembelian.create') }}" class="btn btn-sm btn-primary" style="float: right">
                            Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pembeli</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($pembelian as $data_pembelian)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data_pembelian->nama_pembeli }}</td>
                                            <td>{{ date('d M Y', strtotime($data_pembelian->tgl_pembelian)) }}</td>
                                            <td>{{ $data_pembelian->nama_barang }}</td>
                                            <td>{{ $data_pembelian->harga_satuan }}</td>
                                            <td>{{ $data_pembelian->jumlah_barang }}</td>
                                            <td>{{ $data_pembelian->total_harga }}</td>
                                            
                                            
                                            <td>
                                                <form action="{{ route('pembelian.destroy',$data_pembelian->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('pembelian.edit', $data_pembelian->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Edit
                                                    </a> |
                                                    <a href="{{ route('pembelian.show', $data_pembelian->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        Show
                                                    </a> |
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('U SURE?')">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>
</html>