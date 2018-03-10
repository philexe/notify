<?php

   /**
    * Send Notification to view.
    */
   namespace Philexe\Notify;

   use Config, Session;

   class Notify
   {
    /**
     * Added notifications
     *
     * @var array
     */
    protected $notifications = [];

    /**
     * Illuminate Session
     *
     * @var \Illuminate\Session\SessionManager
     */


    /**
     * Render the notifications' script tag
     *
     * @return string
     * @internal param bool $flashed Whether to get the
     *
     */
     public function render() {

          $notifications = Session::get('notify::notifications');

          if(!$notifications) $notifications = [];

          $lastConfig = [];

       return View('Notify::notify', compact('notifications', 'lastConfig'));
    }

    /**
     * Add a notification
     *
     * @param string $type Could be error, info, success, or warning.
     * @param string $message The notification's message
     * @param string $title The notification's title
     *
     * @return bool Returns whether the notification was successfully added or
     * not.
     */
    public function add($type, $icon, $message, $title = null, $options = []) {
        $allowedTypes = ['danger', 'info', 'success', 'warning'];
        if(!in_array($type, $allowedTypes)) return false;

        $this->notifications[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'options' => $options,
            'icon'    => $icon,
        ];

        Session::flash('notify::notifications', $this->notifications);
    }

    /**
     * Shortcut for adding an info notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function info($message, $title = null, $icon = null, $options = []) {
        $this->add('info', isset($icon) ? $icon :  'fa fa-info-circle fa-3x', $message, $title, $options);
    }

    /**
     * Shortcut for adding an error notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function error($message, $title = null, $icon = null, $options = []) {
        $this->add('danger', isset($icon) ? $icon :  'fa fa-times-circle fa-3x', $message, $title, $options);
    }

    /**
     * Shortcut for adding a warning notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function warning($message, $title = null, $icon = null, $options = []) {
        $this->add('warning', isset($icon) ? $icon :  'fa fa-exclamation-triangle fa-3x', $message, $title, $options);
    }

    /**
     * Shortcut for adding a success notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function success($message, $title = null, $icon = null, $options = []) {
        $this->add('success', isset($icon) ? $icon :  'fa fa-check-circle fa-3x', $message, $title, $options);
    }

    /**
     * Clear all notifications
     */
    public function clear() {
        $this->notifications = [];
    }

}


 ?>
