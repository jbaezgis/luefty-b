@extends('layouts.app2')
@section('title', __('Rules'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="container py-5">
  <div class="">
    <h1 class="display-4">{{ __('Luefty Auction Use Rules ') }}</h1>
    <p></p>
  </div>
  <p class="lead">
    We reserve the right to adjust rules as we see fit and welcome suggestions to further improve user experience.
  </p>
    <h5>Sellers (Auctioneers/Agents etc.)</h5>
    <p>
      You can mark you favorite (trusted) providers and they will appear at the top of your bidders list. You can also mark ‘potential favorites’ and test them. You can set your profile to show your company name publicly or keep your name private. 
    </p>
    <p></p>
    <h5>Providers (Bidders/Operators)</h5>
    <p>
      You can set your profile so Agencies can see how many first class other Agencies use your services. This will build your business because agencies that have not used your services will begin to accept your bids. You can set your profile to show your company name publicly or keep your name private. You can also set your profile to show as many details about you and your company you want to show publicly. This is a good idea when you want to expose your quality to the general market. 
    </p>
    <p></p>

    <h5>Rules for Private Transfers</h5>
    <ol class="">
      <li class="">Accepted Bids: Means you have Accepted a Bid and the Auction is closed.</li>
      <li class="">Auction Changed: Means you have changed an Auction.</li>
      <li class="">Open Bids: Means you have not Accepted Bids yet.</li>
      <li class="">No Bid Yet: Means you have not received a bid for the auction.</li>
    </ol>
    <p></p>

    {{-- <h5>Rules for Shared Transfers</h5>
    <ol class="">
      <li class="">Accepted Bids: Means you have Accepted a Bid and the Auction is closed.</li>
      <li class="">Auction Changed: Means you have changed an Auction.</li>
      <li class="">Open Bids: Means you have not Accepted Bids yet.</li>
      <li class="">No Bid Yet: Means you have not received a bid for the auction.</li>
    </ol> --}}

    <p></p>

    <h5>Other Rules</h5>
    <ol class="">
      <li class="">Edit or change auction details, only before you have accepted a bid.</li>
      <li class="">Reinstate auctions you have deleted only for 1 hour.</li>
      <li class="">Bidders see changed and deleted auctions for their convenience.</li>
      <li class="">The first bid for an auction needs to be entered manually.</li>
      <li class="">Bids after the first bid are selected are entered with our one touch bid system.</li>
      <li class="">You can bid at any time an auction is active and as many times as you like.</li>
      <li class="">You can bid on as many auctions as you want.</li>
      <li class="">You may not bid on you own auction.</li>
    </ol>
    <p></p>
    {{-- <h4 class="text-danger">IMPORTANT</h4> --}}
    <p><strong>Bidding on your own auction is prohibited.</strong> 
      Luefty personnel, our algorithms and other users will be alerted. Such abuse automatically triggers disqualification from Luefty for 30 days and public exposure. Luefty welcomes our user base to report such abuse and reserves the right to ban anyone from the site at any time. 
    </p>

    <p></p>
    <p></p>
  </div>

@endsection
