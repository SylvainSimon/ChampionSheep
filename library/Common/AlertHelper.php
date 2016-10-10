<?php

class AlertHelper {

    public static function addError($message) {
        SessionHelper::addFlash('error', $message);
    }

    public static function addWarning($message) {
        SessionHelper::addFlash('warning', $message);
    }

    public static function addSuccess($message) {
        SessionHelper::addFlash('success', $message);
    }

    public static function addInfo($message) {
        SessionHelper::addFlash('info', $message);
    }

    public static function clearError() {
        SessionHelper::$session->getFlashBag()->clear('error');
    }

    public static function clearWarning() {
        SessionHelper::$session->getFlashBag()->clear('warning');
    }

    public static function clearSuccess() {
        SessionHelper::$session->getFlashBag()->clear('success');
    }

    public static function clearInfo() {
        SessionHelper::$session->getFlashBag()->clear('info');
    }

    public static function clearAll() {
        SessionHelper::$session->getFlashBag()->clear();
    }

    public static function generateAlertMessage() {

        $return = "";

        foreach (SessionHelper::$session->getFlashBag()->all() as $type => $messages) {
            switch ($type) {
                case 'success':
                    $title = "Opération réussie";
                    break;
                case 'info':
                    $title = "Information";
                    break;
                case 'warning':
                    $title = "Attention !";
                    break;
                case 'error':
                    $title = "Erreur";
                    $type = "danger";
                    break;
            }

            foreach ($messages as $message) {
                $strMessage = addslashes(trim($message));
                if (strlen($strMessage) > 0) {
                    $return .= '<div class="col-md-12"><div class="alert alert-' . $type . ' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4></i>' . $title . '</h4>
                ' . $message . '
              </div></div>';
                }
            }
        }

        return $return;
    }
}
