@extends('backend.admin.master')
@section('styles')
@stop
@section('scripts')
@stop
@section('container')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <h2>Cập Nhật Chuyên Mục</h2>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary" href="{{ route('categorypost.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Úi!</strong> Hình Như Có Gì Đó Sai Sai.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($categorypost,array('route' => ['categorypost.update',$categorypost->id],'method'=>'PATCH')) !!}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Tên Chuyên Mục:</strong>
                            {!! Form::text('name',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <strong>Chọn Trang Content</strong>
                            <select name="page_id" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                @foreach($pages as $key=>$data)
                                    @if($data->id==$categorypost->page_id)
                                        <option value="{{$data->id}}" selected>{{$data->title}}</option>
                                    @else
                                        <option value="{{$data->id}}">{{$data->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <strong>Menu Cấp</strong>
                            <select class="form-control" name="parent">'
                                @foreach($dd_categorie_posts as $key=>$data) {
                                @if($data['index']===$categorypost->parent_id)
                                    <option value="{{$data['index']}}" selected>{{$data['value']}}</option>
                                @else
                                    <option value="{{$data['index']}}">{{$data['value']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <strong>Chọn Giao Diện:</strong>
                            {{Form::text('template',null,array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <strong>Thứ Tự:</strong>
                            {!! Form::text('order',null, array('placeholder' => 'Thứ Tự','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="text-align:  center;">
                <button id="btnDanhMuc" type="submit" class="btn btn-primary">Tạo Mới Chuyên Mục</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop