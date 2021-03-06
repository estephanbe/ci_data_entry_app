<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UsersCheck implements FilterInterface
{
  /**
   * Do whatever processing this filter needs to do.
   * By default it should not return anything during
   * normal execution. However, when an abnormal state
   * is found, it should return an instance of
   * CodeIgniter\HTTP\Response. If it does, script
   * execution will end and that Response will be
   * sent back to the client, allowing for error pages,
   * redirects, etc.
   *
   * @param RequestInterface $request
   * @param array|null       $arguments
   *
   * @return mixed
   */
  public function before(RequestInterface $request, $arguments = null)
  {
    if(! session()->get('is_admin')) {
      return redirect()->to('/');
    }
    // Do something here
    // If segment 1 == users
    //we have to redirect the request to the second segment
    // $uri = service('uri');
    // if ($uri->getSegment(1) == 'entries') {
    //   if ($uri->getSegment(2) == '')
    //     $segment = '/entries';
    //   else
    //     $segment = '/' . $uri->getSegment(2);

    //   return redirect()->to($segment);
    // }
  }

  /**
   * Allows After filters to inspect and modify the response
   * object as needed. This method does not allow any way
   * to stop execution of other after filters, short of
   * throwing an Exception or Error.
   *
   * @param RequestInterface  $request
   * @param ResponseInterface $response
   * @param array|null        $arguments
   *
   * @return mixed
   */
  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
