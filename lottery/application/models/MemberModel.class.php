<?php
namespace Yboard;

class MemberModel extends CommonModel {
    public function __construct($options = null) {
        $this->_table = 'lty_member';
        $this->_pk    = 'm_uid';
        parent::__construct($options);
    }

    public function getMemberByUsername($username) {
        if (empty($username)) {
            return null;
        }

        return $this->get($this->_table, '*', ['username' => $username]);
    }
}