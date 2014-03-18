<?php

class TestClass
{
  public    $isNeedToTestPublic = 'abc';
  private   $isNeedToTestPrivate = 'bcd';
  protected $isNeedToTestProtected = 'dca';
  
  public function testMe()
  {
    $isNeedToTestPublic = '123';
    
    echo $isNeedToTestPublic;
    echo $this->isNeedToTestPrivate;
    echo $this->isNeedToTestProtected;
    echo $this->isNeedToTestPublic;
    
    return $isNeedToTestPublic;
  }
  
  private function getPrivate()
  {
    return $this->isNeedToTestPrivate;
  }
}