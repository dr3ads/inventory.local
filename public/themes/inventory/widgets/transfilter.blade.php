<div class="transaction-filter">
        <div class="controls">
            <div class="pull-left">
                <form method="get" id="issue_search_form" class="pull-left issue-search-form" action="/bridal-gallery/bridal-gallery/issues" accept-charset="UTF-8"><div style="display:none"><input type="hidden" value="✓" name="utf8"></div>
                    <div class="append-right-10 hidden-xs hidden-sm">
                        <input type="search" spellcheck="false" placeholder="Filter by title or description" name="issue_search" id="issue_search" class="form-control issue_search search-text-input">
                        <input type="hidden" value="closed" name="state" id="state">
                        <input type="hidden" value="all" name="scope" id="scope">
                        <input type="hidden" value="" name="assignee_id" id="assignee_id">
                        <input type="hidden" value="" name="author_id" id="author_id">
                        <input type="hidden" value="" name="milestone_id" id="milestone_id">
                        <input type="hidden" name="label_id" id="label_id">
                    </div>
                </form>
            </div>
            <a title="New Transactions" id="new_trans_link" href="{{ url('transactions/create') }}" class="btn btn-new pull-left"><i class="fa fa-plus"></i>
                New Transaction
            </a>
        </div>
        <div class="status-filter">
            <div class="status-filter-wrap">
                <ul class="center-top-menu">
                    <li @if(Input::get('status') == 'default' || Input::get('status') == '') class="active" @endif>
                        <a href="{{ url('transactions?status=default') }}"><span>Active</span> <span class="badge">{!! $transactionsStatusCount['active'] !!}</span></a>
                    </li>
                    <li @if(Input::get('status') == 'claimed') class="active" @endif>
                        <a href="{{ url('transactions?status=claimed') }}"><span>Claimed</span> <span class="badge">{!! $transactionsStatusCount['claimed'] !!}</span></a>
                    </li>
                    <li @if(Input::get('status') == 'expired') class="active" @endif>
                        <a href="{{ url('transactions?status=expired') }}"><span>Expired</span> <span class="badge">{!! $transactionsStatusCount['expired'] !!}</span></a>
                    </li>
                    <li @if(Input::get('status') == 'void') class="active" @endif>
                        <a href="{{ url('transactions?status=void') }}"><span>Void</span> <span class="badge">{!! $transactionsStatusCount['void'] !!}</span></a>
                    </li>
                    <li @if(Input::get('status') == 'hold') class="active" @endif>
                        <a href="{{ url('transactions?status=hold') }}"><span>Hold</span> <span class="badge">{!! $transactionsStatusCount['hold'] !!}</span></a>
                    </li>
                </ul>
            </div>
            <div class="trans-details-filter">
                {!! Form::open(array('method' => 'get')) !!}
                    {!! Form::hidden('status', (Input::get('status'))) !!}
                    <div class="issues-other-filters row">
                        <div class="filter-item left col-md-2">
                            <div class="select2-container" id="customer-wrap">
                                {!! Form::select('customers',$customers,Input::get('customers'), array('class' => 'select2','placeholder' => ' ','data-placeholder' => 'Customers')) !!}
                            </div>

                        </div>
                        <!-- <div class="filter-item left">
                            <div class="select2-container select2 trigger-submit" id="s2id_label_name" title="" style="display: inline-block; width: 150px;"><a tabindex="-1" class="select2-choice select2-default" href="javascript:void(0)">   <span class="select2-chosen" id="select2-chosen-21">Label</span><abbr class="select2-search-choice-close"></abbr>   <span role="presentation" class="select2-arrow"><b role="presentation"></b></span></a><label class="select2-offscreen" for="s2id_autogen21"></label><input type="text" role="button" aria-haspopup="true" class="select2-focusser select2-offscreen" aria-labelledby="select2-chosen-21" id="s2id_autogen21"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label class="select2-offscreen" for="s2id_autogen21_search"></label>       <input type="text" aria-autocomplete="list" aria-expanded="true" role="combobox" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" aria-owns="select2-results-21" id="s2id_autogen21_search" placeholder="">   </div>   <ul role="listbox" class="select2-results" id="select2-results-21">   </ul></div></div><select name="label_name" id="label_name" data-placeholder="Label" class="select2 trigger-submit" title="" style="display: none;" tabindex="-1"><option value=""></option><option value="" selected="selected">Any</option>
                                <option value="No Label">No Label</option>
                                <option value="Layer: Backend">Layer: Backend</option>
                                <option value="Layer: UI/UX">Layer: UI/UX</option>
                                <option value="Priority: Critical">Priority: Critical</option>
                                <option value="Priority: High">Priority: High</option>
                            </select>
                        </div>-->
                        <div class="pull-right col-md-1">
                            {!! Form::submit('Filter',array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
