<?php
use Input;
use App\Item;
use DB;
use Excel;
class WebLeadsController extends Controller
{
	public function webLeads()
	{
		return view('apptsetting.web_lead');
	}
	public function downloadExcel($type)
	{
		$data = Item::get()->toArray();
		return Excel::create('web_lead_report', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = ['Sr. No.' => $value->id,'Name' => $value->first_name.''.$value->last_name,'description' => $value->description,'description' => $value->description, 'description' => $value->description];
				}
				if(!empty($insert)){
					DB::table('items')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}
}