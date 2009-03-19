<?php

class sfTitleMakerExecutionFilter extends sfExecutionFilter
{
  protected function executeView($moduleName, $actionName, $viewName, $viewAttributes)
  {
    sfContext::getInstance()->getResponse()->setTitle(sfTitleMaker::getInstance());

    parent::executeView($moduleName, $actionName, $viewName, $viewAttributes);
  }
}
