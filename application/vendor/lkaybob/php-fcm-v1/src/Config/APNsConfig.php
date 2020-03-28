<?php
/**
 * Created by PhpStorm.
 * User: lkaybob
 * Date: 31/03/2018
 * Time: 00:12
 */

namespace phpFCMv1\Config;

class APNsConfig implements CommonConfig {
    const PRIORITY_HIGH = '10', PRIORITY_NORMAL = '5';
    private $payload;
    private $extra_payload;

    public function __construct() {
        $this -> payload = array();
        $this -> extra_payload = array();
    }

    public function __invoke() {
        return $this -> getPayload();
    }

    /**
     * @param $key
     * @return mixed
     */
    function setCollapseKey($key) {
        $payload = array_merge($this -> payload, array('apns-collapse-id' => $key));
        $this -> payload = $payload;

        return null;
    }

    /**
     * @param $priority
     * @return mixed
     */
    function setPriority($priority) {
        $payload = array_merge($this -> payload, array('apns-priority' => $priority));
        $this -> payload = $payload;

        return null;
    }

    /**
     * @param $filename
     * @return mixed
     */
    function setSound($filename = "default") {
        $extra_payload = array_merge($this -> extra_payload, array("sound" => $filename));
        $this -> extra_payload = $extra_payload;

        return null;
    }

    /**
     * @param $badge_number
     * @return mixed
     */
    function setBadge($badge_number = 1) {
        $extra_payload = array_merge($this -> extra_payload, array("badge" => $badge_number));
        $this -> extra_payload = $extra_payload;

        return null;
    }

    /**
     * @param $time : Time for notification to live in seconds
     * @return mixed    : Expiration option using UNIX epoch date
     * @throws \Exception
     */
    function setTimeToLive($time) {
        $expiration = new \DateTime('now');
        $expiration -> add(new \DateInterval('PT' . $time . 'S'));
        $expValue = $expiration -> format('U');

        $payload = array_merge($this -> payload, array('apns-expiration' => $expValue));
        $this -> payload = $payload;

        return null;
    }

    /**
     * @return mixed
     */
    public function getPayload() {
        if (!sizeof($this -> payload)) {
            // To prevent erorr on array_merge. Returns empty array
            return $this -> payload;
        } else {
            // 'apns' should have 'header' & 'payload' field
            $payload = array(
                'apns' => array(
                    'headers' => $this -> payload,
                    'payload' => array(
                        'aps' => $this -> extra_payload,
                    ),
                )
            );
            return $payload;
        }
    }
}
