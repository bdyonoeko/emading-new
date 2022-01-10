<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AlreadyLoginCheckFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('kode_user')) {
          return redirect()->to('/user');
        } 
        elseif (session()->has('kode_admin')) {
            return redirect()->to('/admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}