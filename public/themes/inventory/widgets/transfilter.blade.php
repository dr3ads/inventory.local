<div class="container-fluid">
    <div class="transaction-filter">
        <div class="controls">
            {{--<div class="pull-left">
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
            </div>--}}
            <a title="New Transactions" id="new_trans_link" href="{{ url('transactions/create') }}" class="btn btn-new pull-left"><i class="fa fa-plus"></i>
                New Transaction
            </a>
        </div>
        <div class="status-filter">
            <div class="status-filter-wrap">
                <ul class="center-top-menu">
                    <li @if(Input::get('status') == 'default' || Input::get('status') == '') class="active" @endif>
                        <a href="{{ url('transactions?status=default') }}"><span>Active</span> <span class="badge">0</span></a>
                    </li>
                    <li @if(Input::get('status') == 'claimed') class="active" @endif>
                        <a href="{{ url('transactions?status=claimed') }}"><span>Claimed</span> <span class="badge">0</span></a>
                    </li>
                    <li @if(Input::get('status') == 'expired') class="active" @endif>
                        <a href="{{ url('transactions?status=expired') }}"><span>Expired</span> <span class="badge">0</span></a>
                    </li>
                    <li @if(Input::get('status') == 'void') class="active" @endif>
                        <a href="{{ url('transactions?status=void') }}"><span>Void</span> <span class="badge">0</span></a>
                    </li>
                </ul>
            </div>
            <div class="trans-details-filter">
                {!! Form::open(array('method' => 'get')) !!}
                    <div class="issues-other-filters">
                        <div class="filter-item left">
                            <div class="select2-container" id="customer-wrap">
                                {!! Form::select('customers',$customers,Input::old('customers'), array('class' => 'select2','data-placeholder' => 'Customers')) !!}
                            </div>

                        </div>
                        <div class="filter-item left">
                            <div class="select2-container select2 trigger-submit" id="s2id_label_name" title="" style="display: inline-block; width: 150px;"><a tabindex="-1" class="select2-choice select2-default" href="javascript:void(0)">   <span class="select2-chosen" id="select2-chosen-21">Label</span><abbr class="select2-search-choice-close"></abbr>   <span role="presentation" class="select2-arrow"><b role="presentation"></b></span></a><label class="select2-offscreen" for="s2id_autogen21"></label><input type="text" role="button" aria-haspopup="true" class="select2-focusser select2-offscreen" aria-labelledby="select2-chosen-21" id="s2id_autogen21"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label class="select2-offscreen" for="s2id_autogen21_search"></label>       <input type="text" aria-autocomplete="list" aria-expanded="true" role="combobox" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" aria-owns="select2-results-21" id="s2id_autogen21_search" placeholder="">   </div>   <ul role="listbox" class="select2-results" id="select2-results-21">   </ul></div></div><select name="label_name" id="label_name" data-placeholder="Label" class="select2 trigger-submit" title="" style="display: none;" tabindex="-1"><option value=""></option><option value="" selected="selected">Any</option>
                                <option value="No Label">No Label</option>
                                <option value="Layer: Backend">Layer: Backend</option>
                                <option value="Layer: UI/UX">Layer: UI/UX</option>
                                <option value="Priority: Critical">Priority: Critical</option>
                                <option value="Priority: High">Priority: High</option>
                            </select>
                        </div>
                        <div class="pull-right">
                            <div class="dropdown inline prepend-left-10">
                                <button type="button" data-toggle="dropdown" class="dropdown-toggle btn" aria-expanded="false">
                                    <span class="light">sort:</span>
                                    Recently created
                                    <b class="caret"></b>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-align-right">
                                    <li>
                                        <a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=created_desc&amp;state=closed">Recently created
                                        </a><a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=created_asc&amp;state=closed">Oldest created
                                        </a><a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=updated_desc&amp;state=closed">Recently updated
                                        </a><a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=updated_asc&amp;state=closed">Oldest updated
                                        </a><a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=milestone_due_asc&amp;state=closed">Milestone due soon
                                        </a><a href="/bridal-gallery/bridal-gallery/issues?assignee_id=&amp;author_id=&amp;label_name=&amp;milestone_id=&amp;scope=all&amp;sort=milestone_due_desc&amp;state=closed">Milestone due later
                                        </a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                {!! Form::close() !!}

                <div class="issues_bulk_update hide">
                    <form method="post" action="/bridal-gallery/bridal-gallery/issues/bulk_update" accept-charset="UTF-8"><div style="display:none"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="VZ1bvLF0Az8F7160habDqHyGX7qigicm3CD7MabH1F4=" name="authenticity_token"></div>
                        <select name="update[state_event]" id="update_state_event" class="form-control"><option value="">Status</option><option value="reopen">Open</option>
                            <option value="close">Closed</option></select>
                        <div class="select2-container ajax-users-select" id="s2id_update_assignee_id"><a tabindex="-1" class="select2-choice select2-default" href="javascript:void(0)">   <span class="select2-chosen" id="select2-chosen-17">Assignee</span><abbr class="select2-search-choice-close"></abbr>   <span role="presentation" class="select2-arrow"><b role="presentation"></b></span></a><label class="select2-offscreen" for="s2id_autogen17"></label><input type="text" role="button" aria-haspopup="true" class="select2-focusser select2-offscreen" aria-labelledby="select2-chosen-17" id="s2id_autogen17"><div class="select2-drop select2-display-none ajax-users-dropdown select2-with-searchbox">   <div class="select2-search">       <label class="select2-offscreen" for="s2id_autogen17_search"></label>       <input type="text" aria-autocomplete="list" aria-expanded="true" role="combobox" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" aria-owns="select2-results-17" id="s2id_autogen17_search" placeholder="">   </div>   <ul role="listbox" class="select2-results" id="select2-results-17">   </ul></div></div><input type="hidden" value="" name="update[assignee_id]" id="update_assignee_id" data-project-id="1" data-placeholder="Assignee" data-null-user="true" data-first-user="arnelb.nst" data-email-user="false" data-current-user="true" data-any-user="false" class="ajax-users-select " tabindex="-1" title="" style="display: none;">
                        <div class="select2-container" id="s2id_update_milestone_id" style="width: 150px;"><a tabindex="-1" class="select2-choice" href="javascript:void(0)">   <span class="select2-chosen" id="select2-chosen-18">Milestone</span><abbr class="select2-search-choice-close"></abbr>   <span role="presentation" class="select2-arrow"><b role="presentation"></b></span></a><label class="select2-offscreen" for="s2id_autogen18"></label><input type="text" role="button" aria-haspopup="true" class="select2-focusser select2-offscreen" aria-labelledby="select2-chosen-18" id="s2id_autogen18"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label class="select2-offscreen" for="s2id_autogen18_search"></label>       <input type="text" aria-autocomplete="list" aria-expanded="true" role="combobox" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" aria-owns="select2-results-18" id="s2id_autogen18_search" placeholder="">   </div>   <ul role="listbox" class="select2-results" id="select2-results-18">   </ul></div></div><select name="update[milestone_id]" id="update_milestone_id" tabindex="-1" title="" style="display: none;"><option value="">Milestone</option><option value="-1">None (backlog)</option><option value="3">Sprint 5</option>
                            <option value="2">Sprint 4</option>
                            <option value="1">Sprint 3</option></select>
                        <input type="hidden" value="" name="update[issues_ids]" id="update_issues_ids">
                        <input type="hidden" name="state_event" id="state_event">
                        <button type="submit" name="button" class="btn update_selected_issues btn-save">Update issues</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>