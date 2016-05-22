        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/') }}" class="site_title"><i class="fa fa-cog"></i>
              <span>{{ App\User::getType(Auth::user()->type) }}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset(Auth::user()->avatar)}}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>ยินดีตอนรับ</span>
                <h2>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>ทั่วไป</h3>
                <ul class="nav side-menu">
                  <li{!! Request::is('/member/activities/*') ? ' class="active"':'' !!}>
                    <a><i class="fa fa-calendar"></i> กิจกรรม <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"{!! Request::is('/member/activities/*') ? '  style="display: block;"':'' !!}>
                      <li>
                        <a href="{{ url('/member/activities') }}">กิจกรรมทั้งหมด</a>
                      </li>
                      <li>
                        <a href="{{ url('/member/activities/create') }}">เพิ่มกิจกรรม</a>
                      </li>
                    </ul>
                  </li>
                  <li{!! Request::is('/member/activities-category/*') ? ' class="active"':'' !!}>
                    <a><i class="fa fa-list-ul"></i> ประเภทกิจกรรม <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"{!! Request::is('/member/activities-category/*') ? ' style="display: block;"':'' !!}>
                      <li>
                        <a href="{{ url('/member/activities-category') }}">ประเภทกิจกรรมทั้งหมด</a>
                      </li>
                      <li>
                        <a href="{{ url('/member/activities-category/create') }}">เพิ่มประเภทกิจกรรม</a>
                      </li>
                    </ul>
                  </li>
                  <li class="hide" {!! Request::is('/member/users/*') ? ' class="active"':'' !!}>
                    <a><i class="fa fa-user"></i> ผู้ใช้ <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"{!! Request::is('/member/users/*') ? '  style="display: block;"':'' !!}>
                      <li>
                        <a href="{{ url('/member/users/create') }}">นักศึกษา</a>
                      </li>
                      <li>
                        <a href="{{ url('/member/users/category') }}">อาจารย์</a>
                      </li>
                      <li>
                        <a href="{{ url('/member/users') }}">เพิ่มผู้ใช้</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section hide">
                <h3>บัญชี</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{ url('/member/profile') }}"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a>
                  </li>
                  <li>
                    <a href="{{ url('/member/profile/change-password') }}"><i class="fa fa-lock"></i> เปลี่ยนรหัสผ่าน</a>
                  </li>
                  <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-lock"></i> ออกจากระบบ</a>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small hide">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>