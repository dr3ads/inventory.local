<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                <a class="btn btn-default pull-left margin-left-20 link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Repawn Transaction" href="{{ url('transactions/repawn/'.$processTree['parent']->id) }}" id="repawn_link" title="Repawn">
                    <i class="fa fa-refresh"></i>Repawn
                </a>
                <a class="btn btn-default pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Claim Item" href="{{ url('transactions/claim/'.$processTree['parent']->id) }}" id="claim_link" title="Claim">
                    <i class="fa fa-mail-forward"></i>Claim
                </a>
                <a class="btn btn-info pull-left link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Renew Transaction" href="{{ url('transactions/renew/'.$processTree['parent']->id) }}" id="renew_link" title="Renew">
                    <i class="fa fa-clone"></i>Renew
                </a>
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
            <div class="col-md-9">
                <div class="transaction-tree">
                    <ul id="trans-list">
                        <li>
                            <div class="row">
                                <div class="col-md-9">
                                    Control Number: <span class="ctrl-number">{{ $processTree['parent']->ctrl_number }}</span> &#183;
                                    <span class="trans-type">{{$pr}}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
 </div>

