# Electronic Origami (e-origami)

WordPress theme based on **Bootstrap**, **Font Awesome** and **jQuery**, designed for **design portfolios and personal websites**.

The theme intentionally **does not use the Gutenberg block editor** and is built entirely with the **classic WordPress templating approach**.

---

## Filosofia del progetto

Electronic Origami è concepito come un **dimostratore di layout**.

All'interno del tema sono presenti tre varianti grafiche:

- **Origami** – tema principale del sito
- **Shodo**
- **Nostalgia**

Le varianti **Origami** e **Shodo** sono basate sul concetto di **inversione dell’ordine di scrittura**, descritto qui:

https://www.marziodev.it/visione/

La variante **Nostalgia** è invece ispirata ai **layout tradizionali del web pre-block editor**.

Le tre varianti sono progettate per essere **quasi indipendenti** tra loro.  
Ognuna utilizza il proprio file `style.css`, caricato solo all’interno delle pagine che utilizzano quel layout.

---

## Architettura tecnica

Il tema è sviluppato secondo la **metodologia classica di WordPress**, utilizzando:

- PHP
- HTML5
- CSS
- WordPress Template Hierarchy
- funzioni e hook nativi di WordPress

Non vengono utilizzati framework di templating esterni.

---

## Disabilitazione Gutenberg

Il tema include una serie di funzioni e hook per **disabilitare completamente Gutenberg**.

Queste funzionalità sono implementate nel file: inc/gutenberg.php


---

## Funzionalità non incluse

Per scelta progettuale il tema **non implementa**:

- sistema di commenti
- integrazione con il **WordPress Customizer**

---

## Funzionalità integrate nel tema

Alcune funzionalità tipicamente delegate ai plugin sono state implementate direttamente nel tema tramite funzioni dedicate.

Questo approccio è stato adottato per **ridurre l'affollamento di plugin**, migliorando:

- prestazioni
- sicurezza
- controllo del codice
- SEO

Funzionalità incluse:

### Shortcode e componenti

- Social media shortcode
- Stat cards
- Document Download Widget
- Pulsanti per social sharing

### Gestione utenti

- Gestione avanzata dei profili utente

### Sicurezza

- Messaggio personalizzato per login fallito
- URL di login personalizzata
- Disabilitazione XML-RPC

### Accessibilità

Controlli implementati nel file `main.js`.

Funzionalità disponibili:

- controllo della dimensione del font sul front-end
- gestione del contrasto (attualmente non attiva)
- attributi ARIA per i controlli di dimensione del font
- attributi ARIA per i controlli di contrasto (non attivi)

---

## Stack tecnologico

- WordPress
- PHP
- HTML5
- CSS
- Bootstrap
- Font Awesome
- jQuery
