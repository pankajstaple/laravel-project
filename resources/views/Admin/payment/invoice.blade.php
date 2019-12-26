@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
    @include('elements.printerror')
    <div class="ibox invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">
                    <div class="invoice-logo">
                        <img src="{{url('fronttheme/images/logo-dad.png')}}" alt="BeDadStrong Logo" height="65px">
                    </div>
                    <div>
                        <div class="m-b-5 font-bold">Invoice from</div>
                        <div>{{ $fromAddress['company']}}</div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">
                                <span class="font-strong">A:</span> {{ $fromAddress['address']}}</li>
                            <li class="m-b-5">
                                <span class="font-strong">W:</span> {{ $fromAddress['email']}}</li>
                            <li>
                                <span class="font-strong">P:</span> {{ $fromAddress['phone']}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="clf" style="margin-bottom:30px;">
                        <dl class="row pull-right" style="width:260px;"><dt class="col-sm-6">Invoice Date</dt>
                            <dd class="col-sm-6">{{ (!empty($payment['created_at'])?\Carbon\Carbon::parse($payment['created_at'])->format('m/d/Y'):"")}}</dd><dt class="col-sm-6">Issue Date</dt>
                            <dd class="col-sm-6">{{ date('m/d/Y', time())}}</dd><dt class="col-sm-6">Invoice No.</dt>
                            <dd class="col-sm-6">{{ $payment['invoice_no']}}</dd>
                        </dl>
                    </div>
                    <div>
                        <div class="m-b-5 font-bold">Invoice To</div>
                        <div>{{  $payment->get_user->first_name." ".$payment->get_user->last_name}}</div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">{{ $payment->get_user->profile->address}}</li>
                            <li class="m-b-5">{{  $payment->get_user->email}}</li>
                            <li>{{ $payment->get_user->profile->contact}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped no-margin table-invoice">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>&nbsp;</th>
                    <th>Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @if($payment->payment_for == "Challenge")
                        <div>
                            <strong>{{ isset($payment->get_challenge)?$payment->get_challenge->title:"N/A"}}</strong>
                        </div>
                        <small>{{ isset($payment->get_challenge)?$payment->get_challenge->description:"N/A"}}</small>
                        @elseif($payment->payment_for == "Membership")
                        <div>
                            <strong>Yearly Membership</strong>
                        </div>
                        
                        @endif
                    </td>
                    <td>&nbsp;</td>
                    <td>${{$payment->actual_amount}}</td>
                    <td>${{$payment->actual_amount}}</td>
                </tr>
              
            </tbody>
        </table>
        <table class="table no-border">
            <thead>
                <tr>
                    <th></th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-right">
                    <td>Subtotal:</td>
                    <td>${{$payment->actual_amount}}</td>
                </tr>
                <tr class="text-right">
                    <td>Discount:</td>
                    <td>${{ !empty($payment->discount)?$payment->discount:0.00}}</td>
                </tr>
                <tr class="text-right">
                    <td class="font-bold font-18">TOTAL:</td>
                    <td class="font-bold font-18">${{$payment->paid_amount}}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <button class="btn btn-info print-invoice" type="button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
    </div>
</div>
@endsection
