<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor é o nome da sua aplicação, que será usado quando o
    | framework precisar exibir o nome da aplicação em uma notificação ou
    | outros elementos da interface onde o nome da aplicação precisa ser mostrado.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que sua aplicação está rodando.
    | Isso pode determinar como você prefere configurar vários
    | serviços utilizados pela aplicação. Defina isso no seu arquivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração da Aplicação
    |--------------------------------------------------------------------------
    |
    | Quando a sua aplicação está em modo de depuração, mensagens de erro detalhadas
    | com rastros de pilha serão exibidas a cada erro que ocorrer dentro de sua
    | aplicação. Se desativado, uma página de erro genérica será mostrada.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar URLs corretamente ao usar
    | a ferramenta de linha de comando Artisan. Você deve definir isso para a raiz
    | da aplicação para que esteja disponível nos comandos Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para sua aplicação, que
    | será usado pelas funções de data e hora do PHP. O fuso horário
    | é definido como "UTC" por padrão, pois é adequado para a maioria dos casos de uso.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'America/Cuiaba'),

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade da aplicação determina o idioma padrão que será usado
    | pelos métodos de tradução/localização do Laravel. Esta opção pode ser
    | configurada para qualquer localidade para a qual você planeja ter strings de tradução.
    |
    */

    'locale' => env('APP_LOCALE', 'pt_BR'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'pt_BR'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'pt_BR'),

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é utilizada pelos serviços de criptografia do Laravel e deve ser
    | definida como uma string aleatória de 32 caracteres para garantir que todos
    | os valores criptografados sejam seguros. Você deve fazer isso antes de
    | implantar a aplicação.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver do Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Essas opções de configuração determinam o driver usado para determinar e
    | gerenciar o status do "modo de manutenção" do Laravel. O driver "cache"
    | permitirá que o modo de manutenção seja controlado em várias máquinas.
    |
    | Drivers suportados: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
