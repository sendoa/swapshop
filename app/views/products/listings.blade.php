@extends('layouts.master')

@section('content')
<h1>{{$product['name']}}</h1>
<hr />

<div class="row-fluid">
	<div class="span3" style="text-align: center;">
	@if(count($product['images']))
	<img style="height: 100px; width: auto;" src="/images/products/{{$product['id']}}/{{$product['images'][0]['image']}}">
	@else
		<img src="/images/holder.js/100x100">
	@endif
		
	</div>
	<div class="span9">
		<div class="well">
			{{$product['description']}}
		</div>
	</div>
</div>
<hr />
<div class="row-fluid">
@foreach($product['listings'] as $listing)
@if($listing['quantity'] > 0)
<div class="span3">
	<div class="well" style="text-align: center;">
		<h4>{{$listing['user']['username']}}</h4>
		<p><a class="btn btn-small" href="mailto:{{$listing['user']['email']}}">Contact Seller</a>  
		<a class="btn btn-small" href="{{URL::action('Swapshop\Controllers\ListingController@getPurchase', $listing['id'])}}">Purchase</a> </p>
		<span class="badge badge-inverse">${{number_format($listing['price'],2)}}</span>
		<span class="badge badge-info">{{$listing['condition']}}</span>
		<span class="badge badge-success">{{$listing['quantity']}}</span>
	</div>	
	@endif
</div>
@endforeach
</div>
@stop