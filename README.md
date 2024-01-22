# Web Apps Security

Ce projet contient l'ensemble des tp du cours de **Sécurité des Applications Web**.
L'ensemble des corrections ont été réalisées par moi-même.
Il se peut donc que certaines corrections soient erronées ou incomplètes.

## TPs

- TP1
  - [TP1 - Sujet](/subjects/tp1.md)
- TP2
  - [TP2 - Sujet](/subjects/tp2.md)
  - [TP2 - Correction](/corrections/TP2.md)
  - [TP2 - Code](/src/tp2)
- TP3
  - [TP3 - Sujet](/subjects/tp3.md)
  - [TP3 - Correction](/corrections/TP3.md)
  - [TP3 - Code](/src/tp3)
- TP4
  - [TP4 - Sujet](/subjects/tp4.md)
  - [TP4 - Correction](/corrections/TP4.md)
  - [TP4 - Code](/src/tp4)
- TP5
  - [TP5 - Sujet](/subjects/tp5.md)
  - [TP5 - Correction](/corrections/TP5.md)
  - [TP5 - Code](/src/tp5)

## Installation

### Fichiers de configuration

Il est nécessaire d'ajouter les entrées suivantes dans le fichier `/etc/hosts` ou `C:\Windows\System32\drivers\etc\hosts` de votre machine :

```conf
127.0.0.1       evil.com
127.0.0.1       attacker.com
127.0.0.1       host.com
127.0.0.1       subdomain.host.com
```

## Exécution

Pour pouvoir exécuter les différents solutions simplement, il est possible d'utiliser *Docker*.
Il est nécessaire de construire l'image *Docker* à partir du `Dockerfile` présent dans le projet.

### Construire l'image Docker

Il faut tout d'abord exécuter le script bash `generate-ssl.sh` pour générer les certificats TLS du serveur web :

> :warning: Attention  
> Si vous utilisez *WSL*, il faut dabord changer les caractères de fin de ligne du script avec la commande [dos2unix](https://command-not-found.com/dos2unix) : `dos2unix ./generate_certificate.sh`

```bash
bash ./generate_certificate.sh
```

Si vous êtes sur Windows, vous pouvez exécuter le script sous *WSL*.

Il faut ensuite construire l'image *Docker* avec la commande suivante :

```bash
docker build . -t quentin/web-apps-security -f ./dockerfile/Dockerfile
```

L'image doit impérativement être construite à partir du dossier racine du projet.

### Lancer le conteneur

> :warning: Attention  
> `$PWD` ne fonctionne qu'avec *Powershell* et *Bash*, il ne fonctionne pas avec *CMD*.

```bash
docker run -d -p 8080:80 -p 4443:443 -v $pwd/src:/var/www/html --name web-apps-security quentin/web-apps-security
```

Il faut ensuite accéder au serveur avec le nom de dommaine `host.com`.
Le certificat TLS est auto-sign", uniquement pour ce nom de domaine.

J'espère que ce projet vous sera utile.
N'hésitez pas à me contacter si vous avez des questions ou des remarques.

## Autres

Si vous êtes à la recherche de la documentation pour l'installation de l'image Docker contenant [pyre-check](https://github.com/facebook/pyre-check).
Elle se trouve dans le fichier [pyre-check.md](docs/pyre-check.md).
