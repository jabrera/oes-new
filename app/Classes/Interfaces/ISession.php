<?php
/**
 * Created by PhpStorm.
 * User: juvar_a
 * Date: 8/30/16
 * Time: 9:14 PM
 */

namespace Oslo\Interfaces;

interface ISession {

    function __constuct();

    function setUser($id);

    function getUser();

    function checkSession();

    function checkUserType();

}