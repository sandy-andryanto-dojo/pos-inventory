<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset(\Auth::User()->getImageProfile()) }}" class="img-circle img-user" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ \Auth::User()->getFullname() }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu hidden" id="menu-utama">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ \Auth::User()->grantAccess('dashboards') }}"><a href="{{ route('dashboards.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('profiles.index') }}"><i class="fa fa-user-plus"></i> <span>Profile</span></a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-database"></i> <span>References</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('dashboards') }}"><a href="{{ route('banks.index') }}"><i class="fa fa-circle-o"></i> Bank</a></li>
                <li class="{{ \Auth::User()->grantAccess('customers') }}"><a href="{{ route('customers.index') }}"><i class="fa fa-circle-o"></i> Customer</a></li>
                <li class="{{ \Auth::User()->grantAccess('stakeholders') }}"><a href="{{ route('stakeholders.index') }}"><i class="fa fa-circle-o"></i> Stakeholder</a></li>
                <li class="{{ \Auth::User()->grantAccess('suppliers') }}"><a href="{{ route('suppliers.index') }}"><i class="fa fa-circle-o"></i> Supplier</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cubes"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('brands') }}"><a href="{{ route('brands.index') }}"><i class="fa fa-circle-o"></i> Brand</a></li>
                <li class="{{ \Auth::User()->grantAccess('groups') }}"><a href="{{ route('groups.index') }}"><i class="fa fa-circle-o"></i> Group</a></li>
                <li class="{{ \Auth::User()->grantAccess('categories') }}"><a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                <li class="{{ \Auth::User()->grantAccess('items') }}"><a href="{{ route('items.index') }}"><i class="fa fa-circle-o"></i> Items</a></li>
                <li class="{{ \Auth::User()->grantAccess('product_images') }}"><a href="{{ route('product_images.index') }}"><i class="fa fa-circle-o"></i> Image</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-money"></i> <span>Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('transaction_purchases') }}"><a href="{{ route('transaction_purchases.index') }}"><i class="fa fa-circle-o"></i> Purchase</a></li>
                <li class="{{ \Auth::User()->grantAccess('transaction_sales') }}"><a href="{{ route('transaction_sales.index') }}"><i class="fa fa-circle-o"></i> Sales</a></li>
                <li class="{{ \Auth::User()->grantAccess('transaction_fees') }}"><a href="{{ route('transaction_fees.index') }}"><i class="fa fa-circle-o"></i> Fee</a></li>
            </ul>
        </li>
        <li class="treeview {{ \Auth::User()->grantAccess('reports') }}">
            <a href="#">
                <i class="fa fa-line-chart"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('reports.show', ['id'=> 2]) }}"><i class="fa fa-circle-o"></i> Purchase</a></li>
                <li><a href="{{ route('reports.show', ['id'=> 1]) }}"><i class="fa fa-circle-o"></i> Sales</a></li>
                <li><a href="{{ route('reports.show', ['id'=> 3]) }}"><i class="fa fa-circle-o"></i> Fee</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gears"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('audits') }}"><a href="{{ route('audits.index') }}"><i class="fa fa-circle-o"></i> Audit Log</a></li>
                <li class="{{ \Auth::User()->grantAccess('settings') }}"><a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i> Application</a></li>
                <li class="{{ \Auth::User()->grantAccess('users') }}"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> User</a></li>
                <li class="{{ \Auth::User()->grantAccess('roles') }}"><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> Role & Permission</a></li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->