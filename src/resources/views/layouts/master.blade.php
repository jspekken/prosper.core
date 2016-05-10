@include('prosper.core::components.layout.header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                @include('prosper.core::components.layout.sidebar')
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('content')
            </div>
        </div>
    </div>

@include('prosper.core::components.layout.header')