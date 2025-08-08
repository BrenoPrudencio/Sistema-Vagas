# Sistema de Gestão de Vagas e Candidaturas

![Página de Listagem de Vagas](https://i.imgur.com/3xA8l1f.png)  
Aplicação web full-stack desenvolvida como parte de um desafio técnico para demonstrar competências em desenvolvimento backend com **PHP** e o framework **Laravel**. O sistema simula uma plataforma de recrutamento, permitindo o gerenciamento completo de vagas de emprego e de candidatos.

---

## 🚀 Tecnologias Utilizadas

- **Backend:** PHP 8.4, Laravel 12
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5, Tailwind CSS (via Laravel Breeze)
- **Banco de Dados:** MySQL (ou Postgres, configurável)
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
- **Listagem com Filtros:** A lista de vagas é paginada e pode ser filtrada dinamicamente por título, tipo de contratação (CLT, PJ, Freelancer) e status (Ativa, Pausada).

### 3. CRUD de Candidatos
- **CRUD completo** para o gerenciamento de candidatos.
- **Formatação de Dados:** O campo de telefone possui uma máscara de entrada no front-end para melhorar a experiência do usuário.
- **Listagem com Filtros:** A lista de candidatos é paginada e permite busca por nome ou e-mail.

### 4. Sistema de Inscrição
- **Relação Muitos-para-Muitos:** Um candidato pode se inscrever em múltiplas vagas, e uma vaga pode ter múltiplos candidatos.
- **Interface de Inscrição:** Quando clica no título de uma vaga, é possível ver a lista de candidatos já inscritos e inscrever novos candidatos a partir de uma lista.
- **Cancelamento de Inscrição:** É possível remover a inscrição de um candidato de uma vaga específica.

### 5. Melhorias de Usabilidade (Bônus)
- **Deleção em Massa:** As listas de vagas e candidatos permitem a seleção de múltiplos itens para exclusão em uma única ação.
- **Controle de Paginação:** O usuário pode escolher quantos itens deseja exibir por página (10, 20 ou 50).

### 6. API RESTful (Bônus)
- **Endpoints JSON:** Foram criados endpoints de API para os CRUDs de Vagas e Candidatos, retornando os dados em formato JSON.
- **Estrutura Organizada:** A API possui seus próprios controllers e rotas (`/api/*`), separada da aplicação web.

### 7. Qualidade e Boas Práticas
- **Testes Automatizados:** O projeto conta com uma suíte de testes de funcionalidade (Feature Tests) que cobrem os "caminhos felizes" e os "caminhos tristes" (validação) para os CRUDs, garantindo a estabilidade do código.
- **Dados de Teste (Seeders):** O banco de dados pode ser populado com um grande volume de dados falsos (`migrate:fresh --seed`), facilitando a demonstração de funcionalidades como paginação e filtros.

---

## ⚙️ Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e rodar a aplicação.

### Pré-requisitos
- PHP (versão compatível com Laravel 12)
- Composer
- Node.js e NPM
- Um servidor de banco de dados (ex: MySQL)

### Passo a Passo

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/BrenoPrudencio/Sistema-Vagas.git
    ```

2.  **Navegue até a pasta do projeto:**
    ```bash
    cd Sistema-Vagas
    ```

3.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

4.  **Instale as dependências do JavaScript:**
    ```bash
    npm install
    ```

5.  **Configure o Ambiente:**
    Copie o arquivo de exemplo `.env` e gere a chave da aplicação.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

6.  **Configure o Banco de Dados:**
    Abra o arquivo `.env` e atualize as credenciais do seu banco de dados.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sistema_vagas
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Lembre-se de criar um banco de dados vazio com o nome `sistema_vagas`.*

7.  **Crie a Estrutura e Popule o Banco:**
    Este comando irá criar todas as tabelas e preenchê-las com dados de teste.
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Compile os Assets para Produção:**
    ```bash
    npm run build
    ```

9.  **Inicie o Servidor:**
    ```bash
    php artisan serve
    ```

10. **Acesse e Utilize:**
    - Abra seu navegador e acesse `http://127.0.0.1:8000`.
    - Clique em **"Register"** para criar uma conta.
    - Após o login, você será redirecionado para o Dashboard, onde poderá navegar para as seções de **Vagas** e **Candidatos** através do menu superior.

---