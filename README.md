# Task Manager

Web application sviluppata con **Laravel** per la gestione di una lista personale di attività (*task*), con possibilità di creazione, modifica ed eliminazione.

Ogni task è associata all'utente che l'ha creata e può essere caratterizzata da titolo, descrizione, data di scadenza, priorità e stato. L'applicazione esegue inoltre la validazione dei dati lato server e controlli di autenticazione e autorizzazione, garantendo che ogni utente possa accedere e modificare esclusivamente le proprie attività.

## Funzionalità

### Autenticazione

Il sistema presenta le seguenti funzionalità di autenticazione:

- Registrazione, login e logout di un utente.
- Validazione server-side dei dati di registrazione.
- Hashing delle password tramite le funzionalità native di Laravel.
- Protezione delle pagine riservate mediante middleware `auth`.

### Gestione dei task

L'utente autenticato può eseguire le seguenti operazioni:

- visualizzare l'elenco dei propri task;
- creare un nuovo task;
- modificare un task esistente;
- eliminare un task previa conferma.

Ogni task è associato all'utente che l'ha creata e contiene i seguenti dati:

- **Titolo**
- **Descrizione**, opzionale
- **Data di scadenza**
- **Priorità**: bassa, media o alta
- **Stato**: da fare, in corso o completato

I task appartenenti ad altri utenti non possono essere visualizzati, modificati o eliminati, nemmeno nel caso in cui l'ID del task venga inserito manualmente nell'URL.

## Requisiti

Per eseguire il progetto sono necessari:

- **PHP 8.3** o superiore
- **Composer**
- **Docker**
- **Docker Compose**

L'utilizzo di Docker permette di eseguire l'applicazione all'interno di un ambiente di sviluppo configurato e riproducibile.

## Tecnologie utilizzate
Per la realizzazione del progetto, sono state utilizzate le seguenti tecnologie:

- **PHP 8.5**: linguaggio di programmazione server-side utilizzato per la logica di backend dell'applicazione;
- **Laravel 13**: framework PHP per lo sviluppo web, utilizzato per la realizzazione della web app secondo il pattern MVC (Model-View-Controller);
- **Blade**: motore di template di Laravel, utilizzato per la creazione delle viste dell'applicazione;
- **MySQL 8.4**: sistema di gestione di database relazionali;
- **HTML/CSS**: markup e stili per la creazione delle interfacce utente;
- **Bootstrap 5.3**: framework CSS per la creazione di interfacce utente responsive e moderne;
- **Docker**: piattaforma per la creazione e gestione di container, utilizzata per realizzare un ambiente di sviluppo isolato per il testing dell'applicazione, in particolare mediante l'utilizzo del tool **Docker Compose**;
- **PHPUnit**: framework per la realizzazione di test automatici del codice PHP, utilizzato in particolare per verificare la corretta gestione dell'autenticazione e dell'autorizzazione degli utenti;
- **Laravel Pint**: tool per il linting del codice PHP secondo le best practices di Laravel.

## Installazione

### Clonazione del repository

Clonare il repository e accedere alla directory del progetto:

```bash
git clone https://github.com/gerrygrimaldi/Task-Manager.git task-manager
cd task-manager
```

### Installazione delle dipendenze

Le dipendenze PHP del progetto sono gestite tramite **Composer**. Se il progetto viene eseguito direttamente sull'host, possono essere installate con il comando:

```bash
composer install
```

Nell'ambiente Docker, esso viene eseguito automaticamente durante la build del container dell'applicazione.

La directory `vendor` non è inclusa nel repository e viene generata automaticamente durante l'installazione delle dipendenze.

### Configurazione dell'ambiente

Per poter avviare l'applicazione, è necessario innanzitutto configurare l'ambiente copiando il file `.env.example` in `.env`:

```bash
cp .env.example .env
```

Generare quindi la chiave dell'applicazione:

```bash
php artisan key:generate
```

Il progetto è stato configurato per utilizzare **MySQL** come sistema di gestione di database, pertanto nel file `.env` saranno presenti le seguenti impostazioni di connessione al database MySQL:

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=task_manager
DB_PASSWORD=task_manager_password
```

## Avvio dell'ambiente Docker

Il progetto è stato configurato per essere eseguito all'interno di un ambiente di sviluppo basato su **Docker Compose**. Si presuppone pertanto che Docker e Docker Compose siano già installati sulla macchina host. La configurazione dei servizi è definita nel file `compose.yaml`, che include:
- un container per l'applicazione Laravel;
- un container per il database MySQL;
- un container per la visualizzazione del database tramite **phpMyAdmin**.

Per creare e avviare i container, eseguire:

```bash
docker compose up -d --build
```
Con questo comando, Docker Compose ricostruisce l'immagine dell'applicazione utilizzando il `Dockerfile` presente nella directory del progetto e avvia i container in background. L'applicazione sarà quindi accessibile all'indirizzo `http://localhost:8000`, mentre phpMyAdmin sarà accessibile all'indirizzo `http://localhost:8080`.

Per arrestare l'ambiente:

```bash
docker compose down
```

Per visualizzare i log dei container:

```bash
docker compose logs -f
```

## Database
All'interno della rete Docker, il database MySQL è raggiungibile dall'applicazione tramite il nome del servizio `mysql` sulla porta `3306`.

Le tabelle del database che saranno utilizzate dall'applicazione possono essere create tramite le **migration** di Laravel, richiamabili con il comando:

```bash
docker compose exec app php artisan migrate
```

> **Nota**
>
> Se si esegue il progetto senza Docker, il database MySQL deve essere installato e configurato manualmente sulla macchina host. Le impostazioni di connessione nel file `.env` devono essere modificate di conseguenza.
>
> Le migration possono essere eseguite con:
>
> ```bash
> php artisan migrate
> ```
>
> Inoltre, per eseguire l'applicazione in locale, è necessario avviare il server di sviluppo Laravel con il comando:
>
> ```bash
> php artisan serve
> ```

## Queue Worker

L'applicazione non utilizza attualmente job o code per l'esecuzione di operazioni in background. Tuttavia, per completezza, è possibile avviare un worker delle code con il comando:

```bash
php artisan queue:work
```

Il comando non è necessario per il normale funzionamento dell'applicazione.

## Testing

Il progetto include test automatici realizzati con il framework di Laravel basato su **PHPUnit**, con lo scopo di verificare il corretto funzionamento di alcune funzionalità critiche dell'applicazione. Per eseguire la suite di test, eseguire il comando:

```bash
php artisan test
```

## Scelte implementative

L'applicazione è stata sviluppata seguendo la struttura e le convenzioni del framework Laravel.

In particolare:

- i controller ricevono le richieste HTTP, interagiscono con i model e restituiscono le risposte mediante viste Blade;
- i model rappresentano le singole entità del database, e quindi le classi mediante le quali è possibile interagire direttamente con le tabelle del database per eseguire le operazioni CRUD sui dati;
- le viste Blade rappresentano la logica di presentazione dei dati, ossia la parte dell'applicazione che l'utente finale visualizza e con cui interagisce;
- le Form Request centralizzano la validazione dei dati in ingresso e, per le operazioni sui task, verificano che l'utente sia autorizzato a eseguire l'operazione richiesta;
- la policy TaskPolicy definisce le regole di autorizzazione per le operazioni sui task;
- le migration definiscono la struttura del database, creando e modificando le tabelle necessarie per il funzionamento dell'applicazione.

Il progetto è stato sviluppato senza utilizzare pacchetti aggiuntivi, implementando le funzionalità richieste utilizzando gli strumenti forniti nativamente da Laravel.