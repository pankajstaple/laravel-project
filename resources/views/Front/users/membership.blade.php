@extends('layouts.front')
@section('content')
<div class="container">

  <div class='headings text-center my-5'>
    <h2>Membership</h2>
  </div>

  <section class="membership mb-5">
    <div class="card">
      <div class="card-body">
        <div class="membership-box">
          <img src="{{ url('fronttheme/images/membership-icon.png') }}" class="img-fluid">
          <h3 class="text-uppercase">Membership</h3>
          <h5>Huge prizes, smarter progress, more game choices!</h5>
          <p>Major prize give aways each week</p>
          <p>Progress-trackingtools to get you to your biggest goals</p>
          <p>Exciting new game types</p>
          @if(isset($alreadyEnrolled) && $alreadyEnrolled > 0)
                <span style="padding:8px 16px;color: #182633;background-color: #e0a800;border-color: #d39e00;">You are already member.</span>
    
          @else
                <a href="{{ route('checkout', 'membership')}}" class="btn btn-yellow rounded-0">Yearly: ${{$subscription_amt}}/year</a>
    
          @endif
        </div>
      </div>
    </div>
  </section>

</div>
@endsection