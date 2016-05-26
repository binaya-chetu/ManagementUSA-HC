@if($id == 'allergies1')
<header class="panel-heading">
    <h2 class="panel-title">Allergic Medications</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medications I am Allergic To</th>                
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
                  
@elseif($id == 'illness1')
<header class="panel-heading">
    <h2 class="panel-title">Other Illness List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type Of Illness</th>                
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif($id == 'medication1')
<header class="panel-heading">
    <h2 class="panel-title">Medication List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name Of Medication</th>     
                        <th>Dosage in MG</th>  
                        <th>How often</th>  
                        <th>Condition Taken For</th>  
                     
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif($id == 'surgeries1')
<header class="panel-heading">
    <h2 class="panel-title">Major Surgery List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type Of Surgery</th>     
                        <th>Date</th>  
                        <th>Reason</th>                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif($id == 'vitamin_taken1')
<header class="panel-heading">
    <h2 class="panel-title">Vitamin Medication List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name Of Vitamin Supplement</th>     
                        <th>Dosage in MG</th>  
                        <th>How Often</th>            
                        <th>Condition Taken For</th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default closePop">Cancel</button>
        </div>
    </div>
</footer>  