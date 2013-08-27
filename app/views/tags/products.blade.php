@extends('layouts.master')

@section('jquery')

@stop

@section('content')
<h1>{{$tag['name']}}</h1>
<hr />
<div class="row-fluid">
		@foreach($tag['products'] as $product)
			@if(count($product['listings']))
				<div class="span3 well" style="text-align:center;">
					@if(count($product['images']))
					<img src="/images/products/{{$product['id']}}/{{$product['images'][0]['image']}}" style="padding-bottom: 5px;">
					@else
					<img src="/images/holder.js/300x300" style="padding-bottom: 5px;">
					@endif
					
					<h2>{{$product['name']}}</h2>
					<h3>
						{{$product['listings'][0]['total_quantity']}} available for ${{$product['listings'][0]['min_price']}}
						{{$product['listings'][0]['min_price'] != $product['listings'][0]['max_price'] ? ' ~ ' . $product['listings'][0]['max_price'] : ''}}
					</h3>
					<p>{{HTML::LinkAction('Swapshop\Controllers\ProductController@getListings', $product['listings'][0]['num_listings'] . ' Listing' . ($product['listings'][0]['num_listings'] != 1 ? 's' : ''), $product['id'],array('class' => 'btn btn-primary'))}}</p>
					<p>{{$product['description']}}</p>
					<p><a href="{{$product['pdf']}}">More Information</a></p>
				</div>
			@endif
		@endforeach
		</div>
@stop