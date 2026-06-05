# PROJETO - SO 
### PAO 🍞 — Projeto de Atividades Organizadas...

<p align="center">
  <img src="assets/decoracat.gif" width="120">
</p>

## 📌 Sobre o Projeto
Aplicação web desenvolvida para o gerenciamento e monitoramento de tarefas diárias, permitindo que usuários acompanhem suas atividades de forma organizada e segura.
Além das funcionalidades de gerenciamento de tarefas, o sistema possui um mecanismo de backup automático do banco de dados, garantindo maior proteção contra perda de informações.

#### Planejamento, Acompanhamento e Backup em um só lugar.

## 🎯 Principal Objetivo

#### Fornecer uma plataforma simples e eficiente para controle de atividades pessoais, aplicando conceitos de:

- Sistemas Operacionais
- Gerenciamento de dados
- Segurança da informação
- Automatização de processos
- Banco de dados

## ⚙️ Funcionalidades

### Autenticação de Usuários
Cadastro de novos usuários
Login seguro com senha criptografada
Encerramento de sessão (Logout)

### Gerenciamento de Tarefas
Criar tarefas
Atualizar status das tarefas
Excluir tarefas
Pesquisar tarefas por nome

### Monitoramento de Atividades

#### As tarefas são organizadas em três estados:
🔴 Em Falta
🔵 Em Execução
🟢 Finalizado

Isso permite acompanhar facilmente o andamento das atividades registradas.

### Sistema de Backup Automático

O sistema realiza backups do banco de dados de duas formas: Backup Dinâmico
Executado automaticamente sempre que: Uma tarefa é criada; Uma tarefa é atualizada; Uma tarefa é removida

#### Backup Semanal
Executado automaticamente a cada 7 dias, criando uma cópia histórica do banco de dados.
Os backups são armazenados em arquivos .sql, permitindo recuperação futura dos dados.

## 🔒 Segurança

- Senhas criptografadas com password_hash()
- Verificação segura com password_verify()
- Sessões PHP para autenticação
- Prepared Statements para evitar SQL Injection
  
## 📚 Conceitos Aplicados
- CRUD (Create, Read, Update, Delete)
- Sessões PHP
- Banco de Dados Relacional
- Backup Automatizado
- Controle de Usuários
- Persistência de Dados
- Segurança de Aplicações Web

👨‍💻 Projeto desenvolvido para a disciplina de Sistemas Operacionais como aplicação prática dos conceitos estudados.

<img src="assets/famosin.gif">
