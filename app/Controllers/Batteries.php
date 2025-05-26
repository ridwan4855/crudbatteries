<?php namespace App\Controllers;

use App\Models\BatteryModel;
use App\Models\BatteryTypeModel;
use CodeIgniter\API\ResponseTrait;

class Batteries extends BaseController
{
    use ResponseTrait;
    protected $model;
    protected $response;

    public function __construct()
    {
        $this->model = new BatteryModel();
        $this->response = \Config\Services::response();
        helper('form');
    
        // Add this for AJAX endpoints
        // if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        //     $this->request->setHeader('Content-Type', 'application/json');
        // }
        
        // // Disable CSRF protection for AJAX calls
        // \Config\Services::session()->disableHooks();

        // Add CSRF token to AJAX requests
        $this->response->setHeader('X-CSRF-TOKEN', csrf_token());
    }

    // For AJAX DataTable
    public function datatable()
    {
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $search = $this->request->getPost('search')['value'];

        $query = $this->model->dtQuery($search, $start, $length);
        $data = [
            "draw" => $draw,
            "recordsTotal" => $this->model->countAll(),
            "recordsFiltered" => $search ? $this->model->countAllResults() : $this->model->countAll(),
            "data" => $query
        ];

        // return $this->respond($data);
        return $this->response->setJSON($data);
    }

    public function index()
    {
        // Get all data at once
        $model = new BatteryModel();
        $data['batteries'] = $model->select('batteries.*, battery_types.type_name as type')
                                ->join('battery_types', 'battery_types.id = batteries.type')
                                ->findAll();
                                
        return view('batteries/index', $data);
    }

    public function create()
    {
        $typeModel = new BatteryTypeModel();
        return view('batteries/form', [
            'types' => $typeModel->findAll(),
            'battery' => null // Ensures form starts empty
        ]);
    }

    public function store()
    {
       // VALIDATION STARTS HERE
        $rules = [
            'name' => 'required|min_length[3]',
            'type' => 'required|integer',
            'voltage' => 'required|decimal',
            'capacity' => 'required|integer',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // VALIDATION ENDS HERE

        $this->model->save($this->request->getPost());
        return redirect()->to('/batteries')->with('success', 'Battery added successfully');
    }

    public function edit($id)
    {
        $typeModel = new BatteryTypeModel();
        $battery = $this->model->find($id);
        
        return view('batteries/form', [
            'types' => $typeModel->findAll(),
            'battery' => $battery
        ]);
    }

    public function update($id)
    {
        // VALIDATION STARTS HERE
        $rules = [
            'name' => 'required|min_length[3]',
            'type' => 'required|integer',
            'voltage' => 'required|decimal',
            'capacity' => 'required|integer',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // VALIDATION ENDS HERE
        
        // Similar validation to store()
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/batteries')->with('success', 'Battery updated successfully');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/batteries')->with('success', 'Battery deleted successfully');
    }
}