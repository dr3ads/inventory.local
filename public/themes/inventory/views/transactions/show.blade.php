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
                            <div class="modal fade bs-example-modal-lg receipt-modal"
                                 id="reciept-modal-{{ $child->ctrl_number }}"
                                 tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content receipt-body"
                                         id="print-receipt-{{ $child->ctrl_number }}">
                                        {{--<div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Modal title</h4>
                                        </div>--}}
                                        <div class="modal-body">
                                            <h3 class="center-align">DEED OF SALE WITH RIGHT OF REPURCHASE</h3>
                                            <p>&nbsp;</p>
                                            <h4>KNOW ALL MEN BY THESE PRESENTS:</h4>
                                            <p class="center-align">
                                                This Deed of Sale with Right of Repurchase, made and executed by and
                                                between:
                                            </p>
                                            <p class="center-align">

                                                <span class="underline">{{ $child->customer->full_name }}</span> of
                                                legal age, and a resident of <span class="underline"
                                                                                   style="min-width: 100px; display: inline-block">{!!  ($child->customer->address) ?: "<span style='border-bottom: solid 1px #000;display: inline-block;width: 100%'>&nbsp;</span>" !!}</span>
                                                hereinafter referred to as the SELLER;
                                            </p>
                                            <p class="center-align">-and-</p>
                                            <p class="center-align">FG CEBU GADGET SHOP, with principal place of
                                                business at N. Bacalso St., Cebu City, Philippines, hereinafter referred
                                                to as the BUYER;</p>
                                            <p class="center-align">WITNESSETH, that:</p>
                                            <p class="center-align">WHEREAS, the Seller is the true and absolute owner
                                                of the following
                                                item/s herein below described:</p>
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
                                            <p>NOW, THEREFORE, for and in consideration of the sum of
                                                <span class="underline strong">{{ $child->item->value }}</span>,
                                                Philippine currency,receipt of which is hereby acknowledged by the
                                                SELLER to his full and complete satisfaction, the SELLER does hereby
                                                SELL, TRANSFER,
                                                and CONVEY with RIGHT OF REPURCHASE unto the said BUYER, his heirs,
                                                successors and
                                                assigns, the above-described item/s, free from any and all liens and
                                                encumbrances;
                                            </p>
                                            <p>
                                                That the SELLER, in executing this assignment and conveyance, hereby
                                                reserves the right to REPURCHASE, and the BUYER, in accepting the same,
                                                hereby obligates itself to RESELL, RETRANSFER, and RECONVEY, the
                                                above-described item/s within a period of fifteen (15) days starting
                                                today until <span class="underline strong">{{ date('M d, Y',
                                                strtotime($processTree['lastChild']->expired_at)) }}</span>,
                                                for the price of <span
                                                        class="underline strong">{{ $child->pawn_amount }}</span>,
                                                Philippine currency; provided, however, that if the SELLER shall fail to
                                                exercise his/her right to repurchase by fully and completely paying the
                                                said price within the period stipulated, then this conveyance shall
                                                become ABSOLUTE AND IRREVOCABLE, without necessity of drawing up a new
                                                deed of absolute sale.
                                            </p>
                                            <p>
                                                That this instrument is prepared only in two (2) copies with each copy
                                                distributed only to the SELLER and the BUYER. That in the event of
                                                repurchase, the SELLER shall surrender his copy of this instrument to
                                                the BUYER within the period stipulated together with price agreed upon
                                                for the repurchase.
                                            </p>
                                            <p>
                                                IN WITNESS WHEREOF, we have hereunto set our signatures this <strong>{{ date('jS') }}</strong> day of <strong>{{ date('F') }}</strong> in the city of Cebu, Philippines.
                                            </p>
                                            <div class="row margin-top-30">
                                                <div class="col-md-6">
                                                    <p class="center-align" style="width: 100%;border-top: solid 1px #000;">
                                                        NAME AND SIGNATURE OF SELLER
                                                    </p>
                                                    <p class="center-align"><label>ID TYPE:</label> <underline> {{ $child->customer->id_type }}</underline></p>
                                                    <p class="center-align"><label>ID NO:</label> {{ $child->customer->id_no }}</p>
                                                    <p class="center-align"><label>ISSUED BY:</label> {{ $child->customer->id_issuedby }}</p>
                                                    <p class="center-align"><label>VALID UNTIL:</label> {{ $child->customer->valid_until }}</p>
                                                </div>

                                                <div class="col-md-6">
                                                    <p class="center-align" style="width: 100%;border-top: solid 1px #000;">
                                                        FG CEBU GADGET SHOP  (BUYER)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                            <button type="button" class="btn btn-primary go-print"
                                                    data-id="{{ $child->ctrl_number }}">Print
                                            </button>
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

