# AFRIK-INNOVSCIENCE SITE WEB PRINCIPAL

Ce repository contient (presque) tous les fichiers necessaires au fonctionnenement du site web principal.
Pour pouvoir travailler avec ce repository, bien vouloir respecter les étapes suivantes:
1. Cloner le Repository par HTTPS ou SSH (git clone git@github.com:Afrik-Innovscience/Site-Web-principal.git ou https://github.com/Afrik-Innovscience/Site-Web-principal.git).
2. Pour chaque Bug/Feature, créer une branche avec le nom du Bug ou du feature.
3. Les branches dédiées aux features auront pour préfixe **feature/**  et celles dédiées à la résolution des bugs auront pour prefixe  **bug/** .
4. Les Noms des branches doivent être toutes en minuscule et les espaces doivent être remplacés par des tirets de 6. Exemples: <br/><br/>
   Nom du feature: Creation du menu principal <br/> 
   Nom de la branche: _**feature/**creation-du-menu-principal**_  <br/><br/>
   Nom du bug: Changer la couleur des liens en vert <br/>
   Nom de la branche: _**bug/**changer-la-couleur-des-liens-en-vert**_  
   
5. Faire correspondre le fichier sur lequel on travaille avec le nom du meme fichier sur le serveur FTP en configurant son editeur de la maniere suivante:
   Pour l'editeur PHPStorm, les etapes a suivre sont:

    * Cliquer sur le menu fichier et choisir options (Fichier -> Options).
    * Chercher l'option "Deployment" sur la barre de recherche au-dessus.
    * Cliquer sur l'onglet PLUS (+) sur la fenetre qui s'affiche, pour ajouter un nouveau serveur pour deployer le projet.
    * Entrer le nom du serveur (Bien vouloir entrer en contact avec l' adminitrateur mauricejuniorbayano@gmail.com, pour obtenir le lien qui mene au serveur)
    * Choisir ensuite l'option SSH Configuration, pour pouvoir configurer les donnes pour se connecter au serveur.<br/>
           ![Config](https://github.com/Afrik-Innovscience/Site-Web-principal/blob/master/images/ssh_config.PNG)
    * Choisir ensuite le menu Mappings pour pouvoir Mapper le Repository local avec les fichiers du site sur le serveur (Bien vouloir entrer en contact avec l' adminitrateur        mauricejuniorbayano@gmail.com, pour obtenir toutes les informations necessaires).
    * Verifier toute la configuration en rentrant sur le menu Connection. <br/>
          ![Check config](https://github.com/Afrik-Innovscience/Site-Web-principal/blob/master/images/chech_config.PNG)
6. Si le fichier sur lequel on travaille est un nouveau fichier, bien vouloir mapper le dossier contenant le fichier sur lequel on travaille avec le dossier correspondant au
   niveau du serveur.
7. Bien vouloir tester toutes ses implementations avant de pousser dans le repository ou de deployer au niveau du serveur.
8. Si le test compromet le fonctionnement du site entierr, bien vouloir NE PAS POUSSER les modifications au niveau du serveur FTP ou de ce Repository
9. Seul l'administrateur mauricejuniorbayano@gmail.com a le droit de merger toutes les branches auxiliaures dans la branche principale Master.

PS: **NE JAMAIS TRAVAILLER DIRECTEMENT SUR LA BRANCHE MASTER.**
