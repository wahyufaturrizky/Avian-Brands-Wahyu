<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This library is to send push notification via Firebase Cloud Messaging system.
 * required is secure-login json to identify the sender.
 * use the structured config array to send the notification right away!
 */

require_once APPPATH.'vendor/autoload.php';

use phpFCMv1\Client;
use phpFCMv1\Notification;
use phpFCMv1\Recipient;
use phpFCMv1\Config\APNsConfig;
use phpFCMv1\Config\AndroidConfig;

const PRIORITY_HIGH_IOS = '10', PRIORITY_NORMAL_IOS = '5';
const PRIORITY_HIGH_ANDROID = 'HIGH', PRIORITY_NORMAL_ANDROID = 'NORMAL';

class FirebaseFcm {

    protected $CI;
    private $secure_login_path;

    function __construct() {
        //Assign the CodeIgniter super-object
        //$this->CI =& get_instance();

        //set default secure-login file path!.
        $this->secure_login_path = APPPATH."keys/avianbrands-1310-firebase-adminsdk-6y92i-795b9b6284.json";
    }

    /**
     * fire a push notification to ios devices.
     * have different config format than android.
     * $config = array(
     *     "mode"          => "topic|single",
     *     "target"        => "topic_name|fcm_token",
     *     "priority"      => ("PRIORITY_HIGH"|"PRIORITY_NORMAL"),
     *     "sound"         => "default|sound_filename",
     *     "badge"         => (1|any_integer_number),
     *     "notif_title"   => "This is Notification Title!",
     *     "notif_content" => "Hello world, this is notification content.",
     *     "extra_data"    => array(
     *         "key1"      => "value1",
     *         "key2"      => "value2",
     *     ),
     * );
     */
    public function firepush_ios($config = array()) {

        $is_error = TRUE;
        $error_message = "Something is gone wrong...";

        // default config.
        $config_default = array(
            "mode"          => "topic",
            "target"        => "ios",
            "priority"      => PRIORITY_NORMAL_IOS,
            "sound"         => "default",
            "badge"         => 1,
            "notif_title"   => "This is Notification Title!",
            "notif_content" => "Hello world, this is notification content.",
            "extra_data"    => array(
                "key"      => "no value",
            ),
        );

        // validations.
        if (empty($config)) {
            $error_message = "Config iOS harus dikirimkan dengan format yang ditentukan.";
            return ["is_error" => $is_error, "error_message" => $error_message];
        }

        // mode.
        if (!isset($config["mode"]) || ($config["mode"] != "single" && $config["mode"] != "topic")) {
            $config["mode"] = $config_default["mode"];
        }

        // target.
        if (!isset($config["target"]) || strlen(trim($config["target"])) == 0) {
            $config["target"] = $config_default["target"];
        }

        // priority.
        if (!isset($config["priority"])  || ($config["priority"] != "PRIORITY_HIGH" && $config["priority"] != "PRIORITY_NORMAL")) {
            $config["priority"] = $config_default["priority"];
        } else {
            $config["priority"] = ($config["priority"] == "PRIORITY_HIGH") ? PRIORITY_HIGH_IOS : PRIORITY_NORMAL_IOS;
        }

        // sound.
        if (!isset($config["sound"]) || strlen(trim($config["sound"])) == 0) {
            $config["sound"] = $config_default["sound"];
        }

        // badge.
        if (!isset($config["badge"]) || is_null($config["badge"]) || !is_int($config["badge"]) ) {
            $config["badge"] = $config_default["badge"];
        }

        // notif title.
        if (!isset($config["notif_title"]) || strlen(trim($config["notif_title"])) == 0) {
            $config["notif_title"] = $config_default["notif_title"];
        }

        // notif content.
        if (!isset($config["notif_content"]) || strlen(trim($config["notif_content"])) == 0) {
            $config["notif_content"] = $config_default["notif_content"];
        }

        // extra data.
        if (!isset($config["extra_data"]) || !is_array($config["extra_data"])) {
            $config["extra_data"] = $config_default["extra_data"];
        }

        $recipient = new Recipient();
        $notification = new Notification();
        $APNS_config = new APNsConfig();

        $APNS_config->setPriority($config['priority']);
        $APNS_config->setSound($config['sound']);
        $APNS_config->setBadge($config['badge']);

        if ($config["mode"] == "single") {
            $recipient->setSingleRecipient($config['target']);
        }
        else {
            $recipient->setTopicRecipient($config['target']);
        }

        $notification->setNotification($config['notif_title'], $config['notif_content']);

        $result = $this->__fire($recipient, $notification, $config['extra_data'], $APNS_config);

        if ($result == 1) {
            return true;
        }
        else {
            $error_message = $result;
            return ["is_error" => $is_error, "error_message" => $error_message];
        }
    }

    /**
     * fire a push notification to android devices.
     * have different config format than ios.
     * $config = array(
     *     "mode"          => "topic|single",
     *     "target"        => "topic_name|fcm_token",
     *     "priority"      => ("PRIORITY_HIGH"|"PRIORITY_NORMAL"),
     *     "notif_title"   => "This is Notification Title!",
     *     "notif_content" => "Hello world, this is notification content.",
     *     "extra_data"    => array(
     *         "key1"      => "value1",
     *         "key2"      => "value2",
     *     ),
     * );
     */
    public function firepush_android($config = array()) {

        $is_error = TRUE;
        $error_message = "Something is gone wrong...";

        // default config.
        $config_default = array(
            "mode"          => "topic",
            "target"        => "android",
            "priority"      => PRIORITY_NORMAL_ANDROID,
            "notif_title"   => "This is Notification Title!",
            "notif_content" => "Hello world, this is notification content.",
            "extra_data"    => array(
                "key"      => "no value",
            ),
        );

        // validations.
        if (empty($config)) {
            $error_message = "Config android harus dikirimkan dengan format yang ditentukan.";
            return ["is_error" => $is_error, "error_message" => $error_message];
        }

        // mode.
        if (!isset($config["mode"]) || ($config["mode"] != "single" && $config["mode"] != "topic")) {
            $config["mode"] = $config_default["mode"];
        }

        // target.
        if (!isset($config["target"]) || strlen(trim($config["target"])) == 0) {
            $config["target"] = $config_default["target"];
        }

        // priority.
        if (!isset($config["priority"])  || ($config["priority"] != "PRIORITY_HIGH" && $config["priority"] != "PRIORITY_NORMAL")) {
            $config["priority"] = $config_default["priority"];
        } else {
            $config["priority"] = ($config["priority"] == "PRIORITY_HIGH") ? PRIORITY_HIGH_ANDROID : PRIORITY_NORMAL_ANDROID;
        }

        // notif title.
        if (!isset($config["notif_title"]) || strlen(trim($config["notif_title"])) == 0) {
            $config["notif_title"] = $config_default["notif_title"];
        }

        // notif content.
        if (!isset($config["notif_content"]) || strlen(trim($config["notif_content"])) == 0) {
            $config["notif_content"] = $config_default["notif_content"];
        }

        // extra data.
        if (!isset($config["extra_data"]) || !is_array($config["extra_data"])) {
            $config["extra_data"] = $config_default["extra_data"];
        }

        $recipient = new Recipient();
        $notification = new Notification();
        $Android_config = new AndroidConfig();

        $Android_config->setPriority($config['priority']);

        if ($config["mode"] == "single") {
            $recipient->setSingleRecipient($config['target']);
        }
        else {
            $recipient->setTopicRecipient($config['target']);
        }

        $notification->setNotification($config['notif_title'], $config['notif_content']);

        $result = $this->__fire($recipient, $notification, $config['extra_data'], $Android_config);

        if ($result == 1) {
            return true;
        }
        else {
            $error_message = $result;
            return ["is_error" => $is_error, "error_message" => $error_message];
        }
    }

    /**
     * Private method to FIRE the FCM.
     */
    private function __fire($recipient, $notification, $data, $config) {
        $client = new Client($this->secure_login_path);
        $client->build($recipient, $notification, $data, $config);
        $result = $client->fire();
        return $result;
    }

}
