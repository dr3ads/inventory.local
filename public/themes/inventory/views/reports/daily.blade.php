<div class="content-wrapper">
    <section class="container-fluid">
        {{--{!! Theme::widget('reportfilter')->render() !!}--}}
        <h3>{{ date('l, F d, Y')  }}</h3>
        <hr />
        <section class="quick-stat">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-pie-graph"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Beginning Capital</span>
                            <span class="info-box-number">{{ $yesterday['total'] }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-stats-bars"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pawns</span>
                            <span class="info-box-number">{{ count($pawns) }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-briefcase"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Vault Items</span>
                            <span class="info-box-number">{{ $active_items->total() }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Display Items</span>
                            <span class="info-box-number">{{ count($display_items) }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

            </div>
        </section>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pawns</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin table-striped">
                                <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($pawns as $pawn)
                                        <tr>
                                            <td>{{ $pawn->ctrl_number }}</td>
                                            <td>{{ $pawn->item->name }}</td>
                                            <td>{{ $pawn->pawn_amount }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_pawn }}</strong></div>
                    </div><!-- /.box-footer -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Claim</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin table-striped">
                                <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($claims as $claim)
                                    <tr>
                                        <td>{{ $claim->ctrl_number }}</td>
                                        <td>{{ $claim->item->name }}</td>
                                        <td>{{ $claim->pawn_amount }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_claim }}</strong></div>
                    </div><!-- /.box-footer -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sold Accessories</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin table-striped">
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
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $sum_sold_accessories }}</strong></div>
                    </div><!-- /.box-footer -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchased Units</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin table-striped">
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
                                            <td>{{ $bought_unit->acquire_price }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_bought_units }}</strong></div>
                    </div><!-- /.box-footer -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sold Units</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin table-striped">
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
                                            <td>{{ $sold_unit->acquire_price }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_sold_units }}</strong></div>
                    </div><!-- /.box-footer -->
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cashed Out</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
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
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_cash_outs }}</strong></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cashed In</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
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
                    <div class="box-footer clearfix">
                        <div class="pull-right">TOTAL: <strong>P{{ $total_cash_ins }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>