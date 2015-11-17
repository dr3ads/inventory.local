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
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Transactions</a>
                <ul class="nav nav-second-level collapse in" aria-expanded="true">
                    <li>
                        <a href="{!! url('transactions/new') !!}">New</a>
                    </li>
                    <li>
                        <a href="{!! url('transactions') !!}">Active</a>
                    </li>
                </ul>
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