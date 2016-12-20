@include('BO.partials.header')

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>

            <h1>@yield('title')</h1>
            <div class="options">
                <div class="btn-toolbar">
                    @section('options')
                        <select class="form-control">
                            <option selected hidden>Current contest</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    @show
                </div>
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>
    </div>
</div>

@include('BO.partials.footer')