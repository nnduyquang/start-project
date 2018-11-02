@extends('backend.admin.master')
@section('title-page')
    Cập Nhật Sản Phẩm
@stop
@section('styles')
@stop
@section('scripts')
@stop
@section('container')
    <div class="col-lg-12 title-header">
        <div class="row">
            <div class="col-md-8">
                <h2>Cập Nhật Bất Động Sản</h2>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
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
    {!! Form::model($product,array('route' => ['product.update',$product->id],'method'=>'PATCH')) !!}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="wrap-create-edit">
                    <strong class="text-title-left">Tên Sản Phẩm</strong>
                    <div class="form-group">
                        {!! Form::text('name',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <strong class="text-title-left">Mô Tả Ngắn</strong>
                    <div class="form-group">
                        {!! Form::textarea('description',null,array('placeholder' => '','id'=>'description-page','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="wrap-create-edit">
                    <strong class="text-title-right">Hình Đại Diện</strong>
                    <div class="form-group">
                        {!! Form::text('image', url('/').'/'.$product->image, array('class' => 'form-control','id'=>'pathImage')) !!}
                        <br>
                        {!! Form::button('Tìm', array('id' => 'btnBrowseImage','class'=>'btn btn-primary')) !!}
                    </div>
                    <div class="form-group">
                        {{ Html::image($product->image,'',array('id'=>'showHinh','class'=>'show-image'))}}
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <strong class="text-title-right">Thêm Hình Sản Phẩm </strong>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::button('Thêm', array('id' => 'btnBrowseMore','class'=>'btn btn-primary')) !!}
                        </div>
                        <div class="form-group">
                            <div id="add-image" class="row">
                                @php
                                    $listImage=explode(';',$product->sub_image);
                                @endphp
                                @foreach($listImage as $key=>$item)
                                    <div class="col-md-3 text-center one-image">
                                        {{ Html::image($item,'',array('id'=>'showHinh','class'=>'image-choose'))}}
                                        {{ Form::hidden('image-choose[]', $item) }}
                                        <span class='remove-image'>X</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <strong class="text-title-right">Loại Sản Phẩm</strong>
                    <div class="category-info">
                        @include('backend.admin.product.list-select-option-edit')
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <strong class="text-title-right">Địa Điểm</strong>
                    <div class="form-group">
                        <select name="select-city" class="form-control">
                            <option value="-1">Chọn Tỉnh/Thành Phố</option>
                            @foreach($cities as $key=>$item)
                                <option {{($city_id=== $item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="select-district" class="form-control">
                            <option value="-1" selected>Chọn Quận/Huyện</option>
                            @foreach($districts as $key=>$item)
                                <option {{($district_id=== $item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="select-ward" class="form-control">
                            <option value="-1" selected>Chọn Phường/Xã</option>
                            @if(!is_null($wards))
                                @foreach($wards as $key=>$item)
                                    <option {{($ward_id=== $item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <strong class="text-title-right">Hướng</strong>
                    <div class="form-group">
                        <select name="direction_id" class="form-control">
                            <option value="-1">Chọn Hướng</option>
                            @foreach($directions as $key=>$item)
                                <option {{($product->direction_id=== $item->id)?'selected':''}}   value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="wrap-create-edit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Giá: </strong>
                                {!! Form::text('price',null, array('placeholder' => 'Giá','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>ĐVT: </strong>
                                <select name="select-unit" class="form-control">
                                    <option value="-1">Chọn Đơn Vị Tính</option>
                                    @foreach($units as $key=>$item)
                                        <option {{($product->unit_id=== $item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Diện Tích(m2) </strong>
                                {!! Form::text('area',null, array('placeholder' => 'Diện Tích','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Số Phòng </strong>
                                {!! Form::text('num_bed',null, array('placeholder' => 'Số Phòng','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 p-0">
            <div class="wrap-create-edit">
                <strong class="text-title-left">Bản Đồ</strong>
                {!! Form::textarea('map',null,array('placeholder' => '','id'=>'','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                <div class="show-map">
                    @if(!is_null($product->map))
                        {!! $product->map !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 p-0">
            <div class="wrap-create-edit">
                <strong class="text-title-left">Mô Tả Sản Phẩm</strong>
                {!! Form::textarea('content',null,array('placeholder' => '','id'=>'content-page','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
            </div>

        </div>
        <hr>

        <div id="seo-part" class="col-md-12 p-0">
            <h3>SEO</h3>
            <div class="content">
                <div class="show-pattern">
                    @if(!is_null($product->seo_id))
                        <span class="title">{{$product->seos->seo_title}}</span>
                    @else
                        <span class="title"></span>
                    @endif
                    <span class="link">{{URL::to('/')}}/{{$product->path}}</span>
                    @if(!is_null($product->seo_id))
                        <span class="description">{{$product->seos->seo_description}}</span>
                    @else
                        <span class="description"></span>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Từ khóa cần SEO</strong>
                        @if(!is_null($product->seo_id))
                            {!! Form::text('seo_keywords',$product->seos->seo_keywords, array('placeholder' => 'keywords cách nhau dấu phẩy','class' => 'form-control')) !!}
                        @else
                            {!! Form::text('seo_keywords',null, array('placeholder' => 'keywords cách nhau dấu phẩy','class' => 'form-control')) !!}
                        @endif
                        <ul class="error-notice">
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <strong>Tiêu Đề (title):</strong>
                    @if(!is_null($product->seo_id))
                        {!! Form::text('seo_title',$product->seos->seo_title, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                    @else
                        {!! Form::text('seo_title',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                    @endif
                </div>
                <div class="col-md-12 form-group">
                    <strong>Mô Tả (description):</strong>
                    @if(!is_null($product->seo_id))
                        {!! Form::textarea('seo_description',$product->seos->seo_description,array('placeholder' => '','id'=>'seo-description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    @else
                        {!! Form::textarea('seo_description',null,array('placeholder' => '','id'=>'seo-description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    @endif
                </div>
            </div>
            <h3>Mạng Xã Hội</h3>
            <div class="content">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Chọn hình đại diện hiển thị MXH: </strong>
                        @if(!is_null($product->seo_id))
                            {!! Form::text('seo_image', $product->seos->seo_image, array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                        @else
                            {!! Form::text('seo_image', null, array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                        @endif
                        <br>
                        {!! Form::button('Tìm', array('id' => 'btnBrowseImageMXH','class'=>'btn btn-primary')) !!}
                    </div>
                    <div class="form-group">
                        @if(!is_null($product->seo_id))
                            {{ Html::image($product->seos->seo_image,'',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                        @else
                            {{ Html::image('','',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <strong>Kích Hoạt:</strong>
            <input {{$product->is_active==1?'checked':''}}  name="is_active" data-on="Có"
                   data-off="Không"
                   type="checkbox" data-toggle="toggle">
        </div>
        <div class="col-md-12" style="text-align:  center;">
            <button id="btnDanhMuc" type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop