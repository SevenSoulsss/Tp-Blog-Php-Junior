# Tp de blog en Php

## Parent Kylian

### Schémas du site web

Base de donnée : MySQL 

### Fonctionnalités

En premier lieu un redirect a lieu dans l'index.php si l'utilisateur est connecté ou non.

Si il est connecté, nous arrivons dans le blog où tous nos articles et ceux de la communauté sont affichés à l'aide d'une boucle while

Dans ce blog, nous pouvons ajouter et modifier nos articles (mais non pas les supprimer car ce n'était pas demandé dans le TP et en fonctionnant comme à la demande d'un client, nous n'ajoutons pas ce qui n'est pas demandé par le client).

Nous avons une page pour nous connecter et une autre pour nous inscrire, que l'on soit connecté ou non, nous avons la disponibilité de lire les articles mais nous ne pouvons ni modifier nos propres articles, ni en créer de nouveau, il faudra être connecté pour ça.

Les intéraction sutilisateurs sont filtrées, les actions non autorisées d'un utilisateur non connecté sont redirigées sur le `login_form.php`.

Les actions étant composées majoritairement de php (et non pas d'html pour les pages) ont été placées dans le dossier `actions`.

Contre l'injection SQL j'ai vérifié que le contenu était bien un mail pour les champs sensibles, le reste des champs intégrés dans mes requêtes n'étant pas sensible ils n'ont pas de vérification supplémentaire hormis l'htmlspecialchars pour les caractères spéciaux inclut

Je remplace également les guillemets du côté de l'édition des articles, les guillemets étant mal interprétés par SQL j'ai rajouté deux anti slash pour palier à ceci dans mon `str_replace`.

Je vous laisse juger de mon code et me faire les retours en conséquence, bonne lecture.

Parent Kylian