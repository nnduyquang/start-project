<div id="menu" class="container-fluid p-0">
    <div id="menu_top">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 p-0">
                        {{ Html::image('images/temps/logo/logo_demo.png','',array('class'=>'menu_logo'))}}
                    </div>
                    <div class="col-md-4 justify-content-center align-self-center pl-0">
                        <ul class="menu-search">
                            <li><a href="#" id="clickSearch"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li style="width: 100%">
                                {!! Form::open(array('method'=>'POST','id'=>'formSearch')) !!}
                                {!! Form::text('key-search', '', array('placeholder' => 'Tìm Kiếm','class' => 'form-control','id'=>'searchInput')) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 justify-content-center align-self-center text-right">
                        <span><i class="fa fa-phone" aria-hidden="true"></i> 0965.322.239 - 0901.196.676</span>
                        <span><i class="fa fa-home" aria-hidden="true"></i> 55/4 KP3 Hà Huy Giáp, Q.12, TPHCM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu_bottom">
        <div class="container">
            <div class="col-md-12 p-0">
                <ul class="main_menu">
                    <li class="li-normal"><a href="#">Menu 1</a></li>
                    <li class="li-normal"><a href="#">Menu 2</a></li>
                    <li class="has-item-down"><a href="#">Menu 3</a>
                        <ul class="sub_menu">
                            <li><a href="#">Menu 31 31</a></li>
                            <li><a href="#">Menu 31 31</a></li>
                            <li><a href="#">Menu 31 31</a></li>
                            <li><a href="#">Menu 31 31</a></li>
                        </ul>
                    </li>
                    <li class="li-normal"><a href="#">Menu 4</a></li>
                    <li class="li-normal"><a href="#">Menu 5</a></li>
                    <li class="li-normal"><a href="#">Menu 6</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
