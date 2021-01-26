<?php 

//Rendre dynamiques les noms de variables 
$myVariable = 'I am a variable!<br>';
echo $myVariable; //affiche I am a variable!


//syntaxe alternative : $ puis {} contenant une chaîne de caractères
echo ${'myVariable'}; //affiche I am a variable!


//on peut donc s'amuser à mettre une variable contenant une chaîne de caractères entre les accolades {}
$variableName = 'myVariable';
echo ${$variableName};//affiche I am a variable!


$variableName = 'random';
echo ${$variableName}; //erreur ! affiche Warning: Undefined variable $random

echo '<br>';

//Rendre dynamiques les noms de fonctions
function sayHello()
{
    echo 'hello<br>';
}

function sayHi()
{
    echo 'hi<br>';
}

sayHello(); //affiche hello
sayHi(); //affiche hi

//on crée une variable $var qui contient une string qui correspond au nom d'une fonction
$functionName = 'sayHello';
$functionName(); //appelle la fonction sayHello() et affiche hello

$functionName = 'sayHi';
$functionName(); //appelle maintenant la fonction sayHi() et affiche hi

//on peut aussi écrire  :
${'functionName'}(); //appelle sayHi()

//Si on change la valeur de $functionName pour lui donner une string qui ne correspond pas à un nom de fonction :
//$functionName = 'sayGoodBye';
// $functionName(); //Fatal error : Uncaught Error: Call to undefined function sayGoodBye() 

echo '<br>';

//Avec des objets, leurs propriétés et leurs méthodes
class MyClass {
    public $myProperty = 'This is my property!<br>';
    
    public function myMethod(){
        echo 'This is my method!<br>';
    }
}

$myObject = new MyClass();

//on peut rendre dynamiques les noms des objets
$objectName = 'myObject';


//echo ${$objectName}; // Fatal error ! on ne peut pas faire echo sur un objet. On va faire un var_dump 
var_dump(${$objectName}); //affiche object(MyClass)#1 (1) { ["myProperty"]=> string(24) "This is my property!" }
echo '<br>';


//on peut rendre dynamique le nom de la classe instanciée
$className = 'MyClass';
$myObject = new $className();
var_dump($myObject); //$myObject est bien de la classe MyClass

echo '<br><br>';

//on peut rendre dynamiques les noms des propriétés
echo $myObject->myProperty; //affiche This is my Property!

$propertyName = 'myProperty';
echo $myObject->$propertyName; //affiche This is my Property! 
//# Attention à bien mettre le $ avant le nom de la variable contenant le nom de la propriété

echo '<br>';

//on peut rendre dynamiques les noms des méthodes
$myObject->myMethod(); //affiche This is my method!

$methodName = 'myMethod';
$myObject->$methodName(); //affiche This is my method!
//# Attention à bien mettre le $ avant le nom de la variable contenant le nom de la méthode

echo '<br>';

//on peut rendre dynamiques le nom de l'objet ET celui de sa propriété / méthode
echo ${$objectName}->$propertyName; //affiche This is my Property!
${$objectName}->$methodName(); //affiche This is my method!

echo '<br>';

//Applications : mutualiser un même code pour des effets différents
class Rat {
    public $poids = 'très léger';
    public $taille = 'tout petit';
    public $couleur = 'gris';

    public function cri(){
        return 'couine !';
    }
    public function bruit(){
        return 'ne fait pas de bruit !';
    }
    public function activite(){
        return 'fait des trous à tes chaussettes !';
    }
}

class Chat {
    public $poids = 'plutôt léger';
    public $taille = 'de taille moyenne';
    public $couleur = 'roux';

    public function cri(){
        return 'miaule !';
    }
    public function bruit(){
        return 'fait RRrrrRRRrrrRRRrrr !';
    }
    public function activite(){
        return 'dort comme une grosse feignasse !';
    }
}

class Chien {
    public $poids = 'lourd';
    public $taille = 'assez grand';
    public $couleur = 'noir';

    public function cri(){
        return 'aboie !';
    }
    public function bruit(){
        return 'fait Grr... !';
    }
    public function activite(){
        return 'bave partout sur ton pantalon neuf !';
    }
}

$animaux = [
    'Rat',
    'Chat',
    'Chien',
];

$proprietes = [
    'poids',
    'taille',
    'couleur',
];

$actions = [
    'cri',
    'bruit',
    'activite',
];

//on va générer dix animaux aléatoires en affichant une de leurs propriétés et une de leurs méthodes.
//à chaque tour de boucle, et à chaque rafraîchissement de la page, les résultats sont différents.
for ($i = 1 ; $i <= 10 ; $i++) {
    $animal = $animaux[random_int(0,2)];
    $propriete = $proprietes[random_int(0,2)];
    $action = $actions[random_int(0,2)];
    
    $animalMystere = new $animal();
    echo 'L\'animal mystère n° '. $i . ' est un '. strtolower(get_class($animalMystere)) . ', il est ' . $animalMystere->$propriete . ' et il ' . $animalMystere->$action() ;
    
    echo '<br>';
}

echo '<br>';

//Plutôt qu'appeler aléatoirement des propriétés et des méthodes on aurait pu appeler des méthodes qui retournent une valeur aléatoirement parmi plusieurs.
//Mais pourquoi faire simple...
class Pigeon {
    public $proprietes = [
        'léger',
        'de taille moyenne',
        'tacheté'
    ];
    public $actions = [
        'roucoule !',
        'fait rrrou !',
        'chie partout sur ton balcon !',
    ];

    public function propriete(){
        return $this->proprietes[random_int(0,2)];
    }
    public function action(){
        return $this->actions[random_int(0,2)];
    }
}

$monPigeon = new Pigeon();

for ($i = 1 ; $i <= 5 ; $i++) {
echo 'Le ' . strtolower(get_class($monPigeon)) . ' n° '. $i . ' est ' . $monPigeon->propriete() . ' et il ' . $monPigeon->action() ;
echo '<br>';
}
