<!DOCTYPE html>
<html lang="en">
@include('frontend.head')
<body>
    @include('frontend.header')
    <div class="xl:container xl:mx-auto">
        <main>
            @yield('content')
        </main>
        @include('frontend.footer')
    </div>
</body>
</html>
