<?php

if(property_exists($request,'submit') && $request->submit === 'submit')
{
    match($request->type)
    {
        'register'      => $requestController->submitRegister($request),
        'login'         => $requestController->submitLogin($request),
        'reset_send'    => $requestController->submitResetSend($request),
        'reset_pwd'     => $requestController->submitReset($request),
        'bookmark'      => $requestController->submitBookmark($request),
        'kontakt'       => $requestController->submitKontakt($request),
        'update_member' => $requestController->updateMember($request),
        'update'        => $articleController->update($request),
        'delete'        => $articleController->delete($request),
        'create'        => $articleController->create($request),
         default => null,
    };
}
?>
