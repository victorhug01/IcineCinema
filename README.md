## Nome e RA
- Nicolas Emanuel Pinheiro - 2039083 
- Miguel Venancio de Oliveira 2038422
- Miguel Vinicius de Oliveira Ferreira 2038440
- Victor Hugo Barros Baptista Pereira - 2042140

# Icine - Sistema de Cinema (CLI)

Bem-vindo ao Icine! Este é um sistema simples de cinema para terminal, onde você pode criar cinemas, salas, filmes, sessões e vender ingressos de forma interativa.

## Requisitos
- PHP 8.0 ou superior
- Composer (para autoload)

## Instalação
1. Clone ou baixe este repositório.
2. Instale as dependências do autoload:
   ```
   composer install
   ```
3. Gere o autoload do Composer (se necessário):
   ```
   composer dump-autoload
   ```

## Como rodar
Execute o sistema no terminal com:
```
php index.php
```


## Estrutura do sistema
O projeto é organizado em classes, cada uma representando um conceito do cinema:

- **Cinema**: Gerencia o nome e as salas do cinema.
- **Sala**: Controla número, capacidade e ocupação dos assentos.
- **Filme**: Armazena informações do filme (título, duração, classificação).
- **Sessao**: Relaciona filme, sala, horário e ingressos vendidos.
- **Bilheteria**: Gerencia a venda de ingressos, garantindo ocupação correta.
- **Ingresso**: Representa cada ingresso vendido, com dados do comprador e assento.
- **Pessoa**: Identifica o cliente que compra o ingresso.
