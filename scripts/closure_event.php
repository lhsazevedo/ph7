<?
//Closure as event handler
class Button
  {
    public $OnBeforeClick;
    public $OnAfterClick;
    public $Name;

    function Button()
    {
      $this->Name = 'MyButton';   
    }
   
    public function Click()
    {
      $this->DoBeforeClick();
     
      echo 'Click!';
     
      $this->DoAfterClick();
    }

    private function DoBeforeClick()
    {
      if (isset($this->OnBeforeClick))
      {
        $Event = $this->OnBeforeClick;
        $Event($this);
      }
    }

    private function DoAfterClick()
    {
      if (isset($this->OnAfterClick))
      {
        $Event = $this->OnAfterClick;
        $Event($this);
      }
    }
  }
 
  //eclipse may warn here about syntax error but no problem, it runs well.
  $BeforeClickEventHandler = function($Sender) { echo $Sender->Name . ' (Before Click)'; }; 
  $AfterClickEventHandler = function($Sender) { echo $Sender->Name . ' (After Click)'; }; 
 
  $MyWidget = new Button();
  $MyWidget->OnBeforeClick = $BeforeClickEventHandler;
  $MyWidget->OnAfterClick = $AfterClickEventHandler;
  $MyWidget->Click();
/*
 Should output
MyButton (Before Click)Click!MyButton (After Click)
*/
?>