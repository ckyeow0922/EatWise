<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.partials.head')
    @yield('style')
    <style>

    </style>
</head>

<body>
    <div class="nk-app-root" style="background: white;">
        <div class="nk-wrap">
            @include('user.partials.header')
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.partials.modals')
    @include('user.partials.scripts')
    @yield('scripts')
</body>

</html>
