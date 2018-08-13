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
    <div id="seo-part" class="col-md-12 p-0">
        <h3>SEO</h3>
        <div class="content">
            <div class="show-pattern">
                @foreach($cauhinhs as $key=>$cauhinh)
                    @if($cauhinh->name=='config-seo-title')
                        <span class="title">{{$cauhinh->content}}</span>
                        <span class="link">{{URL::to('/')}}</span>
                    @endif

                    @if($cauhinh->name=='config-seo-description')
                        <span class="description">{{$cauhinh->content}}</span>
                    @endif
                @endforeach
            </div>
            @foreach($cauhinhs as $key=>$cauhinh)
                @if($cauhinh->name=='config-seo-keywords')
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Từ khóa cần SEO</strong>
                            {!! Form::text('seo_keywords',$cauhinh->content, array('placeholder' => 'keywords cách nhau dấu phẩy','class' => 'form-control')) !!}
                            {{ Form::hidden('hd-seo-keywords', $cauhinh->content) }}
                            <ul class="error-notice">
                            </ul>
                        </div>
                    </div>
                @endif

                @if($cauhinh->name=='config-seo-title')
                    <div class="col-md-12 form-group">
                        <strong>Tiêu Đề (title):</strong>
                        {!! Form::text('seo_title',$cauhinh->content, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                        {{ Form::hidden('hd-seo-title', $cauhinh->content) }}
                    </div>
                @endif
                @if($cauhinh->name=='config-seo-description')
                    <div class="col-md-12 form-group">
                        <strong>Mô Tả (description):</strong>
                        {!! Form::textarea('seo_description', $cauhinh->content,array('placeholder' => '','id'=>'seo-description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                        {{ Form::hidden('hd-seo-description', $cauhinh->content) }}
                    </div>
                @endif
            @endforeach
        </div>
        @foreach($cauhinhs as $key=>$cauhinh)
            @if($cauhinh->name=='config-seo-image')
                <h3>Mạng Xã Hội</h3>
                <div class="content">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Chọn hình đại diện hiển thị MXH: </strong>
                            @if($cauhinh->content!='')
                                {!! Form::text('seo-image', url('/').'/'.$cauhinh->content, array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                            @else
                                {!! Form::text('seo-image', '', array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                            @endif

                            <br>
                            {!! Form::button('Tìm', array('id' => 'btnBrowseImageMXH','class'=>'btn btn-primary')) !!}
                        </div>
                        <div class="form-group">
                            @if($cauhinh->content!='')
                                {{ Html::image($cauhinh->content,'',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                            @else
                                {{ Html::image('','',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button id="btnDanhMuc" type="submit" class="btn btn-primary">Lưu Cấu Hình</button>
    </div>

    {!! Form::close() !!}
@stop