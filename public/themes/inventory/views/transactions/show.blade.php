<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">

                @if($processTree['parent']->status == 'active')
                    <a class="btn btn-default pull-left margin-left-20 link-tooltip @if( $transactionDetails['totalPawnAmount'] >= $processTree['parent']->item->value  ) disabled @endif"
                       data-placement="bottom" data-toggle="tooltip" title="Repawn Transaction"
                       href="{{ url('transactions/repawn/'.$processTree['parent']->id) }}" id="repawn_link"
                       title="Repawn">
                        <i class="fa fa-refresh"></i>Repawn
                    </a>
                @endif
                @if($processTree['parent']->status != 'claimed')
                    <a class="btn btn-default pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip"
                       title="Claim Item" href="{{ url('transactions/claim/'.$processTree['parent']->id) }}"
                       id="claim_link" title="Claim">
                        <i class="fa fa-mail-forward"></i>Claim
                    </a>
                    <a class="btn btn-info pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip"
                       title="Renew Transaction" href="{{ url('transactions/renew/'.$processTree['parent']->id) }}"
                       id="renew_link" title="Renew">
                        <i class="fa fa-clone"></i>Renew
                    </a>
                @endif
                @if($processTree['parent']->status == 'expired')
                    <a class="btn btn-info pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip"
                       title="Hold Transaction" href="{{ url('transactions/hold/'.$processTree['parent']->id) }}"
                       id="hold_link" title="Hold">
                        <i class="fa fa-clone"></i>Hold
                    </a>
                @endif
            </div>
            <div class="page-title">
                <a class="trans-status btn btn-primary"
                   title="Status: {{ ucfirst($processTree['parent']->status) }}">{!! ucfirst($processTree['parent']->status) !!}</a>
                <span class="customer">Customer: {{ $processTree['parent']->customer->full_name }}</span> &#183;
                <span class="customer">Expiry: {{ date('M d, Y', strtotime($processTree['lastChild']->expired_at)) }}</span>
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
                                            <a href="#" data-toggle="modal"
                                               data-target="#reciept-modal-{{ $child->ctrl_number }}"
                                               class="link-tooltip" title="Print Reciept"><i
                                                        class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <div class="modal fade bs-example-modal-lg receipt-modal" id="reciept-modal-{{ $child->ctrl_number }}"
                                 tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content receipt-body" id="print-receipt-{{ $child->ctrl_number }}">
                                        {{--<div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Modal title</h4>
                                        </div>--}}
                                        <div class="modal-body">
                                            <p style="text-indent: 10px">FG CEBU GADGET SHOP, with principal place of
                                                business at F. Llamas St.,
                                                Punta Princesa, Labongon, Cebu City, Philippines hereinafter referred to
                                                the BUYER:</p>
                                            <p style="text-align: center">WITNESSETH, that:</p>
                                            <p>As, the Seller of the true and absolute owner of the following item/s
                                                herein below described:</p>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <td>Brand/Model</td>
                                                    <td>Serial Number</td>
                                                    <td>Accessories</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ $processTree['parent']->item->brand }}</td>
                                                    <td>{{ $processTree['parent']->item->serial }}</td>
                                                    <td>{{ $processTree['parent']->item->description }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p>NOW, THEREFORE, for and in consideration of the sum
                                                <span class="underline strong">{{ $child->item->value }}</span>,
                                                Philippine currency,
                                                receipt of which is hereby acknowledged by the SELLER to his full and
                                                complete satisfaction, the SELLER does hereby SELL, TRANSFER, and
                                                CONVERY with RIGHT REPURCHASE unto the said BUYER to his successors and
                                                as the above-described items/, free from an and all liens and
                                                encumbrances;
                                            </p>
                                            <p>
                                                That the SELLER, in executing this assignment and conveyance, hereby
                                                reserves the right to REPURCHASE , and the BUYER, in the same hererby
                                                obligates itself to RESELL, RETRANSFER, and RECONVEY, the
                                                above-described item/s within a period of fifteen (15) days starting
                                                today until <span class="underline strong">{{ date('M d, Y',
                                                strtotime($processTree['lastChild']->expired_at)) }}</span>,
                                                for the price of <span
                                                        class="underline strong">{{ $child->pawn_amount }}</span>,
                                                Philippine currency; provided, however, that the SELLER shall fail to
                                                exercise his/her right to repurchase by fully and completely paying the
                                                said price within the period alloted, then this conveyance shall become
                                                ABSOLUTE AND IRREVOCABLE, without the necessity of drawing up a new deed
                                                of absolute
                                            </p>
                                            <p></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                            <button type="button" class="btn btn-primary go-print" data-id="{{ $child->ctrl_number }}">Print</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
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

