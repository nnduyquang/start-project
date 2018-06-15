@extends('backend.admin.master')
@section('styles')
@stop
@section('scripts')
@stop
@section('container')

    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <h2>Cập Nhật Bài Viết</h2>
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
    {!! Form::model($post,array('route' => ['post.update',$post->id],'method'=>'PATCH')) !!}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">

                <strong>Tên Bài Viết:</strong>
                {!! Form::text('title',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}

                <div class="form-group">
                    <strong>Chuyên Mục</strong>
                    <select class="form-control" name="parent">'
                        @foreach($dd_categorie_posts as $key=>$data) {
                        @if($data['index']==$post->category_item_id)
                            <option value="{{$data['index']}}" selected>{{$data['value']}}</option>
                        @else
                            <option value="{{$data['index']}}">{{$data['value']}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <strong>Mô Tả Ngắn:</strong>
                    {!! Form::textarea('description',null,array('placeholder' => '','id'=>'description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Hình Đại Diện: </strong>
                    @if($post->image!='')
                        {!! Form::text('image', url('/').'/'.$post->image, array('class' => 'form-control','id'=>'pathImagePost')) !!}
                    @else
                        {!! Form::text('image', '', array('class' => 'form-control','id'=>'pathImagePost')) !!}
                    @endif
                    <br>
                    {!! Form::button('Tìm', array('id' => 'btnBrowseImagePost','class'=>'btn btn-primary')) !!}
                </div>
                <div class="form-group">
                    @if($post->image!='')
                        {{ Html::image($post->image,'',array('id'=>'showHinhPost','class'=>'show-image'))}}
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
            <div class="col-md-12 p-0">
                <h3>SEO</h3>
                <div class="form-group">
                    <strong>Tiêu Đề (title):</strong>
                    {!! Form::text('seo_title',null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Mô Tả (description):</strong>
                    {!! Form::textarea('seo_description',null,array('placeholder' => '','id'=>'seo-description-post','class' => 'form-control','rows'=>'10','style'=>'resize:none')) !!}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Keywords (cách nhau dấu phẩy ','):</strong>
                        {!! Form::text('seo_keywords',null, array('placeholder' => 'keywords cách nhau dấu phẩy','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <strong>Kích Hoạt:</strong>
                    <input {{$post->isActive==1?'checked':''}}  name="post_is_active" data-on="Có"
                           data-off="Không"
                           type="checkbox" data-toggle="toggle">
                </div>
            </div>

            <div class="col-md-12" style="text-align:  center;">
                <button id="btnDanhMuc" type="submit" class="btn btn-primary">Cập Nhật Bài Viết</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop