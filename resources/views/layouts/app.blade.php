<!-- resources/views/layouts/app.blade.php -->
@include('includes.header')

<!-- Main Content -->
<div class="content" style="background-color:rgb(238, 238, 238);">
    @yield('content')
</div>

@include('includes.footer')
