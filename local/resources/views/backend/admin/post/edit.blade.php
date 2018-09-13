@extends('backend.admin.master')
@section('title-page')
    Cập Nhật Bài Viết
@stop
@section('styles')
@stop
@section('scripts')
@stop
@section('container')

    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                {{--<h2>Cập Nhật Bài Viết</h2>--}}
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary" href="{{ route('post.index') }}"> Back</a>
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
    {!! Form::model($data['post'],array('route' => ['post.update',$data['post']->id],'method'=>'PATCH')) !!}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">

                <strong>Tên Bài Viết:</strong>
                {!! Form::text('title',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                <div class="form-group">
                    <strong>Chuyên Mục</strong>
                    <div class="category-info">
                        @php
                            $arrayCategoryItem=$data['post']->categoryitems()->get();
                        @endphp
                        @foreach($data['dd_categorie_posts'] as $key=>$item)
                            <label class="check-container">
                                {{$item['value']}}
                                @if(in_array($item['index'],explode(',',$arrayCategoryItem->implode('id',','))))
                                    {{ Form::checkbox('list_category_id[]', $item['index'], true, array('class' => '')) }}
                                    <span class="check-mark"></span>
                                @else
                                    {{ Form::checkbox('list_category_id[]', $item['index'], false, array('class' => '')) }}
                                    <span class="check-mark"></span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <strong>Mô Tả Ngắn:</strong>
                    {!! Form::textarea('description',null,array('placeholder' => '','id'=>'description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Hình Đại Diện: </strong>
                    @if($data['post']->image!='')
                        {!! Form::text('image', url('/').'/'.$data['post']->image, array('class' => 'form-control','id'=>'pathImagePost')) !!}
                    @else
                        {!! Form::text('image', '', array('class' => 'form-control','id'=>'pathImagePost')) !!}
                    @endif
                    <br>
                    {!! Form::button('Tìm', array('id' => 'btnBrowseImagePost','class'=>'btn btn-primary')) !!}
                </div>
                <div class="form-group">
                    @if($data['post']->image!='')
                        {{ Html::image($data['post']->image,'',array('id'=>'showHinhPost','class'=>'show-image'))}}
                    @else
                        {{ Html::image('','',array('id'=>'showHinhPost','class'=>'show-image'))}}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Nội Dung Bài Viết:</strong>
                {!! Form::textarea('content',null,array('placeholder' => '','id'=>'content-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}

            </div>
            <hr>
            <div id="seo-part" class="col-md-12 p-0">
                <h3>SEO</h3>
                <div class="content">
                    <div class="show-pattern">
                        <span class="title">{{$data['post']->seos->seo_title}}</span>
                        <span class="link">{{URL::to('/')}}/{{$data['post']->path}}</span>
                        <span class="description">{{$data['post']->seos->seo_description}}</span>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Từ khóa cần SEO</strong>
                            {!! Form::text('seo_keywords',$data['post']->seos->seo_keywords, array('placeholder' => 'keywords cách nhau dấu phẩy','class' => 'form-control')) !!}
                            <ul class="error-notice">
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <strong>Tiêu Đề (title):</strong>
                        {!! Form::text('seo_title',$data['post']->seos->seo_title, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <strong>Mô Tả (description):</strong>
                        {!! Form::textarea('seo_description',$data['post']->seos->seo_description,array('placeholder' => '','id'=>'seo-description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                    </div>
                </div>
                <h3>Mạng Xã Hội</h3>
                <div class="content">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Chọn hình đại diện hiển thị MXH: </strong>
                            @if($data['post']->seos->seo_image!='')
                                {!! Form::text('seo-image', url('/').'/'.$data['post']->seos->seo_image, array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                            @else
                                {!! Form::text('seo-image', '', array('class' => 'form-control','id'=>'pathImageMXH')) !!}
                            @endif
                            <br>
                            {!! Form::button('Tìm', array('id' => 'btnBrowseImageMXH','class'=>'btn btn-primary')) !!}
                        </div>
                        <div class="form-group">
                            @if($data['post']->seos->seo_image!='')
                                {{ Html::image($data['post']->seos->seo_image,'',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                            @else
                                {{ Html::image('','',array('id'=>'showHinhMXH','class'=>'show-image'))}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <strong>Kích Hoạt:</strong>
                <input {{$data['post']->isActive==1?'checked':''}}  name="isActive" data-on="Có"
                       data-off="Không"
                       type="checkbox" data-toggle="toggle">
            </div>
            <div class="col-md-12" style="text-align:  center;">
                <button id="btnDanhMuc" type="submit" class="btn btn-primary">Cập Nhật Bài Viết</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop