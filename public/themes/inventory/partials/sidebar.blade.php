<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!--<li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </li> -->
            <li>
                <a href="{!! url('customers') !!}"><i class="fa fa-dashboard fa-fw"></i> Customers</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">New</a>
                    </li>
                    <li>
                        <a href="morris.html">Sell</a>
                    </li>
                    <li>
                        <a href="morris.html">Miscellaneous</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{!! url('inventory') !!}"><i class="fa fa-dashboard fa-fw"></i> Inventory</a>
            </li>
            <li>
                <a href="{!! url('inventory') !!}"><i class="fa fa-dashboard fa-fw"></i> Reports</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->