<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $customers = $customerModel->findAll();

        $data['customers'] = array_map(function ($customer) {
            return [
                'id'    => $customer['id'],
                'name'  => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'type'  => $customer['type'] ?? 'Regular',
            ];
        }, $customers);

        return view('customers/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('customers/create');
    }

    public function create()
    {
        helper(['form']);
        
        $rules = [
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'type'  => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('customers/create', [
                'validation' => $this->validator
            ]);
        }

        $customerModel = new CustomerModel();
        $customerModel->save([
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'type'  => $this->request->getPost('type'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer added successfully.');
    }

    public function edit($id)
    {
        helper(['form']);
        $customerModel = new CustomerModel();
        $data['customer'] = $customerModel->find($id);

        if (!$data['customer']) {
            return redirect()->to('/customers');
        }

        return view('customers/edit', $data);
    }

    public function update($id)
    {
        helper(['form']);
        $customerModel = new CustomerModel();

        $rules = [
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'type'  => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('customers/edit', [
                'customer'   => $customerModel->find($id),
                'validation' => $this->validator
            ]);
        }

        $customerModel->update($id, [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'type'  => $this->request->getPost('type'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated successfully.');
    }
}