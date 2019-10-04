<?php

namespace Helper;

class Format
{
    public static function _empty($value, $format=null)
    {
        if (empty($value)) {
            return '<span style="font-style: italic; color: #666666;">Sem Informação</span>';
        }

        if (is_callable($format)) {
            return call_user_func_array($format, [$value]);
        }

        return $value;
    }

    public static function _money($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    public static function _boolean($value, $positiveLabel='Sim', $negativeLabel='Não')
    {
        return strtr('<span class="label label-type">text</span>', [
            'type' => $value ? 'success' : 'danger',
            'text' => $value ? $positiveLabel : $negativeLabel
            ]);
    }

    public static function _timestamp($value, $format='%d de %B de %Y', $default='-')
    {
        if (empty($value)) {
            return $default;
        }

        return strftime($format, strtotime($value));
    }

    public static function _periodo($inicio, $final, $format='%d de %B de %Y', $default=null)
    {
        $inicioFormatado = utf8_encode(strftime($format, strtotime($inicio)));
        $finalFormatado = utf8_encode(strftime($format, strtotime($final)));

        if (!empty($inicio) && !empty($final)) {
            return 'de ' . $inicioFormatado . ' até ' . $finalFormatado;
        }

        if (!empty($inicio)) {
            return 'a partir de ' . $inicioFormatado;
        }

        if (!empty($final)) {
            return 'até ' . $finalFormatado;
        }

        return $default;
    }

    /*
     * baseado em https://pt.wikipedia.org/wiki/Endere%C3%A7o_postal
     */
    public static function _endereco($logradouro, $numero, $complemento=null, $bairro, $cidade, $estado, $cep)
    {
        $value = [];

        array_push($value, $logradouro);
        array_push($value, ', ');
        array_push($value, $numero);

        if (!empty($complemento)) {
            array_push($value, $complemento);
        }

        array_push($value, '<br>');
        array_push($value, $bairro);
        array_push($value, ' - ');
        array_push($value, $cidade);
        array_push($value, ' / ');
        array_push($value, $estado);

        if (!empty($cep)) {
            array_push($value, '<br>');
            array_push($value, $cep);
        }

        return implode('', $value);
    }

    public static function _url($value)
    {
        if (empty($value)) {
            return;
        }

        return strtr('<a href="{URL}">{URL}</a>', ['{URL}' => $value]);
    }

    public static function _excerpt($text, $length=30, $more='[...]')
    {
        $text = strip_tags($text);

        $text = trim($text);

        if (strlen($text) > $length) {
            return substr($text, 0, $length).$more;
        }

        return $text;
    }

    public static function _mask($mask, $text) {
        for($i=0; $i < strlen($text); $i++) {
            $position = strpos($mask,'#');

            if ($position===false) {
                break;
            }

            $mask[$position] = $text[$i];
        }

        return $mask;
    }

    public static function _phone($value, $prependCountryCode = '55')
    {
        if (empty($value)) {
            return;
        }

        $replaced = preg_replace('/([^0-9\+])+/', '', $value);

        if (!empty($prependCountryCode) && !preg_match("~^$prependCountryCode?~", $replaced)) {
            $replaced = $prependCountryCode . $replaced;
        }

        return $replaced;
    }

    public static function renderAttributes(array $attributes)
    {
        $output = [];

        foreach ($attributes as $name => $value) {
            if (is_int($name)) {
                array_push($output, $value);
                continue;
            }

            array_push($output, sprintf('%s="%s"', $name, $value));
        }

        return implode(' ', $output);
    }
}
