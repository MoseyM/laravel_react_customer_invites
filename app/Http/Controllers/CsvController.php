<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel;

class CsvController extends BaseController
{
    /**
     * Handles the parsing of csv files.
     * 
     * @return array
     */
    public function upload(Request $request)
    {
        $request->validate([
            'data-file' => 'required|file|mimes:csv,txt',
        ]);

        $parsed = $this->parseCsv($request->file('data-file')->path());

        return view('results', ['data' => $parsed]);
    }

    /**
     * Adds attributes to array based on existing values.
     * 
     * @param  string $name
     * @return array
     */
    protected function parseCsv(string $name)
    {
        $headings = null;
        $dataArr = [];
        //open the file
        if (($handle = fopen($name, 'r')) != false) {
            //read each line but the first row will be the headings
            while(($row = fgetcsv($handle, 1500, ',')) != false) {
                if (is_null($headings)) {
                    $headings = $row;
                } else {
                    $dataArr[] = array_combine($headings, $row);
                    $unedited = end($dataArr);
                    //add the extra attributes for invitations
                    $unedited['invite_sent'] = false;
                    $unedited['invite_channel'] = (!empty($unedited['cust_phone'])) 
                        ? "Phone" : "Email";
                    $unedited['invite_type'] = $unedited['trans_type'];
                    $dataArr[count($dataArr)-1] = $unedited;
                }
            }
        }
        
        return json_encode($dataArr);
    }
}
