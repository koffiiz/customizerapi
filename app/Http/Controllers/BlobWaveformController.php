<?php

namespace App\Http\Controllers;

use App\Models\BlobWaveform;
use Illuminate\Http\Request;
use File;

class BlobWaveformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blob_data = $request->get('blob_data');
        $blob_type = $request->get('blob_type');
        $blob_file_ext = $request->get('file_ext');
        $blob_file_raw_ext = $request->get('fileExtention');

        $data = new BlobWaveform;
        $data->blob_data = $blob_data;
        $data->blob_type = $blob_type;
        $data->blob_ext = $blob_file_ext;
        $data->blob_raw_extention = $blob_file_raw_ext;
        $data->save();

        return response()->json([
            'blob_data_id' => $data->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloblWaveform  $bloblWaveform
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteBlobWaveform = BlobWaveform::find($id);
        $deleteBlobWaveform->delete();
        return response()->json([
            'success' => true,
            'message' => 'Blob Succesfully Deleted'
        ]);
    }
}
