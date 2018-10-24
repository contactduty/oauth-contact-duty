<?php

namespace ContactDuty\OAuth2;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class Owner implements ResourceOwnerInterface {
    use ArrayAccessorTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @var string
     */
    protected $fieldOfActivity;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @param array $response
     */
    public function __construct(array $response) {
        $this->id = $response['id'];
        $this->name = $response['name'];
        $this->email = $response['email'];
        $this->dateFormat = $response['dateFormat'];
        $this->fieldOfActivity = $response['fieldOfActivity'];
        $this->phone = $response['phone'];
    }

    /**
     * Get message ID.
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get full name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getDateFormat() {
        return $this->dateFormat;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getFieldOfActivity() {
        return $this->fieldOfActivity;
    }

    /**
     * Get phone.
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Get user data as an array.
     *
     * @return array
     */
    public function toArray() {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'dateFormat' => $this->dateFormat,
            'fieldOfActivity' => $this->fieldOfActivity,
            'phone' => $this->phone,
        );
    }
}
