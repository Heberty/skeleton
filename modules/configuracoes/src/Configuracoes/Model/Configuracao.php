<?php
namespace Configuracoes\Model;

use Mix\Model\Field\Decorator\InputGroupDecorator;

class Configuracao extends ConfiguracaoBase
{
    public function init()
    {
        $this->text('nome_site', 'Nome do Site')->mandatory()->maxLength(100);

        $this->text('site_keywords', 'Palavras-chave do site')->setInfo('Separadas por vírgula');
        $this->text('site_description', 'Descrição do site');

        $this
            ->text('facebook_url', 'URL do Facebook')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-facebook"></fa>'));

        $this
            ->text('instagram_url', 'URL do Instagram')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-instagram"></fa>'));

        $this
            ->url('youtube_url', 'URL do Youtube')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-youtube"></fa>'));

        $this
            ->phone('whatsapp_phone', 'Número do Whatsapp')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-whatsapp"></fa>'));

        $this
            ->email('email_contact', 'Email de Contato')
            ->mandatory()
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-envelope"></fa>'))
            ->setInfo('E-mail que receberá as mensagens de contato e será exibido no site.');

        $this->text('address', 'Endereço de localização')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-map-marker"></fa>'));

        $this->text('google_analytics', 'Código de rastreio do Google Analytics')
            ->addDecorator(new InputGroupDecorator('<fa class="fa fa-google"></fa>'));
    }


    public static function getWatermarkPositions()
    {
        return [
            -1 => 'Não colocar marca d\'água',
            1 => 'Superior esquerdo',
            2 => 'Superior central',
            3 => 'Superior direito',
            4 => 'Centro à direita',
            5 => 'Centro',
            6 => 'Centro à esquerda',
            7 => 'Inferior esquerdo',
            8 => 'Inferior central',
            9 => 'Inferior direito',
        ];
    }

}
