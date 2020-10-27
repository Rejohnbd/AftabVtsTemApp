<div class="sticky">
    <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true"><a href="#" class="sub-icon "><i class="fe fe-users"></i> Users <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('drivers.index') }}">Drivers</a></li>
                            <li aria-haspopup="true"><a href="{{ route('helpers.index') }}">Helpers</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon "><i class="fe fe-server"></i> Devices <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('device-type.index') }}">Devices Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('devices.index') }}">All Devices</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class=""><i class="ion ion-model-s"></i> Vehicles <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('vehicle-type.index') }}">Vehicle Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('vehicles.index') }}">All Vehicle</a></li>
                            <li aria-haspopup="true"><a href="{{ route('vehicle-device') }}">All Vehicle Devices</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file-text"></i> Expenses <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('expenses-type.index') }}">Expenses Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('all-expenses.index') }}">All Expenses</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="{{ route('trips.index') }}" class="sub-icon"><i class="fa fa-road"></i> Trips</a></li>

                    {{--
                     <li aria-haspopup="true"><a href="#" class="sub-icon active"><i class="fe fe-life-buoy"></i> Pages <i class="fa fa-angle-down horizontal-icon"></i></a>
                         <ul class="sub-menu">
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Profile</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="profile.html">Profile</a></li>
                                     <li aria-haspopup="true"><a href="editprofile.html">Edit Profile</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Mail</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="email.html">Mail-Compose</a></li>
                                     <li aria-haspopup="true"><a href="emailservices.html">Mail-inbox</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">E-commerce</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="shop.html">Shop</a></li>
                                     <li aria-haspopup="true"><a href="shop-description.html">Product Details</a></li>
                                     <li aria-haspopup="true"><a href="cart.html">Shopping Cart</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Custom Pages</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="login.html">Login</a></li>
                                     <li aria-haspopup="true"><a href="register.html">Register</a></li>
                                     <li aria-haspopup="true"><a href="forgot-password.html">Forgot Password</a></li>
                                     <li aria-haspopup="true"><a href="lockscreen.html">Lock screen</a></li>
                                     <li aria-haspopup="true"><a href="empty.html" class="active">Empty Page</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true"><a href="construction.html">Under Construction</a></li>
                             <li aria-haspopup="true"><a href="gallery.html">Gallery</a></li>
                             <li aria-haspopup="true"><a href="about.html">About Company </a></li>
                             <li aria-haspopup="true"><a href="services.html">Services </a></li>
                             <li aria-haspopup="true"><a href="faq.html">FAQS</a></li>
                             <li aria-haspopup="true"><a href="terms.html">Terms</a></li>
                             <li aria-haspopup="true"><a href="invoice.html">Invoice</a></li>
                             <li aria-haspopup="true"><a href="pricing.html">Pricing Tables</a></li>
                             <li aria-haspopup="true"><a href="blog.html">Blog</a></li>
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Error Pages</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="400.html">400</a></li>
                                     <li aria-haspopup="true"><a href="401.html">401</a></li>
                                     <li aria-haspopup="true"><a href="403.html">403</a></li>
                                     <li aria-haspopup="true"><a href="404.html">404</a></li>
                                     <li aria-haspopup="true"><a href="500.html">500</a></li>
                                     <li aria-haspopup="true"><a href="503.html">503</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-pie-chart"></i> Charts <i class="fa fa-angle-down horizontal-icon"></i></a>
                         <ul class="sub-menu">
                             <li aria-haspopup="true"><a href="chart-chartist.html">Chart Js</a></li>

                             <li aria-haspopup="true"><a href="chart-flot.html"> Flot Charts</a></li>
                             <li aria-haspopup="true"><a href="chart-echart.html">ECharts</a></li>
                             <li aria-haspopup="true"><a href="chart-morris.html">Morris Charts</a></li>
                             <li aria-haspopup="true"><a href="chart-nvd3.html">Nvd3 Charts</a></li>
                             <li aria-haspopup="true" class="sub-menu-sub"><a href="#">C3 charts</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="charts.html">C3 Bar Charts</a></li>
                                     <li aria-haspopup="true"><a href="chart-line.html">C3 Line Charts</a></li>
                                     <li aria-haspopup="true"><a href="chart-donut.html">C3 Donut Charts</a></li>
                                     <li aria-haspopup="true"><a href="chart-pie.html">C3 Pie charts</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-package"></i> UI Elements <i class="fa fa-angle-down horizontal-icon"></i></a>
                         <div class="horizontal-megamenu clearfix">
                             <div class="container">
                                 <div class="mega-menubg">
                                     <div class="row">
                                         <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                             <ul>
                                                 <li aria-haspopup="true"><a href="alerts.html">Alerts</a></li>
                                                 <li aria-haspopup="true"><a href="buttons.html">Buttons</a></li>
                                                 <li aria-haspopup="true"><a href="colors.html">Colors</a></li>
                                                 <li aria-haspopup="true"><a href="avatarsquare.html">Avatar-Square</a></li>
                                                 <li aria-haspopup="true"><a href="avatar-round.html">Avatar-Rounded</a></li>
                                                 <li aria-haspopup="true"><a href="avatar-radius.html">Avatar-Radius</a></li>
                                                 <li aria-haspopup="true"><a href="dropdown.html">Drop downs</a></li>
                                                 <li aria-haspopup="true"><a href="cards.html">Cards design</a></li>
                                                 <li aria-haspopup="true"><a href="chat.html">Default Chat</a></li>
                                             </ul>
                                         </div>
                                         <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                             <ul>
                                                 <li aria-haspopup="true"><a href="list.html">List</a></li>
                                                 <li aria-haspopup="true"><a href="tags.html">Tags</a></li>
                                                 <li aria-haspopup="true"><a href="pagination.html">Pagination</a></li>
                                                 <li aria-haspopup="true"><a href="navigation.html">Navigation</a></li>
                                                 <li aria-haspopup="true"><a href="typography.html">Typography</a></li>
                                                 <li aria-haspopup="true"><a href="breadcrumbs.html">Breadcrumbs</a></li>
                                                 <li aria-haspopup="true"><a href="badge.html">Badges</a></li>
                                                 <li aria-haspopup="true"><a href="notify.html">Notifications</a></li>
                                                 <li aria-haspopup="true"><a href="sweetalert.html">Sweet alerts</a></li>
                                             </ul>
                                         </div>
                                         <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                             <ul>
                                                 <li aria-haspopup="true"><a href="jumbotron.html">Jumbotron</a></li>
                                                 <li aria-haspopup="true"><a href="panels.html">Panels</a></li>
                                                 <li aria-haspopup="true"><a href="thumbnails.html">Thumbnails</a></li>
                                                 <li aria-haspopup="true"><a href="mediaobject.html">Media Object</a></li>
                                                 <li aria-haspopup="true"><a href="accordion.html">Accordions</a></li>
                                                 <li aria-haspopup="true"><a href="tabs.html">Tabs</a></li>
                                                 <li aria-haspopup="true"><a href="chart.html">Charts</a></li>
                                                 <li aria-haspopup="true"><a href="rangeslider.html">Range slider</a></li>
                                                 <li aria-haspopup="true"><a href="scroll.html">Content Scroll bar</a></li>
                                             </ul>
                                         </div>
                                         <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                             <ul>
                                                 <li aria-haspopup="true"><a href="modal.html">Modal</a></li>
                                                 <li aria-haspopup="true"><a href="tooltipandpopover.html">Tooltip and popover</a></li>
                                                 <li aria-haspopup="true"><a href="progress.html">Progress</a></li>
                                                 <li aria-haspopup="true"><a href="carousel.html">Carousels</a></li>
                                                 <li aria-haspopup="true"><a href="headers.html">Headers</a></li>
                                                 <li aria-haspopup="true"><a href="footers.html">Footers </a></li>
                                                 <li aria-haspopup="true"><a href="loaders.html">Loaders</a></li>
                                                 <li aria-haspopup="true"><a href="counters.html">Counters</a></li>
                                                 <li aria-haspopup="true"><a href="rating.html">Rating</a></li>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-layers"></i>Components <i class="fa fa-angle-down horizontal-icon"></i></a>
                         <ul class="sub-menu">
                             <li aria-haspopup="true"><a href="maps.html">Maps</a></li>
                             <li aria-haspopup="true"><a href="crypto-currencies.html">Crypto-currencies</a></li>
                             <li aria-haspopup="true"><a href="users-list.html">User List</a></li>
                             <li aria-haspopup="true"><a href="timeline.html">Timeline</a></li>
                             <li aria-haspopup="true" class="sub-menu-sub"><span class="horizontalMenu-click02"></span><a href="#">Calendar</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="calendar.html">Default calendar</a></li>
                                     <li aria-haspopup="true"><a href="calendar2.html">Full calendar</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true" class="sub-menu-sub"><span class="horizontalMenu-click02"></span><a href="#">Tables</a>
                                 <ul class="sub-menu">
                                     <li aria-haspopup="true"><a href="tables.html">Default table</a></li>
                                     <li aria-haspopup="true"><a href="datatable.html">Data Table</a></li>
                                 </ul>
                             </li>
                             <li aria-haspopup="true"><a href="search.html">Search page</a></li>
                             <li aria-haspopup="true"><a href="tasks.html">Tasks</a></li>
                         </ul>
                     </li>
                     
                     <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-stop-circle"></i> Icons <i class="fa fa-angle-down horizontal-icon"></i></a>
                         <ul class="sub-menu">
                             <li aria-haspopup="true"><a href="icons.html">Font Awesome</a></li>
                             <li aria-haspopup="true"><a href="icons2.html">Material Design Icons</a></li>
                             <li aria-haspopup="true"><a href="icons3.html">Simple Line Icons</a></li>
                             <li aria-haspopup="true"><a href="icons4.html">Feather Icons</a></li>
                             <li aria-haspopup="true"><a href="icons5.html">Ionic Icons</a></li>
                             <li aria-haspopup="true"><a href="icons6.html">Flag Icons</a></li>
                             <li aria-haspopup="true"><a href="icons7.html">pe7 Icons</a></li>
                             <li aria-haspopup="true"><a href="icons8.html">Themify Icons</a></li>
                             <li aria-haspopup="true"><a href="icons9.html">Typicons Icons</a></li>
                             <li aria-haspopup="true"><a href="icons10.html">Weather Icons</a></li>
                         </ul>
                     </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>