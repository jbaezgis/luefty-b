<div class="row">
    @foreach ($services_prices as $item)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Private</h4>
                            <p class="card-text">
                                <span><i class="fa fa-user text-success" aria-hidden="true"></i> {{ $item->priceOption->name }}</span> |
                                <span><i class="fa fa-car text-success" aria-hidden="true"></i> <strong>{{__('Driving time:')}}</strong> 3 hours</span>
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <span class="text-muted">{{__('Total one-way price')}}</span>
                            <h3 class="">{{ $item->oneway_price }}</h3>
                            {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}
                                {{-- hidden fields --}}
                                {{ Form::hidden('auction_id', $auction->id) }}

                                {{-- Button --}}
                                {!! Form::button(__('Buy Now'), array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-success btn-block',
                                        'title' => __('Buy Now')
                                )) !!}
                            {!! Form::close() !!}
                            {{-- <a href="#" class="btn btn-success btn-block">{{__('Buy Now')}}</a> --}}
                        </div>
                    </div>

                </div>
            </div>
            <br>
        </div>

    @endforeach
</div>

