# Pyre Check

Pour télécharger l'image Docker, il faut exécuter la commande suivante :

```bash
docker pull quentindubois12/pyre-check
```

Si pour une raison quelconque, l'image n'est pas disponible sur *Docker Hub* ou que vous préférez la construire en local.
Il est possible de la construire à partir du `Dockerfile`, [Dockerfile-pyre-check](dockerfile/Dockerfile-pyre-check) présent dans le projet.

Pour construire l'image à partir du Dockerfile, il faut exécuter la commande suivante :

```bash
docker build . -t quentindubois12/pyre-check -f ./dockerfile/Dockerfile-pyre-check
```

Pour exécuter l'image, il faut exécuter la commande suivante :

```bash
docker run -it --name pyre-check quentindubois12/pyre-check /bin/bash
```

Il est possible bien évidemment de faire un montage de volume avec l'option `-v` pour pouvoir exécuter pyre-check
sur un projet présent sur votre machine hôte.