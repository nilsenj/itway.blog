<?php namespace itway\listeners;

/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 4/23/2015
 * Time: 3:57 PM
 */
    interface AuthentificateUserListener {

        public function userHasLoggedIn($user);
    }