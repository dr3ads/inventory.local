<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{!! url('customers') !!}"><i class="fa fa-dashboard fa-fw"></i> Customers</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Transactions</a>
                <ul class="nav nav-second-level collapse in" aria-expanded="true">
                    <li>
                        <a href="{!! url('transactions/create') !!}">New</a>
                    </li>
                    <li>
                        <a href="{!! url('transactions') !!}">Active</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Inventory</a>
                <ul class="nav nav-second-level collapse in" aria-expanded="true">
                    <li>
                        <a href="{!! url('inventory?on_hand=1') !!}"><i class="fa fa-dashboard fa-fw"></i> On Hand</a>
                    </li>
                    <li>
                        <a href="{!! url('inventory?on_hand=0') !!}"><i class="fa fa-dashboard fa-fw"></i> Track</a>
                    </li>
                    <li>
                        <a href="{!! url('inventory/buy') !!}"><i class="fa fa-dashboard fa-fw"></i> Buy Item</a>
                    </li>
                    <li>
                        <a href="{!! url('inventory/buy') !!}"><i class="fa fa-dashboard fa-fw"></i> Sell Item</a>
                    </li>
                </ul>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Miscellaneous</a>
                <ul class="nav nav-second-level collapse in" aria-expanded="true">
                    <li>
                        <a href="{!! url('misc') !!}">List</a>
                    </li>
                    <li>
                        <a href="{!! url('misc/spend') !!}">Cash Out</a>
                    </li>
                    <li>
                        <a href="{!! url('misc/earn') !!}">Cash In</a>
                    </li>
                </ul>
            </li>
            </li>
            <li>
                <a href="{!! url('reports') !!}"><i class="fa fa-dashboard fa-fw"></i> Reports</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->