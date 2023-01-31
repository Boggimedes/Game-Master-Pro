<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;

class SoundSeeder extends Seeder
{
/**
 * Seed the application's database.
 *
 * @return void
 */
public function run()
{

DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Beach','Ocean Sounds','[{\"fadeOut\": \"2\",\"fadeIn\": \"2\",\"chance\": \"100\",\"pitchVar\": \"0\",\"pitchSet\": \"0\",\"vol\": \"60\",\"sound_id\": \"59\",\"name\": \"Ocean\"}]',80,0,1,0,0,0,0,1,3)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Bee Swarm','A swarm of angry bees','[{\"fadeOut\": \"5\",\"fadeIn\": \"5\",\"chance\": \"100\",\"pitchVar\": \"0\",\"pitchSet\": \"0\",\"vol\": \"50\",\"sound_id\": \"60\",\"name\": \"Bee Swarm\"}]',80,0,1,0,0,0,0,1,4)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Misc dungeon','Random Dungeon Sounds (needs expansion)','[{\"name\": \"Dripping 01\",\"vol\": \"66\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 34,\"randLoc\": true},{\"name\": \"Dripping 02\",\"vol\": \"67\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 33,\"randLoc\": true},{\"name\": \"Dripping 03\",\"vol\": \"68\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 33,\"randLoc\": true}]',40,1,1,20,90,0,0,1,5)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Heavy Rain','Sounds of heavy rain outdoors','[{\"fadeOut\": \"2\",\"fadeIn\": \"2\",\"chance\": \"100\",\"pitchVar\": \"0\",\"pitchSet\": \"0\",\"vol\": \"60\",\"name\": \"Rain (Heavy)\",\"sound_id\": \"61\"}]',80,0,1,0,0,0,0,1,6)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Thunder','Long duration thunder track','[{\"fadeOut\": \"0\",\"fadeIn\": \"0\",\"chance\": \"100\",\"pitchVar\": \"0\",\"pitchSet\": \"0\",\"vol\": \"100\",\"sound_id\": \"62\",\"name\": \"Thunder\"}]',80,0,1,0,0,0,0,1,7)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Group Laughter','Group Laughter','[{\"name\": \"GroupLaugh01\",\"sound_id\": \"1\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 20,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"GroupLaugh02\",\"sound_id\": \"2\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 20,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"GroupLaugh03\",\"sound_id\": \"3\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 20,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"GroupLaugh04\",\"sound_id\": \"4\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 20,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"GroupLaugh05\",\"sound_id\": \"5\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 20,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true}]',100,1,1,10,50,0,0,1,8)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Cave Ambience','Wind and background noise','[{\"name\": \"AMB Dungeon02\",\"sound_id\": \"6\",\"vol\": \"100\",\"pitchSet\": \"0\",\"pitchVar\": \"0\",\"chance\": \"100\",\"fadeIn\": \"2\",\"fadeOut\": \"2\"}]',80,0,1,0,0,0,0,1,9)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Wind in the trees','Wind in the trees','[{\"name\": \"Wind in the Trees\",\"sound_id\": \"63\",\"vol\": \"60\",\"pitchSet\": \"0\",\"pitchVar\": \"0\",\"chance\": \"100\",\"fadeIn\": \"2\",\"fadeOut\": \"2\"}]',80,0,1,0,0,0,0,1,10)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Forest Rustling','Misc rustling sounds',' [{\"name\": \"Rustling 01\",\"sound_id\": \"36\",\"vol\": \"25\",\"pitchSet\": \"0\",\"pitchVar\": \"100\",\"chance\": \"12\",\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"Rustling 02\",\"sound_id\": \"37\",\"vol\": \"26\",\"pitchSet\": \"0\",\"pitchVar\": \"100\",\"chance\": \"12\",\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"Rustling 03\",\"sound_id\": \"38\",\"vol\": \"27\",\"pitchSet\": \"0\",\"pitchVar\": \"100\",\"chance\": \"12\",\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true}]',80,1,1,20,90,0,0,1,11)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('CombatMusic','','[{\"name\": \"CombatMusic\",\"sound_id\": \"39\",\"vol\": 40,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": 4,\"fadeOut\": 4,\"randLoc\": false}]',80,0,1,0,0,0,0,1,12)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Cave/Dungeon Ambience','','[{\"name\": \"Cave Ambience\",\"sound_id\": \"6\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": 2,\"fadeOut\": 2,\"randLoc\": false}]',60,0,1,0,0,0,0,1,13)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Water Dripping and Echoing','','[{\"name\": \"Dripping 01\",\"sound_id\": \"7\",\"vol\": \"66\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 34,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true},{\"name\": \"Dripping 02\",\"sound_id\": \"8\",\"vol\": \"67\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 33,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true},{\"name\": \"Dripping 03\",\"sound_id\": \"9\",\"vol\": \"68\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 33,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true}]',40,1,1,20,90,0,0,1,14)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Wind in the Trees','','[{\"name\": \"Wind in the Trees\",\"sound_id\": \"63\",\"vol\": 60,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": 2,\"fadeOut\": 2,\"randLoc\": false}]',80,0,1,0,0,0,0,1,15)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Brush Rustling','','[{\"name\": \"Rustling 01\",\"sound_id\": \"36\",\"vol\": \"25\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 12,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true},{\"name\": \"Rustling 02\",\"sound_id\": \"37\",\"vol\": \"26\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 12,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true},{\"name\": \"Rustling 03\",\"sound_id\": \"38\",\"vol\": \"27\",\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 12,\"fadeIn\": 1,\"fadeOut\": 1,\"randLoc\": true}]',80,1,1,20,90,0,0,1,16)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Forest Birds','','[{\"name\": \"Bird09\",\"sound_id\": \"10\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 4,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird08\",\"sound_id\": \"11\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird07\",\"sound_id\": \"12\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird06\",\"sound_id\": \"13\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird05\",\"sound_id\": \"14\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird04\",\"sound_id\": \"15\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird03\",\"sound_id\": \"16\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird02\",\"sound_id\": \"17\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true},{\"name\": \"Bird01\",\"sound_id\": \"18\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 200,\"reverb\": false,\"chance\": 12,\"fadeIn\": 0,\"fadeOut\": 0,\"randLoc\": true}]',80,1,1,0,30,0,0,1,17)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Large Combat Background','','[{\"name\": \"Large Skirmish\",\"sound_id\": \"19\",\"vol\": 70,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 100,\"fadeIn\": 2,\"fadeOut\": 2,\"randLoc\": false}]',80,0,1,0,0,0,0,1,18)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('City Marketplace','','[{\"name\": \"City Marketplace\",\"sound_id\": \"20\",\"vol\": 80,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": 2,\"fadeOut\": 2,\"randLoc\": false}]',80,0,1,0,0,0,0,1,19)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern background','','[{\"name\": \"Tavern background\",\"sound_id\": \"21\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": \"2\",\"fadeOut\": \"2\",\"randLoc\": false}]',65,0,1,0,0,0,0,1,20)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Campfire','','[{\"name\": \"Fire\",\"sound_id\": \"65\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 0,\"reverb\": false,\"chance\": 100,\"fadeIn\": \"2\",\"fadeOut\": \"2\",\"randLoc\": false}]',25,0,1,0,0,1,0,1,21)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern Non Vocal','','[{\"name\": \"Tavern(Non Vocal)01\",\"sound_id\": \"22\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"Tavern(Non Vocal)02\",\"sound_id\": \"23\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"Tavern(Non Vocal)03\",\"sound_id\": \"24\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"EFF Tavern(Non Vocal)04\",\"sound_id\": \"25\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"EFF Tavern(Non Vocal)05\",\"sound_id\": \"26\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"EFF Tavern(Non Vocal)06\",\"sound_id\": \"27\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 14,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true},{\"name\": \"EFF Tavern(Non Vocal)07\",\"sound_id\": \"28\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 16,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": true}]',100,1,1,20,90,0,0,1,22)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern Music','','[{\"name\": \"Tavern Song 1\",\"sound_id\": \"66\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 16,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false},{\"name\": \"Tavern Song 2\",\"sound_id\": \"29\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 17,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false},{\"name\": \"Tavern Song 3\",\"sound_id\": \"30\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 16,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false},{\"name\": \"Tavern Song 4\",\"sound_id\": \"31\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 17,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false},{\"name\": \"Tavern Song 5\",\"sound_id\": \"43\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 17,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false},{\"name\": \"Tavern Song 6\",\"sound_id\": \"44\",\"vol\": 100,\"pitchSet\": 0,\"pitchVar\": 100,\"reverb\": false,\"chance\": 17,\"fadeIn\": \"1\",\"fadeOut\": \"1\",\"randLoc\": false}]',30,1,1,10,120,0,0,1,23)");

DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Very soft wind','Very soft wind','[{\"name\":\"Very soft wind\",\"sound_id\":\"45\",\"vol\":80,\"pitchSet\":0,\"pitchVar\":50,\"chance\":100,\"fadeIn\":2,\"fadeOut\":2}]',100,0,1,0,0,0,0,1,27)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Acid Bubbles','Acid Bubbles; 12 vol','[{\"name\":\"Acid Bubbles\",\"sound_id\":\"46\",\"vol\":10,\"pitchSet\":0,\"pitchVar\":0,\"chance\":100,\"fadeIn\":2,\"fadeOut\":2}]',80,0,1,1,20,1,0,1,28)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Buzzing Insects','3 different, sounds delay 20-120, randomized location','[{\"name\":\"Buzzing Insect 01\",\"sound_id\":\"47\",\"vol\":60,\"pitchSet\":0,\"pitchVar\":100,\"chance\":33,\"fadeIn\":1,\"fadeOut\":1,\"randLoc\":true},{\"name\":\"Buzzing Insect 02\",\"sound_id\":\"48\",\"vol\":60,\"pitchSet\":0,\"pitchVar\":100,\"chance\":33,\"fadeIn\":1,\"fadeOut\":1,\"randLoc\":true},{\"name\":\"buzzing insect 05\",\"sound_id\":\"49\",\"vol\":100,\"pitchSet\":0,\"pitchVar\":100,\"chance\":34,\"fadeIn\":1,\"fadeOut\":1,\"randLoc\":true}]',100,1,1,20,120,0,0,1,29)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Bubbling Mud','Random bubbling mud sounds','[{\"name\":\"mud bubble 01\",\"sound_id\":\"50\",\"vol\":75,\"pitchSet\":0,\"pitchVar\":200,\"chance\":100,\"fadeIn\":0,\"fadeOut\":0,\"randLoc\":true},{\"name\":\"Squish Mud 03\",\"sound_id\":\"51\",\"vol\":80,\"pitchSet\":0,\"pitchVar\":100,\"chance\":0,\"randLoc\":true,\"fadeIn\":0,\"fadeOut\":0}]',100,1,1,0,10,1,0,1,31)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Frogs','Misc croaking Frogs, no peepers','[{\"name\":\"scattered frogs\",\"sound_id\":\"52\",\"vol\":90,\"pitchSet\":0,\"pitchVar\":100,\"chance\":16,\"fadeIn\":1,\"fadeOut\":1,\"randLoc\":true},{\"name\":\"frog 05\",\"sound_id\":\"55\",\"vol\":100,\"pitchSet\":0,\"pitchVar\":100,\"chance\":28,\"fadeIn\":0,\"fadeOut\":0,\"randLoc\":true},{\"name\":\"frog 06\",\"sound_id\":\"54\",\"vol\":100,\"pitchSet\":0,\"pitchVar\":100,\"chance\":28,\"fadeOut\":0,\"fadeIn\":0,\"randLoc\":true},{\"name\":\"frog 07\",\"sound_id\":\"55\",\"vol\":100,\"pitchSet\":0,\"pitchVar\":100,\"chance\":28,\"fadeIn\":0,\"fadeOut\":0,\"randLoc\":true}]',100,1,1,1,20,1,0,1,32)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Swamp Birds','Sparse bird sounds','[{\"name\":\"Bird02\",\"sound_id\":\"17\",\"vol\":75,\"pitchSet\":0,\"pitchVar\":100,\"chance\":33,\"fadeIn\":0,\"fadeOut\":0,\"randLoc\":true},{\"name\":\"Bird09\",\"sound_id\":\"10\",\"vol\":75,\"pitchSet\":0,\"pitchVar\":100,\"chance\":33,\"fadeIn\":0,\"fadeOut\":0,\"randLoc\":true},{\"name\":\"EFF Animals(Misc)08\",\"sound_id\":\"34\",\"vol\":50,\"pitchSet\":0,\"pitchVar\":100,\"chance\":17,\"fadeIn\":1,\"fadeOut\":1,\"randLoc\":true},{\"name\":\"EFF Animals(Misc)10\",\"sound_id\":\"35\",\"vol\":50,\"pitchSet\":0,\"pitchVar\":100,\"chance\":17,\"fadeOut\":1,\"fadeIn\":1,\"randLoc\":true}]',80,1,1,5,20,1,0,1,33)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('amb marsh insects','amb marsh insects','[{\"name\":\"amb marsh insects\",\"sound_id\":\"56\",\"vol\":10,\"pitchSet\":0,\"pitchVar\":0,\"chance\":100,\"fadeIn\":1,\"fadeOut\":1}]',45,0,1,0,0,1,0,1,34)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `sounds`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('large roaring fire','large roaring fire','[{\"name\":\"large roaring fire\",\"sound_id\":\"57\",\"vol\":85,\"pitchSet\":0,\"pitchVar\":0,\"chance\":100,\"fadeIn\":2,\"fadeOut\":2}]',100,0,1,0,0,0,0,1,35)");

DB::insert("INSERT INTO `collections` (`name`,`id`,`desc`, `user_id`) VALUES ('Default Collection',1,'All Default Scenes',1)");

DB::insert("INSERT INTO `scenes` (`name`,`user_id`,`desc`,`volume`,`fade_in`,`fade_out`,`scene_solo`,`img`,`id`) 
VALUES ('Beach',1,'Simple waves crashing on a beach',80,2,2,0,'scene-shore.png',1),
('Bee Swarm',1,'',80,2,2,0,'scene-beeswarm.png',2),
('Thunderstorm',1,'Thunderstorm',80,2,2,0,'scene-thunderstorm.png',3),
('Combat Music',1,'Combat Music',80,2,2,0,'CombatMusic.png',4),
('Dungeon',1,'General background dungeon sounds',80,2,2,0,'scene-dungeon.png',5),
('Forest Day',1,'Wind in the trees, birds, and rustling noinse',80,2,2,0,'scene-forest.png',6),
('Large Skirmish',1,'Combat sounds, large group',80,2,2,0,'scene-combat.png',7),
('Marketplace',1,'Marketplace',80,2,2,0,'scene-marketplace.png',8),
('Forest Night',1,'Night sounds in the woods',80,2,2,0,'scene-forestnight.png',9),
('Tavern',1,'Tavern sounds and music',80,2,2,0,'scene-tavern.png',10),
('Bubbling Swamp',1,'Swamp noises',100,2,2,0,'scene-swamp.png',13),
('large roaring fire',1,'large roaring fire',100,2,2,0,'scene-largefire.png',14)");

DB::insert("INSERT INTO `collection_scene` (`collection_id`, `scene_id`) VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10)");


DB::insert("INSERT INTO `scene_effect` (`scene_id`,`effect_id`) VALUES (10,8),(10,23),(10,21),(10,20),(10,22),(9,11),(8,19),(7,18),(6,17),(6,11),(6,15),(5,5),(5,9),(4,12),(3,6),(3,7),(2,4),(1,3),(13,32),(13,28),(13,29),(13,27),(13,34),(13,31),(13,33),(14,35)");

DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (1,'GroupLaugh01','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (2,'GroupLaugh02','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (3,'GroupLaugh03','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (4,'GroupLaugh04','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (5,'GroupLaugh05','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (6,'AMB Dungeon02','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (7,'EFF Echo (Drip)01','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (8,'EFF Echo (Drip)04','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (9,'EFF Echo (Drip)05','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (10,'Bird09','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (11,'Bird08','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (12,'Bird07','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (13,'Bird06','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (14,'Bird05','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (15,'Bird04','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (16,'Bird03','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (17,'Bird02','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (18,'Bird01','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (19,'Large Skirmish 03','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (20,'AMB City Day 001','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (21,'AMB Tavern03','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (22,'EFF Tavern(Non Vocal)01','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (23,'EFF Tavern(Non Vocal)02','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (24,'EFF Tavern(Non Vocal)03','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (25,'EFF Tavern(Non Vocal)04','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (26,'EFF Tavern(Non Vocal)05','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (27,'EFF Tavern(Non Vocal)06','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (28,'EFF Tavern(Non Vocal)07','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (29,'Tavern Song 2','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (30,'Tavern Song 3','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (31,'Tavern Song 4','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (34,'EFF Animals(Misc)08','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (35,'EFF Animals(Misc)10','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (36,'Rustling 01','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (37,'Rustling 02','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (38,'Rustling 03','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (39,'FaithsEnd','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (43,'Tavern Song 5','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (44,'Tavern Song 6','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (45,'very soft wind','wav')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (46,'Acid Bubbles','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (47,'Buzzing Insect 01','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (48,'Buzzing Insect 02','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (49,'buzzing insect 05','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (50,'mud bubble 01','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (51,'Squish Mud 03','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (52,'scattered frogs','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (53,'frog 05','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (54,'frog 06','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (55,'frog 07','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (56,'amb marsh insects','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (57,'large roaring fire','mp3')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (59,'Beach','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (60,'Bee Swarm','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (61,'Rain (Heavy)','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (62,'Thunder','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (63,'Forest','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (65,'Campfire','ogg')");
DB::insert("INSERT INTO sounds (`id`,`name`,`ext`) VALUES (66,'Tavern Song 1','ogg')");
}

}