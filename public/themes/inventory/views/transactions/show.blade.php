<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">

                @if($processTree['parent']->status == 'active')
                    <a class="btn btn-default pull-left margin-left-20 link-tooltip @if( $transactionDetails['totalPawnAmount'] >= $processTree['parent']->item->value  ) disabled @endif" data-placement="bottom" data-toggle="tooltip" title="Repawn Transaction" href="{{ url('transactions/repawn/'.$processTree['parent']->id) }}" id="repawn_link" title="Repawn">
                        <i class="fa fa-refresh"></i>Repawn
                    </a>
                @endif
                @if($processTree['parent']->status != 'claimed')
                    <a class="btn btn-default pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Claim Item" href="{{ url('transactions/claim/'.$processTree['parent']->id) }}" id="claim_link" title="Claim">
                        <i class="fa fa-mail-forward"></i>Claim
                    </a>
                    <a class="btn btn-info pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Renew Transaction" href="{{ url('transactions/renew/'.$processTree['parent']->id) }}" id="renew_link" title="Renew">
                        <i class="fa fa-clone"></i>Renew
                    </a>
                @endif
                @if($processTree['parent']->status == 'expired')
                    <a class="btn btn-info pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Hold Transaction" href="{{ url('transactions/hold/'.$processTree['parent']->id) }}" id="hold_link" title="Hold">
                        <i class="fa fa-clone"></i>Hold
                    </a>
                @endif
            </div>
            <div class="page-title">
                <a class="trans-status btn btn-primary" title="Status: {{ ucfirst($processTree['parent']->status) }}">{!! ucfirst($processTree['parent']->status) !!}</a>
                <span class="customer">Customer:  {{ $processTree['parent']->customer->full_name }}</span> &#183;
                <span class="customer">Expiry:  {{ date('M d, Y', strtotime($processTree['lastChild']->expired_at)) }}</span>
            </div>
            <div class="item-details">
                <h2 class="item-name">{{ $processTree['parent']->item->name }}</h2>
                <div class="item-value">Item Value: P{{ $processTree['parent']->item->value }}</div>
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $processTree['parent']->item->brand }}</div>
            <div class="item-brand">{{ $processTree['parent']->item->serial }}</div>
            <div class="item-brand">{{ $processTree['parent']->item->description }}</div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="transaction-tree">
                    <ul id="trans-list">
                        @foreach($children as $child)
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="trans-details">
                                        <span class="ctrl-number">#{{ $child->ctrl_number }}</span> &#183;
                                        <span class="trans-type">{{ ucfirst($child->type) }}</span> &#183;
                                        <span class="trans-amount">P{{ $child->pawn_amount }}</span>
                                    </div>
                                    <div class="trans-timeline">
                                        <span class="trans-date">{{ date('M d, Y', strtotime($child->pawned_at)) }}</span>
                                    </div>
                                    <div class="trans-actions pull-right">
                                        <a href="#" class="link-tooltip" title="Print Reciept" ><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="claim-details">
                    <h3>Amount Details</h3>
                    <div class="form-group">
                        {!! Form::label('pawn_amount', 'Total Amount') !!}
                        <div class="item">{!! money_format('P %i', $transactionDetails['totalPawnAmount']) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('principal_amount', 'Principal Payable') !!}
                        <div class="item">{!! money_format('P %i', $transactionDetails['totalPrincipal']) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('penalty', 'Penalty Amount') !!}
                        <div class="item">{!! money_format('P %i', $totalAmount * ($transactionDetails['processPenalty'] / 100)) !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

