<?php

namespace HBO\Broadlink\Request;


use HBO\Broadlink\Session;

interface RequestInterface
{
    public function execute(Session $session);
}