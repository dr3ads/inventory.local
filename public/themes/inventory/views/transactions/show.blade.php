<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                <a class="btn btn-warning pull-left margin-left-20" href="{{ url('transactions/repawn/'.$process->id) }}" id="repawn_link" title="Repawn">
                    <i class="fa fa-plus"></i>Repawn
                </a>
                <a class="btn btn-success pull-left" href="{{ url('transactions/claim/'.$process->id) }}" id="claim_link" title="Claim">
                    <i class="fa fa-plus"></i>Claim
                </a>
                <a class="btn btn-info pull-left" href="{{ url('transactions/renew/'.$process->id) }}" id="renew_link" title="Renew">
                    <i class="fa fa-plus"></i>Renew
                </a>
            </div>
            <div class="status-filter">
                <div class="status-filter-wrap">
                    <ul class="center-top-menu">
                        <li class="active">
                            <a href="http://inventory.dev/transactions?status=default"><span>Active</span> <span class="badge">9</span></a>
                        </li>
                        <li>
                            <a href="http://inventory.dev/transactions?status=claimed"><span>Claimed</span> <span class="badge">6</span></a>
                        </li>
                        <li>
                            <a href="http://inventory.dev/transactions?status=expired"><span>Expired</span> <span class="badge">0</span></a>
                        </li>
                        <li>
                            <a href="http://inventory.dev/transactions?status=void"><span>Void</span> <span class="badge">7</span></a>
                        </li>
                        <li>
                            <a href="http://inventory.dev/transactions?status=hold"><span>Hold</span> <span class="badge">0</span></a>
                        </li>
                    </ul>
                </div>
                <div class="trans-details-filter">
                    <form accept-charset="UTF-8" action="http://inventory.dev/transactions" method="GET">
                        <input type="hidden" name="status">
                        <div class="issues-other-filters row">
                            <div class="filter-item left col-md-2">
                                <div id="customer-wrap" class="select2-container">
                                    <select name="customers" data-placeholder="Customers" class="select2" style="display: none;"><option value="" selected="selected"> </option><option value="1">Margot Gussie</option><option value="2">Ursula Shawna</option><option value="3">Margaretta Nyasia</option><option value="4">Reina Margaret</option><option value="5">Lavina Marian</option><option value="6">Josue Marie</option><option value="7">Ervin Bertrand</option><option value="8">Rebeka Lola</option><option value="9">Orlando Chadd</option><option value="10">Maureen Rusty</option><option value="11">Rasheed Paula</option><option value="12">Tanner Angie</option><option value="13">Aurelie Paris</option><option value="14">Wilford Vilma</option><option value="15">Kiana Gustave</option><option value="16">Eusebio Cayla</option><option value="17">Merl Santino</option><option value="18">Meda Rodrick</option><option value="19">Webster Lilian</option><option value="20">Samara Dixie</option><option value="21">Rose Devonte</option><option value="22">Tony Scottie</option><option value="23">Thurman Novella</option><option value="24">Audra Alexanne</option><option value="25">Kyler Isaias</option><option value="26">Lia Nat</option><option value="27">Augustus Stephen</option><option value="28">Murphy Francesca</option><option value="29">Ida Miracle</option><option value="30">Hollis Andre</option><option value="31">Ariane Aiyana</option><option value="32">Camryn Mavis</option><option value="33">Angeline Walton</option><option value="34">Wanda Madisen</option><option value="35">Cordelia Lenora</option><option value="36">Raoul Seamus</option><option value="37">Reggie Beth</option><option value="38">Rozella Renee</option><option value="39">Cortney Sarah</option><option value="40">Johnpaul Armando</option><option value="41">Humberto Destany</option><option value="42">Kiarra Candace</option><option value="43">Suzanne Candace</option><option value="44">Reid Kian</option><option value="45">Brielle Dakota</option><option value="46">Khalil Augusta</option><option value="47">Bartholome Brionna</option><option value="48">Garnet Ahmad</option><option value="49">Nadia Ozella</option><option value="50">Rey Conner</option><option value="51">Mertie Gisselle</option><option value="52">Georgiana Yvette</option><option value="53">Benton Hollie</option><option value="54">Reid Lillie</option><option value="55">Bobby Sydnee</option><option value="56">Spencer Constantin</option><option value="57">Kyle Berneice</option><option value="58">Golda Reed</option><option value="59">Kristian Viva</option><option value="60">Taryn Joanny</option><option value="61">Sigrid Rebekah</option><option value="62">Aron Florine</option><option value="63">Lolita Murphy</option><option value="64">Leatha Martina</option><option value="65">Hailee Modesto</option><option value="66">Myron Rylee</option><option value="67">Cameron Lonnie</option><option value="68">Jordyn Zechariah</option><option value="69">Antonio Elliott</option><option value="70">Audra Aron</option><option value="71">Ricky Doug</option><option value="72">Weldon Jordane</option><option value="73">Ruth Ramona</option><option value="74">Rex Thora</option><option value="75">Peggie Dahlia</option><option value="76">Lonzo Phyllis</option><option value="77">Pearl Luis</option><option value="78">Glennie Jamil</option><option value="79">Israel Cecilia</option><option value="80">Green Domenic</option><option value="81">Lorine Wilfrid</option><option value="82">Max Joy</option><option value="83">Annamarie Lessie</option><option value="84">Mozelle Ignacio</option><option value="85">Leora Elise</option><option value="86">Nadia Jessy</option><option value="87">Jessie Libby</option><option value="88">Kayleigh Abigale</option><option value="89">Damaris Anderson</option><option value="90">Guadalupe Chet</option><option value="91">Crystel Esta</option><option value="92">Ellie Sabina</option><option value="93">Lue Amiya</option><option value="94">Fae Brionna</option><option value="95">Sean Johnathan</option><option value="96">Ibrahim Marvin</option><option value="97">Hildegard Damon</option><option value="98">Ciara Maddison</option><option value="99">Olaf Jeramie</option><option value="100">Tito Rachael</option><option value="101">Tara Alan</option></select><div class="chosen-container chosen-container-single" style="width: auto;" title=""><a tabindex="-1" class="chosen-single chosen-default"><span>Customers</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                </div>

                            </div>

                            <div class="pull-right col-md-1">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <div class="row">
    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('', 'Transaction Details') !!}
            {{ $process->ctrl_number  }}
        </div>

        <div class="form-group">
            {!! Form::label('', 'Customer') !!}
            {{ $process->customer->full_name  }}
        </div>
        <div class="form-group">
            {!! Form::label('', 'Pawn Date') !!}
            {{ date('M d, Y', strtotime($process->pawned_at)) }}
        </div>

        <div class="form-group">
            {!! Form::label('', 'Expiry Date') !!}
            {{ date('M d, Y', strtotime($process->expired_at)) }}
        </div>

    </div>

</div>


