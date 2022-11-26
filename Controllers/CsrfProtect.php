<?php
namespace Controllers;

class CsrfProtect
{
    public function csrf()
    {
        /*generate csrf token to protect*/
        $sessionProvider = new \EasyCSRF\NativeSessionProvider();
        $easyCSRF = new \EasyCSRF\EasyCSRF($sessionProvider);
        return $easyCSRF->generate('csrf');
    }
    public function check($token)
    {
        /*check csrf token to protect*/
        $sessionProvider = new \EasyCSRF\NativeSessionProvider();
        $easyCSRF = new \EasyCSRF\EasyCSRF($sessionProvider);
        try {
            $easyCSRF->check('csrf', $token);
        } catch (\EasyCSRF\Exceptions\InvalidCsrfTokenException $e) {
            return false;
        }
        return true;
    }
}