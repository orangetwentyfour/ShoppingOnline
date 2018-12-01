<section class="container px-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light pl-0 ml-0 mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{route('list-products', $product->categories[0]->slug)}}">{{$product->categories[0]->name}}</a>
            </li>
        </ol>
    </nav>
    <div class="pb-3">
        <div class="d-flex">
            <div class="w-100 border bg-white d-flex py-3 px-4">
                <div class="mr-3 pr-4 border-right d-flex justify-content-center align-items-center">
                    <img class="img-fluid detail-product-img" src="{{$product->images[0]->url}}" alt="">
                </div>
                <div class="w-100">
                    <div class="d-flex align-items-center">
                        @if($product->star >= 4)
                            <span class="badge mr-1 font-weight-normal b-color-common text-white text-common-sm">
                                <i class="fa fa-check mr-1"></i>{{__('Yêu thích')}}
                            </span>
                        @endif
                        <h4>
                            {{$product->name}}
                        </h4>
                    </div>
                    <span class="d-block d-flex align-items-center">
                        <u class="color-common text-common-md mr-2">{{$product->star}}</u>
                        @for($index = 0; $index < $product->star; $index ++)
                            <i class="fa fa-star color-common mr-1"></i>
                        @endfor
                    </span>
                    <p class="text-justify">
                        {{$product->summary}}
                    </p>
                    <p>
                        <span class="bg-light d-block p-3 text-common mb-3">
                            <u>{{__('đ')}}</u> {{money($product->price . '000')}}
                        </span>
                    </p>
                    <form class="w-100" action="{{route('add-cart')}}" method="post">
                        <div class="form-group mb-2">
                            <label class="mr-3">
                                {{__('Số lượng')}}
                            </label>
                            <input type="number" class="form-control d-inline-block" value="1">
                        </div>
                        <div class="form-group pt-3" data-id="{{$product->id}}">
                            <button id="add-cart-button" class="btn mr-3 bg-white border-common color-common">
                                {{__('Thêm vào giỏ hàng')}}
                            </button>
                            <button id="buy-button" class="btn mr-3 b-color-common border-common text-white">
                                {{__('Mua ngay')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container px-0">
    <div class="d-flex border flex-column p-3 bg-white">
        <h4 class="border-bottom pb-3">
            {{__('CHI TIẾT SẢN PHẨM')}}
        </h4>
        <div class="w-100 bg-white p-3">
            {{$product->description}}
        </div>
    </div>
</section>

<section class="container px-0 mt-3">
    <div class="d-flex border flex-column p-3 bg-white">
        <h4 class="border-bottom pb-3">
            {{__('ĐÁNH GIÁ SẢN PHẨM')}}
        </h4>
        <div class="w-100 bg-white p-3">

        </div>
    </div>
</section>
