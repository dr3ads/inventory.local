<div class="header-logo">
    <a title="" id="js-shortcuts-home" href="/" data-toggle="tooltip" data-placement="bottom" class="home"
       data-original-title="Dashboard">
        <img src="{!! Theme::asset()->url('img/logo-full.jpeg') !!}" alt="logo"  />
        <!--<h3>Cebu GADGET</h3>-->
    </a>
</div>
<ul class="nav nav-sidebar">
    <li>&nbsp;</li>
    <li class="separate-item"></li>
    <li class="dashboard">
        <a title="Dashboard" href="#" data-placement="right"
           class="shortcuts-dashboard">
            <i class="fa fa-dashboard fa-fw"></i><span>Dashboard</span>
        </a>
    </li>
    <li class="customers">
        <a title="Customers" href="{{ url('customers') }}" data-placement="right"
           class="shortcuts-customers">
            <i class="fa fa-users fa-fw"></i><span>Customers</span>
        </a>
    </li>
    <li class="transactions">
        <a title="Transactions" href="{{ url('transactions') }}" data-placement="right"
           class="shortcuts-transactions">
            <i class="fa fa-book fa-fw"></i><span>Transactions</span>
        </a>
    </li>
    <li class="alerts">
        <a title="Reports" href="{{ url('alerts') }}" data-placement="right"
           class="shortcuts-alerts">
            <i class="fa fa-exclamation-circle fa-fw"></i><span>Reports</span>
        </a>
    </li>
    <li class="inventory">
        <a title="Transactions" href="{{ url('inventory') }}" data-placement="right"
           class="shortcuts-inventory">
            <i class="fa fa-cubes fa-fw"></i><span>Inventory</span>
        </a>
    </li>
    <li class="misc">
        <a title="Miscellaneous" href="{{ url('misc') }}" data-placement="right"
           class="shortcuts-misc">
            <i class="fa fa-files-o fa-fw"></i><span>Miscellaneous</span>
        </a>
    </li>
    <li class="reports">
        <a title="Reports" href="{{ url('reports') }}" data-placement="right"
           class="shortcuts-reports">
            <i class="fa fa-area-chart fa-fw"></i><span>Reports</span>
        </a>
    </li>

</ul>
