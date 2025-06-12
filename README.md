# Fiscaliza+   

## 📌 Tecnologias Utilizadas  

- **Laravel**
- **PHP**  
- **MySQL**    
- **phpMyAdmin**
- **Docker Compose**

## 🚀 Como Rodar o Projeto  

### 🔧 Pré-requisitos  

Antes de começar, instale os seguintes programas na sua máquina:  

- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/) (Recomendado: LTS)

### ▶️ Rodando o Projeto  

1. **Configurar o ambiente**  
   - Copie e cole o arquivo `.env.example` e renomeie para `.env`.  
   - Copie e cole o seguinte código dentro do arquivo `.env`:  

   ```env

   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=fiscaliza
   DB_USERNAME=fiscaliza
   DB_PASSWORD=fiscaliza123

   ```

2. **Subir os containers do projeto**  
   ```bash
   docker-compose up --build -d
   ```

3. **Acessar o container do back-end**  
   ```bash
   docker exec -it back_fiscaliza bash   
   ```

4. **Instalar as dependências do Laravel**  
   ```bash
   composer install
   ```

5. **Gerar a chave do projeto Laravel**  
   ```bash
   php artisan key:generate
   ```

6. **Criar as tabelas no banco de dados**  
   ```bash
   php artisan migrate
   ```
### 🎯 Acesse o Projeto  

- **Front-end:** [http://localhost/](http://localhost/)  
- **phpMyAdmin:** [http://localhost:8082](http://localhost:8081)

## ➕ Comandos Úteis  

### 🔄 Limpar o cache e imagens do Docker

```bash
docker system prune -a
```
### Subir os containers 
```bash
docker-compose up -d
```
### Remover containers
```bash
docker-compose down
```
