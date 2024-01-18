@extends('layouts.mainLayout')

@section('body')
    <div>
        <div>
            Gambar Telur
        </div>

        <div>
            <h1>About us</h1>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus molestiae neque error quod nulla
                    officia accusantium quae nisi, voluptatum placeat.</p>
            </div>
        </div>

        <div>
            <h1>Top Products</h1>
            <div>
                @foreach ($products as $item)
                    <div>
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->description }}
                        </p>
                    </div>
                @endforeach

                {{-- <div>
                    <h3>Telur</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum delectus quaerat deserunt.</p>
                </div> --}}
            </div>
        </div>

        <div>
            <h1>Contact us</h1>
            <p>Questions or feedback? contact us anytime!</p>

            <div>
                <form></form>
            </div>
        </div>
    </div>
@endsection
