# TP5

**Question 1 Write JavaScript code to perform a CSRF attack
(SameSite=None). file: [xsrfAttack.php](/src/tp5/ressources/xsrfAttack.php)**

- Use SameSite=LAX cookies to defend (no token)
- Use SameSite=LAX and no token to perform a CSRF attack.
- Use SameSite=LAX and token to defend from the the attack.
- Check the OWASP top ten: implement and
perform an example attack of A04 to A10

**Script : [tp5/ressources/xsrfAttack.php?name=toto (localhost live)](http://host.com:8080/tp5/ressources/xsrfAttack.php?name=toto) | [tp5/ressources/xsrfAttack.php (code)](/src/tp5/ressources/xsrfAttack.php)**


# Questions

## Q1

**Q1 : Write JavaScript code to perform a CSRF attack (SameSite=None). file: xsrfAttack.php**

Il est important de savoir que les navigateurs modernes applique la politique **"Lax-by-default"**. Cela signifie que si la valeur Samesite d'un cookie n'est pas fixé, il est évalué à `Lax` par le navigateur. Cette modification a tout d'abord été appliquée par Google Chrome à partir de la version 80. Firefox a ensuite suivi, ainsi que tous les autres navigateurs.

Il y a aussi une autre politique qui a commencé à être appliquée est qu'un cookie avec `Samesite=None` doit aussi inclure, l'attribut `Secure`. Cela signifie qu'il n'est pas possible de définir un cookie Cross-Site (`Samesite=None`) qui est envoyé lors de l'utilisation du protocole HTTP. Cette politique est appliqué dans les versions récentes de Chrome. En revanche, elle n'est pas encore appliquée dans la version 121.0.1 (la dernière version lors de l'écriture de ce rapport) de la branche stable de Firefox (version classique). Néanmoins, elle est appliquée dans la dernière version de la branche développeur de Firefox.

Ainsi si vous utilisez Chrome ou que votre navigateur applique la dernière politique mentionnée. Il faut modifier le paramètre "secure" dans la fonction `setcookie` du script [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php) de la manière suivante `'secure' => true` et utiliser **HTTPS**. Le protocole https est supporté par l'image Docker fournit dans ce projet.

Au niveau de l'implémentation de la CSRF, j'ai utilisé une redirection cliente avec `document.location` au détriment des API Javascript pour réaliser des requêtes HTTP tel que "XMLHttpRequest" et "fetch". Pour informations, ces API forcent la politique de SOP (Same Origin Policy), sauf si des entêtes CORS sont chargés. Ce qui n'est pas un problème puisque dans l'image Docker, apache est configuré pour fournir l'entête suivant dans toutes les réponses : `Access-Control-Allow-Origin: *`. Cet entête a pour effet de désactiver CORS. En revanche, les cookies ne sont pas attachés aux requêtes par défauts pour ces API, il faut rajouter la propriété `credentials: include` (fecth) ou  `withCredentials = true` (XMLHttpRequest). Mais "Access-Control-Allow-Origin" ne doit pas contenir de wildcard pour pouvoir utiliser `credentials: include` avec fetch. Ce qui n'est pas notre cas comme mentionné précédent. Concernant, XMLHttpRequest je n'ai pas regardé en effet, j'utilise exclusivement `fetch` qui est meilleur pour de nombreuses raisons, la principale étant l'utilisation de promesses (promise), permettant de réaliser de la programmation asynchrone.

**Sources :**

- [Cross-origin resource sharing (CORS) - HTTP | MDN (mozilla.org)](https://developer.mozilla.org/fr/docs/Web/HTTP/CORS)
- [Using the Fetch API - Web APIs | MDN (mozilla.org)](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch#sending_a_request_with_credentials_included)
- [XMLHttpRequest: withCredentials property - Web APIs | MDN (mozilla.org)](https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/withCredentials)

Vous l'aurez compris, pour des raisons de simplicité il est plus aisé de réaliser des requêtes GET contenant des cookies par redirection plutôt que d'utiliser les API "XMLHttpRequest" et "fetch". De plus, nous verrons dans la [Q3](#Q3) que le seul moyen de réaliser une CSRF contenant les cookies avec la politique `Samesite=Lax` est de réaliser une redirection.

## Q2

**Q2 : Use SameSite=LAX cookies to defend (no token)**

Il suffit de modifier le paramètre `samesite` de la fonction `setcookie` fixant le cookie "login" dans le cookie du navigateur du client. Il faut passer le paramètre de `'None'` à `'Lax'`. Cette fonction se trouve appelée dans le script [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php).

## Q3

**Q3 : Use SameSite=LAX and no token to perform a CSRF attack.**

Il faut tout d'abord bien comprendre les implications de la politique `Samesite=Lax`. Je vais donc citer la documentation de Mozilla.

> `Lax` : Le cookie n'est pas envoyé sur les requêtes inter-sites, telles que les appels pour charger des images ou des *iframes*, mais il est envoyé lorsqu'un utilisateur navigue vers le site d'origine à partir d'un site externe (par exemple, s'il suit un lien). C'est le comportement par défaut si l'attribut `SameSite` n'est pas spécifié.

**Source :** [Set-Cookie - HTTP | MDN (mozilla.org)](https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value)

Nous apprenons ainsi que les cookies avec la politique `Samesite=Lax` sont envoyés **navigation de premier niveau (top-level navigation)**. Ce point est extrêmement important, il est à bien comprendre et à retenir. Cela signifie que lors d'une redirection côté client, les cookies "Lax" sont envoyés.

En revanche, il faut une **navigation de premier niveau**, cela signifie que la redirection doit être appliqué sur la page principale (objet `document` mère). Il est ainsi impossible d'envoyer des cookies "Lax" dans une `iframe` !

Vous pouvez bien voir cette nuance en chargeant les scripts [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php) et [iframeInfected.php](../src/tp5/mycode/iframeInfected.php) avec le cookie "login" possédant la politique `Samesite=Lax` déjà définie dans votre navigateur.  
Dans le script [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php), une redirection vers le script [simple.php](../src/tp/ressources/simple.php) est réalisée dans l'iframe et nous obtenons comme résultat que le cookie "login" n'a pas été envoyé au script.  
Tandis que dans le script [iframeInfected.php](../src/tp5/mycode/iframeInfected.php), le cookie "login" est envoyé au script [simple.php](../src/tp/ressources/simple.php).

Il est important de noter que comme les cookies `Samesite=Lax` ne sont envoyés que lors de redirection de premier niveau, il est donc possible de les envoyer que pour des requêtes **GET**.

Du moins c'est dans la théorie. Il existe à ma connaissance au moins une exception. Je vous la mets en dessous si cela vous intéresse.

> Cookies with `Lax` SameSite restrictions aren't normally sent in any cross-site `POST` requests, but there are some exceptions. As mentioned earlier, if a website doesn't include a `SameSite` attribute when setting a cookie, Chrome automatically applies `Lax` restrictions by default. However, to avoid breaking single sign-on (SSO) mechanisms, it doesn't actually enforce these restrictions for the first 120 seconds on top-level `POST` requests. As a result, there is a two-minute window in which users may be susceptible to cross-site attacks.

**Source :** [Bypassing SameSite cookie restrictions | Web Security Academy (portswigger.net)](https://portswigger.net/web-security/csrf/bypassing-samesite-restrictions#:~:text=SameSite%20is%20a%20browser%20security,leaks%2C%20and%20some%20CORS%20exploits.)

## Q4

**Q4 : Use SameSite=LAX and token to defend from the attack.**

Le but est ici de générer une session en php qui va nous permettre de stocker notre token qui va nous protéger des CSRF. Un attaquant ne pourra pas deviner le token, puisque celui-ci va être généré aléatoirement à chaque session.

Vous pouvez trouver ci-dessous la manière de générer un token qui est stocké dans une session php. Dans mon exemple, ce bout de code se trouve dans le script [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php).

```php
// démarre la session
session_start();

// stocke le token généré dans la session du client
$_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
```

Ensuite, il suffit d'ajouter le token en paramètre à l'ensemble des requêtes réalisées par le script [xsrfAttack.php](../src/tp5/ressources/xsrfAttack.php) à destination du domaine interne (host.com). Comme la requête pour récupérer le résultat du script [simple.php](../src/tp/ressources/simple.php) est GET, nous allons ajouter le token en tant que paramètre de l'URL de la manière suivante :

```js
const url = `${protocol}//host.com:${port}/tp5/ressources/simple.php?csrf_token=<?php echo $_SESSION["csrf_token"] ?>`;  
```

Nous avons ensuite besoin de vérifier côté du script que la valeur reçue en paramètres (ici `csrf_token`) et la même que celle stockée dans la session du client. Pour cela, il suffit de rajouter une vérification avant d'exécuter le script

```php
isset($_GET["csrf_token"]) && isset($_SESSION["csrf_token"]) && $_GET["csrf_token"] == $_SESSION["csrf_token"])
```

## Q5

**Q5 : Check the OWASP top ten: implement and perform an example attack of A04 to A10**

**TO BE CONTINUE !**

# Sources

Je tiens à remercier **Léo LE BIHAN** pour le partage de son travail sur ce TP. Il m'a été d'une grande utilité et m'a permis en partie de pouvoir vous réaliser ce compte rendu complet.

**Liens :**

- [Bypassing SameSite cookie restrictions | Web Security Academy (portswigger.net)](https://portswigger.net/web-security/csrf/bypassing-samesite-restrictions#:~:text=SameSite%20is%20a%20browser%20security,leaks%2C%20and%20some%20CORS%20exploits.)
- [Set-Cookie - HTTP | MDN (mozilla.org)](https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value)
- [PHP CSRF (phptutorial.net)](https://www.phptutorial.net/php-tutorial/php-csrf/)
