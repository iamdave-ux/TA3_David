<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('users/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('users/create');
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'username'  => 'required|is_unique[users.username]|min_length[3]',
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return view('users/create', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();
        $userModel->save([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        helper(['form']);
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('/users');
        }

        return view('users/edit', $data);
    }

    public function update($id)
    {
        helper(['form']);
        $userModel = new UserModel();
        $user = $userModel->find($id);

        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'avatar'    => 'uploaded[avatar]|max_size[avatar,2048]|ext_in[avatar,jpg,jpeg,png]'
        ];

        $file = $this->request->getFile('avatar');
        if (!$file->isValid()) {
            unset($rules['avatar']);
        }

        if (!$this->validate($rules)) {
            return view('users/edit', [
                'user'       => $user,
                'validation' => $this->validator
            ]);
        }

        $avatarName = $user['avatar'];
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $avatarName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $userModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'avatar'    => $avatarName
        ]);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }
}