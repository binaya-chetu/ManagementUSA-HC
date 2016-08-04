@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Petty Cash Logs</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('accounting.listCashLogs') !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">
            Petty Cash Log Lists
            </h2>
        </header>
        <div class="panel-body">
          <div class="row">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
            @endif
           </div>
            
            <table class="table table-bordered table-striped mb-none" id="pettyCashLogs" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Date</th>
                        <th>Agent</th>
                        <th>Detail</th>
                        <th>Cash In</th>
                        <th>Cash Out</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align:right">Total Cash Left:</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    {{--*/ $i = 0 /*--}}
                    {{--*/ $cashLeft = 0 /*--}}
                    @foreach ($cashLogs as $cashLog)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td>{{ date('F j, Y', strtotime($cashLog->date)) }}</td>
                        <td>{{ $cashLog->agent->first_name }} {{ $cashLog->agent->last_name }}</td>
                        <td>{{ $cashLog->details }}</td>
                        <td>@if($cashLog->cash_in != '0.00') ${{ $cashLog->cash_in }} {{--*/ $cashLeft = $cashLeft + $cashLog->cash_in /*--}} @endif</td>
                        <td>@if($cashLog->cash_out != '0.00') ${{ $cashLog->cash_out }} {{--*/ $cashLeft = $cashLeft - $cashLog->cash_out /*--}} @endif</td>
                        <td>${{ $cashLeft }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection