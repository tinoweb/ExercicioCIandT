<?php 

/**
 * Form Class
 *
 * resposnsavel para criar select form
 *
 * @param array $elements 
 *
 * @return void
 */
class Form{

  public $elements;
  public $form_number = 1;

  public function __construct($elements){
     $this->elements = $elements;
  }

  /**
    * 
    * 
    * @return void
    * 
    */
  public function dumpElements() {
     var_dump($this->elements);
  }

  /**
    * Class Form para criar um formulario atraves de array
    * 
    * 
    * @return string $output contem o fomulário com HTML
    * 
    */
  function build() {
    $output = '';
    
    // loop em cada elemento e renderizar no formulario.
    foreach ($this->elements as $name => $elements) {
      $label = '<label>' . $elements['title'] . '</label>';
      switch ($elements['type']) {
        case 'select':
          
          foreach ($elements['option'] as $key => $value) {
            $text .= '<option value="'.$value.'"> '.$value.' </option>';
          }

          $input =  '<select name="" >'
                      .$text.
                    '</select>';
          break;
        case 'textarea':
          $input = '<textarea name="' . $name . '" ></textarea>';
          break;
        case 'submit':
          $input = '<input type="submit" name="' . $name . '" value="' . $elements['title'] . '">';
          $label = '';
          break;
        default:
          $input = '<input type="' . $elements['type'] . '" name="' . $name . '" />';
          break;
      }
      $output .= $label . '<p>' . $input . '</p>';
    }
    
    // Colocando inputs dentro do formulario.
    $output = '
      <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
        <input type="hidden" name="action" value="submit_' . $this->form_number . '" />
        ' . $output . '
      </form>';
    
    // Retirnar o formulario.
    return $output;
  }

}

/*
 * esses arquivos contem a lista que vai defenir o formulario
 * 
 */

$contact_form = array(
  'name' => array(
    'title' => 'Nome',
    'type' => 'text',
    'validations' => array('not_empty'),
  ),
  'select' => array(
    'title' => 'Selecione a sua Prioridade',
    'type' => 'select',
    'option' => array(
                  'Familia' => 'Familia',
                  'Trabalho' => 'Trabalho',
                  'Amigos' => 'Amigos',
                  'Diversões' => 'Diversões'
                ),
    'validations' => array('not_empty'),
  ),
  'email' => array(
    'title' => 'Email',
    'type' => 'email',
    'validations' => array('not_empty', 'is_valid_email'),
  ),
  'comment' => array(
    'title' => 'Comentarios',
    'type' => 'textarea',
    'validations' => array('not_empty'),
  ),
  'submit' => array(
    'title' => 'Enviar!',
    'type' => 'submit',
  ),
);


$form = new Form($contact_form);
$form_html = $form->build();
?>

<!DOCTYPE html>
<html>
<head>
  <title>The index file</title>
  <style>
    .styleformat{
        position: relative;
        width: 30%;
        left: 30%;
        margin-top: 5%;
    }
    legend {
        background-color: #000;
        color: #fff;
        padding: 3px 6px;
    }
    label {
        margin-top: 1rem;
        display: block;
        font-size: .8rem;
    }
  </style>
</head>
<body>
  <fieldset class="styleformat">
    <legend>Formulario Gerado pela Classe</legend>
    <?php echo $form_html; ?>
  </fieldset>
</body>
</html>