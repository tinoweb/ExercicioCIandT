<?php 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if ($_GET['url'] == "listar") {
    $content = unserialize(file_get_contents('apidata.txt'));
    response(200,'listagem dos usuarios',$content);
  }
}else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_GET['url'] == "cadastrar") {

    $content = unserialize(file_get_contents('apidata.txt'));
    
    if (!empty($_POST['nome'])) {
        $data['nome'] = $_POST['nome'];
    }
    if (!empty($_POST['sobreNome'])) {
        $data['sobreNome'] = $_POST['sobreNome'];
    }
    if (!empty($_POST['email'])) {
        $data['email'] = $_POST['email'];
    }
    if (!empty($_POST['telefone'])) {
        $data['telefone'] = $_POST['telefone'];
    }
    
    // print_r($data);
    // die;

    if (count($data)>0) {
      $todos = array();
      if (empty($content)) {
        $data = [$data];
        $dados = serialize($data);
        file_put_contents("apidata.txt", $dados);
        response(200,"Cadastro efetuado com sucesso",NULL);
      }
      else{
        for ($i=0; $i < count($content); $i++) { 
          if (count($content)>1) {
            $todos[$i] = $content[$i];
            $todos[count($content)] = $data;
          }else{
            $todos[$i] = $content[$i];
            $todos[$i+count($content)] = $data;
          }
        }
        $serializado = serialize($todos);
        file_put_contents('apidata.txt', $serializado);
        response(200,"Cadastro efetuado com sucesso",NULL);
      }

    }else{
      echo "Não tem dados para Guardar";
    }
  }
}else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  if ($_GET['url'] == "deletar"){
    if (isset($_GET['email'])) {
        $data['email'] = $_GET['email'];
        $email = $data['email'];

        $content = unserialize(file_get_contents('apidata.txt'));

        $count=0;
        foreach ($content as $key => $value) {
          if (in_array($email, $value)) {
            unset($content[$count]);
          }
        $count++;
        }

        $newData = array_values($content);

        $dados = serialize($newData);
        file_put_contents("apidata.txt", $dados);
        response(200,"Cadastro deletado com sucesso",NULL);

    }else{
      response(404,"Email não informado!!",NULL);
    }

  }
}
else{
  http_response_code(405);
}


function response($status,$status_message,$data)
{
  header("HTTP/1.1 ".$status);
  
  $response['status']=$status;
  $response['status_message']=$status_message;
  $response['data']=$data;
  
  $json_response = json_encode($response);
  echo $json_response;
}

?>


