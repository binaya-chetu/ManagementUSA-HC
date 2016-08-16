@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Inventory Details</h2>

        <div class="right-wrapper pull-right">
           
            
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
                Patient Inventory Details
            </h2>
        </header>
        <div class="panel-body">
          <div class="row">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
            @endif
           </div>
            <div class="row">
            
                <div class="col-md-6 commentdiv">
                      Patient Name
                </div>
               <div class="col-md-6 commentdiv">
                 Date of Birth
                </div>
                <div class="col-md-6 commentdiv">
                   Amir       
                </div>
               <div class="col-md-6 commentdiv">
                    06/09/1987
                </div>
            </div>
        
        </div>
       
			
					<!-- start: page -->
					<div class="row">
						<div class="col-md-12">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Package Totals</h2>
									
								</header>
								<div class="panel-body">
                                                                    <div class="row show-grid">
										<div class="col-md-2"><span class="show-grid-block">Trimix</span></div>
                                                                                <div class="col-md-2"><span class="show-grid-block">Sublingual</span></div>
                                                                                <div class="col-md-2"><span class="show-grid-block">Office Visit</span></div>
                                                                                <div class="col-md-2"><span class="show-grid-block">Redose</span></div>
                                                                                <div class="col-md-2"><span class="show-grid-block">Antidotes</span></div>
                                                                                <div class="col-md-2"><span class="show-grid-block">Prolyfic Treatment</span></div>
                                                                    </div>

									<hr class="mt-md mb-md">

									

			
								</div>
							</section>
						</div>
					</div>
					<!-- end: page -->
				</section>
   
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection