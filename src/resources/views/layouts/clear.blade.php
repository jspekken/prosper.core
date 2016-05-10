@include('prosper.core::components.layout.header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 main">
                @yield('content')
            </div>
        </div>
    </div>

@include('prosper.core::components.layout.footer')