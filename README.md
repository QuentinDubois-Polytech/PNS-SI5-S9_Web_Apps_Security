# Web Apps Security

Ce projet contient l'ensemble des tp du cours de **Sécurité des Applications Web**.
L'ensemble des corrections ont été réalisées par moi-même.
Il se peut donc que certaines corrections soient erronées ou incomplètes.

## TPs

- TP1
  - [TP1 - Subject](/subjects/tp1.md)
- TP2
  - [TP2 - Subject](/subjects/tp2.pdf)
  - [TP2 - Answers](/corrections/TP2.md)
  - [TP2 - Code](/src/tp2)
- TP3
  - [TP3 - Subject](/subjects/tp3.pdf)
  - [TP3 - Answers](/corrections/TP3.md)
  - [TP3 - Code](/src/tp3)
- TP4
  - [TP4 - Subject](/subjects/tp4.pdf)
  - [TP4 - Answers](/corrections/TP4.md)
  - [TP4 - Code](/src/tp4)

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

```bash
docker build . -t quentin/web-apps-security -f ./dockerfile/Dockerfile
```

L'image doit impérativement être construite à partir du dossier racine du projet.

### Lancer le conteneur

> :warning: Attention  
> `$PWD` ne fonctionne qu'avec *Powershell* et *Bash*, il ne fonctionne pas avec *CMD*.

```bash
docker run -d -p 8080:80 -v $PWD/src:/var/www/html --name web-apps-security quentin/web-apps-security
```

J'espère que ce projet vous sera utile.
N'hésitez pas à me contacter si vous avez des questions ou des remarques.
