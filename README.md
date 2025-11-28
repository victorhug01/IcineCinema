## Nome e RA
- Otavio Henrique de Sá e Silva - 2039341
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

- **Cinema**: Gerencia o nome (string) e um array de salas (`Sala`); fornece métodos para adicionar salas e listar informações do cinema.
- **Sala**: Controla número (int), capacidade (int) e ocupação dos assentos; mantém array de `Ingresso`s vendidos e fornece método para verificar disponibilidade de assento.
- **Filme**: Armazena informações do filme (`titulo`, `duracao` em minutos, `classificacao`); fornece getters para acesso aos dados.
- **Sessao**: Relaciona um `Filme`, uma `Sala`, horário (`DateTimeImmutable`) e array de `Ingresso`s vendidos; gerencia dados da exibição.
- **Bilheteria**: Gerencia a venda de ingressos; valida assento disponível e ocupação máxima da sala, criando objetos `Ingresso` quando bem-sucedido.
- **Ingresso**: Representa cada ingresso vendido, armazenando referência ao `Pessoa` comprador, `Sessao`, número do assento (int) e valor (float).
- **Pessoa**: Identifica o cliente que compra o ingresso, com `nome` (string) e `telefone` (string opcional); fornece getters para acesso aos dados.
- **Produto (abstract)**: Classe base para itens vendáveis na bomboniere (`codigo`, `nome`, `preco`), com `descricao()` abstrata e `calcularPreco()`.
- **Comida (extends Produto)**: Subclasse de `Produto` para alimentos (salgados, doces), com propriedade `tipo` e comportamento próprio de preço/descrição.
- **Bebida (extends Produto)**: Subclasse de `Produto` para bebidas, com `volume` (ml) e `alcoolica` (bool); pode ajustar preço se alcoólica.
- **ItemEstoque**: Associa um `Produto` a uma `quantidade` disponível no estoque; métodos para aumentar/reduzir quantidade.
- **Estoque**: Gerencia um array associativo de `ItemEstoque` indexado por código (fornece CRUD, obter e reduzir quantidade).
- **Venda**: Representa uma transação na bomboniere (id, produto, quantidade, total, data) e calcula total via `produto->calcularPreco()`.
- **Bomboniere**: Controlador que usa `Estoque` para cadastrar/editar/excluir/listar/vender produtos e registrar `Venda`s.

