@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>All PDF Forms</h2>
        <div class="right-wrapper pull-right">
           {!! Breadcrumbs::render('frontpdfform.pdf_list') !!}
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title">PDF Form List </h2>
                </header>	
                <div class="panel-body">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
                @endif
                @if(Session::has('error_message'))
                    <div class="alert alert-warning"><span class="glyphicon glyphicon-ok"></span><em>{!! session('error_message') !!}</em></div>
                @endif
                    <div class="col-md-12">
                        <li><a target="_blank" href="{{ URL::asset('/consent/HGH_Consent_OKC.html') }}">HGH Consent OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/HGH_Consent_Tulsa.html') }}">HGH Consent Tulsa</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Implied_Consent_Prolific_OKC.html') }}">Implied Consent Prolific OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Implied_Consent_Weight_Loss_OKC.html') }}">Implied Consent Weight Loss OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Implied_Consent_Weight_Loss_Tulsa.html') }}">Implied Consent Weight Loss Tulsa</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/IV_Drip_Implied_Consent_OKC.html') }}">IV Drip Implied Consent OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/IV_Drip_Implied_Consent_Tulsa.html') }}">IV Drip Implied Consent Tulsa</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Patient_Treatment_OKC.html') }}">Patient Treatment OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Patient_Treatment_Tulsa.html') }}">Patient Treatment Tulsa</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Priapus_Consent_OKC.html') }}">Priapus Consent OKC</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Priapus_Consent_Tulsa.html') }}">Priapus Consent Tulsa</a></li>
                        <li><a target="_blank" href="{{ URL::asset('/consent/Prolific_Implied_Consent_Tulsa.html') }}">Prolific Implied Consent Tulsa</a></li>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>    
@endsection