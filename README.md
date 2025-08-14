<h1>Encurtador de URL - Back-end</h1>

<p>Este projeto é o back-end de um sistema de encurtamento de URLs, desenvolvido com foco na estrutura, testes e escalabilidade. Através dele, você poderá aprender mais sobre arquitetura de software, requisitos funcionais e não funcionais, além de práticas para tornar seu sistema mais robusto e preparado para crescimento.</p>

<h2>Visão Geral</h2>

<p>Este projeto foi criado para proporcionar uma compreensão prática sobre a construção de uma API de encurtamento de URLs, com foco em boas práticas de desenvolvimento, testes e organização de código. Além disso, estimulou o estudo de requisitos não funcionais essenciais para a escalabilidade de aplicações web.</p>

<h2>Como rodar o projeto</h2>

<h3>Clone o repositório</h3>

<pre><code>git clone https://github.com/DaviFreitas77/encurtador-de-url.git
cd encurtador-de-url
</code></pre>

<h3>Configuração inicial</h3>

<ol>
  <li>Crie o arquivo <code>.env</code> na raiz do projeto, baseando-se no arquivo <code>.env.example</code>:
    <pre><code>cp .env.example .env</code></pre>
  </li>
  <li>Gere a chave da aplicação:
    <pre><code>php artisan key:generate</code></pre>
  </li>
  <li>Instale as dependências do Composer:
    <pre><code>composer install</code></pre>
  </li>
  <li>Configure o banco de dados no arquivo <code>.env</code>. Crie o banco com o nome <strong>db_encurtador</strong>:
    <pre><code>DB_DATABASE=db_encurtador
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha</code></pre>
  </li>
  <li>Realize as migrações e seeders para criar a estrutura do banco:
    <pre><code>php artisan migrate:fresh --seed</code></pre>
  </li>
</ol>

<h3>Iniciando o servidor</h3>

<pre><code>php artisan serve</code></pre>

<p>Seu servidor estará acessível em: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></p>

<h2>Requisitos adicionais</h2>

<ul>
  <li><strong>Apache</strong> e <strong>MySQL</strong> devem estar ativos e configurados na sua máquina para rodar o projeto localmente na porta padrão 8000.</li>
  <li>Certifique-se de criar o banco de dados <strong>db_encurtador</strong> antes de rodar as migrações.</li>
</ul>

<h2>Observações importantes</h2>

<ul>
  <li>O projeto foi desenvolvido com foco em testes, estrutura bem definida e escalabilidade.</li>
  <li>Para um ambiente de produção, considere configurar ambiente adequado, segurança, cache e otimizações adicionais.</li>
</ul>

<h2>Contato</h2>

<p>Dúvidas ou sugestões? Entre em contato comigo pelo <a href="mailto:dfreitas.developer@gmail.com">dfreitas.developer@gmail.com</a>.</p>
