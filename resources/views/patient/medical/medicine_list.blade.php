@if($id == 'allergies1')
<header class="panel-heading">
    <h2 class="panel-title">Allergic Medications</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none" id="allergiesList">
                <thead>
                    <tr>
                        <th>Medications I am Allergic To</th>
						<th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				@if($data && !empty($data))
					@foreach($data as $i => $row)
					<tr data-count="{{ $i }}">
						<td class="allergic_medicine">{{ Form::text('medicine_'.$i, $row->allergic_medicine, ['class' => 'form-control allergiesInput input-sm', 'id' => 'medicine_'.$i, 'placeholder' => 'Allergic medicine']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					@endforeach
				@else				
					<tr data-count="1">
						<td class="allergic_medicine">{{ Form::text('medicine_1', null, ['class' => 'form-control allergiesInput input-sm', 'id' => 'medicine_1', 'placeholder' => 'Allergic medicine']) }}</td>						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="2">
						<td class="allergic_medicine">{{ Form::text('medicine_2', null, ['class' => 'form-control allergiesInput input-sm', 'id' => 'medicine_2', 'placeholder' => 'Allergic medicine']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					<tr data-count="3">
						<td class="allergic_medicine">{{ Form::text('medicine_3', null, ['class' => 'form-control allergiesInput input-sm', 'id' => 'medicine_3', 'placeholder' => 'Allergic medicine']) }}</td>						
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
				@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveAllergiesList">Save</button>
        </div>
    </div>
</footer>                    
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
                        <th>Type Of Illness</th>
                        <th>Delete</th>						
                    </tr>
                </thead>
                <tbody>
				@if($data && !empty($data))
					@foreach($data as $i => $row)
					<tr data-count="{{ $i }}">
						<td class="illness">{{ Form::text('illness_'.$i, $row->illness, ['class' => 'form-control illnessInput input-sm', 'id' => 'illness_'.$i, 'placeholder' => 'Illness Name']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					@endforeach
				@else
					<tr data-count="1">
						<td class="illness">{{ Form::text('illness_1', null, ['class' => 'form-control illnessInput input-sm', 'id' => 'illness_1', 'placeholder' => 'Illness Name']) }}</td>						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>					
					<tr data-count="2">
						<td class="illness">{{ Form::text('illness_2', null, ['class' => 'form-control illnessInput input-sm', 'id' => 'illness_2', 'placeholder' => 'Illness Name']) }}</td>						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="3">
						<td class="illness">{{ Form::text('illness_3', null, ['class' => 'form-control illnessInput input-sm', 'id' => 'illness_3', 'placeholder' => 'Illness Name']) }}</td>						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
				@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveIllnessList">Save</button>
        </div>
    </div>
</footer>  
@elseif($id == 'medication1')
<header class="panel-heading">
    <h2 class="panel-title">Medication List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none" id="medicationList">
                <thead>
                    <tr>
                        <th>Name Of Medication</th>     
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
						<td class="name">{{ Form::text('name_'.$i, $row->name, ['class' => 'form-control medicationInput input-sm', 'id' => 'name_'.$i, 'placeholder' => 'Medication Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_'.$i, $row->dosage, ['class' => 'form-control medicationInput input-sm', 'id' => 'dosage_'.$i, 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_'.$i, $row->how_often, ['class' => 'form-control medicationInput input-sm', 'id' => 'how_often_'.$i, 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_'.$i, $row->taken_for, ['class' => 'form-control medicationInput input-sm', 'id' => 'condition_'.$i, 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					@endforeach
				@else
					<tr data-count="1">
						<td class="name">{{ Form::text('name_1', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'name_1', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_1', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'dosage_1', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_1', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'how_often_1', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_1', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'condition_1', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="2">
						<td class="name">{{ Form::text('name_2', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'name_2', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_2', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'dosage_2', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_1', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'how_often_1', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_2', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'condition_2', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
					<tr data-count="3">
						<td class="name">{{ Form::text('name_3', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'name_3', 'placeholder' => 'Suppliment Name']) }}</td>
						<td class="dosage">{{ Form::text('dosage_3', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'dosage_3', 'placeholder' => 'Dosage(in mg)']) }}</td>
						<td class="how_often">{{ Form::text('how_often_3', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'how_often_3', 'placeholder' => 'How Often']) }}</td>
						<td class="condition">{{ Form::text('condition_3', null, ['class' => 'form-control medicationInput input-sm', 'id' => 'condition_3', 'placeholder' => 'Condition taking for']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>
				@endif	
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveMedicationList">Save</button>
        </div>
    </div>
</footer>  
@elseif($id == 'surgeries1')
<header class="panel-heading">
    <h2 class="panel-title">Major Surgery List</h2>
</header>
<div class="panel-body">
    <div class="table-responsive" >
        <div class="table-responsive">
            <table class="table table-bordered mb-none" id="surgeryList">
                <thead>
                    <tr>
                        <th>Type Of Surgery</th>     
                        <th>Date</th>  
                        <th>Reason</th>
						<th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				@if($data && !empty($data))
					@foreach($data as $i => $row)
					<tr data-count="{{ $i }}">
						<td class="type_of_surgery">{{ Form::text('type_'.$i, $row->type_of_surgery, ['class' => 'form-control surgeryInput input-sm', 'id' => 'type_'.$i, 'placeholder' => 'Type of surgery']) }}</td>
						<td class="surgery_date">{{ Form::date('date_'.$i, $row->date, ['class' => 'form-control surgeryInput input-sm', 'id' => 'date_'.$i, 'placeholder' => 'Date']) }}</td>
						<td class="surgery_reason">{{ Form::text('reason_'.$i, $row->reason, ['class' => 'form-control surgeryInput input-sm', 'id' => 'reason_'.$i, 'placeholder' => 'Reason']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					@endforeach
				@else				
					<tr data-count="1">
						<td class="type_of_surgery">{{ Form::text('type_1', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'type_1', 'placeholder' => 'Type of surgery']) }}</td>
						<td class="surgery_date">{{ Form::date('date_1', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'date_1', 'placeholder' => 'Date']) }}</td>
						<td class="surgery_reason">{{ Form::text('reason_1', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'reason_1', 'placeholder' => 'Reason']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					<tr data-count="2">
						<td class="type_of_surgery">{{ Form::text('type_2', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'type_2', 'placeholder' => 'Type of surgery']) }}</td>
						<td class="surgery_date">{{ Form::date('date_2', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'date_2', 'placeholder' => 'Date']) }}</td>
						<td class="surgery_reason">{{ Form::text('reason_2', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'reason_2', 'placeholder' => 'Reason']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
					<tr data-count="3">
						<td class="type_of_surgery">{{ Form::text('type_3', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'type_3', 'placeholder' => 'Type of surgery']) }}</td>
						<td class="surgery_date">{{ Form::date('date_3', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'date_3', 'placeholder' => 'Date']) }}</td>
						<td class="surgery_reason">{{ Form::text('reason_3', null, ['class' => 'form-control surgeryInput input-sm', 'id' => 'reason_3', 'placeholder' => 'Reason']) }}</td>
						<td><a class="deleteVitListRow" href="#"><i class="fa fa-times"></i></a></td>
					</tr>	
				@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveSurgeryList">Save</button>
        </div>
    </div>
</footer>  
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
<footer class="panel-footer">
    <div class="row">
        <div class="col-md-12 text-right">                        
            <button class="btn btn-default addMedicineListRow">Add Row</button>
            <button class="btn btn-default closePop saveMedicineList">Save</button>
        </div>
    </div>
</footer>  
@endif
