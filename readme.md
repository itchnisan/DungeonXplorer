# DungeonXplorer

DungeonXplorer est une application web interactive inspirée des livres "dont vous êtes le héros", développée pour l'association **Les Aventuriers du Val Perdu**. Ce projet a pour objectif de recréer l'expérience immersive de ces récits interactifs tout en intégrant des fonctionnalités modernes.

## Table des Matières
- [Objectifs](#objectifs)
- [Technologies Utilisées](#technologies-utilisées)
- [Fonctionnalités](#fonctionnalités)
- [Charte Graphique](#charte-graphique)
- [Système de Combat](#système-de-combat)
- [Structure du Projet](#structure-du-projet)
- [Contributeurs](#contributeurs)

---

## Objectifs

- **Traitement de formulaire HTML avec PHP.**
- **Conception et gestion de base de données MySQL.**
- **Implémentation d'un CRUD complet.**
- **Utilisation du design pattern MVC.**
- **Respect des normes W3C & WCAG**

---

## Technologies Utilisées

- **Backend :** PHP avec PDO pour l'interaction avec la base de données ainsi que le MVC.
- **Frontend :** HTML, CSS (Bootstrap) et JavaScript.
- **Base de Données :** MySQL.
- **Outils :** Visual Studio Code, Git, GitHub.

---

## Fonctionnalités

### Version 1 (V1)
#### Joueur
- Création de compte et connexion.
- Création d’un personnage parmi trois classes (Guerrier, Voleur, Magicien).
- Début ou reprise de l’aventure.
- Gestion des Combats dans les Chapitres.
- Gestion de l'inventaire du joueur.

---

## Charte Graphique

### Couleurs
- **Fond principal :** `#1A1A1A` (noir doux).
- **Texte principal :** `#e0e0d1` (crème).
- **Titres :** `#d4af37` (Couleur dorée).     
- **Blocs de textes :** `rgba(79, 50, 34, 0.8)` (brun translucide).
- **Boutton :** `#4f3222` (brun foncée).

### Polices
- **Titres :** [Cinzel Decorative](https://fonts.google.com/specimen/Cinzel+Decorative).
- **Texte courant :** [Cinzel,serif](https://fonts.google.com/specimen/Cinzel).

---

## Système de Combat

### Classes de Personnages
- **Guerrier :** Force élevée, pas de mana.
- **Voleur :** Initiative élevée, mana limitée.
- **Magicien :** Utilise des sorts avec mana et a une bonne force.

### Actions par Tour
- **Attaque physique :** Basée sur la force et les équipements.
- **Attaque magique :** Réservée aux Magiciens, consomme du mana.
- **Utilisation de potions :** Restaure PV ou mana.

### Exemple de Calcul

Voici un exemple des calculs utilisés dans le système de combat :

### Calcul de la Priorité
La priorité au début du combat est déterminée par la formule suivante :
- Lancer un dé pour le héros (`deHero`) et le monstre (`deAdversaire`) avec une valeur entre 1 et 6.
- Ajouter ces valeurs à leurs initiatives respectives.
- Si les valeurs sont égales, le héros a l'avantage s'il est de classe "Guerrier".

```php
$deHero = rand(1,6);
$deAdversaire = rand(1,6);

if ($hero->getHeroInitiative() + $deHero > $monster->getMonsterInitiative() + $deAdversaire || 
    ($hero->getHeroInitiative() + $deHero == $monster->getMonsterInitiative() + $deAdversaire && $hero->getClassId() == 2)) {
    echo "Le héros commence !";
} else {
    echo "Le monstre commence !";
}
```
## Exemple de Calcul de dégats

Exemple d'utilisation de la fonction getPhysicDamage et de takeDammage ainsi de comment elles sont implémentées

```php
public function performPhysicalAttack($mysqlClient) {
    if ($this->isHeroTurn) { // si c'est le tour du hero c'est le monstre qui subit les damage
        $this->monster->takeDamage($mysqlClient, $this->hero->getPhysicDamage($mysqlClient));
    } else { //c'est le hero sinon.
        $this->hero->takeDamage($this->mysqlClient, $this->monster->getPhysicDamage($mysqlClient));
    }
}
```
- Fonction getPhysicDamage :
```php
    public function getPhysicDamage($mysqlClient) {
        $deAttaque = rand(1,6);
        $bonus_arme = 0; //initialisation du bonus arme a 0
        $id = $this->hero_id;
        $id_type = 1;
        //requete pour recuperer le bonus que confere l'arme equipe par le hero.
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $id_type);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
        $bonus_arme = $donnee[0]["ITEMS_EFFICIENCY"]; // si le hero a bien équipé une arme alors on ajoute son bonus pour l'jouter au calcul total des degats.
        }

        return $this->hero_strength + $bonus_arme + $deAttaque;
    }
```

- Fonction takeDamage :
```php
        public function takeDamage($mysqlClient,$damage)
    {
        $deDefenseur = rand(1,6);
        $bonus_armure = 0; //initialisation du bonus d'armure a 0
        $id = $this->hero_id;
        $idItemType = 2;

        //requete pour recuperer le bonus que confere l'armure equipe par le hero.
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $idItemType);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
            $bonus_armure = $donnee[0]["ITEMS_EFFICIENCY"];
        }

        if($this->class_id == 2) {
            $diff = max(0,$damage - ($this->hero_initiative/2 + $bonus_armure + $deDefenseur));
        }
        else {
            $diff = max(0,$damage - ($this->hero_strength/2 + $bonus_armure + $deDefenseur));
        }

        $sql = "UPDATE HERO SET HERO_PV = HERO_PV - :diff WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id,'nombre');
        ajouterParamPDO($cur, ':diff', $diff,'nombre');
        $donnee = [];
        $res1 = $cur->execute();
        $this->hero_pv -= $diff;
    }
```

### Structure-du-projet
|-- index.php           # Point d'entrée de l'application.
|-- readme.md           # Fichier permettant la compréhension de l'application.
|-- /controllers        # Gestion des requêtes et logique métier.
|-- /models             # Gestion des données et interactions BDD.
|-- /views              # Fichiers HTML et rendu des pages.
|-- /Images             # Fichiers images.
|-- /Router             # Gestion de redirection des routes.


### Contributeurs
- Lukas Fortin
- Julien Moisson
- Baptiste Cadiou
- Louison Courtois
- Gaudré Soren

