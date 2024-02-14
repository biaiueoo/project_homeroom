@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Categories')
@section('main')
    @include('dashboard.main')

    {{-- Tabel --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('categories.create') }}"><span
                                class="badge badge-sm bg-gradient-primary mb-3 fs-6">Add New Item</span></a>
                        <h6>Categories</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenis as $i => $dt)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{ $i + 1 . '. ' }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $dt->jenis }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href=""><span
                                                        class="badge badge-sm bg-gradient-success">Edit</span></a>
                                                <a href=""><span
                                                        class="badge badge-sm bg-gradient-danger">Delete</span></a>
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

        {{-- Tutup Tabel --}}

        <footer class="footer pt-5  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                    Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <input type="text" id="status" value="@isset($status){{ $status }}@endisset">
    <input type="text" id="pesan" value="@isset($pesan){{ $pesan }}@endisset">
    <script>
        const sts = document.getElementById("status")
        const psn = document.getElementById("pesan")
        const body = document.getElementById("master")

        function pesan_simpan() {
            if (sts.value === "simpan") {
                swal('Good Job!', psn.value, 'success')
            }
        }
        body.onload = function() {
            pesan_simpan()
        }
    </script>
@endsection
