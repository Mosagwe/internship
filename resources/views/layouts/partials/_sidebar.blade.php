<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/hudumalogo2.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-bolder">Huduma Kenya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user.jpg') }}" class="img-circle elevation-2" alt="User">
            </div>
            @auth
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            @endauth
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="header">MAIN NAVIGATION</li>
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt orange"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employee Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('employee.index') }}" class="nav-link">
                                <i class="fa fa-users fa-fw"></i>
                                Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contract.index') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Contracts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contract.expired') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Expired Contracts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Categories
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Payroll Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payrolls.create') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Run Payroll
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payroll.pending') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Approve
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payrolls.index') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Latest Summary Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payroll.search') }}" class="nav-link">
                                <i class="fa fa-users fa-fw"></i>
                                Payroll Reports
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon"></i>
                        <p>
                            Users Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="fa fa-users fa-fw"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Permissions
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon"></i>
                        <p>
                            System Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('department.index') }}" class="nav-link">
                                <i class="fa fa-users fa-fw"></i>
                                Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('unit.index') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Units
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('station.index') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Stations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bank.index') }}" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                Banks
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payroll.search') }}" class="nav-link">
                                <i class="fa fa-users fa-fw"></i>
                                Pay Register
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payslip.search') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Individual Payslip
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payslips.search') }}" class="nav-link">
                                <i class="fa fa-user-alt fa-fw"></i>
                                Group Payslips
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class=" fa fa-key fa-fw"></i>
                                P9
                            </a>
                        </li>
                    </ul>
                </li>
<!--                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>-->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
