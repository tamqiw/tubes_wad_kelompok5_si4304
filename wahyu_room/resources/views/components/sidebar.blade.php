<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo d-flex">
                    <h1 class="mr-3">{{config('app.name')}}</h1>
                    <a href="{{url('/')}}"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item
                {{(Request::is('admin')) ? 'active' : ''}}
                {{(Request::is('staff')) ? 'active' : ''}}
                {{(Request::is('user')) ? 'active' : ''}}
                    ">
                    <a href="{{url('/home')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub {{ (Request::is('admin/user/*')) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Manajemen User</span>
                    </a>
                    <ul class="submenu  {{ (Request::is('admin/user/*')) ? 'active' : ''}} ">
                        <li class="submenu-item  {{ (Request::is('/admin/user/create')) ? 'active' : ''}}">
                            <a href="{{url('/admin/user/create')}}">Tambah User</a>
                        </li>
                        <li class="submenu-item  {{ (Request::is('/admin/user/manage')) ? 'active' : ''}}">
                            <a href="{{url('/admin/user/manage')}}">Manage</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item  has-sub {{ (Request::is('booking/*')) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Booking</span>
                    </a>
                    <ul class="submenu  {{ (Request::is('booking/*')) ? 'active' : ''}} ">
                        <li class="submenu-item  {{ (Request::is('/booking/manage')) ? 'active' : ''}}">
                            <a href="{{url('booking/manage')}}">Data Booking</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Ruangan</li>

                <li class="sidebar-item  has-sub {{ (Request::is('room/*')) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Ruangan</span>
                    </a>
                    <ul class="submenu  {{ (Request::is('room/*')) ? 'active' : ''}} ">
                        <li class="submenu-item  {{ (Request::is('/room-type/create')) ? 'active' : ''}}">
                            <a href="{{url('room/create')}}">Tambah Ruangan</a>
                        </li>
                        <li class="submenu-item  {{ (Request::is('/facility/manage')) ? 'active' : ''}}">
                            <a href="{{url('room/manage')}}">Manage Ruangan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub {{ (Request::is('facility/*')) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Fasilitas</span>
                    </a>
                    <ul class="submenu  {{ (Request::is('facility/*')) ? 'active' : ''}} ">
                        <li class="submenu-item  {{ (Request::is('/room-type/create')) ? 'active' : ''}}">
                            <a href="{{url('facility/create')}}">Tambah Fasilitas</a>
                        </li>
                        <li class="submenu-item  {{ (Request::is('/facility/manage')) ? 'active' : ''}}">
                            <a href="{{url('facility/manage')}}">Manage</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub {{ (Request::is('room-type/*')) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Tipe Ruangan Utama</span>
                    </a>
                    <ul class="submenu  {{ (Request::is('room-type/*')) ? 'active' : ''}} ">
                        <li class="submenu-item  {{ (Request::is('/room-type/create')) ? 'active' : ''}}">
                            <a href="{{url('room-type/create')}}">Tambah Jenis Ruangan</a>
                        </li>
                        <li class="submenu-item  {{ (Request::is('/room-type/manage')) ? 'active' : ''}}">
                            <a href="{{url('room-type/manage')}}">Manage</a>
                        </li>
                    </ul>
                </li>

                


                <li class="sidebar-title">Logout</li>
                <li class="sidebar-item  ">

                    <a href="{{url('/logout')}}" class="sidebar-link">
                        <i class="bi bi-life-preserver"></i>
                        <span>Logout</span>
                    </a>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
