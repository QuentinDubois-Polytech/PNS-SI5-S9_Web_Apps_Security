# TP2

**Question 1 : Perform a store XSS attack to [guestbook.php](http://localhost:8080/tp2/ressources/guestbook.php). Defend this with a CSP header.**

**Script : [tp2/ressources/guestbook.php (localhost live)](http://localhost:8080/tp2/ressources/guestbook.php) | [tp2/ressources/guestbook.php (code)](/src/tp2/ressources/guestbook.php)**

**Deux manières de le faire :**

En marquant en message le code suivant :

```html
<script>alert('xss')</script>
```

On inscrit dans `messages.txt` notre XSS.

**Seconde manière : On peut aussi le faire manuellement directement via le fichier PHP qui s'en occupe :**

Il faut rentrer dans le champ input de la page web du code JavaScript à exécuter dans une balise script.  
Le navigateur va contacter un autre script avec la valeur de l'input dans le paramètre "message".

```bash
http://localhost:8080/tp2/ressources/guestbookleavemessage.php?message=<script>alert('xss')</script>
```

Le champ de l'utilisateur va être stocké côté serveur.  
Nous permettant de réaliser une XSS stored. Lorsque l'utilisateur va recharger la page `tp2/guestbook.php`, le contenu du fichier va être récupéré et le code contenu à l'intérieur va être exécuté.

Pour mettre en place le *CSP  header* (Content Security Policy) sur le script PHP. Il faut rajouter le code php suivant au début du script.

```php
header("Content-Security-Policy: script-src 'self'");
```

Maintenant le client va exécuter que les balises script qui ont pour origine celui du serveur, donc localhost.

Résultat :

- [tp2/mycode/guestbook_csp_header.php (localhost live)](http://localhost:8080/tp2/mycode/guestbook_csp_header.php)
- [tp2/mycode/guestbook_csp_header.php (code)](/src/tp2/mycode/guestbook_csp_header.php)

---

**Question 2 : xssme.php perform all the attacks and generate protectedxssme.php to defend.**  
**Do htmlentities or htmlspecialchars work in every context of [xssme.php](http://localhost:8080/tp2/ressources/xssme.php)? If not, explain and correct.**

**Script : [tp2/ressources/xssme.php (localhost live)](http://localhost:8080/tp2/ressources/xssme.php) | [tp2/ressources/xssme.php (code)](/src/tp2/ressources/xssme.php)**

Paramètre : htmlcontext

```bash
htmlcontext=<script>alert('xss');</script>
htmlcontext=%3Cscript%3Ealert(%22xss%22)%3C/script%3E
```

<http://localhost:8080/tp2/ressources/xssme.php?htmlcontext=%3Cscript%3Ealert(%22xss%22)%3C/script%3E>

Paramètre : attributecontext1

```bash
attributecontext1='' onerror=alert('xss')
attributecontext1=%27%27%20onerror=alert(%22xss%22)
```

<http://localhost:8080/tp2/ressources/xssme.php?attributecontext1=%27%27%20onerror=alert(%22xss%22)>

Paramètre : attributecontext2

```bash
attributecontext2="" onerror=alert('xss')
attributecontext2=%22%22%20onerror=alert(%22xss%22)
```

<http://localhost:8080/tp2/ressources/xssme.php?attributecontext2=%22%22%20onerror=alert(%22xss%22)>

Paramètre : attributecontext3

```bash
attributecontext3='' onerror=alert('xss')
attributecontext3=%27%27%20onerror=alert(%27xss%27)
```

<http://localhost:8080/tp2/ressources/xssme.php?attributecontext3=%27%27%20onerror=alert(%27xss%27)>

Paramètre : scriptcontext

```bash
scriptcontext=alert('xss')
scriptcontext=alert(%22xss%22)
```

<http://localhost:8080/tp2/ressources/xssme.php?scriptcontext=alert(%22xss%22)>

Paramètre : attributecontextonerror

```bash
attributecontextonerror=alert('xss')
attributecontextonerror=alert(%22xss%22)
```

<http://localhost:8080/tp2/ressources/xssme.php?attributecontextonerror=alert(%22xss%22)>

**Défenses :**

Il faut mettre en place le CSP sur le script-src avec pour valeur self.

```php
header("Content-Security-Policy: script-src 'self'");
```

Un autre moyen est d'encoder les inputs utilisateurs avec des fonctions d'encoding comme htmlentities et htmlspecialchars en php.

Résultat :

- [tp2/mycode/protectedxssme.php (localhost live)](http://localhost:8080/tp2/mycode/protectedxssme.php)
- [tp2/mycode/protectedxssme.php (code)](/src/tp2/mycode/protectedxssme.php)

**Question 3 : Write code to defend and attack for each of the contexts described for XSS and DOM-XSS in the OWASP cheatsheets.**

Exploitation XSS sur les différents scripts :

**Script : [tp2/ressources/domxss4.html (localhost live)](http://localhost:8080/tp2/ressources/domxss4.html) | [tp2/ressources/domxss4.html (code)](/src/tp2/ressources/domxss4.html)**

```bash
x=<script>alert('xss');</script>
x=%3Cscript%3Ealert(%22xss%22)%3C/script%3E
```

<http://localhost:8080/tp2/ressources/domxss4.html?x=%3Cscript%3Ealert(%22xss%22)%3C/script%3E>

**Script : [tp2/ressources/domxss5.html (localhost live)](http://localhost:8080/tp2/ressources/domxss5.html) | [tp2/ressources/domxss5.html (code)](/src/tp2/ressources/domxss5.html)**

Mettre une balise script dans l'input ne fonctionne pas, car dans la spécification de HTML :  
"a `<script>` tag inserted with `innerHTML` should not executed."  
(Source : [Element: innerHTML property - Web APIs | MDN (mozilla.org)](https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML))

Le moyen est donc d'injecter du code javascript, mais sans utiliser une balise script.  
L'une des manières de faire est d'utiliser une balise img.

```bash
<img src='' onerror=alert('xss');>
```

**Script : [tp2/ressources/domxss6.html (localhost live)](http://localhost:8080/tp2/ressources/domxss6.html) | [tp2/ressources/domxss6.html (code)](/src/tp2/ressources/domxss6.html)**

`window.location.hash` permet de récupérer les fragments qui sont spécifiés dans l'url par l'utilisateur c'est-à-dire, l'ensemble des paramètres spécifiés après le caractère `#`.

```txt
http://localhost:8080/tp2/ressources/domxss6.html#myhash'onmouseover='alert(1)
```

Note : on ne peut pas encoder les caractères `"` et `'` avec des `%22` et `%27` car le navigateur va les décoder et les interpréter comme les trois caractères et pas leur valeur encodée.

Le code javascript s'exécute lorsque l'utilisateur clique sur la balise input.

**Défenses contre XSS :**

- Utiliser le mécanisme CSP
- Encoder les inputs utilisateurs en caractères html

**Défenses contre XSS-DOM :**

- Utiliser le mécanisme de CSP
- Encoder les inputs utilisateurs en caractères html
- Utiliser l'API Trusted Types ([Trusted Types API - Web APIs | MDN (mozilla.org)](https://developer.mozilla.org/en-US/docs/Web/API/Trusted_Types_API))
- Utiliser le mode strict de javascript (`"use strict";` en première ligne de chaque fichier JavaScript ([Strict mode - JavaScript | MDN (mozilla.org)](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode))
- Ne pas utiliser innerHTML sur des inputs non vérifiés et utilisé plutôt à la place innerText.

**Question 4 : Investigate how to use Trusted types for DOM-XSS and the new attack.**

[Untrusted types: Researcher demos trick to beat Trusted Types protection in Google Chrome | The Daily Swig](https://portswigger.net/daily-swig/untrusted-types-researcher-demos-trick-to-beat-trusted-types-protection-in-google-chrome)

**Fonctionnement de la Trusted types API :**

La trusted types API permet de forcer la validation des chaines de caractères employées pour l'utilisation des fonctions constituant des "injections sinks".  
Les injections sinks sont des fonctions qui insèrent du HTML dans le document, des fonctions qui créent un nouveau document de même origine avec un balisage contrôlé par l'appelant, des fonctions qui exécutent du code et des setteurs pour les attributs d'éléments qui acceptent une URL pour charger ou exécuter du code.

Si l'utilisateur utilise une string au lieu d'un trusted type fourni par une fonction de validation définie dans un objet TrustedTypePolicyFactory, l'utilisateur va recevoir une "TypeError".

**L'attaque : CVE-2022-1494.**

Il n'y a pas beaucoup d'information sur la vulnérabilité, à l'exception que le problème vient "d'une validation insuffisante des données dans Trusted Types dans Google Chrome avant la version 101.0.4951.41 permettait à un attaquant distant de contourner les trusted types policies via une page HTML élaborée."

Source : [NVD - CVE-2022-1494 (nist.gov)](https://nvd.nist.gov/vuln/detail/CVE-2022-1494)
