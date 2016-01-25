<div class="content-wrapper">
    <div class="container-fluid">
        {{--{!! Theme::widget('reportfilter')->render() !!}--}}
        <h3>{{ date('l, F d, Y')  }}</h3>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Beg. Capital</td>
                                <td>P{{ $yesterday['total'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sold Units</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Model</td>
                                    <td>Serial Number</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($sold_units)
                                    @foreach($sold_units as $sold_unit)
                                        <tr>
                                            <td>{{ $sold_unit->brand }}</td>
                                            <td>{{ $sold_unit->serial }}</td>
                                            <td>{{ $sold_unit->selling_value }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sold Accessories</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Quantity</td>
                                <td>Item Description</td>
                                <td>Price</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($sold_accessories)
                                @foreach($sold_accessories as $sold_accessory)
                                    <tr>
                                        <td>{{ $sold_accessory->quantity }}</td>
                                        <td>{{ $sold_accessory->accessory->description }}</td>
                                        <td>P {{ number_format($sold_accessory->amount / $sold_accessory->quantity, 2) }}</td>
                                        <td>P {{ $sold_accessory->amount }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Purchased Units</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Model</td>
                                <td>Serial Number</td>
                                <td>Amount</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bought_units)
                                @foreach($bought_units as $bought_unit)
                                    <tr>
                                        <td>{{ $bought_unit->brand }}</td>
                                        <td>{{ $bought_unit->serial }}</td>
                                        <td>{{ $bought_unit->value }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row">
            <div class="col-md-12">
                <div class="panel-heading">
                    <h3 class="panel-title">Claims</h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Quantity</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bought_units)
                                @foreach($bought_units as $bought_unit)
                                    <tr>
                                        <td>{{ $bought_unit->brand }}</td>
                                        <td>{{ $bought_unit->serial }}</td>
                                        <td>{{ $bought_unit->value }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cashed Out</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Description</td>
                                <td>Type</td>
                                <td>Amount</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cash_outs)
                                @foreach($cash_outs as $cash_out)
                                    <tr>
                                        <td>{{ $cash_out->description }}</td>
                                        <td>{{ $cash_out->type }}</td>
                                        <td>{{ $cash_out->amount }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cashed In</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Description</td>
                                <td>Type</td>
                                <td>Amount</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cash_ins)
                                @foreach($cash_ins as $cash_in)
                                    <tr>
                                        <td>{{ $cash_in->description }}</td>
                                        <td>{{ $cash_in->type }}</td>
                                        <td>{{ $cash_in->amount }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="daily-report-holder row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Item Claims</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>Brand</td>
                                <td>Model/Serial</td>
                                <td>Principal</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($claims)
                                @foreach($claims as $claim)
                                    <tr>
                                        <td>{{ $claim->item->brand }}</td>
                                        <td>{{ $claim->item->serial }}</td>
                                        <td>{{ $claim->pawn_amount }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="daily-report-holder row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Item Pawns</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>Brand</td>
                                <td>Model/Serial</td>
                                <td>Principal</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($pawns)
                                @foreach($pawns as $pawn)
                                    <tr>
                                        <td>{{ $pawn->item->brand }}</td>
                                        <td>{{ $pawn->item->serial }}</td>
                                        <td>{{ $claim->pawn_amount }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>