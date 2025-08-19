# Sistema de Gestão de Vagas e Candidaturas

![Página de Listagem de Vagas](https://i.imgur.com/3xA8l1f.png)  
Aplicação web full-stack desenvolvida como parte de um desafio técnico para demonstrar competências em desenvolvimento backend com **PHP** e o framework **Laravel**. O sistema simula uma plataforma de recrutamento, permitindo o gerenciamento completo de vagas de emprego e de candidatos.

---

## 🚀 Tecnologias Utilizadas

- **Backend:** PHP, Laravel
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5, Tailwind CSS (via Laravel Breeze)
- **Banco de Dados:** MySQL
- **Ambiente de Desenvolvimento:** Docker, Laravel Sail
- **Gerenciamento de Dependências:** Composer, NPM
- **Testes:** PHPUnit
- **Versionamento:** Git & GitHub

---

## ✨ Funcionalidades Principais

Este projeto implementa todas as funcionalidades solicitadas no desafio, incluindo diversos bônus para demonstrar uma aplicação mais robusta e completa.

### 1. Autenticação de Usuários
- Sistema completo de **Registro** e **Login** utilizando Laravel Breeze.
- As rotas de gerenciamento são protegidas, garantindo que apenas usuários autenticados possam acessar, criar, editar ou excluir dados.

### 2. CRUD de Vagas
- **Criação, Leitura, Atualização e Exclusão (CRUD)** de vagas de emprego.
- **Pausa de Vagas:** Uma vaga pode ter seu status alterado para "Pausada", o que impede que novos candidatos se inscrevam nela.
- **Listagem com Filtros:** A lista de vagas é paginada e pode ser filtrada dinamicamente por título, tipo de contratação e status.

### 3. CRUD de Candidatos
- **CRUD completo** para o gerenciamento de candidatos.
- **Formatação de Dados:** O campo de telefone possui uma máscara de entrada no front-end para melhorar a experiência do usuário.
- **Listagem com Filtros:** A lista de candidatos é paginada e permite busca por nome ou e-mail.

### 4. Sistema de Inscrição
- **Relação Muitos-para-Muitos:** Um candidato pode se inscrever em múltiplas vagas, e uma vaga pode ter múltiplos candidatos.
- **Interface de Inscrição:** Na página de detalhes de uma vaga, é possível ver a lista de candidatos já inscritos e inscrever novos candidatos.
- **Cancelamento de Inscrição:** É possível remover a inscrição de um candidato de uma vaga específica.

### 5. Melhorias de Usabilidade (Bônus)
- **Deleção em Massa:** As listas de vagas e candidatos permitem a seleção de múltiplos itens para exclusão em uma única ação.
- **Controle de Paginação:** O usuário pode escolher quantos itens deseja exibir por página.

### 6. API RESTful (Bônus)
- **Endpoints JSON:** Foram criados endpoints de API para os CRUDs de Vagas e Candidatos, retornando os dados em formato JSON.

### 7. Qualidade e Boas Práticas
- **Ambiente Dockerizado:** A aplicação utiliza **Laravel Sail**, garantindo um ambiente de desenvolvimento consistente, portátil e isolado.
- **Testes Automatizados:** O projeto conta com uma suíte de testes de funcionalidade (Feature Tests) que cobrem os CRUDs.
- **Dados de Teste (Seeders):** O banco de dados pode ser populado com um grande volume de dados falsos.

---

## 🐳 Instalação com Docker (Laravel Sail) - Método Recomendado

Este projeto foi configurado para ser executado em um ambiente Docker, garantindo consistência e facilidade na configuração.

### Pré-requisitos
- Docker Desktop
- WSL2 (para usuários Windows) ou um ambiente Linux/macOS.

### Passo a Passo

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/BrenoPrudencio/Sistema-Vagas.git
    ```

2.  **Navegue até a pasta do projeto:**
    ```bash
    cd Sistema-Vagas
    ```

3.  **Configure o Ambiente:**
    Copie o arquivo de exemplo `.env`. Ele já vem pré-configurado para o Sail.
    ```bash
    cp .env.example .env
    ```

4.  **Instale as dependências do Composer:**
    *Este comando usa uma imagem Docker temporária para instalar os pacotes PHP.*
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

5.  **Inicie os Containers do Sail:**
    *O download das imagens pode ser demorado na primeira vez.*
    ```bash
    # Para Linux/macOS/WSL
    ./vendor/bin/sail up -d
    ```

6.  **Execute os Comandos de Finalização:**
    *Use o Sail para executar os comandos Artisan e NPM dentro dos containers.*
    ```bash
    ./vendor/bin/sail npm install
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate:fresh --seed
    ./vendor/bin/sail npm run build
    ```

7.  **Acesse a Aplicação:**
    - Abra seu navegador e acesse `http://localhost`.
    - Você pode se registrar com um novo usuário para começar.

Para parar os containers, use o comando `./vendor/bin/sail down`.

---