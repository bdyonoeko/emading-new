<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminMasterCheckFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $status_admin = session()->get('status_admin');

        if ($status_admin != "Master") {
          session()->setFlashdata('pesan_danger', 'Anda tidak punya akses ke halaman ini');
          return redirect()->to('/admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}