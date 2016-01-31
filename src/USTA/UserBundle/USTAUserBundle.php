<?php

namespace USTA\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class USTAUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
