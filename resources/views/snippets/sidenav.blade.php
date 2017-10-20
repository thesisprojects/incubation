<div class="col-md-3 col-sm-6 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">

    <div class="list-group border-0 card text-center text-md-left">
        <div class="row list-group-item">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-white">Incubation.app</h2>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <p class="text-white">Welcome back, {{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->last_name) }}</p>
            </div>
        </div>
        @if(Auth::user()->hasPermission('view dashboard'))
            <a href="{{ Route('getDashboard') }}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-tachometer" aria-hidden="true"></i> <span
                        class="d-none d-md-inline">Dashboard</span></a>
        @endif
        @if(Auth::user()->hasPermission('view roles'))
            <a href="#rolesandpermissions" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Roles and Permissions</span> </a>
            <div class="collapse" id="rolesandpermissions">
                <a href="#roles" class="list-group-item" data-toggle="collapse" aria-expanded="false">Roles </a>
                <div class="collapse" id="roles">
                    <a href="{{ Route('getRoles') }}" class="list-group-item" data-parent="#menu1sub1">Create Roles</a>
                </div>
            </div>
        @endif
        @if(Auth::user()->hasPermission('view users'))
            <a href="#users" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Users</span> </a>
            <div class="collapse" id="users">
                <a href="{{ route('getCreateUser') }}" class="list-group-item" data-parent="#users">Create </a>
                <a href="{{ route('getUsers') }}" class="list-group-item" data-parent="#users">View </a>
            </div>
        @endif
        @if(Auth::user()->hasPermission('view farms'))
            <a href="#farms" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-home" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Farms</span> </a>
            <div class="collapse" id="farms">
                <a href="{{ route('getCreateFarm') }}" class="list-group-item" data-parent="#farms">Create </a>
                <a href="{{ route('getFarms') }}" class="list-group-item" data-parent="#farms">View </a>
            </div>
        @endif
        @if(Auth::user()->hasPermission('view eggs'))
            <a href="#eggs" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-circle-thin" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Eggs</span> </a>
            <div class="collapse" id="eggs">
                <a href="{{ route('getCreateEgg') }}" class="list-group-item" data-parent="#eggs">Create </a>
                <a href="{{ route('getEggs') }}" class="list-group-item" data-parent="#eggs">View </a>
                <a href="{{ route('getEggs') }}" class="list-group-item" data-parent="#eggs">Expired </a>
            </div>
        @endif
        @if(Auth::user()->hasPermission('view incubators'))
            <a href="#incubators" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-thermometer-full" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Incubators</span> </a>
            <div class="collapse" id="incubators">
                <a href="{{ route('getCreateIncubator') }}" class="list-group-item" data-parent="#incubators">Create </a>
                <a href="{{ route('getIncubators') }}" class="list-group-item" data-parent="#incubators">View </a>
            </div>
        @endif

        @if(Auth::user()->hasPermission('view incubators'))
            <a href="#clients" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Clients</span> </a>
            <div class="collapse" id="clients">
                <a href="{{ route('getCreateClient') }}" class="list-group-item" data-parent="#clients">Create </a>
                <a href="{{ route('getClients') }}" class="list-group-item" data-parent="#clients">View </a>
            </div>
        @endif

        @if(Auth::user()->hasPermission('view hatchery'))
            <a href="#hatcheries" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-thermometer" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Hatcheries</span> </a>
            <div class="collapse" id="hatcheries">
                <a href="{{ route('getCreateHatchery') }}" class="list-group-item" data-parent="#hatcheries">Create </a>
                <a href="{{ route('getHatcheries') }}" class="list-group-item" data-parent="#hatcheries">View </a>
            </div>
        @endif

        @if(Auth::user()->hasPermission('deliver'))
            <a href="#delivery" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-truck" aria-hidden="true"></i>
                <span class="d-none d-md-inline">Delivery</span> </a>
            <div class="collapse" id="delivery">
                <a href="{{ route('getDelivery') }}" class="list-group-item" data-parent="#delivery">Deliver eggs</a>
                <a href="{{ route('getDeliveries') }}" class="list-group-item" data-parent="#delivery">Deliveries</a>
            </div>
        @endif


        <a href="{{ Route('getLogout') }}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="d-none d-md-inline">Logout</span></a>
    </div>
</div>