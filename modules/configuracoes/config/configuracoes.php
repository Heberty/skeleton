<?php
return [
    'singular' => 'Configuração',
    'plural' => 'Configurações',
    'gender' => 'f',
    'active_menu' => 'configuracoes',
    'model' => '\\Configuracoes\\Model\\Configuracao',
    'form_layout' => function (Mix\Html\FormBuilder $builder) {
        // Create the tabs
        $builder->addTab('site', 'Site');
        $builder->addTab('integrations', 'Integrações');
        $builder->setActiveTab('site');

        //
        // Site config
        //
        $builder->openTab('site');

            $builder->row(['nome_site' => 9]);
            $builder->row(['site_keywords' => 9]);
            $builder->row(['site_description' => 9]);

            // Social info
            $builder->row(['facebook_url' => 6]);
            $builder->row(['instagram_url' => 6]);
            $builder->row(['youtube_url' => 6]);
            $builder->row(['whatsapp_phone' => 6]);

            $builder->row(['email_contact' => 6]);
            $builder->row(['address' => 6]);
            // $builder->row(['mapa_empresa' => 6]);

        $builder->closeTab();

        //
        // Site config
        //
        $builder->openTab('integrations');

            $builder->row(['google_analytics' => 6]);

        $builder->closeTab();

        return $builder->getLayout();
    },
    'add_subtitle' => false,
    'add_breadcrumb' => false,
    'add_backbutton' => false,
    'insert_success_message' => 'Configurações atualizadas com sucesso.'
];
