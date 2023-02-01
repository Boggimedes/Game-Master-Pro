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

DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Beach','Ocean Sounds',80,0,1,0,0,0,0,1,3)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (1,'Beach','ocean','ogg',1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`) VALUES ('Beach',3,1,2,2,100,0,0,60)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Bee Swarm','A swarm of angry bees',80,0,1,0,0,0,0,1,4)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (2,'Bee Swarm','bee insect buzz','ogg',1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`) VALUES ('Bee Swarm',4,2,5,5,100,0,0,50)");
DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Misc dungeon','Random Dungeon Sounds (needs expansion)',40,1,1,20,90,0,0,1,5)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (3,'EFF Echo (Drip)01','nature water drip','wav',1)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (4,'EFF Echo (Drip) 02','nature water drip','wav',1)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (5,'EFF Echo (Drip) 03','nature water drip','wav',1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`,`rand_loc`) VALUES ('Dripping 01',5,3,0,0,34,100,0,66,1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`,`rand_loc`) VALUES ('Dripping 02',5,4,0,0,33,100,0,67,1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`,`rand_loc`) VALUES ('Dripping 03',5,5,0,0,33,100,0,68,1)");

DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Heavy Rain','Sounds of heavy rain outdoors',80,0,1,0,0,0,0,1,6)");

DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (6,'Rain (Heavy)','nature water rain','ogg',1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`,`rand_loc`) VALUES ('Dripping 01',6,6,2,2,100,0,0,60,1)");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Thunder','Long duration thunder track',80,0,1,0,0,0,0,1,7)");
DB::insert("INSERT INTO `sound_files` (`id`,`name`,`keywords`,`ext`,`user_id`) VALUES (7,'Thunder','nature thunder','ogg',1)");
DB::insert("INSERT INTO `sounds` (`name`,`effect_id`,`sound_file_id`,`fade_out`,`fade_in`,`chance`,`pitch_var`,`pitch_set`, `vol`,`rand_loc`) VALUES ('Dripping 01',7,7,0,0,100,0,0,100,1)");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Group Laughter','Group Laughter',100,1,1,10,50,0,0,1,8)");
DB::insert("INSERT INTO sound_files SET `id` = 8,`name` = 'GroupLaugh01', `ext` = 'wav',`keywords`='voice laugh'");
DB::insert("INSERT INTO sound_files SET `id` = 9,`name` = 'GroupLaugh02', `ext` = 'wav',`keywords`='voice laugh'");
DB::insert("INSERT INTO sound_files SET `id` = 10,`name` = 'GroupLaugh03', `ext` = 'wav',`keywords`='voice laugh'");
DB::insert("INSERT INTO sound_files SET `id` = 11,`name` = 'GroupLaugh04', `ext` = 'wav',`keywords`='voice laugh'");
DB::insert("INSERT INTO sound_files SET `id` = 12,`name` = 'GroupLaugh05', `ext` = 'wav',`keywords`='voice laugh'");

DB::insert("INSERT INTO sounds SET `effect_id` = 8, `sound_file_id` = 8,`name` = 'GroupLaugh01',`vol` = 100, `pitch_set` = 0, `pitch_var` = 100, `reverb` = 0, `chance` = 20, `fade_in` = 1, `fade_out` = 1, `rand_loc` = 1");
DB::insert("INSERT INTO sounds SET `effect_id` = 8, `sound_file_id` = 9,`name` = 'GroupLaugh02',`vol` = 100, `pitch_set` = 0, `pitch_var` = 100, `reverb` = 0, `chance` = 20, `fade_in` = 1, `fade_out` = 1, `rand_loc` = 1");
DB::insert("INSERT INTO sounds SET `effect_id` = 8, `sound_file_id` = 10,`name` = 'GroupLaugh03',`vol` = 100, `pitch_set` = 0, `pitch_var` = 100, `reverb` = 0, `chance` = 20, `fade_in` = 1, `fade_out` = 1, `rand_loc` = 1");
DB::insert("INSERT INTO sounds SET `effect_id` = 8, `sound_file_id` = 11,`name` = 'GroupLaugh04',`vol` = 100, `pitch_set` = 0, `pitch_var` = 100, `reverb` = 0, `chance` = 20, `fade_in` = 1, `fade_out` = 1, `rand_loc` = 1");
DB::insert("INSERT INTO sounds SET `effect_id` = 8, `sound_file_id` = 12,`name` = 'GroupLaugh05',`vol` = 100, `pitch_set` = 0, `pitch_var` = 100, `reverb` = 0, `chance` = 20, `fade_in` = 1, `fade_out` = 1, `rand_loc` = 1");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Cave Ambience','Wind and background noise',80,0,1,0,0,0,0,1,9)");


DB::insert("INSERT INTO sound_files SET `id` = 13, `name` = 'AMB Dungeon02', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 9, `sound_file_id` = 13,`vol` =  100,`pitch_set` =  0,`pitch_var` =  0,`chance` =  100,`fade_in` =  2,`fade_out` =  2");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Wind in the trees','Wind in the trees',80,0,1,0,0,0,0,1,10)");

DB::insert("INSERT INTO sound_files SET `id` = 14,`name` = 'Wind in the Trees', `ext` = 'ogg'");
DB::insert("INSERT INTO sounds SET `effect_id` = 10, `sound_file_id` = 14, `vol` =  60,`pitch_set` =  0,`pitch_var` =  0,`chance` =  100,`fade_in` =  2,`fade_out` =  2");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Forest Rustling','Misc rustling sounds',80,1,1,20,90,0,0,1,11)");

DB::insert("INSERT INTO sound_files SET `id` = 15, `name` = 'Rustling 01', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 11, `sound_file_id` = 15,`vol` =  25,`pitch_set` =  0,`pitch_var` =  100,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");


DB::insert("INSERT INTO sound_files SET `id` = 16, `name` = 'Rustling 02', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 11, `sound_file_id` = 16,`vol` =  26,`pitch_set` =  0,`pitch_var` =  100,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc`= 1");

DB::insert("INSERT INTO sound_files SET `id` = 17, `name` = 'Rustling 03', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 11, `sound_file_id` = 17,`vol` =  27,`pitch_set` =  0,`pitch_var` =  100,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc`= 1");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('CombatMusic','',80,0,1,0,0,0,0,1,12)");

DB::insert("INSERT INTO sound_files SET `id` = 18, `name` = 'FaithsEnd', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 12, `sound_file_id` = 18,`vol` =  40,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  4,`fade_out` =  4,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Cave/Dungeon Ambience','',60,0,1,0,0,0,0,1,13)");


DB::insert("INSERT INTO sound_files SET `id` = 19, `name` = 'AMB Dungeon02', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 13, `sound_file_id` = 19,`vol` =  100,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Water Dripping and Echoing','',40,1,1,20,90,0,0,1,14)");

DB::insert("INSERT INTO sound_files SET `id` = 20, `name` = 'EFF Echo (Drip)01', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 14, `sound_file_id` = 20,`vol` =  66,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  34,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 21, `name` = 'EFF Echo (Drip)04', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 14, `sound_file_id` = 21,`vol` =  67,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  33,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 22, `name` = 'EFF Echo (Drip)05', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 14, `sound_file_id` = 21,`vol` =  68,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  33,`fade_in` =  1,`fade_out` =  1, `rand_loc` = 1");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Wind in the Trees','',80,0,1,0,0,0,0,1,15)");


DB::insert("INSERT INTO sound_files SET `id` = 23, `name` = 'Wind in the Trees', `ext` = 'ogg'");
DB::insert("INSERT INTO sounds SET `effect_id` = 15, `sound_file_id` = 23,`vol` =  60,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Brush Rustling','',80,1,1,20,90,0,0,1,16)");


DB::insert("INSERT INTO sounds SET `effect_id` = 16, `sound_file_id` = 15,`vol` =  25,`pitch_set` =  0,`pitch_var` =  100,`reverb`= 0,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc`= 1");

DB::insert("INSERT INTO sounds SET `effect_id` = 16, `sound_file_id` = 16,`vol` =  26,`pitch_set` =  0,`pitch_var` =  100,`reverb`= 0,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc`= 1");

DB::insert("INSERT INTO sounds SET `effect_id` = 16, `sound_file_id` = 17,`vol` =  27,`pitch_set` =  0,`pitch_var` =  100,`reverb`= 0,`chance` =  12,`fade_in` =  1,`fade_out` =  1,`rand_loc`= 1");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Forest Birds','',80,1,1,0,30,0,0,1,17)");

DB::insert("INSERT INTO sound_files SET `id` = 24,`name` = 'Bird09', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 24,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  4,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 25,`name` = 'Bird08', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 25,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 26,`name` = 'Bird07', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 26,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 27,`name` = 'Bird06', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 27,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 28,`name` = 'Bird05', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 17, `vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 29,`name` = 'Bird04', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 29,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 30,`name` = 'Bird03', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 30,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 31,`name` = 'Bird02', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 31,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 32,`name` = 'Bird01', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 17, `sound_file_id` = 31,`vol` =  80,`pitch_set` =  0,`pitch_var` =  200, reverb = 0, `chance` =  12,`fade_in` =  0,`fade_out` =  0, `rand_loc` = 1");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Large Combat Background','',80,0,1,0,0,0,0,1,18)");

DB::insert("INSERT INTO sound_files SET `id` = 33,`name` = 'Large Skirmish 03', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 18, `sound_file_id` = 33,`vol` =  70,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('City Marketplace','',80,0,1,0,0,0,0,1,19)");

DB::insert("INSERT INTO sound_files SET `id` = 34,`name` = 'City Marketplace', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 19, `sound_file_id` = 34,`vol` =  80,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern background','',65,0,1,0,0,0,0,1,20)");

DB::insert("INSERT INTO sound_files SET `id` = 35,`name` = 'Tavern background', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 20, `sound_file_id` = 35,`vol` =  100,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Campfire','',25,0,1,0,0,1,0,1,21)");


DB::insert("INSERT INTO sound_files SET `id` = 36,`name` = 'Fire', `ext` = 'ogg'");
DB::insert("INSERT INTO sounds SET `effect_id` = 21, `sound_file_id` = 36,`vol` =  100,`pitch_set` =  0,`pitch_var` =  0, reverb = 0, `chance` =  100,`fade_in` =  2,`fade_out` =  2,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern Non Vocal','',100,1,1,20,90,0,0,1,22)");

DB::insert("INSERT INTO sound_files SET `id` = 37,`name` = 'EFF Tavern(Non Vocal)01', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 37,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 38,`name` = 'EFF Tavern(Non Vocal)02', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 38,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 39,`name` = 'EFF Tavern(Non Vocal)03', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 39,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 40,`name` = 'EFF Tavern(Non Vocal)04', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 40,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 41,`name` = 'EFF Tavern(Non Vocal)05', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 41,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 42,`name` = 'EFF Tavern(Non Vocal)06', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 42,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  14,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 1");

DB::insert("INSERT INTO sound_files SET `id` = 43,`name` = 'EFF Tavern(Non Vocal)07', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 22, `sound_file_id` = 43,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  16,`fade_in` =  1,`fade_out` =  1, `rand_loc` = 1");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Tavern Music','',30,1,1,10,120,0,0,1,23)");

DB::insert("INSERT INTO sound_files SET `id` = 44,`name` = 'Tavern Song 1', `ext` = 'ogg'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 44,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  16,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");

DB::insert("INSERT INTO sound_files SET `id` = 45,`name` = 'Tavern Song 2', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 45,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  17,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");

DB::insert("INSERT INTO sound_files SET `id` = 46,`name` = 'Tavern Song 3', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 46,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  16,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");

DB::insert("INSERT INTO sound_files SET `id` = 47,`name` = 'Tavern Song 4', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 47,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  17,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");

DB::insert("INSERT INTO sound_files SET `id` = 48,`name` = 'Tavern Song 5', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 48,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  17,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");

DB::insert("INSERT INTO sound_files SET `id` = 49,`name` = 'Tavern Song 6', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 23, `sound_file_id` = 49,`vol` =  100,`pitch_set` =  0,`pitch_var` =  100, reverb = 0, `chance` =  17,`fade_in` =  1,`fade_out` =  1,`rand_loc` = 0");


DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Very soft wind','Very soft wind',100,0,1,0,0,0,0,1,27)");
DB::insert("INSERT INTO sound_files SET `id` = 50,`name` = 'very soft wind', `ext` = 'mp3'");
    DB::insert("INSERT INTO sounds SET `effect_id` = 27, `sound_file_id` = 50,`vol` = 80,`pitch_set` = 0,`pitch_var` = 50,`chance` = 100,`fade_in` = 2,`fade_out` = 2");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Acid Bubbles','Acid Bubbles; 12 vol',80,0,1,1,20,1,0,1,28)");
DB::insert("INSERT INTO sound_files SET `id` = 51,`name` = 'Acid Bubbles', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 28, `sound_file_id` = 51,`vol` = 12,`pitch_set` = 0,`pitch_var` = 0,`chance` = 100,`fade_in` = 2,`fade_out` = 2");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Buzzing Insects','3 different, sounds delay 20-120, randomized location',100,1,1,20,120,0,0,1,29)");
DB::insert("INSERT INTO `sound_files` SET `id` = 52,`name` = 'Buzzing Insect 01', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 29, `sound_file_id` = 52,`vol` = 60,`pitch_set` = 0,`pitch_var` = 100,`chance` = 33,`fade_in` = 1,`fade_out` = 1,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 53,`name` = 'Buzzing Insect 02', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 29, `sound_file_id` = 53,`vol` = 60,`pitch_set` = 0,`pitch_var` = 100,`chance` = 33,`fade_in` = 1,`fade_out` = 1,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 54,`name` = 'buzzing insect 05', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 29, `sound_file_id` = 54,`vol` = 100,`pitch_set` = 0,`pitch_var` = 100,`chance` = 34,`fade_in` = 1,`fade_out` = 1,`rand_loc` = 1");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Bubbling Mud','Random bubbling mud sounds',100,1,1,0,10,1,0,1,31)");
DB::insert("INSERT INTO `sound_files` SET `id` = 55,`name` = 'mud bubble 01', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 31, `sound_file_id` = 55,`vol` = 75,`pitch_set` = 0,`pitch_var` = 200,`chance` = 100,`fade_in` = 0,`fade_out` = 0,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 56,`name` = 'Squish Mud 03', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 31, `sound_file_id` = 56,`vol` = 80,`pitch_set` = 0,`pitch_var` = 100,`chance` = 0,`rand_loc` = 1,`fade_in` = 0,`fade_out` = 0");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Frogs','Misc croaking Frogs, no peepers',100,1,1,1,20,1,0,1,32)");
DB::insert("INSERT INTO `sound_files` SET `id` = 57,`name` = 'scattered frogs', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 32, `sound_file_id` = 57,`vol` = 90,`pitch_set` = 0,`pitch_var` = 100,`chance` = 16,`fade_in` = 1,`fade_out` = 1,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 58,`name` = 'frog 05', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 32, `sound_file_id` = 58,`vol` = 100,`pitch_set` = 0,`pitch_var` = 100,`chance` = 28,`fade_in` = 0,`fade_out` = 0,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 59,`name` = 'frog 06', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 32, `sound_file_id` = 59,`vol` = 100,`pitch_set` = 0,`pitch_var` = 100,`chance` = 28,`fade_out` = 0,`fade_in` = 0,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 60,`name` = 'frog 07', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 32, `sound_file_id` = 60,`vol` = 100,`pitch_set` = 0,`pitch_var` = 100,`chance` = 28,`fade_in` = 0,`fade_out` = 0,`rand_loc` = 1");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('Swamp Birds','Sparse bird sounds',80,1,1,5,20,1,0,1,33)");
DB::insert("INSERT INTO `sound_files` SET `id` = 61,`name` = 'Bird02', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 33, `sound_file_id` = 61,`vol` = 75,`pitch_set` = 0,`pitch_var` = 100,`chance` = 33,`fade_in` = 0,`fade_out` = 0,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 62,`name` = 'Bird09', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 33, `sound_file_id` = 62,`vol` = 75,`pitch_set` = 0,`pitch_var` = 100,`chance` = 33,`fade_in` = 0,`fade_out` = 0,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 63,`name` = 'EFF Animals(Misc)08', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 33, `sound_file_id` = 63,`vol` = 50,`pitch_set` = 0,`pitch_var` = 100,`chance` = 17,`fade_in` = 1,`fade_out` = 1,`rand_loc` = 1");
DB::insert("INSERT INTO `sound_files` SET `id` = 64,`name` = 'EFF Animals(Misc)10', `ext` = 'wav'");
DB::insert("INSERT INTO sounds SET `effect_id` = 33, `sound_file_id` = 64,`vol` = 50,`pitch_set` = 0,`pitch_var` = 100,`chance` = 17,`fade_out` = 1,`fade_in` = 1,`rand_loc` = 1");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('amb marsh insects','amb marsh insects',45,0,1,0,0,1,0,1,34)");
DB::insert("INSERT INTO `sound_files` SET `id` = 65,`name` = 'amb marsh insects', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 34, `sound_file_id` = 65,`vol` = 10,`pitch_set` = 0,`pitch_var` = 0,`chance` = 100,`fade_in` = 1,`fade_out` = 1");



DB::insert("INSERT INTO `effects` (`name`, `desc`, `volume`, `pre_Delay`, `loop`, `delay_min`, `delay_max`, `optional`, `seq`, `user_id`, `id`)  VALUES ('large roaring fire','large roaring fire',100,0,1,0,0,0,0,1,35)");
DB::insert("INSERT INTO `sound_files` SET `id` = 66,`name` = 'large roaring fire', `ext` = 'mp3'");
DB::insert("INSERT INTO sounds SET `effect_id` = 35, `sound_file_id` = 66,`vol` = 85,`pitch_set` = 0,`pitch_var` = 0,`chance` = 100,`fade_in` = 2,`fade_out` = 2");


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

DB::insert("INSERT INTO `collection_scene` (`collection_id`, `scene_id`) VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,13)");


DB::insert("INSERT INTO `scene_effect` (`scene_id`,`effect_id`) VALUES (10,8),(10,23),(10,21),(10,20),(10,22),(9,11),(8,19),(7,18),(6,17),(6,11),(6,15),(5,5),(5,9),(4,12),(3,6),(3,7),(2,4),(1,3),(13,32),(13,28),(13,29),(13,27),(13,34),(13,31),(13,33),(14,35)");

}

}