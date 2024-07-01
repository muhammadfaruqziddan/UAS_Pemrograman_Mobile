<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Pembayaran;

class PembayaranController extends ResourceController
{
    protected $modelName = 'App\Models\Pembayaran';
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data_pembayaran' => $this->model->findAll()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = [
            'message' => 'success',
            'data_pembayaran' => $this->model->find($id)
        ];

        if ($data['data_pembayaran_byid'] == null) {
            return $this->failNotFound('Data Tidak Ditemukan');
        }

        return $this->respond($data, 200);
    }


    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        // This method might not be needed in a typical REST API
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = $this->validate([
            'nis'        => 'required',
            'nama_siswa' => 'required',
            'nominal'    => 'required',
            'berita'     => 'required',
        ]);

        if(!$rules)
        {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        // Menambahkan Data
        $this->model->insert([
            'nis'       => esc($this->request->getVar('nis')),
            'nama_siswa'=> esc($this->request->getVar('nama_siswa')),
            'nominal'   => esc($this->request->getVar('nominal')),
            'berita'    => esc($this->request->getVar('berita')),
        ]);

        $response = [
            'message' => 'Data Berhasil Ditambahkan'
        ];

        return $this->respondCreated($response);
    }


    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        // This method might not be needed in a typical REST API
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $rules = $this->validate([
            'nis'        => 'required',
            'nama_siswa' => 'required',
            'nominal'    => 'required',
            'berita'     => 'required',
        ]);

        if(!$rules)
        {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        // Menambahkan Data
        $this->model->update($id, [
            'nis'       => esc($this->request->getVar('nis')),
            'nama_siswa'=> esc($this->request->getVar('nama_siswa')),
            'nominal'   => esc($this->request->getVar('nominal')),
            'berita'    => esc($this->request->getVar('berita')),
        ]);

        $response = [
            'message' => 'Data Berhasil Diubah'
        ];
        return $this->respond($response, 200);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        $response = [
            'message' => 'Data Berhasil Dihapus'
        ];
        return $this->respondDeleted($response, 200);
    }
}
