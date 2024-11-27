# Projeto PHP - Open Music

## Configuração e Execução com XAMPP

Este projeto é um exemplo de aplicação PHP. Este documento orienta como configurá-lo e executá-lo localmente usando o XAMPP.

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/index.html) instalado em sua máquina.
- Um editor de texto, como o [Visual Studio Code](https://code.visualstudio.com/), para edição de código.
- Navegador web para acessar a aplicação.

## Instalação e Configuração

1. **Baixe o XAMPP**

   - Faça o download do XAMPP na [página oficial](https://www.apachefriends.org/index.html).
   - Instale-o seguindo as instruções fornecidas para o seu sistema operacional.

2. **Clone este repositório**

   - Abra o terminal e execute:
     ```bash
     git clone https://github.com/NattanSilva/projeto-web-php.git
     ```
   - Alternativamente, faça o download do projeto como um arquivo `.zip` e extraia os arquivos.

3. **Copie o projeto para a pasta `htdocs`**

   - Localize o diretório `htdocs`, normalmente em:
     - Windows: `C:\xampp\htdocs`
     - macOS/Linux: `/opt/lampp/htdocs`
   - Copie os arquivos do projeto para a pasta `htdocs`. Você pode renomear a pasta para o nome desejado (exemplo: `meu-projeto`).

4. **Inicie o XAMPP**

   - Abra o painel de controle do XAMPP e inicie os serviços:
     - **Apache**
     - (Opcional) **MySQL** se o projeto utilizar um banco de dados.

5. **Configure o banco de dados (se necessário)**
   - Acesse o [phpMyAdmin](http://localhost/phpmyadmin) no navegador.
   - Crie um banco de dados para o projeto com o nome especificado (verifique no código do projeto).

## Executando o Projeto

1. Abra o navegador.
2. Acesse o seguinte endereço:

Substitua `<NOME-DA-PASTA>` pelo nome da pasta em que o projeto foi copiado para o `htdocs`.

## Problemas Comuns

- **Erro de porta ocupada para o Apache**:
- Isso ocorre se a porta padrão (80) estiver sendo usada por outro serviço.
- Alterne a porta no painel do XAMPP em _Config > Apache (httpd.conf)_, substituindo `Listen 80` por outra porta (ex.: `Listen 8080`).
- Acesse o projeto com a nova porta:

```
http://localhost:8080/<NOME-DA-PASTA>
```

- **Banco de dados não encontrado**:
- Certifique-se de que o banco foi criado corretamente e que as credenciais no código estão corretas.

## Contribuição

Sinta-se à vontade para abrir issues ou enviar pull requests para melhorias ou correções.

## Licença

Este projeto é licenciado sob a licença MIT. Consulte o arquivo `LICENSE` para mais informações.

## Desenvolvedores

- <a href="https://github.com/NattanSilva" target="_blank">Nattan Silva</a>
- <a href="https://github.com/EduardoCoura" target="_blank">Eduardo Coura</a>
- <a href="https://github.com/Dereck234" target="_blank">Dereck Patrik</a>
- <a href="#" target="_blank">Alawander</a>
- <a href="https://github.com/Gabriellucas20" target="_blank">Gabriel Lucas</a>