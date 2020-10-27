<div class="sidebar sidebar-right sidebar-animate">
    <div class="p-2 pr-3 mb-2 sidebar-icon">
        <a href="#" class="text-right float-right" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
    </div>
    <div class="tab-menu-heading siderbar-tabs border-0">
        <div class="tabs-menu ">
            <ul class="nav panel-tabs">
                <li class=""><a href="#tab1" class="active" data-toggle="tab">Settings</a></li>
                <li><a href="#tab2" data-toggle="tab">Followers</a></li>
                <li><a href="#tab3" data-toggle="tab">Todo</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
        <div class="tab-content border-top">
            <div class="tab-pane active " id="tab1">
                <div class="p-3 border-bottom">
                    <h5 class="border-bottom-0 mb-0">General Settings</h5>
                </div>
                <div class="p-4">
                    <div class="switch-settings">
                        <div class="d-flex mb-2">
                            <span class="mr-auto fs-15">Notifications</span>
                            <div class="onoffswitch2">
                                <input type="checkbox" name="onoffswitch2" id="onoffswitch" class="onoffswitch2-checkbox" checked>
                                <label for="onoffswitch" class="onoffswitch2-label"></label>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="mr-auto fs-15">Show your emails</span>
                            <div class="onoffswitch2">
                                <input type="checkbox" name="onoffswitch2" id="onoffswitch1" class="onoffswitch2-checkbox">
                                <label for="onoffswitch1" class="onoffswitch2-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 border-bottom">
                    <h5 class="border-bottom-0 mb-0">Overview</h5>
                </div>
                <div class="p-4">
                    <div class="progress-wrapper">
                        <div class="mb-3">
                            <p class="mb-2">Achieves<span class="float-right text-muted font-weight-normal">80%</span></p>
                            <div class="progress h-1">
                                <div class="progress-bar bg-primary w-80 " role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-wrapper pt-2">
                        <div class="mb-3">
                            <p class="mb-2">Projects<span class="float-right text-muted font-weight-normal">60%</span></p>
                            <div class="progress h-1">
                                <div class="progress-bar bg-secondary w-60 " role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-wrapper pt-2">
                        <div class="mb-3">
                            <p class="mb-2">Earnings<span class="float-right text-muted font-weight-normal">50%</span></p>
                            <div class="progress h-1">
                                <div class="progress-bar bg-success w-50" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-wrapper pt-2">
                        <div class="mb-3">
                            <p class="mb-2">Balance<span class="float-right text-muted font-weight-normal">45%</span></p>
                            <div class="progress h-1">
                                <div class="progress-bar bg-warning w-45 " role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="list-group-item d-flex  align-items-center border-top-0">
                    <div class="mr-2">
                        <span class="avatar avatar-md brround cover-image" data-image-src="{{ asset('img/users/1.jpg') }}" style="background: url({{ asset('img/users/1.jpg') }}) center center;"></span>
                    </div>
                    <div class="">
                        <div class="font-weight-500">Mozelle Belt</div>
                        <small class="text-muted">Web Designer
                        </small>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="btn btn-sm  btn-light">Follow</a>
                    </div>
                </div>
                <div class="list-group-item d-flex  align-items-center">
                    <div class="mr-2">
                        <span class="avatar avatar-md brround cover-image" data-image-src="{{ asset('img/users/1.jpg') }}" style="background: url({{ asset('img/users/1.jpg') }}) center center;"></span>
                    </div>
                    <div class="">
                        <div class="font-weight-500">Alina Bernier</div>
                        <small class="text-muted">Administrator
                        </small>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="btn btn-sm  btn-light">Follow</a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="">
                    <div class="d-flex p-3">
                        <label class="custom-control custom-checkbox mb-0">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                            <span class="custom-control-label">Do Even More..</span>
                        </label>
                        <span class="ml-auto">
                            <i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
                            <i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
                        </span>
                    </div>
                    <div class="d-flex p-3 border-top">
                        <label class="custom-control custom-checkbox mb-0">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox5" value="option5">
                            <span class="custom-control-label">Eat healthy, Eat Fresh..</span>
                        </label>
                        <span class="ml-auto">
                            <i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
                            <i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>