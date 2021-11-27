<?php
    require_once __DIR__. '/../src/autoloader.php';
    use sysborg\autentiquev2\createDoc;
    use sysborg\autentiquev2\autentique;
    
    $token = ''; //en-US: put your autentique's token here https://www.autentique.com.br/ | pt-BR: coloque seu token da autentique aqui https://www.autentique.com.br/

    /**
     * en-US: Calling the desired layout and passing the variables expecteds and disred. At this case the document creation and upload with multiple point of the same signer
     * pt-BR: Invoca o layout desejado e passa as variáveis esperadas e desejadas. Nesse caso a criação e upload do documento com múltiplas assinaturas do mesmo assinante
     */
    $l = new createDoc();
    $l->name = 'Test with one signer';
    $l->file = __DIR__. '/examples/doc1.pdf';
    $signer = $l->addSigners('andmarruda@gmail.com', 80, 70, 1);
    $signer->addPositions(20, 70, 1);

    /**
     * en-US: Invokes the autentique api to transmit data by curl and recive the response
     * pt-BR: Invoca a api do autentique e transmite os dados por curl e recebe a resposta
     */

    $t = new autentique($l);
    $t->debug=true;
    $t->token=$token;
    $r = $t->transmit();
    echo '//en-US: Clean response | pt-BR: Resposta limpa<br><pre>';
    var_dump($r); //en-US: Clean response | pt-BR: Resposta limpa
    echo '</pre>';

    echo '<br><br>//en-US: Response decoded | pt-BR: Resposta decodificada<br><pre>';
    var_dump(json_decode($r, true)); //en-US: Response decoded | pt-BR: Resposta decodificada
    echo '</pre>';
?>
