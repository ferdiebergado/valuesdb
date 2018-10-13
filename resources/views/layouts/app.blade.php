<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ferdinand Saporas Bergado">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @stack('styles')

</head>

<body>
    <div id="app">
        <div class="text-center" style="color: white;">
            <h1 class="mt-5"><strong>{{ optional($currentevent)->activitytitle ?? config('app.name') }}</h1></strong>
            <h3>{{ optional($currentevent)->venue }}</h3>
            @php
            $start = \Carbon\Carbon::parse(optional($currentevent)->startdate);
            $end = \Carbon\Carbon::parse(optional($currentevent)->enddate);
            @endphp
            <h4 class="mb-5">{{ $start->format('F d')}} to {{ ($end->month >= $start->month) ? $end->day : ($end->month > $start->month) ? $end->format('F d') : $end->day }}, {{ $end->year }}</h4>
        </div>

        @if (Route::is('search') || Route::is('login'))

        <div class="flex-container">
            <div class="flex-row col-6">
                @include('messages')
                @yield('content')
            </div>
        </div> <!-- flex-container -->

        @else

        <div class="container-fluid">
            {{-- <p><h1 class="text-center" style="color: white;"><strong>{{ config('app.name') }}</h1></strong></p> --}}
            <div class="row justify-content-center">
                <div class="card card-primary">
                    <div class="card">
                        {{-- @if (Route::is('*.index')) --}}
                        <div class="card-header">
                            @yield('boxtools')
                        </div>
                        {{-- @endif --}}
                        <div class="card-body">
                            @include('messages')
                            @yield('content')
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-center">
                                <small class="text-center">&copy; Copyright 2018. <a href="javascript:void();" data-toggle="modal" data-target="#license">License</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->

        {{-- @include('footer') --}}
        @endif

        <!-- Modal -->
        <div class="modal fade" id="license" tabindex="-1" role="dialog" aria-labelledby="License" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">MIT License</h4>
                    </div>
                    <div class="modal-body">
                        {!! file_get_contents(base_path('LICENSE')) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> <!-- Modal -->

    </div> <!-- app -->

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
