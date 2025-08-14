
## Visão geral

    Esse é o back-end em de um encurtador de URL,que me permitiu ter uma visão maior de estrutura e desenvolver orientado a testes,algo que ja tinha mechido em projetos prontos porem nunca começado um do zero.O projeto me fez querer estudar além de apenas códigos e entender a estrutura de um software com seus requisitos funcionais e principalemte os não funcionais porem que são essenciais para a escalabidade do proejto.


## Como rodar o projeto

# clone o repositório
git clone https://github.com/DaviFreitas77/encurtador-de-url.git
cd encurtador-de-url

# Na raiz do projeto 
crie o arquivo .env e colo o .env.exemple

# Gerando key
php artisan key:generate

# Instalar dependencias
composer install

# Rodar migration com seeders
php artisan migrate:fresh --seed 

# Iniciar servidor
php artisan serve
seu servidor estará rodando em http://127.0.0.1:8000

# ATENÇÃO
certifique-se de ligar o apache o e mysql para rodar localmente na port :8000
logo após crie o banco db_encurtador para dar inicio a rodar a migration.


