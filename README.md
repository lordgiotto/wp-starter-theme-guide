# ITS WP Starter theme

## Tema di Wordpress, da dove si parte.

Per creare un nuovo tema di Wordpress basta creare una nuova cartella dentro `/wp-content/themes/` con all'interno due file `style.css` e `index.php`.
Perchè il tema venga riconosciuto bastano questi due files, anche vuoti.

Per iniziare basta mettere questi files in una cartella `/wp-content/themes/NOME_TEMA/`.

## Tipologie di dato di default Wordpress

Wordpress ha due principali tipologie di dato di default: pages e posts.

La differenza principale tra le due è che le pagine possono avere una struttura gerarchica, mentre i post hanno una struttura piatta.

Nell'interfaccia di amministrazione ci sono due voci relative che permettono di aggiungere nuove pagine o nuovi post.

## Tipologie di dato personalizzate

E' possibile, oltre i due tipi di dato principali, creare nuove tipologie di dato, che vengono chiamati **Custom Post Type** (o abbreviato **CPT**).

Nell'interfaccia di backoffice verrà creata una nuova pagina per ogni CPT creato.

Per vedere come creare un CPT fate riferimento al file `inc/cpt_project.php`.

## Templates

Quando viene richiesta una pagina dal browser, Wordpress utilizza diversi template sulla base di cosa è stato richiesto.

Nella root del tema è possibile creare diversi template per ogni tipologia di pagina richiesta.

### `header.php` e `footer.php`

Questi template non vengono mai mostrati singolarmente, ma possono esser richiamati negli altri template con le funzioni relative:

```
  <?php get_header(); ?>
```

```
  <?php get_footer(); ?>
```

### `index.php`

È il template più generico e viene utilizzato se nessun altro template risponde alle necessità della pagina richiesta.

### `home.php`

Viene utilizzato quando si richiede la pagina principale del sito, ma solo nel caso l'impostazione Impostazioni -> Lettura-> "La tua homepage mostra" sia impostata su "Gli ultimi articoli".

### `front-page.php`

Viene utilizzato quando si richiede la pagina principale del sito, ma sia nel caso l'impostazione Impostazioni -> Lettura-> "La tua homepage mostra" sia impostata su "Gli ultimi articoli" o su "Una pagina statica".

Se questo template è presente, il template `home.php` verrà ignorato.

### `page.php`

Viene utilizzato quando si richiede una pagina, cioè un tipo di dato 'page'.

### `single.php`

Viene utilizzato quando si richiede un post specifico, cioè un tipo di dato 'post'.

### `single-CPT_NAME.php`

Viene utilizzato quando si richiede un post specifico di tipo *CPT*, dove *CPT_NAME* è il nome del tipo di post personalizzato.

Quindi, se è stato creato un tipo di post personalizzato "project", il nome del template sarà `single-project.php`.

### `archive-CPT_NAME.php`

Viene utilizzato quando si richiede l'archivio dei post di tipo *CPT*, dove *CPT_NAME* è il nome del tipo di post personalizzato.

Quindi, se è stato creato un tipo di post personalizzato "project", il nome del template sarà `archive-project.php`.

### `404.php`

Questo template viene utilizzato se viene richiesta una pagina che non esiste.

### Template di pagina personalizzati

È possibile creare dei template di pagina personalizzati.

Per farlo è necessario creare nella root del tema un file php con un nome qualsiasi, ed aggiungere come prima riga:

```
<?php /* Template Name: Nome del template */ ?>
```

Fatto questo, creando una pagina nel backoffice, sarà possibile scegliere come template il nuovo template creato. Quando questa pagina verrà richiesta dal browser, verrà usato questo file php come template.

## URL degli asset situati nella cartella del tema

Quando vuoi aggiungere al tuo html un asset che si trova dentro la cartella del tema, ad esempio un'immagine, devi specificare l'URL completo, altrimenti il browser lo cercherà relativamente all'url che stai navigando.

Poniamo ad esempio che tu abbia nella cartella del tema una cartella `img` con dentro un file `pippo.jpg`, e che tu stia navigando la pagina principale del sito all'url `http://localhost:8000`: se metti un tag image `<img src="img/pippo.jpg">` il browser cercherà l'immagine in `http://localhost:8000/img/pippo.jpg`, ovviamente non trovandola (non esiste nessuna cartella img dentro la root di wordpress).

Questo perchè l'immagine si trova nella cartella del tema, quindi `http://localhost:8000/wp-content/themes/NOME_TEMA/img/pippo.jpg`.

Per risolvere questo problema, e per non dover mettere il percorso completo con il rischio che il tema non funzioni se posizionato in una cartella di nome diverso, Wordpress mette a disposizione la funzione `get_template_directory_uri();`

```html
<img src="<?php echo get_template_directory_uri(); ?>/pippo.jpg">
```

Ora, aprendo il browser, si può notare che l'url dell'imagine caricato è `http://localhost:8000/wp-content/themes/NOME_TEMA/img/pippo.jpg`.

## Come mostrare i dati richiesti dentro un template

Ogni volta che viene richiesta una pagina dal browser viene utilizzato da Wordpress il template relativo alla pagina richiesta.

In questo template è possibile mostrare quindi i dati richiesti: per farlo si può utilizzare quello che viene chiamato **il loop**.

```php
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php 
        // Qui dentro si può accedere alla variabile $post, 
        // contenente ogni ciclo uno delle risorse richieste per quella pagina.
      ?>
    <?php endwhile; ?>
  <?php endif; ?>
```

All'interno del loop è possibile accedere alla variabile `$post` che fa riferimento ogni ciclo ad uno dei dati richiesti per la pagina.

Invece di accedere alla variabile `$post` spesso è sufficiente utilizzare degli helper di Wordpress come `the_title()`, `the_content()`, `the_post_thumbnail()`, etc.

### Quali dati vengono mostrati nel loop?

Dipende dalla pagina richiesta. Per fare due esempi:

- Se viene richiesta una pagina od un post specifico, verrà utilizzato il template `single.php` ed il loop conterrà un solo elemento, cioè il post richiesto.

- Se viene richiesta un archivio, verrà utilizzato il template `archive.php` ed il loop conterrà n elementi del tipo di post richiesto, dove n è il numero massimo impostato per la paginazione.

## Modificare il comporamento di Wordpress

Quando viene caricato il tema, wordpress esegue subito il codice che trova dentro il file `functions.php`.

*Per tenere un po' di ordine in questo progetto il file functions.php importa altri files, ma si potrebbe scrivere tutto all'interno del solo file functions.php.*

### Gli Hooks

Per modificare il comportamento di Wordpress, o per configurare il comportamento del tema, è necessario dire a Wordpress *quando* eseguire il codice, cioè in quale momento del suo flusso di caricamento.

Per fare questo Wordpress mette a disposizione degli **hooks**, cioè dei "ganci" ai quali potersi attaccare con delle funzioni per eseguire il codice in un momento specifico: alcuni esempi di hooks sono `init` (all'inizializzazione di wordpress), `after_setup_theme` (dopo che il tema è stato configurato), `wp_enqueue_scripts` (momento nel quale wordpress registra gli asset css e js da caricare nelle pagine), etc.

Potete trovare alcuni esempi all'interno dei files in `/inc/` di questo progetto, mentre la documentazione completa degli hook è reperivbile su https://codex.wordpress.org/Plugin_API/Hooks

## Risorse, Reference e Guide

### Reference ufficiale per lo sviluppo Wordpress

- https://codex.wordpress.org/
- https://developer.wordpress.org/

### Reference per la creazione di temi 

- https://codex.wordpress.org/Theme_Development

### Tools utili

- https://generatewp.com/

### Guides

- https://premium.wpmudev.org/blog/theme-development/ ed in generale altri articoli da https://premium.wpmudev.org/blog/
- http://www.wpexplorer.com/create-wordpress-theme-html-1/
- https://www.google.it/search?q=create+wp+themes
