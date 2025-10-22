@extends('layouts.default')
@section('content')
@php
    $data = [
       [
        'label' => "User",
        'icon'  => "user",
        'jumlah' => 3
        ],
        [
        'label' => "Surat",
        'icon'  => "file",
        'jumlah' => 5
        ],
        [
            'label' => "Pegawai",
            'icon' => "users",
            'jumlah' => 10
        ],
        [
            'label' => "Jenis",
            'icon' => "category",
            'jumlah' => 15
        ]
];
@endphp
<div class="container-fluid">

<div class="row p-3 mt-9">
    @foreach ($data as $index  => $val)
    <div class="col-3">
        <div class="card border border-dark shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <span class="fs-5">
                        <i class="ti ti-{{ $val['icon'] }}"></i>
                        {{ $val['label'] }}
                    </span>
                </div>
                <h5 class="text-center mt-2">{{ $val['jumlah'] }}</h5>
            </div>
        </div>
    </div>
            @endforeach
</div>
</div>

@endsection
