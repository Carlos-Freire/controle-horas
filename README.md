# controle-horas
Controle de horas trabalhadas por tarefa

	Dependencias:
		Bootstrap 3.4;
		JQuery;
		Chart.js;
		mPDF;
		
	Objetivos:

	Criar formulário de entrada de dados: dev, cliente, área trabalhada, dia, hora de início e hora de fim;

	Criar filtros dinâmicos de saídas em PDF e gráficos:
		Por cliente +;
		Por área +;
		Por dia ou período +;
		Por dev;

	Totalizar sempre em horas / dias, conforme o(s) filtro(s).
	Utilizar a tabela Controle

    Para criar o submodulo:
    https://imasters.com.br/desenvolvimento/utilizando-o-git-submodules


## Como funciona:

O projeto foi feito usando a estrutura da PSR4 do PHP [link para o artigo](https://www.treinaweb.com.br/blog/psr-4-a-recomendacao-de-autoload-do-php/).\
Ou seja com isso eu tenho as pastas seguindo o padrão mvc e com namespaces, assim eu consigo criar classes em todas as pastas do projeto e chamar classes de outras pastas sem ter algum problema de conflito de nomes graças ao namespace.


Decidi usar essa estrutura pois assim este projeto poderá ser utilizado em outras ferramentas, basta copiar o projeto para outro local, você também consegue utilizar o conteúdo dele em outras pastas fora deste projeto apenas chamando o autoload da pasta vendor.

**Obs:** Eu deixei a pasta vendor dentro do repositório, porém ela pode ser eliminada sem problemas, mas para isso quem for usar precisa ter o composer e o php em linha de comando instalados na máquina.


## Estrutura das pastas e arquivos

**index.php** - É onde passam todas as requisições do datatables, formulários e relatórios, ele puxa os arquivos necessários para o funcionamento do sistema diretamente do arquivo bootstrap.php\
**config.php** - Aqui estão guardadas as configurações de acesso ao banco.\
**bootstrap.php** - Neste arquivo são carregados os arquivos do sistema que são necessários para o seu funcionamento.\
**vendor/** - Aqui estão as bibliotecas de terceiros instaladas e também o mapeamento das classes do sistema feita pelo composer.\
**assets/** - Aqui estão os arquivos do front-end\
**src/** - Essa pasta é a do sistema onde estão todos os arquivos ela responde pelo namespace "Controle"\


**Controllers/Controller.php** - Este arquivo apenas retorna os headers necessários para o json do datatables\
**Controllers/IndexController.php** - Este arquivo fica responsável por definir qual ação está sendo chamada e então executar o código do repository com a regra de negócio\
**Controllers/Router.php** - Este arquivo verifica se a rota chamada existe e chama o método correspondente no controller


**Database/Database.php** - Este arquivo faz a conexão com o banco de dados e retorna a instância da PDO\
**Database/Connection.php** - Ele apenas chama o conexão e segue o formato singleton assim fica só uma instância da conexão sendo chamada\
**Database/Where** - Aqui estão os arquivos responsáveis por gerar a string sql das cláusulas where\
**Datatables/Datatables.php** - Este arquivo pega os dados vindos do datatables e formulário de pesquisa, depois passa os dados por um filtro e retorna apenas aqueles que não estão vazios, ou seja o sistema verifica o que veio e faz a consulta no banco somente com os dados preenchidos

**Filters/ControleFilter.php** - Este arquivo apenas filtra os dados antes de inserir/editar no banco - trabalha apenas com o formulário que aparece no modal

**Models/Model.php** - Este arquivo chama o Connection.php e pega a instância da pdo, nele também está a lógica para gerar as consultas filtradas com o param da pdo.\
**Models/Controle.php** - Este arquivo estende do Model e com isso tem todos os métodos dele e é o responsável por inserir, editar e deletar o conteúdo da tabela controle.


**Report/PDF/pdf.html** - Aqui fica o modelo de html do relatório em pdf\
**Report/PDF/PdfReport.php** - Toda lógica para gerar o pdf é incluída aqui, neste arquivo a mPDF é chamada\
**Report/CalcDays.php** - Este arquivo recebe as horas, minutos e segundos vindos do banco e pega total de horas e retorna os dias dentro dessas horas\
**Report/Report.php** - Este arquivo faz a consulta no banco e retorna as horas, então chama o CalcDays para separar por dia - hora - minuto - segundo\
**Report/ReportFactory.php** - Este arquivo chama o Report com os dados de cada tipo de relatório, exemplo: horas dev/área/cliente


**Repositories/ControleRepository.php** - Este arquivo tem as regras de negócio da aplicação, ele é o responsável por chamar os arquivos necessários para adionar itens no banco, editar, deletar, filtrar, gerar relatórios, etc...

**Traits/** - Estão os arquivos responsáveis por corrigir as datas e horas antes de inserir no banco

**Views/Wiew.php** - Este aquivo faz o include dos arquivos na pasta files\
**Views/files/** - Estão os arquivos com o html da aplicação



## Como funciona a aplicação
Nesta aplicação você vê as entradas listadas no datatables, logo acima do datatables você tem os botões que interagem com o conteúdo e geram os gráficos e relatórios e acima disso tem o formulário de busca.


Todos os campos preenchidos na busca refletem na consulta no datatables e no gráfico e relatório, por exemplo: se eu quiser apenas os dados do Carlos, basta eu colocar o nome Carlos no campo dev e clicar em filtrar, depois disso você vai ter o gráfico e relatório usando os dados do formulário na hora de fazer o ajax para gerar a saída de cada um deles.\

**Obs:** Antes de gerar o pdf e o gráfico o sistema da um serialize() do jQuery no form de busca e envia os dados via ajax ai no backend eles são filtrados e o relatório gerado. Essa lógica do front-end fica no arquivo datatables.js em assets/js.

No datatables quando você clica em um campo você pode excluí-lo ou editá-lo usando os botões acima do datatables, no botão de + você incluí uma entrada nova, os botões selecionar e cancelar seleção servem para a exclusão de campos.
