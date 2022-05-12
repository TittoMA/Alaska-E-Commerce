@extends('layouts.master')

@section('title', 'Transaction History |')

@section('head')
<style>
    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
    }
    
.table thead th {
    vertical-align: bottom;
    color: #f4473e;
    border-bottom: 2px solid rgba(0, 0, 0, 0.06);
}

</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card br-card def-shadow">
                    <div class="card-header py-3" style="background: linear-gradient(60deg, #f4473e, #f4473e);">
                        <h5 class="card-title" style="color: #ffedec; margin-bottom: 0">Riwayat Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>No</th>
                                    <th>Jasa</th>
                                    <th>Nama Toko</th>
                                    <th>Penjual</th>
                                    <th>Harga</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @if (isset($results))
                                    @forelse ($results as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$item->order->service->service_name}}</td>
                                        <td>{{$item->order->seller->store_name}}</td>
                                        <td>{{$item->order->seller->user->name}}</td>
                                        <td>Rp. {{$item->price}}</td>
                                        <td>{{$item->order->created_at}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->order->status}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">
                                            <h4 class="py-4" style="text-align: center">Tidak ada data pembelian</h4>
                                        </td>

                                    </tr>
                                    @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection