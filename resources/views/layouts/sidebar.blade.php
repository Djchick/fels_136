<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        @if (Auth::user()->isAdmin())
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> {{ trans('user/titles.user') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('user.index') }}">{{ trans('user/titles.user_list') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.create') }}">{{ trans('user/titles.add_user') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('user/titles.category') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('category.index') }}">{{ trans('category/labels.list_category') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.create') }}">{{ trans('category/labels.add_category') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> {{ trans('user/titles.lesson') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('lesson.index') }}">{{ trans('lesson/labels.page_list_lesson') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lesson.create') }}">{{ trans('lesson/labels.add_lesson') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> {{ trans('user/titles.word') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('word.index') }}">{{ trans('user/titles.list_word') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.word.create') }}">{{ trans('user/titles.add_word') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        @else
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('activity.index') }}"><i class="fa fa-dashboard fa-fw"></i> {{ trans('user/titles.activity') }}</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('user/titles.category') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('category.index') }}">{{ trans('category/labels.list_category') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> {{ trans('user/titles.lesson') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('lesson.index') }}">{{ trans('lesson/labels.page_list_lesson') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> {{ trans('user/titles.word') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('word.index') }}">{{ trans('user/titles.list_word') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        @endif 
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->