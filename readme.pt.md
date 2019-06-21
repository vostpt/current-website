# vost tema wordpress

Read this in [English](readme.md)

Versão atual: WordPress 5.1.1, com os seguintes plugins instalados: WPML, ACF, WP Bakery, Classic Editor e ACF extended forms.

 - **[WPML](https://wpml.org/)** - gestão multilingua;
 - **[ACF](https://www.advancedcustomfields.com/)** - para criar custom fields para backoffice;
 - **[ACF](https://www.advancedcustomfields.com/)** _extended form_  - criar forms com o ACF;
 - **[Classic Editor](https://wordpress.org/plugins/classic-editor/)** - para o editor funcionar (s/ guttenberg);
 - **[WP Bakery](https://wpbakery.com/)** - para a criação de posts com templates personalizados;
 - tema criado de raiz para a VOST PT.

## Ambiente de desenvolvimento

O ambiente de produção está feito para trabalhar com gulp, SASS, Babel e otimização de imagens. Pode-se trabalhar sem isto, mas os ficheiros de produção estão minificados;

Os ficheiros encontram-se em *[/wp-content/themes/vost/dev](wp-content/themes/vost/dev)*.

## Instalação

Correr `npm install` e depois `gulp serve`;

Na pasta *[/wp-content/themes/vost/dev](wp-content/themes/vost/dev)* encontra-se o ambiente de produção para minificação, transpilação e compilação do CSS e js;

Dentro do */dev* fazer npm install e depois correr o gulp com gulp serve;

Dentro do */src* estarão os ficheiros .php, copiados diretamente;

*/src/media* são optimizadas as imagens ao iniciar o gulp serve e depois são apenas copiadas (questão de processamento de cpu - podem editar o gulpfile caso queiram sempre);

*/src/js/* concatenados, transpilados e minificados.
*/src/js/* vendor copiado diretamente sem alteração.
*/src/js/* unique minificado, transpilado;

*/src/css/unique* copiado diretamente sem merge.
*/src/css* minificado;

Dentro do */src* estará a base de dados .sql depois de importada é preciso alterar no wp_options os 2 campos do endereço do site;

Actualizar os permalinks.

## Pequenas notas

- O cache buster está ativo para os ficheiros CSS (no ficheiro header.php);
- Se por algum motivo se desactivar o WPML, é preciso ter em atenção todas as instancias em que é chamado;
- O mesmo para o ACF mas isso ia-se logo notar :) ;
- jQuery só é preciso para o slickjs na home, sugestão de optimização de só fazer o call do script ai (está a chamar no functions);
- O ACF poderia-se por a carregar por json, seria ligeiramente mais eficiente;
- Edição do menu em apresentação > menus;
- Edicao das colunas do footer em apresentação > widgets;
- Duplicar os posts para inglês (e informação);
- No functions.php tem um snippet a remover funções para editores;
- Ao fazer upload não esquecer de remover o ambiente de desenvolvimento;
- Editar o wp-config com os dados correctos de ligação à BD.


## TODO

- .htaccess cache para imagens/static;
- Conteúdo (e mails de contacto no formulário);
- Traduções;
- Newsletter integrada com mailchimp;
- Página de arquivo;
- Info header/footer global para fazer menos calls à BD;
- Remover jQuery de carregar globalmente e apenas na home para o slickjs (tentar ter o mais optimizado possivel).