@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2> All Product Categories </h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Categories</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
           <?php echo "<pre>"; print_r($category); echo '</pre>';
           echo "<pre>"; print_r($details); die;
       
                foreach($details AS $key){
                  
                  foreach($key AS $value)
                  {
                      print_r($value);
                  
                  }
                   
                }
                ?>
           
        </div>
            </div>
        </section>    
@endsection