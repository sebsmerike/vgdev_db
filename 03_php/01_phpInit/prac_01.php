Hola mundo HTML<br/>
<?php 
  function espacio ()
  {
    echo "<br />";
  }

  function sumar ($var1, $var2)
  {
    return $var1 + $var2;
  }

  # Las variables inician con $
  # echo sirve para mostrar en html
  echo "Hola mundo desde php: ";

  $resultado = sumar(9,3);
  if ($resultado > 10)
  {
    echo "error, el máximo es 10, no $resultado";
  }
  else
  {
    echo $resultado;
  }

  espacio();espacio();
  
  # print también sirve para mostrar HTML
  print "Resultado=" . $resultado;

  espacio();
  espacio();

  $flotante = 2.5;
  print $flotante;espacio();espacio();

  # estructura for

  for ($i=0, $j=9; $i<10; $i++, $j--)
  {
    echo "valor actual de i : $i, j : $j";espacio();
  }
  
  espacio();espacio();

  $i=0;
  $j=9;
  while ($i<10)
  {
    echo "valor actual de i : $i, j : $j";espacio();
    #final
    $i++;
    $j--;
  }

  class Cybertronian
  {
    #propiedades
    public $edad;
    public $genero;
    public $hasChispa;
    public $canFly;

    function __construct ()
    {
      $this->edad = 0;
      $this->genero = null;
      $this->chispa = TRUE;
      $this->canFly = FALSE;
    }


    function setEdad($edad)
    {
      $this->edad = $edad;
    }

    function getEdad ()
    {
      return $this->edad;
    }

    #métodos
    function transform ()
    {
      return null;
    }

    function getFaction ()
    {
      return "tibio";
    }
  }

  class Autobot extends Cybertronian {

    function __constructor ()
    {
      parent::__constructor();
    }
    function getFaction ()
    {
      return "Autobot";
    }
  }

  class Decepticon extends Cybertronian {

    function __constructor ()
    {
      parent::__constructor();
      $this->canFly = TRUE;
    }
    
    function getFaction ()
    {
      return "Decepticon";
    }
  }
?>