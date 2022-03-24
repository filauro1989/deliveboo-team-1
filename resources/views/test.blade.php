{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    {{-- @php
        use App\User;
        use App\Model\Category;
        use App\Model\Course;
        use App\Model\Dish;
        use App\Model\Order;
        
        $restaurant = User::where('id', 1)->first();
        
        // dd($restaurant->categories()->first()->name);
        
        $category = Category::where('name', 'Pizza')->first();
        
        // dd($category->users()->first()->restaurant_name);
        
        // dd($restaurant->dishes()->first()->name);
        
        $dish = Dish::where('name', 'margherita')->first();
        
        // dd($dish->user()->first()->restaurant_name);
        
        // dd($dish->orders()->first()->total_amount);
        
        // dd($dish->course()->first()->name);
        
        $order = Order::where('id', 1)->first();
        
        // dd($order->dishes()->first()->name);
        
        $course = Course::where('name', 'Pizza')->first();
        
        dd($course->dishes()->first()->name);
        
    @endphp --}}

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
