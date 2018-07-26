<?php
namespace Esic;

class Template
{
    public static function gerar( $arquivo, $_TEMPLATE = null )
    {
        if( !is_file( $arquivo ) ) {
            throw new \Exception( "O arquivo '{$arquivo}'' não foi encontrado", 1);
        }

        ob_start();
        include $arquivo;
        $pagina = ob_get_contents();
        ob_end_clean();

        return $pagina;
    }
}
