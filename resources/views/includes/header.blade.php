<header class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    การบริหารงานกิจการนักศึกษา
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/') }}">หน้าแรก</a>
                    </li>
                    <li>
                        <a href="{{ url('/activities') }}">กิจกรรม</a>
                    </li>
                    <li class="hide">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ประชาสัมพันธ์/กิจกรรม <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">ข่าวกิจกรรม</a></li>
                            <li><a href="#">ข่าวประชาสัมพันธ์</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/parent') }}">บริการผู้ปกครอง</a>
                    </li>
                    @if( Auth::check() )
                        @if( Auth::user()->type == 'admin' )
                            <li>
                                <a href="{{ url('/member') }}">{{ App\User::getType(Auth::user()->type) }}</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}">ออกจากระบบ</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/login') }}">เข้าสู่ระบบ</a>
                        </li>
                        <li>
                            <a href="{{ url('/register') }}">สมัครสมาชิก</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
