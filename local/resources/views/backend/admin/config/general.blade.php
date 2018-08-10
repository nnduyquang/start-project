@extends('backend.admin.master')
@section('container')
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Cấu Hình Chung</h2>
                </div>
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
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {!! Form::open(array('route' => 'config.general.store','method'=>'POST')) !!}

    @foreach($cauhinhs as $key=>$cauhinh)

        @if($cauhinh->name=='config-contact')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Nội Dung Liên Hệ:</label>
                    {!! Form::textarea('config-contact',$cauhinh->content, array('placeholder' => 'Nội Dung','id'=>'description-page','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    {{ Form::hidden('hd-config-contact', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-company-name')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Tên Công Ty:</label>
                    {!! Form::text('config-company-name', $cauhinh->content, array('placeholder' => '','class' => 'form-control')) !!}
                    {{ Form::hidden('hd-config-company-name', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-phone')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Số Điện Thoại Liên Hệ:</label>
                    {!! Form::text('config-phone', $cauhinh->content, array('placeholder' => '','class' => 'form-control')) !!}
                    {{ Form::hidden('hd-config-phone', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-email')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Email Liên Hệ:</label>
                    {!! Form::text('config-email', $cauhinh->content, array('placeholder' => '','class' => 'form-control')) !!}
                    {{ Form::hidden('hd-config-email', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-address')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Địa Chỉ Liên Hệ:</label>
                    {!! Form::text('config-address', $cauhinh->content, array('placeholder' => '','class' => 'form-control')) !!}
                    {{ Form::hidden('hd-config-address', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-name')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Tên Liên Hệ:</label>
                    {!! Form::text('config-name', $cauhinh->content, array('placeholder' => '','class' => 'form-control')) !!}
                    {{ Form::hidden('hd-config-name', $cauhinh->content) }}
                </div>
            </div>
        @endif
        @if($cauhinh->name=='config-introduce')
            <div class=" col-md-12">
                <div class="form-group">
                    <label style="font-weight: bold">Giới Thiệu:</label>
                    {!! Form::textarea('config-introduce',$cauhinh->content, array('placeholder' => 'Nội Dung','id'=>'description-page-introduce','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    {{ Form::hidden('hd-config-introduce', $cauhinh->content) }}
                </div>
            </div>
        @endif
    @endforeach
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button id="btnDanhMuc" type="submit" class="btn btn-primary">Lưu Cấu Hình</button>
    </div>

    {!! Form::close() !!}
@stop