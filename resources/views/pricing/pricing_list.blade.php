@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection

@section('title')
{{ trans('main_trans.pricing') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.pricing') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.pricing') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-success">
                    <div id="messageContainer"></div>
                    {{ session('message') }}
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
                <br><br>

                <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                    <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->

                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th scope="col">{{ trans('main_trans.code') }}</th>
                            <th scope="col">{{ trans('main_trans.pricing_details') }}</th>
                            <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                            <th scope="col">{{ trans('main_trans.edit') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricing as $one)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <td>{{ $one->code }}</td>
                            <td>
                                <a href="{{ route('pricing.show' ,$one->id) }}" class="btn btn-primary" >{{ trans('main_trans.show') }}</a>
                            </td>

                            {{-- <td>
                                <a href="#consModal{{ $review->id }}" class="btn btn-primary" data-toggle="modal">{{ trans('main_trans.show') }}</a>
                            </td>
                            <td>
                                @php
                                $files = json_decode($review->building_files, true);
                                @endphp
                                @foreach ($files as $file)
                                <a href="{{'http://127.0.0.1:8000/reviews_files/'.$file}}" class="btn btn-primary" target="_blank">{{ trans('main_trans.show') }}</a>
                                @endforeach

                                {{-- <a href="{{'http://127.0.0.1:8000/reviews_files/'. json_decode($review->building_files, true)}}" class="btn btn-primary">{{ trans('main_trans.show') }}</a> --}}
                            {{-- </td> --}}

                            <td>{{ $one->admin_status }}</td>
                            <td>
                            <a href="#editModal{{ $one->id }}" class="btn btn-primary"
                                data-toggle="modal">{{ trans('main_trans.edit_status') }}</a>


                       <a href="#" class="btn btn-danger"
                       onclick="openDeleteModal('{{ $one->id }}')">{{ trans('main_trans.delete') }}</a>
<td>




                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

<!-- Create User Modal -->

<!-- Create User Modal -->
@foreach ($pricing as $one )



<!-- Edit User Modals -->
<div class="modal fade" id="editModal{{ $one->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $one->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $one->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pricing.update', $one->id) }}" method="POST">
                    @csrf


                            <div class="form-group">
                                <label for="status">{{ trans('main_trans.admin_status') }}</label>
                                <select class="form-select" aria-label="Default select example" name="admin_status">
                                    <option value="waiting">waiting</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ trans('main_trans.close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal{{ $one->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $one->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $one->id }}">{{ trans('main_trans.edit') }}
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pricing.destroy', $one->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <p>{{ trans('main_trans.delete_text') }}</p>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    {{ trans('main_trans.close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ trans('main_trans.delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openDeleteModal(reviewId) {
        var deleteModalId = '#deleteModal' + reviewId;
        $(deleteModalId).modal('show');
    }
</script>
@endsection
