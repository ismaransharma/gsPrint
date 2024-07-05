@extends('template.template')
@section('content')

<section id="allReviewAndRating" class="my-5">
    <div class="container">
        <div class="box center">
            <div class="header">
                <h2>
                    <a href="{{ route('getProductDetails', $product->slug) }}" class="bold black">{{ $product->product_title }}</a>
                     | Review and Rating
                    </h2>
            </div>
            <div class="body my-5">
                @foreach ($review as $reviews)                        
                <div class="row my-5 agegtea">
                    <div class="col-md-1">
                        <img class="hw-4" src="{{ asset('site/images/user.png') }}" alt="">
                    </div>
                    <div class="col-md-10 iuokugv">
                        <div class="row">
                            <div class="col-md-4 left">
                                <h3>{{ $reviews->name }} ({{ $reviews->uaa }})</h3>
                            </div>
                            <div class="col-md-4 aetgete">
                                <h3>{{ $reviews->created_at->format('F d, Y') }}</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="row bs-gutter-x-0">
                                    <div class="col-md-4 eaeae">
                                        <div class="starReview t-left">
                                            @for ($i = 1; $i <= $reviews->rating; $i++)
                                                <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                    <path style="fill: #ed8a19" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                                </svg>
                                            @endfor

                                            @for ($i = $reviews->rating + 1; $i <= 5; $i++)
                                                <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                    <path style="fill: #cccccc" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="col-md-7 my-2 t-left ">
                                            <div class="starReviewLine">
                                                <h4>{{ $reviews->review }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection