<?php

class PseudoAttribution extends Database
{
    private $pseudos = [
        'Perceval',
        'Karadoc',
        'Guenièvre',
        'Père Blaise',
        'Coco l\'asticot',
        'Guethenoc',
        'Roparzh',
        'ZeratoR',
        'Bizon futé',
        'Groot',
        'IT\'S OVER 9000',
        'LEEROY JEEEEENKINS',
        'Nyan Cat',
        'Tartine au beurre doux',
        'Raiponce',
        'Sasha',
        'Boule de lavage',
        'Geralt of rivia',
        'Albus Dumbledore',
        'Grogu',
        'Link',
        'Zelda',
        'Bowser',
        'Solid Snake',
        'Lara Croft',
        'Sonic',
        'Frodon Sacquet',
        'Gollum',
        'Obi Wan Kenobi',
        'Darth Vader',
        'Ken',
        'Barbie',
        'PewDiePie',
        'Tristepin',
        'Voldemort',
        'Katniss Everdeen',
        'Kirby',
        'Aria',
        'Wario',
        'Waluigi',
        'Hodor',
        'Oberyn Martell',
        'Samwell Tarly',
        'Ron Weasley',
        'Argus Rusard',
        'Croûtard',
        'Dobby',
        'Neville Londubat',
        'Dolores Ombrage',
        'Bohort',
        'Tahiti Bob',
        'Montgomery Burns',
        'Milhouse',
        'Ned Flanders',
        'Moe Szyslak',
        'Apu',
        'Krusty le clown',
        'Kick-Ass',
        'Reese',
        'Dewey',
        'Hal',
        'Tintin',
        'Roi Burgonde',
        'Obélix',
        'Sardoche',
        'Titeuf',
        'Vomito',
        'Mickey',
        'Baloo',
        'Eric Cartman',
        'Chihiro',
        'BB-8',
        'Baymax',
        'Buzz l\'Eclair',
        '(un) Stormtrooper',
        'WALL-E',
        'Donald',
        'Jafar',
        'Cruella',
        'Ursula',
        'Scar',
        'Pumba',
        'Nick Quasi-Sans-Tête',
        'Kronk',
        'Doris',
        'Idéfix',
        'Assurancetourix',
        'Milou',
        'Professeur Tournesol',
        'Dupond (pas Dupont)',
        'Dupont (pas Dupond)',
        'Capitaine Haddock',
        'Pluto',
        'Agathe De Poheur',
        'Simplet',
        'Inspecteur Gadget',
        'Maya l\'abeille',
        'Schtroumpf grognon',
        'Gargamel',
        'Xx_DarkSasukeDu13_xX',
        'Terry Golo',
        'Marsupilami'
    ];
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function RemoveUsedPseudonymes(){
        $assignedPseudonymes = $this->_db->query("SELECT pseudonyme FROM user")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($assignedPseudonymes as $assignedPseudonyme){
            $used_pseudonyme_key = array_search($assignedPseudonyme, $this->pseudos);
            if (isset($used_pseudonyme_key)){
                unset($this->pseudos[$used_pseudonyme_key]);
            }
        }
    }

    public function SortPseudonymes(){
        $this->RemoveUsedPseudonymes();
        $pseudokey = array_rand($this->pseudos);
        return $this->pseudos[$pseudokey];
    }

}
/*
//return un pseudonyme non utilisé
$user = new PseudoAttribution();
var_dump($user->SortPseudonymes());*/
