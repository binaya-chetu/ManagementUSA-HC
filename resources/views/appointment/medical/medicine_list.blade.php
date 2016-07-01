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
            <table class="table table-bordered mb-none" id="vitaminMedList">
                <thead>
                    <tr>
                        <th>Name Of Vitamin Supplement</th>     
                        <th>Dosage in MG</th>  
                        <th>How Often</th>            
                        <th>Condition Taken For</th>
						<th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				@if($data && !empty($data))
					@foreach($data as $i => $row)
					<tr data-count="{{ $i }}">
						<td class="name">{{ Form::text('name_'.$i, $row->name, ['class' => 'form-control vitSupInput input-sm', 'id' => 'name_'.$i, 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_'.$i, $row->dosage, ['class' => 'form-control vitSupInput input-sm', 'id' => 'dosage_'.$i, 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_'.$i, $row->how_often, ['class' => 'form-control vitSupInput input-sm', 'id' => 'how_often_'.$i, 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_'.$i, $row->taken_for, ['class' => 'form-control vitSupInput input-sm', 'id' => 'condition_'.$i, 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					@endforeach
				@else
					<tr data-count="1">
						<td class="name">{{ Form::text('name_1', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'name_1', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_1', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'dosage_1', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_1', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'how_often_1', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_1', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'condition_1', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="2">
						<td class="name">{{ Form::text('name_2', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'name_2', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_2', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'dosage_2', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_1', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'how_often_1', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_2', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'condition_2', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="3">
						<td class="name">{{ Form::text('name_3', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'name_3', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_3', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'dosage_3', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_3', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'how_often_3', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_3', null, ['class' => 'form-control vitSupInput input-sm', 'id' => 'condition_3', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
				@endif	
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveMedicineList">Save</button>
        </div>
    </div>
</footer>  