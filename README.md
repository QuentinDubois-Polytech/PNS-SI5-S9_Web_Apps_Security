Pour construire l'image Docker :

```bash
    docker build . -t myphp -f .\dockerfile\Dockerfile
```

Pour exécuter le conteneur :

```bash
     docker run -p 8080:80 -v C:\Users\Quentin\PhpstormProjects\Web-Application-Security\src:/var/www/html myphp
```