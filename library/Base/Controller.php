<?php

namespace Base;

class Controller {

    protected $objAccount = null;
    protected $connectedController = true;

    public function __construct() {
        if ($this->connectedController) {
            if (!IS_CONNECTED) {
                \ResponseHelper::redirectByRoute("login_form");
            }
        }
    }

    public function fillAccount() {
        if (IS_CONNECTED) {
            $idAccount = \SessionHelper::get("idAccount", 0);
            $objAccount = \LibraryHelper::getAccountRepository()->find($idAccount);
            
            \SessionHelper::set("isActivate", $objAccount->getActivation());
            $this->objAccount = $objAccount;
        }
    }

}
