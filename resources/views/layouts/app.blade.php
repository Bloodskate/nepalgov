<!DOCTYPE html>
<html lang="en">

@include('partials._head')

<body id="app-layout">

    @include('partials._nav')
        
		{{session()->get('parent_id')}}
    <div class="container">
    
        @yield('content')
    
    </div>
    
    @include('partials._footer')

    <!-- JavaScripts -->
    @include('partials._js')

</html>
