<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UploadFotoController extends Controller
{
    public function uploadFoto($foto, $model, $id, $root, $filename) {
        $client = new Client();
        $url = \config('apiurl.url');
        $response = $client->request('POST', $url.'/api/collager/login', [
            'form_params' => [
                'email' => 'user@dev.com',
                'password' => 'devpass',
            ]
        ]);
        $responseLogin = $response->getBody()->getContents();
        $decode_response_login = json_decode($responseLogin);
        $token = $decode_response_login->user->token;
        $clientUploadFoto = new Client();
        $uploadFoto = $clientUploadFoto->request('POST', $url.'/api/collager/upload-foto', [
          'headers' => [
              'Accept'        => 'application/json',
              'Authorization' => 'Bearer '.$token.''
          ],
          'form_params' => [
            'foto' => $foto,
            'model_name' => $model,
            'id' => $id,
            'root' => $root,
            'filename' => $filename,
          ]
        ]);
        $responseUpload = $uploadFoto->getBody()->getContents();
        // $decode_response_upload = json_decode($responseUpload);
        
        return response($responseUpload);
    }

}
