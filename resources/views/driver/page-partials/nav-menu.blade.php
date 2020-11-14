<div class="sticky">
    <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file-text"></i> Expenses <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('driver-expenses') }}">Expenses</a></li>
                            <li aria-haspopup="true"><a href="{{ route('driver-expenses-create') }}">Add Expenses</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class=""><i class="fa fa-road"></i> Trips <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('trip-current') }}">Current Trip</a></li>
                            <li aria-haspopup="true"><a href="{{ route('trip-old') }}">Old Trip</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>