<ul class="sidebar-menu" data-widget="tree">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-link"></i>
            <span>Dashboard</span></a>
    @if(Auth::user()->hasRole('admin')||Auth::user()->can('user-list'))
        <li><a href="{{ route('users.index') }}"><i class="fa fa-link"></i> <span>Người Dùng</span></a>
        </li>
    @endif
    @if(Auth::user()->can('role-list'))
        <li><a href="{{ route('roles.index') }}"><i class="fa fa-link"></i> <span>Quyền</span></a></li>
        @endif
        {{--<li><a href="{{ route('emp.index') }}"><i class="fa fa-link"></i> <span>Quản Lý Nhân Viên</span></a>--}}
        {{--</li>--}}
        {{--<li><a href="{{ route('account.index') }}"><i class="fa fa-link"></i> <span>Tài Khoản</span></a>--}}
        {{--</li>--}}
        {{--<li><a href="{{ route('location.index') }}"><i class="fa fa-link"></i> <span>Địa Điểm</span></a>--}}
        </li>
        <li><a href="{{ route('categorypost.index') }}"><i class="fa fa-link"></i> <span>Chuyên Mục Bài Viết</span></a>
        </li>
        <li><a href="{{ route('page.index') }}"><i class="fa fa-link"></i> <span>Trang</span></a>
        </li>
        <li><a href="{{ route('post.index') }}"><i class="fa fa-link"></i> <span>Bài Viết</span></a>
        </li>
        <li><a href="{{ route('categoryproduct.index') }}"><i class="fa fa-link"></i>
                <span>Chuyên Mục Sản Phẩm</span></a>
        </li>
        <li><a href="{{ route('product.index') }}"><i class="fa fa-link"></i> <span>Sản Phẩm</span></a>
        </li>
        <li><a href="{{ route('config.index') }}"><i class="fa fa-link"></i> <span>Cấu Hình</span></a>
        </li>

        {{--<li><a href="{{ route('tuyendung.index') }}"><i class="fa fa-link"></i> <span>Tuyển Dụng</span></a>--}}
        {{--</li>--}}
        {{--<li><a href="{{ route('menu.index') }}"><i class="fa fa-link"></i> <span>Quản Lý Menu</span></a>--}}
        {{--</li>--}}
        {{--<li class="treeview">--}}
        {{--<a href="#"><i class="fa fa-link"></i><span>Cấu Hình</span>--}}
        {{--<span class="pull-right-container">--}}
        {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</span>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
        {{--<li><a href="#">Cấu Hình Chung</a></li>--}}
        {{--<li><a href="{{ route('config.email.index') }}">Email</a></li>--}}
        {{--<li><a href="{{ route('config.slider.index') }}"><i class="fa fa-link"></i>--}}
        {{--<span>Quản Lý Slider</span></a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</li>--}}
</ul>