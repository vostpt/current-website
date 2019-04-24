# vost tema wordpress

Read this in [English](readme.md)

Actualmente versão 5.1.1 do wp, com plugins wpml, acf, wp bakery, classic editor e acf extended forms instalados.

 - **[WPML](https://wpml.org/)** - gestão multilingua;
 - **[ACF](https://www.advancedcustomfields.com/)** - para criar custom fields para backoffice;
 - **[ACF](https://www.advancedcustomfields.com/)** _extended form_  - criar forms com o acf;
 - **[Classic Editor](https://wordpress.org/plugins/classic-editor/)** - para o editor funcionar (s/ guttenberg);
 - **[WP Bakery](https://wpbakery.com/)** - para a criação de posts com templates personalizados;
 - tema criado de raiz para a VOST /vost.

## Ambiente de desenvolvimento

O ambiente de produção está feito para trabalhar com gulp, sass, babel e optimização de imagens. Pode-se trabalhar sem isto, mas os ficheiros de produção estão minificados;

encontra-se em *[/wp-content/themes/vost/dev](wp-content/themes/vost/dev)*.

## Instalação

Correr `npm install` e depois `gulp serve`;

Na pasta *[/wp-content/themes/vost/dev](wp-content/themes/vost/dev)* encontra-se o ambiente de produção para minificação, transpilação e compilação do css e js;

dentro do */dev* fazer npm install e depois correr o gulp com gulp serve;

dentro do */src* estarão os ficheiros .php, copiados diretamente;

*/src/media* são optimizadas as imagens ao iniciar o gulp serve e depois são apenas copiadas (questão de processamento de cpu - podem editar o gulpfile caso queiram sempre);

*/src/js/* concatenados, transpilados e minificados.
*/src/js/* vendor copiado diretamente sem alteração.
*/src/js/* unique minificado, transpilado;

*/src/css/unique* copiado diretamente sem merge.
*/src/css* minificado;

dentro do */src* estará a base de dados .sql depois de importada é preciso alterar no wp_options os 2 campos do endereço do site;

Actualizar os permalinks.

## Pequenas notas

- O css está com cache buster (no header.php);
- Se por algum motivo se desactivar o wpml, é preciso ter em atenção todas as instancias em que é chamado;
- O mesmo para o acf mas isso ia-se logo notar :) ;
- jquery só é preciso para o slickjs na home, sugestão de optimização de só fazer o call do script ai (está a chamar no functions);
- o acf poderia-se por a carregar por json, seria ligeiramente mais eficiente;
- edição do menu em apresentação > menus;
- edicao das colunas do footer em apresentação > widgets;
- Duplicar os posts para EN (e informação);
- no functions.php tem um snippet a remover funções para editores;
- ao fazer upload não esquecer de remover o ambiente de desenvolvimento;
- e editar o wp-config com os dados correctos de ligação à BD.


## TODO

- htaccess cache para imagens/static;
- conteudo (e mails de contacto no form);
- traduções;
- newsletter integrada com mailchimp;
- pagina de arquivo;
- info footer/header global para fazer menos calls a bd;
- remover jquery de carregar globalmente e apenas na home para o slickjs (tentar ter o mais optimizado possivel).