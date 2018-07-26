<?php

// Função de chamamento de funções
function esicAutoChama( $caminho )
{
    $param = explode( '\\', $caminho );
    $classe = end( $param );

    $arquivo = ESIC_RAIZ ."classes/{$classe}.php";

    if( is_file( $arquivo ) ) require_once( $arquivo );
}
spl_autoload_register( 'esicAutoChama' );
