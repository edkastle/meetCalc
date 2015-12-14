<?php

use root\User\UserPermission;

$app->get('/register', $guest(), function() use ($app){
	$app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest(), function() use ($app){
	
	$request = $app->request;
	
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');
	$wage = $request->post('wage');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');
	
	$v = $app->validation;
	
	$v->validate([
		'First name' => [$firstName, 'required|max(50)'],
		'Last name' => [$lastName, 'required|max(50)'],
		'Wage' => [$wage, 'required|number'],
		'Username' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
		'Password' => [$password, 'required|min(6)'],
		'Password confirm' => [$passwordConfirm, 'required|matches(Password)']
	]);
	
	if($v->passes()){
		
		$user = $app->user->create([
			'first_name' => $firstName,
			'last_name' => $lastName,
			'wage' => round($wage / 3600, 4),
			'username' => $username,
			'password' => $app->hash->password($password),
		]);
		
		$app->flash('login', 'Account has been created. You can now log in.');
		return $app->response->redirect($app->urlFor('login'));
	}
	
	$app->render('auth/register.php', [
		'errors' => $v->errors(),
		'request' => $request,
	]);
	
})->name('register.post');



























$app->get('/savePeople', function() use ($guest, $app){
	
	$json =
	'
{
  "norma.gonzalez": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Gonzalez-Morales",
    "SAL_SECOND":0.0075
  },
  "angelica.hueso": {
    "FIRST_NAME":"Angelica",
    "LAST_NAME":"Hueso",
    "SAL_SECOND":0.0076
  },
  "patricia.lopez": {
    "FIRST_NAME":"Patricia",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.006
  },
  "tracy.osuna": {
    "FIRST_NAME":"Tracy",
    "LAST_NAME":"Osuna",
    "SAL_SECOND":0.006
  },
  "chris.mays": {
    "FIRST_NAME":"Christopher",
    "LAST_NAME":"Mays",
    "SAL_SECOND":0.0108
  },
  "victor.jaime": {
    "FIRST_NAME":"Victor",
    "LAST_NAME":"Jaime",
    "SAL_SECOND":0.026
  },
  "john.lau": {
    "FIRST_NAME":"John",
    "LAST_NAME":"Lau",
    "SAL_SECOND":0.0194
  },
  "nicholas.akinkuoye": {
    "FIRST_NAME":"Nicholas",
    "LAST_NAME":"Akinkuoye",
    "SAL_SECOND":0.0183
  },
  "ted.ceasar": {
    "FIRST_NAME":"Ted",
    "LAST_NAME":"Ceasar",
    "SAL_SECOND":0.019
  },
  "sergio.lopez": {
    "FIRST_NAME":"Sergio",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.0184
  },
  "efrain.silva": {
    "FIRST_NAME":"Efrain",
    "LAST_NAME":"Silva",
    "SAL_SECOND":0.0184
  },
  "tina.aguirre": {
    "FIRST_NAME":"Justina",
    "LAST_NAME":"Aguirre",
    "SAL_SECOND":0.0173
  },
  "ashok.naimpally": {
    "FIRST_NAME":"Ashok",
    "LAST_NAME":"Naimpally",
    "SAL_SECOND":0.0163
  },
  "rick.webster": {
    "FIRST_NAME":"Richard",
    "LAST_NAME":"Webster",
    "SAL_SECOND":0.0167
  },
  "carlos.fletes": {
    "FIRST_NAME":"Luis Carlos",
    "LAST_NAME":"Fletes",
    "SAL_SECOND":0.0167
  },
  "shawn.larry": {
    "FIRST_NAME":"Shawn",
    "LAST_NAME":"Larry",
    "SAL_SECOND":0.0168
  },
  "david.zielinski": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Zielinski",
    "SAL_SECOND":0.0159
  },
  "becky.green": {
    "FIRST_NAME":"Rebecca",
    "LAST_NAME":"Green",
    "SAL_SECOND":0.0153
  },
  "jim.mecate": {
    "FIRST_NAME":"James",
    "LAST_NAME":"Mecate II",
    "SAL_SECOND":0.0162
  },
  "lilia.sandoval": {
    "FIRST_NAME":"Lilia",
    "LAST_NAME":"Sandoval",
    "SAL_SECOND":0.0189
  },
  "stella.orfanos-woo": {
    "FIRST_NAME":"Stella",
    "LAST_NAME":"Orfanos Woo",
    "SAL_SECOND":0.0189
  },
  "norma.nunez": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Nunez",
    "SAL_SECOND":0.0189
  },
  "raquel.garcia": {
    "FIRST_NAME":"Raquel",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0189
  },
  "jesus.esqueda": {
    "FIRST_NAME":"Jesus",
    "LAST_NAME":"Esqueda",
    "SAL_SECOND":0.0189
  },
  "beatriz.alvarado": {
    "FIRST_NAME":"Beatriz",
    "LAST_NAME":"Alvarado",
    "SAL_SECOND":0.0189
  },
  "craig.blek": {
    "FIRST_NAME":"Craig",
    "LAST_NAME":"Blek",
    "SAL_SECOND":0.0189
  },
  "dave.drury": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Drury",
    "SAL_SECOND":0.0162
  },
  "olga.artechi": {
    "FIRST_NAME":"Gloria",
    "LAST_NAME":"Artechi",
    "SAL_SECOND":0.0189
  },
  "dolores.diaz": {
    "FIRST_NAME":"Dolores",
    "LAST_NAME":"Diaz",
    "SAL_SECOND":0.0189
  },
  "ralph.marquez": {
    "FIRST_NAME":"Ralph",
    "LAST_NAME":"Marquez",
    "SAL_SECOND":0.0189
  },
  "said.canez": {
    "FIRST_NAME":"Said",
    "LAST_NAME":"Canez-Savala",
    "SAL_SECOND":0.0189
  },
  "kathleen.dorantes": {
    "FIRST_NAME":"Kathleen",
    "LAST_NAME":"Dorantes",
    "SAL_SECOND":0.0189
  },
  "norma.nava": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Nava",
    "SAL_SECOND":0.0189
  },
  "jeff.enz": {
    "FIRST_NAME":"Jeffrey",
    "LAST_NAME":"Enz",
    "SAL_SECOND":0.0141
  },
  "lourdes.mercado": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Mercado",
    "SAL_SECOND":0.0183
  },
  "martha.garcia": {
    "FIRST_NAME":"Martha",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0148
  },
  "jeff.beckley": {
    "FIRST_NAME":"Jeffrey",
    "LAST_NAME":"Beckley",
    "SAL_SECOND":0.0207
  },
  "james.patterson": {
    "FIRST_NAME":"James",
    "LAST_NAME":"Patterson",
    "SAL_SECOND":0.0207
  },
  "nannette.kelly": {
    "FIRST_NAME":"Nannette",
    "LAST_NAME":"Kelly",
    "SAL_SECOND":0.0207
  },
  "sam.david": {
    "FIRST_NAME":"Samuel",
    "LAST_NAME":"David",
    "SAL_SECOND":0.0207
  },
  "jim.fisher": {
    "FIRST_NAME":"James",
    "LAST_NAME":"Fisher",
    "SAL_SECOND":0.0207
  },
  "jose.carrillo": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Carrillo",
    "SAL_SECOND":0.0134
  },
  "gloria.carmona": {
    "FIRST_NAME":"Gloria",
    "LAST_NAME":"Hoisington",
    "SAL_SECOND":0.0134
  },
  "jeff.cantwell": {
    "FIRST_NAME":"Jeffrey",
    "LAST_NAME":"Cantwell",
    "SAL_SECOND":0.0134
  },
  "gilbert.campos": {
    "FIRST_NAME":"Gilberto",
    "LAST_NAME":"Campos",
    "SAL_SECOND":0.0178
  },
  "jose.plascencia": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Plascencia",
    "SAL_SECOND":0.0178
  },
  "mireya.felix": {
    "FIRST_NAME":"Mireya",
    "LAST_NAME":"Felix",
    "SAL_SECOND":0.0178
  },
  "yolanda.romero": {
    "FIRST_NAME":"Yolanda",
    "LAST_NAME":"Romero",
    "SAL_SECOND":0.0178
  },
  "mary.lofgren": {
    "FIRST_NAME":"Mary",
    "LAST_NAME":"Lofgren",
    "SAL_SECOND":0.0178
  },
  "rosalie.lopez": {
    "FIRST_NAME":"Rosalie",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.0178
  },
  "paige.lovitt": {
    "FIRST_NAME":"Paige",
    "LAST_NAME":"Lovitt",
    "SAL_SECOND":0.0178
  },
  "betty.kakiuchi": {
    "FIRST_NAME":"Bertha",
    "LAST_NAME":"Kakiuchi",
    "SAL_SECOND":0.013
  },
  "cathy.zazueta": {
    "FIRST_NAME":"Cathy",
    "LAST_NAME":"Zazueta",
    "SAL_SECOND":0.0173
  },
  "trini.arguelles": {
    "FIRST_NAME":"Trinidad",
    "LAST_NAME":"Arguelles",
    "SAL_SECOND":0.0173
  },
  "lori.mazeroll": {
    "FIRST_NAME":"Lorrainne",
    "LAST_NAME":"Mazeroll",
    "SAL_SECOND":0.0173
  },
  "kevin.white": {
    "FIRST_NAME":"Kevin",
    "LAST_NAME":"White",
    "SAL_SECOND":0.0173
  },
  "beatriz.avila": {
    "FIRST_NAME":"Beatriz",
    "LAST_NAME":"Avila",
    "SAL_SECOND":0.0148
  },
  "jose.lopez": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.0173
  },
  "walid.ghanim": {
    "FIRST_NAME":"Walid",
    "LAST_NAME":"Ghanim",
    "SAL_SECOND":0.0207
  },
  "sidne.horton": {
    "FIRST_NAME":"Sidne",
    "LAST_NAME":"Horton",
    "SAL_SECOND":0.0207
  },
  "edward.scheuerell": {
    "FIRST_NAME":"Edward",
    "LAST_NAME":"Scheuerell",
    "SAL_SECOND":0.0207
  },
  "alex.voldman": {
    "FIRST_NAME":"Aleksandr",
    "LAST_NAME":"Voldman",
    "SAL_SECOND":0.0207
  },
  "scott.simpson": {
    "FIRST_NAME":"Scott",
    "LAST_NAME":"Simpson",
    "SAL_SECOND":0.0207
  },
  "deirdre.rowley": {
    "FIRST_NAME":"Deirdre",
    "LAST_NAME":"Rowley",
    "SAL_SECOND":0.0207
  },
  "suzanne.gretz": {
    "FIRST_NAME":"Suzanne",
    "LAST_NAME":"Gretz",
    "SAL_SECOND":0.0207
  },
  "robin.staton": {
    "FIRST_NAME":"Mary",
    "LAST_NAME":"Staton",
    "SAL_SECOND":0.0207
  },
  "angie.ruiz": {
    "FIRST_NAME":"Angelica",
    "LAST_NAME":"Ruiz",
    "SAL_SECOND":0.0207
  },
  "josefina.ponce": {
    "FIRST_NAME":"Josefina",
    "LAST_NAME":"Ponce",
    "SAL_SECOND":0.0207
  },
  "mardjan.shokoufi": {
    "FIRST_NAME":"Mardjan",
    "LAST_NAME":"Shokoufi",
    "SAL_SECOND":0.0207
  },
  "todd.hansink": {
    "FIRST_NAME":"Todd",
    "LAST_NAME":"Hansink",
    "SAL_SECOND":0.0207
  },
  "rick.fitzsimmons": {
    "FIRST_NAME":"Richard",
    "LAST_NAME":"Fitzsimmons",
    "SAL_SECOND":0.0207
  },
  "jose.ruiz": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Ruiz",
    "SAL_SECOND":0.0195
  },
  "russell.lavery": {
    "FIRST_NAME":"Russell",
    "LAST_NAME":"Lavery",
    "SAL_SECOND":0.0195
  },
  "michael.heumann": {
    "FIRST_NAME":"Michael",
    "LAST_NAME":"Heumann",
    "SAL_SECOND":0.0195
  },
  "lisa.seals": {
    "FIRST_NAME":"Lisa",
    "LAST_NAME":"Seals",
    "SAL_SECOND":0.0127
  },
  "omar.ramos": {
    "FIRST_NAME":"Omar",
    "LAST_NAME":"Ramos",
    "SAL_SECOND":0.0127
  },
  "thomas.morrell": {
    "FIRST_NAME":"Thomas",
    "LAST_NAME":"Morrell",
    "SAL_SECOND":0.0189
  },
  "andrew.chien": {
    "FIRST_NAME":"Andrew",
    "LAST_NAME":"Chien",
    "SAL_SECOND":0.0189
  },
  "tanya.dorsey": {
    "FIRST_NAME":"Tanya",
    "LAST_NAME":"Dorsey",
    "SAL_SECOND":0.0163
  },
  "carol.hegarty": {
    "FIRST_NAME":"Carol",
    "LAST_NAME":"Hegarty",
    "SAL_SECOND":0.0163
  },
  "maria.esquer": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Esquer",
    "SAL_SECOND":0.0163
  },
  "judy.cormier": {
    "FIRST_NAME":"Judy",
    "LAST_NAME":"Cormier",
    "SAL_SECOND":0.0195
  },
  "frank.rapp": {
    "FIRST_NAME":"Frank",
    "LAST_NAME":"Rapp",
    "SAL_SECOND":0.0195
  },
  "jill.tucker": {
    "FIRST_NAME":"Jill",
    "LAST_NAME":"Tucker",
    "SAL_SECOND":0.0195
  },
  "roberta.bemis": {
    "FIRST_NAME":"Roberta",
    "LAST_NAME":"Bemis",
    "SAL_SECOND":0.0195
  },
  "celeste.armenta": {
    "FIRST_NAME":"Celeste",
    "LAST_NAME":"Armenta",
    "SAL_SECOND":0.0195
  },
  "hope.davis": {
    "FIRST_NAME":"Hope",
    "LAST_NAME":"Davis",
    "SAL_SECOND":0.0184
  },
  "alfonso.sanchez": {
    "FIRST_NAME":"Alfonso",
    "LAST_NAME":"Sanchez",
    "SAL_SECOND":0.0121
  },
  "todd.evangelist": {
    "FIRST_NAME":"Todd",
    "LAST_NAME":"Evangelist",
    "SAL_SECOND":0.0119
  },
  "sydney.rice": {
    "FIRST_NAME":"Sydney",
    "LAST_NAME":"Rice",
    "SAL_SECOND":0.0158
  },
  "gaylla.finnell": {
    "FIRST_NAME":"Gaylla",
    "LAST_NAME":"Finnell",
    "SAL_SECOND":0.0135
  },
  "daniel.gilison": {
    "FIRST_NAME":"Daniel",
    "LAST_NAME":"Gilison",
    "SAL_SECOND":0.0149
  },
  "maryjo.wainwright": {
    "FIRST_NAME":"Mary Jo",
    "LAST_NAME":"Wainwright",
    "SAL_SECOND":0.0189
  },
  "bruce.page": {
    "FIRST_NAME":"Bruce",
    "LAST_NAME":"Page",
    "SAL_SECOND":0.0189
  },
  "romano.sanchez-domin": {
    "FIRST_NAME":"Romano",
    "LAST_NAME":"Sanchez-Dominguez",
    "SAL_SECOND":0.0189
  },
  "nancy.lay": {
    "FIRST_NAME":"Nancy",
    "LAST_NAME":"Lay",
    "SAL_SECOND":0.0189
  },
  "jeff.deyo": {
    "FIRST_NAME":"Jeffrey",
    "LAST_NAME":"Deyo",
    "SAL_SECOND":0.0189
  },
  "patrick.pauley": {
    "FIRST_NAME":"Patrick",
    "LAST_NAME":"Pauley",
    "SAL_SECOND":0.0178
  },
  "rod.smart": {
    "FIRST_NAME":"Rodney",
    "LAST_NAME":"Smart",
    "SAL_SECOND":0.0116
  },
  "edward.wells": {
    "FIRST_NAME":"Edward",
    "LAST_NAME":"Wells",
    "SAL_SECOND":0.0153
  },
  "bettsie.montero": {
    "FIRST_NAME":"Claudia",
    "LAST_NAME":"Montero",
    "SAL_SECOND":0.0115
  },
  "bradford.wright": {
    "FIRST_NAME":"Bradford",
    "LAST_NAME":"Wright",
    "SAL_SECOND":0.0173
  },
  "glenn.swiadon": {
    "FIRST_NAME":"Glenn",
    "LAST_NAME":"Swiadon",
    "SAL_SECOND":0.0173
  },
  "alex.cozzani": {
    "FIRST_NAME":"Alejandro",
    "LAST_NAME":"Cozzani",
    "SAL_SECOND":0.0173
  },
  "javier.rangel": {
    "FIRST_NAME":"Javier",
    "LAST_NAME":"Rangel",
    "SAL_SECOND":0.0173
  },
  "allyn.leon": {
    "FIRST_NAME":"Allyn",
    "LAST_NAME":"Leon",
    "SAL_SECOND":0.0184
  },
  "mary.carter": {
    "FIRST_NAME":"Mary",
    "LAST_NAME":"Carter",
    "SAL_SECOND":0.0112
  },
  "frank.hoppe": {
    "FIRST_NAME":"Frank",
    "LAST_NAME":"Hoppe",
    "SAL_SECOND":0.0149
  },
  "myriam.fletes": {
    "FIRST_NAME":"Myriam",
    "LAST_NAME":"Fletes",
    "SAL_SECOND":0.0149
  },
  "rick.castrapel": {
    "FIRST_NAME":"Rick",
    "LAST_NAME":"Castrapel",
    "SAL_SECOND":0.0178
  },
  "isabel.sigala": {
    "FIRST_NAME":"Ana",
    "LAST_NAME":"Sigala",
    "SAL_SECOND":0.0145
  },
  "kevin.howell": {
    "FIRST_NAME":"Kevin",
    "LAST_NAME":"Howell",
    "SAL_SECOND":0.0173
  },
  "susan.moss": {
    "FIRST_NAME":"Susan",
    "LAST_NAME":"Moss",
    "SAL_SECOND":0.0173
  },
  "leticia.pastrana": {
    "FIRST_NAME":"Leticia",
    "LAST_NAME":"Pastrana",
    "SAL_SECOND":0.0173
  },
  "carey.fristrup": {
    "FIRST_NAME":"Carey",
    "LAST_NAME":"Fristrup",
    "SAL_SECOND":0.014
  },
  "jill.nelipovich": {
    "FIRST_NAME":"Jill",
    "LAST_NAME":"Nelipovich",
    "SAL_SECOND":0.0168
  },
  "sheila.freeman": {
    "FIRST_NAME":"Sheila",
    "LAST_NAME":"Dorsey-Freeman",
    "SAL_SECOND":0.0104
  },
  "fonda.miller": {
    "FIRST_NAME":"Fonda",
    "LAST_NAME":"Miller",
    "SAL_SECOND":0.0166
  },
  "julie.craven": {
    "FIRST_NAME":"Julie",
    "LAST_NAME":"Craven",
    "SAL_SECOND":0.0166
  },
  "diane.harris": {
    "FIRST_NAME":"Diane",
    "LAST_NAME":"Harris",
    "SAL_SECOND":0.0166
  },
  "eddie.chang": {
    "FIRST_NAME":"Eddie",
    "LAST_NAME":"Chang",
    "SAL_SECOND":0.0154
  },
  "veronica.soto": {
    "FIRST_NAME":"Veronica",
    "LAST_NAME":"Soto",
    "SAL_SECOND":0.0127
  },
  "christina.shaner": {
    "FIRST_NAME":"Christina",
    "LAST_NAME":"Shaner",
    "SAL_SECOND":0.0163
  },
  "manfred.knaak": {
    "FIRST_NAME":"Manfred",
    "LAST_NAME":"Knaak",
    "SAL_SECOND":0.0163
  },
  "eric.lehtonen": {
    "FIRST_NAME":"Eric",
    "LAST_NAME":"Lehtonen",
    "SAL_SECOND":0.0163
  },
  "vikki.carr": {
    "FIRST_NAME":"Virginia",
    "LAST_NAME":"Carr",
    "SAL_SECOND":0.0101
  },
  "mark.duva": {
    "FIRST_NAME":"Mark",
    "LAST_NAME":"Duva",
    "SAL_SECOND":0.0149
  },
  "bertha.ortega": {
    "FIRST_NAME":"Bertha",
    "LAST_NAME":"Ortega",
    "SAL_SECOND":0.01
  },
  "audrey.morris": {
    "FIRST_NAME":"Audrey",
    "LAST_NAME":"Morris",
    "SAL_SECOND":0.0158
  },
  "andres.martinez": {
    "FIRST_NAME":"Andres",
    "LAST_NAME":"Martinez",
    "SAL_SECOND":0.0158
  },
  "terry.norris": {
    "FIRST_NAME":"Terry",
    "LAST_NAME":"Norris",
    "SAL_SECOND":0.0129
  },
  "david.sheppard": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Sheppard",
    "SAL_SECOND":0.0154
  },
  "xochitl.tirado": {
    "FIRST_NAME":"Xochitl",
    "LAST_NAME":"Tirado",
    "SAL_SECOND":0.0154
  },
  "alto.benedicto": {
    "FIRST_NAME":"Alto",
    "LAST_NAME":"Benedicto",
    "SAL_SECOND":0.0154
  },
  "robert.baukholt": {
    "FIRST_NAME":"Robert",
    "LAST_NAME":"Baukholt",
    "SAL_SECOND":0.0154
  },
  "ricardo.pradis": {
    "FIRST_NAME":"Ricardo",
    "LAST_NAME":"Pradis",
    "SAL_SECOND":0.0152
  },
  "linda.amidon": {
    "FIRST_NAME":"Ermelinda",
    "LAST_NAME":"Amidon",
    "SAL_SECOND":0.0095
  },
  "laura.gudino": {
    "FIRST_NAME":"Laura",
    "LAST_NAME":"Hartsock",
    "SAL_SECOND":0.0094
  },
  "maria.neely": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Neely",
    "SAL_SECOND":0.0107
  },
  "norma.scott": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Scott",
    "SAL_SECOND":0.0107
  },
  "jacqueline.cortez": {
    "FIRST_NAME":"Jacqueline",
    "LAST_NAME":"Cortez",
    "SAL_SECOND":0.0107
  },
  "kristen.gomez": {
    "FIRST_NAME":"Kristen",
    "LAST_NAME":"Shipman",
    "SAL_SECOND":0.0107
  },
  "alex.garza": {
    "FIRST_NAME":"Alejandro",
    "LAST_NAME":"Garza",
    "SAL_SECOND":0.0149
  },
  "carol.cortes-ramirez": {
    "FIRST_NAME":"Carolina",
    "LAST_NAME":"Cortes-Ramirez",
    "SAL_SECOND":1.6019
  },
  "rick.goldsberry": {
    "FIRST_NAME":"Rick",
    "LAST_NAME":"Goldsberry",
    "SAL_SECOND":0.0121
  },
  "lupita.castro": {
    "FIRST_NAME":"Guadalupe",
    "LAST_NAME":"Castro",
    "SAL_SECOND":0.0104
  },
  "rosalio.marin": {
    "FIRST_NAME":"Rosalio",
    "LAST_NAME":"Marin",
    "SAL_SECOND":0.0091
  },
  "jose.alarcon": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Alarcon",
    "SAL_SECOND":0.0091
  },
  "alison.brock": {
    "FIRST_NAME":"Alison",
    "LAST_NAME":"Brock",
    "SAL_SECOND":0.0145
  },
  "behrang.madani": {
    "FIRST_NAME":"Behrang",
    "LAST_NAME":"Madani",
    "SAL_SECOND":0.0145
  },
  "richard.epps": {
    "FIRST_NAME":"Richard",
    "LAST_NAME":"Epps",
    "SAL_SECOND":0.0145
  },
  "sabrina.worsham": {
    "FIRST_NAME":"Sabrina",
    "LAST_NAME":"Worsham",
    "SAL_SECOND":0.0145
  },
  "daniel.ortiz": {
    "FIRST_NAME":"Daniel",
    "LAST_NAME":"Ortiz",
    "SAL_SECOND":0.0145
  },
  "rumaldo.marquez": {
    "FIRST_NAME":"Rumaldo",
    "LAST_NAME":"Marquez",
    "SAL_SECOND":0.0145
  },
  "frank.miranda": {
    "FIRST_NAME":"Frank",
    "LAST_NAME":"Miranda",
    "SAL_SECOND":0.0145
  },
  "jose.torres": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Torres",
    "SAL_SECOND":0.0088
  },
  "rosalba.jepson": {
    "FIRST_NAME":"Rosalba",
    "LAST_NAME":"Jepson",
    "SAL_SECOND":0.0141
  },
  "jill.kitzmiller": {
    "FIRST_NAME":"Jill",
    "LAST_NAME":"Kitzmiller",
    "SAL_SECOND":0.0141
  },
  "kevin.marty": {
    "FIRST_NAME":"Kevin",
    "LAST_NAME":"Marty",
    "SAL_SECOND":0.0141
  },
  "nicole.rodiles": {
    "FIRST_NAME":"Nicole",
    "LAST_NAME":"Rodiles",
    "SAL_SECOND":0.0141
  },
  "lisa.solomon": {
    "FIRST_NAME":"Lisa",
    "LAST_NAME":"Solomon",
    "SAL_SECOND":0.0141
  },
  "steve.cook": {
    "FIRST_NAME":"Steven",
    "LAST_NAME":"Cook",
    "SAL_SECOND":0.0087
  },
  "jia.sun": {
    "FIRST_NAME":"Jia",
    "LAST_NAME":"Sun",
    "SAL_SECOND":0.0117
  },
  "lisa.cross": {
    "FIRST_NAME":"Lisa",
    "LAST_NAME":"Cross",
    "SAL_SECOND":0.0086
  },
  "mirtha.galindo": {
    "FIRST_NAME":"Mirtha",
    "LAST_NAME":"Galindo",
    "SAL_SECOND":0.0086
  },
  "martha.bandivas": {
    "FIRST_NAME":"Martha",
    "LAST_NAME":"Sanchez",
    "SAL_SECOND":0.0086
  },
  "alex.aguilar": {
    "FIRST_NAME":"Alejandro",
    "LAST_NAME":"Aguilar",
    "SAL_SECOND":0.0086
  },
  "matt.thale": {
    "FIRST_NAME":"Matthew",
    "LAST_NAME":"Thale",
    "SAL_SECOND":0.0086
  },
  "arturo.ramirez": {
    "FIRST_NAME":"Arturo",
    "LAST_NAME":"Ramirez",
    "SAL_SECOND":0.0098
  },
  "aaron.edwards": {
    "FIRST_NAME":"Aaron",
    "LAST_NAME":"Edwards",
    "SAL_SECOND":0.0137
  },
  "steve.holt": {
    "FIRST_NAME":"Steve",
    "LAST_NAME":"Holt",
    "SAL_SECOND":0.0137
  },
  "maria.trejo": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Trejo",
    "SAL_SECOND":0.0085
  },
  "toni.gamboa": {
    "FIRST_NAME":"Maria Antonia",
    "LAST_NAME":"Gamboa",
    "SAL_SECOND":0.0084
  },
  "jesus.valenzuela": {
    "FIRST_NAME":"Jesus",
    "LAST_NAME":"Valenzuela",
    "SAL_SECOND":0.0083
  },
  "roberta.webster": {
    "FIRST_NAME":"Roberta",
    "LAST_NAME":"Webster",
    "SAL_SECOND":0.0133
  },
  "austen.thelen": {
    "FIRST_NAME":"Austen",
    "LAST_NAME":"Thelen",
    "SAL_SECOND":0.0133
  },
  "gordon.bailey": {
    "FIRST_NAME":"Gordon",
    "LAST_NAME":"Bailey",
    "SAL_SECOND":0.0133
  },
  "oscar.hernandez": {
    "FIRST_NAME":"Oscar",
    "LAST_NAME":"Hernandez",
    "SAL_SECOND":0.0133
  },
  "jose.velasquez": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Velasquez",
    "SAL_SECOND":0.0133
  },
  "dixie.krimm": {
    "FIRST_NAME":"Dixie",
    "LAST_NAME":"Krimm",
    "SAL_SECOND":0.0082
  },
  "rex.robinson": {
    "FIRST_NAME":"Rex",
    "LAST_NAME":"Robinson",
    "SAL_SECOND":0.0082
  },
  "joe.espinoza": {
    "FIRST_NAME":"Joe",
    "LAST_NAME":"Espinoza",
    "SAL_SECOND":0.0081
  },
  "manuel.sanchez": {
    "FIRST_NAME":"Manuel",
    "LAST_NAME":"Sanchez",
    "SAL_SECOND":0.0081
  },
  "olivia.garcia": {
    "FIRST_NAME":"Olivia",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0129
  },
  "terrie.sullivan": {
    "FIRST_NAME":"Terrie",
    "LAST_NAME":"Sullivan",
    "SAL_SECOND":0.0129
  },
  "andrew.robinson": {
    "FIRST_NAME":"Andrew",
    "LAST_NAME":"Robinson",
    "SAL_SECOND":0.0129
  },
  "donald.sillings": {
    "FIRST_NAME":"Donald",
    "LAST_NAME":"Sillings",
    "SAL_SECOND":0.0117
  },
  "kathy.rodriguez": {
    "FIRST_NAME":"Kathy",
    "LAST_NAME":"Rodriguez",
    "SAL_SECOND":0.0129
  },
  "mike.nicholas": {
    "FIRST_NAME":"Michael",
    "LAST_NAME":"Nicholas",
    "SAL_SECOND":0.0079
  },
  "zhong.hu": {
    "FIRST_NAME":"Zhong",
    "LAST_NAME":"Hu",
    "SAL_SECOND":0.0098
  },
  "nancy.hoyt": {
    "FIRST_NAME":"Nancy",
    "LAST_NAME":"Hoyt",
    "SAL_SECOND":0.0078
  },
  "isabel.contreras": {
    "FIRST_NAME":"Isabel",
    "LAST_NAME":"Contreras",
    "SAL_SECOND":0.0078
  },
  "pedro.colio": {
    "FIRST_NAME":"Pedro",
    "LAST_NAME":"Colio",
    "SAL_SECOND":0.0125
  },
  "liisa.mendoza": {
    "FIRST_NAME":"Liisa",
    "LAST_NAME":"Mendoza",
    "SAL_SECOND":0.0125
  },
  "phyllis.gilliam": {
    "FIRST_NAME":"Phyllis",
    "LAST_NAME":"Gilliam",
    "SAL_SECOND":0.0077
  },
  "raul.gomez": {
    "FIRST_NAME":"Raul",
    "LAST_NAME":"Gomez",
    "SAL_SECOND":0.0076
  },
  "gina.madrid": {
    "FIRST_NAME":"Georgina",
    "LAST_NAME":"Madrid",
    "SAL_SECOND":0.0076
  },
  "nick.makarchuk": {
    "FIRST_NAME":"Nicholas",
    "LAST_NAME":"Makarchuk",
    "SAL_SECOND":0.0076
  },
  "saria.cardoza": {
    "FIRST_NAME":"Saria",
    "LAST_NAME":"Cardoza",
    "SAL_SECOND":0.0076
  },
  "patricia.robles": {
    "FIRST_NAME":"Patricia",
    "LAST_NAME":"Robles",
    "SAL_SECOND":0.0076
  },
  "dennis.abubo": {
    "FIRST_NAME":"Dennis",
    "LAST_NAME":"Abubo",
    "SAL_SECOND":0.0076
  },
  "silvia.murray": {
    "FIRST_NAME":"Silvia",
    "LAST_NAME":"Murray",
    "SAL_SECOND":0.0076
  },
  "david.poor": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Poor",
    "SAL_SECOND":0.0076
  },
  "cristal.mora": {
    "FIRST_NAME":"Cristal",
    "LAST_NAME":"Mora",
    "SAL_SECOND":0.011
  },
  "caroline.bennett": {
    "FIRST_NAME":"Caroline",
    "LAST_NAME":"Bennett",
    "SAL_SECOND":0.011
  },
  "nannette.everly": {
    "FIRST_NAME":"Nannette",
    "LAST_NAME":"Everly",
    "SAL_SECOND":0.0075
  },
  "anthony.green": {
    "FIRST_NAME":"Anthony",
    "LAST_NAME":"Green",
    "SAL_SECOND":0.0075
  },
  "pablo.chavez": {
    "FIRST_NAME":"Pablo",
    "LAST_NAME":"Chavez",
    "SAL_SECOND":0.0075
  },
  "raquel.gonzalez": {
    "FIRST_NAME":"Raquel",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.0074
  },
  "jonathan.singh": {
    "FIRST_NAME":"Jonathan",
    "LAST_NAME":"Singh",
    "SAL_SECOND":0.0074
  },
  "sara.hernandez": {
    "FIRST_NAME":"Sara",
    "LAST_NAME":"Hernandez",
    "SAL_SECOND":0.0074
  },
  "liz.cantu": {
    "FIRST_NAME":"Elizabeth",
    "LAST_NAME":"Cantu",
    "SAL_SECOND":0.0074
  },
  "elena.wayne": {
    "FIRST_NAME":"Elena",
    "LAST_NAME":"Wayne",
    "SAL_SECOND":0.0073
  },
  "jessica.waddell": {
    "FIRST_NAME":"Jessica",
    "LAST_NAME":"Waddell",
    "SAL_SECOND":0.0073
  },
  "adriana.sano": {
    "FIRST_NAME":"Adriana",
    "LAST_NAME":"Sano",
    "SAL_SECOND":0.0073
  },
  "angie.gallo": {
    "FIRST_NAME":"Angelica",
    "LAST_NAME":"Gallo",
    "SAL_SECOND":0.0071
  },
  "karina.lopez": {
    "FIRST_NAME":"Karina",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.0071
  },
  "alma.orozco": {
    "FIRST_NAME":"Alma",
    "LAST_NAME":"Orozco",
    "SAL_SECOND":0.0071
  },
  "gloria.arrington": {
    "FIRST_NAME":"Gloria",
    "LAST_NAME":"Arrington",
    "SAL_SECOND":0.0071
  },
  "dolores.hartfield": {
    "FIRST_NAME":"Dolores",
    "LAST_NAME":"Hartfield",
    "SAL_SECOND":0.007
  },
  "carlos.araiza": {
    "FIRST_NAME":"Carlos",
    "LAST_NAME":"Araiza",
    "SAL_SECOND":0.0101
  },
  "claudia.aguilar": {
    "FIRST_NAME":"Claudia",
    "LAST_NAME":"Aguilar",
    "SAL_SECOND":0.0069
  },
  "josue.verduzco": {
    "FIRST_NAME":"Josue",
    "LAST_NAME":"Verduzco",
    "SAL_SECOND":0.0068
  },
  "salvador.gutierrez": {
    "FIRST_NAME":"Salvador",
    "LAST_NAME":"Gutierrez",
    "SAL_SECOND":0.0068
  },
  "gabriel.gonzalez": {
    "FIRST_NAME":"Gabriel",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.0068
  },
  "maryann.smith": {
    "FIRST_NAME":"Mary Ann",
    "LAST_NAME":"Monte Smith",
    "SAL_SECOND":0.0068
  },
  "daren.burns": {
    "FIRST_NAME":"Daren",
    "LAST_NAME":"Burns",
    "SAL_SECOND":0.0108
  },
  "laura.semmes": {
    "FIRST_NAME":"Laura",
    "LAST_NAME":"Semmes",
    "SAL_SECOND":0.0108
  },
  "frances.arce-gomez": {
    "FIRST_NAME":"Frances",
    "LAST_NAME":"Arce-Gomez",
    "SAL_SECOND":0.0067
  },
  "elvia.machado": {
    "FIRST_NAME":"Elvia",
    "LAST_NAME":"Camillo",
    "SAL_SECOND":0.0067
  },
  "sara.wheat": {
    "FIRST_NAME":"Sara",
    "LAST_NAME":"Wheat",
    "SAL_SECOND":0.0067
  },
  "charlene.cruz": {
    "FIRST_NAME":"Charlene",
    "LAST_NAME":"Cruz",
    "SAL_SECOND":0.0066
  },
  "arnold.salazar": {
    "FIRST_NAME":"Arnold",
    "LAST_NAME":"Salazar",
    "SAL_SECOND":0.0066
  },
  "melody.chronister": {
    "FIRST_NAME":"Melody",
    "LAST_NAME":"Chronister",
    "SAL_SECOND":0.0066
  },
  "ana.rojas": {
    "FIRST_NAME":"Ana",
    "LAST_NAME":"Rojas",
    "SAL_SECOND":0.0066
  },
  "edward.cesena": {
    "FIRST_NAME":"Edward",
    "LAST_NAME":"Cesena",
    "SAL_SECOND":0.0066
  },
  "grace.espinoza": {
    "FIRST_NAME":"Graciela",
    "LAST_NAME":"Espinoza",
    "SAL_SECOND":0.0066
  },
  "mariaf.garcia": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0065
  },
  "jeff.burt": {
    "FIRST_NAME":"Jeffrey",
    "LAST_NAME":"Burt",
    "SAL_SECOND":0.0095
  },
  "monica.rogers": {
    "FIRST_NAME":"Monica",
    "LAST_NAME":"Rogers",
    "SAL_SECOND":0.0064
  },
  "lency.lucas": {
    "FIRST_NAME":"Lency",
    "LAST_NAME":"Lucas",
    "SAL_SECOND":0.0064
  },
  "leticia.santiago": {
    "FIRST_NAME":"Leticia",
    "LAST_NAME":"Santiago",
    "SAL_SECOND":0.0062
  },
  "cesar.supnet": {
    "FIRST_NAME":"Cesar",
    "LAST_NAME":"Supnet",
    "SAL_SECOND":0.0062
  },
  "norma.santana": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Santana",
    "SAL_SECOND":0.0062
  },
  "hugo.fregoso": {
    "FIRST_NAME":"Hugo",
    "LAST_NAME":"Fregoso",
    "SAL_SECOND":0.0062
  },
  "martha.olea": {
    "FIRST_NAME":"Martha",
    "LAST_NAME":"Olea",
    "SAL_SECOND":0.0061
  },
  "yazmin.andrade": {
    "FIRST_NAME":"Yazmin",
    "LAST_NAME":"Andrade",
    "SAL_SECOND":0.006
  },
  "marisa.izarraraz": {
    "FIRST_NAME":"Marissa",
    "LAST_NAME":"Izarraraz",
    "SAL_SECOND":0.006
  },
  "maggie.vizcarra": {
    "FIRST_NAME":"Margarita",
    "LAST_NAME":"Vizcarra",
    "SAL_SECOND":0.006
  },
  "rebeca.solache": {
    "FIRST_NAME":"Rebeca",
    "LAST_NAME":"Solache",
    "SAL_SECOND":0.006
  },
  "diana.barrios": {
    "FIRST_NAME":"Dianamelissa",
    "LAST_NAME":"Barrios",
    "SAL_SECOND":0.006
  },
  "desiree.gonzales": {
    "FIRST_NAME":"Desiree",
    "LAST_NAME":"Gonzales",
    "SAL_SECOND":0.006
  },
  "tara.wells": {
    "FIRST_NAME":"Tara",
    "LAST_NAME":"Wells",
    "SAL_SECOND":0.006
  },
  "paula.saldana": {
    "FIRST_NAME":"Paula",
    "LAST_NAME":"Saldana",
    "SAL_SECOND":0.006
  },
  "rafael.diaz": {
    "FIRST_NAME":"Rafael",
    "LAST_NAME":"Diaz",
    "SAL_SECOND":0.0059
  },
  "marcia.reyes": {
    "FIRST_NAME":"Marcia",
    "LAST_NAME":"Reyes",
    "SAL_SECOND":0.0058
  },
  "maria.maciel": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Maciel",
    "SAL_SECOND":0.0058
  },
  "mirella.cital": {
    "FIRST_NAME":"Mirella",
    "LAST_NAME":"Cital",
    "SAL_SECOND":0.0058
  },
  "fernando.garcia": {
    "FIRST_NAME":"Fernando",
    "LAST_NAME":"Garcia Quirarte",
    "SAL_SECOND":0.0057
  },
  "yethel.alonso": {
    "FIRST_NAME":"Yethel",
    "LAST_NAME":"Alonso",
    "SAL_SECOND":0.0057
  },
  "raul.montes": {
    "FIRST_NAME":"Raul",
    "LAST_NAME":"Montes",
    "SAL_SECOND":0.0057
  },
  "rafael.torres": {
    "FIRST_NAME":"Rafael",
    "LAST_NAME":"Torres",
    "SAL_SECOND":0.0057
  },
  "cristina.samano": {
    "FIRST_NAME":"Cristina",
    "LAST_NAME":"Samano",
    "SAL_SECOND":0.0055
  },
  "maria.pinuelas": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Pinuelas",
    "SAL_SECOND":0.0055
  },
  "kandy.algravez": {
    "FIRST_NAME":"Kandy",
    "LAST_NAME":"Algravez",
    "SAL_SECOND":0.0055
  },
  "art.rendon": {
    "FIRST_NAME":"Arturo",
    "LAST_NAME":"Rendon",
    "SAL_SECOND":0.0055
  },
  "adriela.belellano": {
    "FIRST_NAME":"Adriela",
    "LAST_NAME":"Belellano",
    "SAL_SECOND":0.0072
  },
  "irma.felix": {
    "FIRST_NAME":"Irma",
    "LAST_NAME":"Felix- Ayala",
    "SAL_SECOND":0.0054
  },
  "joann.green": {
    "FIRST_NAME":"Joann",
    "LAST_NAME":"Green",
    "SAL_SECOND":0.0053
  },
  "erika.aguilar": {
    "FIRST_NAME":"Erika",
    "LAST_NAME":"Aguilar",
    "SAL_SECOND":0.0053
  },
  "maria.sell": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Sell",
    "SAL_SECOND":0.0053
  },
  "rhonda.ruiz": {
    "FIRST_NAME":"Rhonda",
    "LAST_NAME":"Ruiz",
    "SAL_SECOND":0.0053
  },
  "vicky.figueroa": {
    "FIRST_NAME":"Maria Virginia",
    "LAST_NAME":"Figueroa",
    "SAL_SECOND":0.0053
  },
  "oralia.larios": {
    "FIRST_NAME":"Oralia",
    "LAST_NAME":"Larios",
    "SAL_SECOND":0.0053
  },
  "tricia.jones": {
    "FIRST_NAME":"Patricia",
    "LAST_NAME":"Jones",
    "SAL_SECOND":0.0052
  },
  "nancy.sanchez": {
    "FIRST_NAME":"Nancy",
    "LAST_NAME":"Sanchez",
    "SAL_SECOND":0.0052
  },
  "ofelia.duarte": {
    "FIRST_NAME":"Ofelia",
    "LAST_NAME":"Duarte",
    "SAL_SECOND":0.0052
  },
  "martha.navarro": {
    "FIRST_NAME":"Martha",
    "LAST_NAME":"Navarro",
    "SAL_SECOND":0.0052
  },
  "sandie.noel": {
    "FIRST_NAME":"Sandra",
    "LAST_NAME":"Noel",
    "SAL_SECOND":0.0052
  },
  "miriam.trejo": {
    "FIRST_NAME":"Miriam",
    "LAST_NAME":"Trejo",
    "SAL_SECOND":0.0052
  },
  "esther.frias": {
    "FIRST_NAME":"Esther",
    "LAST_NAME":"Frias",
    "SAL_SECOND":0.0062
  },
  "carol.grajeda": {
    "FIRST_NAME":"Carol",
    "LAST_NAME":"Grajeda",
    "SAL_SECOND":0.005
  },
  "ivan.gonzalez": {
    "FIRST_NAME":"Ivan Omar",
    "LAST_NAME":"Gonzalez Torres",
    "SAL_SECOND":0.005
  },
  "sixto.diaz": {
    "FIRST_NAME":"Sixto",
    "LAST_NAME":"Diaz",
    "SAL_SECOND":0.005
  },
  "edgar.lara": {
    "FIRST_NAME":"Edgar",
    "LAST_NAME":"Lara",
    "SAL_SECOND":0.0049
  },
  "roberto.delgado": {
    "FIRST_NAME":"Roberto",
    "LAST_NAME":"Delgado Bazaldua",
    "SAL_SECOND":0.0049
  },
  "abigail.arballo": {
    "FIRST_NAME":"Abigail",
    "LAST_NAME":"Arballo",
    "SAL_SECOND":0.0048
  },
  "linda.stills": {
    "FIRST_NAME":"Linda",
    "LAST_NAME":"Stills",
    "SAL_SECOND":0.0046
  },
  "suellen.gonzalez": {
    "FIRST_NAME":"Suellen",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.009
  },
  "normay.gonzalez": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.0045
  },
  "douglas.rosette": {
    "FIRST_NAME":"Douglas",
    "LAST_NAME":"Rosette",
    "SAL_SECOND":0.0045
  },
  "raymond.herrera": {
    "FIRST_NAME":"Raymond",
    "LAST_NAME":"Herrera",
    "SAL_SECOND":0.0045
  },
  "jorge.marquez": {
    "FIRST_NAME":"Jorge",
    "LAST_NAME":"Marquez",
    "SAL_SECOND":0.0045
  },
  "ruben.mokay": {
    "FIRST_NAME":"Ruben",
    "LAST_NAME":"Mokay",
    "SAL_SECOND":0.0043
  },
  "juan.sandoval": {
    "FIRST_NAME":"Juan",
    "LAST_NAME":"Sandoval",
    "SAL_SECOND":0.0043
  },
  "ricardo.ruiz": {
    "FIRST_NAME":"Ricardo",
    "LAST_NAME":"Ruiz",
    "SAL_SECOND":0.0043
  },
  "analisa.veliz": {
    "FIRST_NAME":"Analisa",
    "LAST_NAME":"Veliz",
    "SAL_SECOND":0.0052
  },
  "jose.aguilar": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Aguilar",
    "SAL_SECOND":0.0041
  },
  "martin.moreno": {
    "FIRST_NAME":"Martin",
    "LAST_NAME":"Moreno",
    "SAL_SECOND":0.0041
  },
  "mabel.vargas": {
    "FIRST_NAME":"Mabel",
    "LAST_NAME":"Vargas",
    "SAL_SECOND":0.0069
  },
  "steve.sciaky": {
    "FIRST_NAME":"Steven",
    "LAST_NAME":"Sciaky",
    "SAL_SECOND":0.0068
  },
  "lizeth.merino": {
    "FIRST_NAME":"Lizeth",
    "LAST_NAME":"Merino",
    "SAL_SECOND":0.0058
  },
  "arturo.galeana": {
    "FIRST_NAME":"Arturo",
    "LAST_NAME":"Galeana",
    "SAL_SECOND":0.0055
  },
  "nubia.heras": {
    "FIRST_NAME":"Nubia",
    "LAST_NAME":"Heras",
    "SAL_SECOND":0.0048
  },
  "sara.gonzalez": {
    "FIRST_NAME":"Sara",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.0047
  },
  "jc.aguilar": {
    "FIRST_NAME":"Juan",
    "LAST_NAME":"Aguilar Valenzuela",
    "SAL_SECOND":0.0046
  },
  "susie.luna": {
    "FIRST_NAME":"Susie",
    "LAST_NAME":"Luna",
    "SAL_SECOND":0.0042
  },
  "carmen.fitzsimmons": {
    "FIRST_NAME":"Carmen",
    "LAST_NAME":"Fitzsimmons",
    "SAL_SECOND":0.0167
  },
  "luis.hernandez": {
    "FIRST_NAME":"Luis",
    "LAST_NAME":"Hernandez",
    "SAL_SECOND":0.0167
  },
  "jill.lerno": {
    "FIRST_NAME":"Jill",
    "LAST_NAME":"Lerno",
    "SAL_SECOND":0.0167
  },
  "don.ross": {
    "FIRST_NAME":"Donnye",
    "LAST_NAME":"Ross",
    "SAL_SECOND":0.0167
  },
  "mikey.palacio": {
    "FIRST_NAME":"John",
    "LAST_NAME":"Palacio Jr.",
    "SAL_SECOND":0.0167
  },
  "mike.palacio": {
    "FIRST_NAME":"John",
    "LAST_NAME":"Palacio",
    "SAL_SECOND":0.0167
  },
  "jose.olmedo": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Olmedo",
    "SAL_SECOND":0.0167
  },
  "ricardo.jimenez": {
    "FIRST_NAME":"Ricardo",
    "LAST_NAME":"Jimenez",
    "SAL_SECOND":0.0167
  },
  "ruben.varela": {
    "FIRST_NAME":"Ruben",
    "LAST_NAME":"Varela",
    "SAL_SECOND":0.0167
  },
  "porfirio.hernandez": {
    "FIRST_NAME":"Porfirio",
    "LAST_NAME":"Hernandez",
    "SAL_SECOND":0.0167
  },
  "jeronimo.garay": {
    "FIRST_NAME":"Jeronimo",
    "LAST_NAME":"Garay",
    "SAL_SECOND":0.0167
  },
  "carolina.gonti": {
    "FIRST_NAME":"Carolina",
    "LAST_NAME":"Gonti",
    "SAL_SECOND":0.0167
  },
  "maria.grivanos": {
    "FIRST_NAME":"Maria Luisa",
    "LAST_NAME":"Grivanos",
    "SAL_SECOND":0.0167
  },
  "maria.garcia": {
    "FIRST_NAME":"Maria",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "alejandra.galaviz": {
    "FIRST_NAME":"Alejandra",
    "LAST_NAME":"Galaviz",
    "SAL_SECOND":0.0167
  },
  "arturo.juarez": {
    "FIRST_NAME":"Arturo",
    "LAST_NAME":"Juarez",
    "SAL_SECOND":0.0167
  },
  "fernanda.moran": {
    "FIRST_NAME":"Fernanda",
    "LAST_NAME":"Moran",
    "SAL_SECOND":0.0167
  },
  "elizabeth.kemp": {
    "FIRST_NAME":"Elizabeth",
    "LAST_NAME":"Kemp",
    "SAL_SECOND":0.0167
  },
  "santos.moran": {
    "FIRST_NAME":"Santos",
    "LAST_NAME":"Moran",
    "SAL_SECOND":0.0167
  },
  "linda.freitas": {
    "FIRST_NAME":"Linda",
    "LAST_NAME":"Freitas",
    "SAL_SECOND":0.0167
  },
  "arashmidos.monjazeb": {
    "FIRST_NAME":"Arashmidos",
    "LAST_NAME":"Monjazeb",
    "SAL_SECOND":0.0167
  },
  "adriana.torres": {
    "FIRST_NAME":"Jesus Adriana",
    "LAST_NAME":"Torres",
    "SAL_SECOND":0.0167
  },
  "aaron.abubo": {
    "FIRST_NAME":"Aaron",
    "LAST_NAME":"Abubo",
    "SAL_SECOND":0.0167
  },
  "jorge.estrada": {
    "FIRST_NAME":"Jorge",
    "LAST_NAME":"Estrada",
    "SAL_SECOND":0.0167
  },
  "susan.altamirano": {
    "FIRST_NAME":"Susan",
    "LAST_NAME":"Altamirano",
    "SAL_SECOND":0.0167
  },
  "hugo.ortega": {
    "FIRST_NAME":"Hugo",
    "LAST_NAME":"Ortega",
    "SAL_SECOND":0.0167
  },
  "rafael.contreras": {
    "FIRST_NAME":"Rafael",
    "LAST_NAME":"Contreras",
    "SAL_SECOND":0.0167
  },
  "jeff.mason": {
    "FIRST_NAME":"Jeff",
    "LAST_NAME":"Mason",
    "SAL_SECOND":0.0167
  },
  "jesus.serrano": {
    "FIRST_NAME":"Jesus",
    "LAST_NAME":"Serrano",
    "SAL_SECOND":0.0167
  },
  "carlos.canez": {
    "FIRST_NAME":"Carlos",
    "LAST_NAME":"Canez",
    "SAL_SECOND":0.0167
  },
  "ida.obeso": {
    "FIRST_NAME":"Ida",
    "LAST_NAME":"Obeso",
    "SAL_SECOND":0.0167
  },
  "jose.landeros": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Landeros",
    "SAL_SECOND":0.0167
  },
  "bret.kofford": {
    "FIRST_NAME":"Bret",
    "LAST_NAME":"Kofford",
    "SAL_SECOND":0.0167
  },
  "michael.swearingen": {
    "FIRST_NAME":"Michael",
    "LAST_NAME":"Swearingen",
    "SAL_SECOND":0.0167
  },
  "toni.pfister": {
    "FIRST_NAME":"Toni",
    "LAST_NAME":"Pfister",
    "SAL_SECOND":0.0167
  },
  "temo.carboni": {
    "FIRST_NAME":"Cuauhtemoc",
    "LAST_NAME":"Carboni",
    "SAL_SECOND":0.0167
  },
  "manuel.guzman": {
    "FIRST_NAME":"Manuel",
    "LAST_NAME":"Guzman",
    "SAL_SECOND":0.0167
  },
  "michael.capeci": {
    "FIRST_NAME":"Michael",
    "LAST_NAME":"Capeci",
    "SAL_SECOND":0.0167
  },
  "aruna.patel": {
    "FIRST_NAME":"Aruna",
    "LAST_NAME":"Patel",
    "SAL_SECOND":0.0167
  },
  "charlotte.murray": {
    "FIRST_NAME":"Charlotte",
    "LAST_NAME":"Murray",
    "SAL_SECOND":0.0167
  },
  "raul.navarro": {
    "FIRST_NAME":"Raul",
    "LAST_NAME":"Navarro",
    "SAL_SECOND":0.0167
  },
  "tina.williams": {
    "FIRST_NAME":"Tina",
    "LAST_NAME":"Williams",
    "SAL_SECOND":0.0167
  },
  "fred.rivera": {
    "FIRST_NAME":"Alfredo",
    "LAST_NAME":"Rivera",
    "SAL_SECOND":0.0167
  },
  "juanita.reyes": {
    "FIRST_NAME":"Juanita",
    "LAST_NAME":"Reyes",
    "SAL_SECOND":0.0167
  },
  "richard.colunga": {
    "FIRST_NAME":"Richard",
    "LAST_NAME":"Colunga Jr.",
    "SAL_SECOND":0.0167
  },
  "roxanne.nunez": {
    "FIRST_NAME":"Roxanne",
    "LAST_NAME":"Nunez",
    "SAL_SECOND":0.0167
  },
  "pompeyo.tabarez": {
    "FIRST_NAME":"Pompeyo",
    "LAST_NAME":"Tabarez",
    "SAL_SECOND":0.0167
  },
  "veronica.landeros": {
    "FIRST_NAME":"Veronica",
    "LAST_NAME":"Landeros",
    "SAL_SECOND":0.0167
  },
  "carlos.duarte": {
    "FIRST_NAME":"Carlos",
    "LAST_NAME":"Duarte",
    "SAL_SECOND":0.0167
  },
  "benny.benavidez": {
    "FIRST_NAME":"Benny",
    "LAST_NAME":"Benavidez",
    "SAL_SECOND":0.0167
  },
  "raenelle.fisher": {
    "FIRST_NAME":"Raenelle",
    "LAST_NAME":"Fisher",
    "SAL_SECOND":0.0167
  },
  "amy.loper": {
    "FIRST_NAME":"Amy",
    "LAST_NAME":"Loper",
    "SAL_SECOND":0.0167
  },
  "phil.beckett": {
    "FIRST_NAME":"Phillip",
    "LAST_NAME":"Beckett",
    "SAL_SECOND":0.0167
  },
  "darren.simon": {
    "FIRST_NAME":"Darren",
    "LAST_NAME":"Simon",
    "SAL_SECOND":0.0167
  },
  "jay.lewenstein": {
    "FIRST_NAME":"Jay",
    "LAST_NAME":"Lewenstein",
    "SAL_SECOND":0.0167
  },
  "francisco.mayoral": {
    "FIRST_NAME":"Francisco",
    "LAST_NAME":"Mayoral",
    "SAL_SECOND":0.0167
  },
  "harriet.williams": {
    "FIRST_NAME":"Harriet",
    "LAST_NAME":"Williams",
    "SAL_SECOND":0.0167
  },
  "nikolai.beope": {
    "FIRST_NAME":"Nikolai",
    "LAST_NAME":"Beope",
    "SAL_SECOND":0.0167
  },
  "reetika.dhawan": {
    "FIRST_NAME":"Reetika",
    "LAST_NAME":"Dhawan",
    "SAL_SECOND":0.0167
  },
  "jose.roman": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Roman",
    "SAL_SECOND":0.0167
  },
  "cynthia.ramirez": {
    "FIRST_NAME":"Cynthia",
    "LAST_NAME":"Ramirez",
    "SAL_SECOND":0.0167
  },
  "angel.sandoval": {
    "FIRST_NAME":"Angel",
    "LAST_NAME":"Sandoval",
    "SAL_SECOND":0.0167
  },
  "velarmino.suarez": {
    "FIRST_NAME":"Velarmino",
    "LAST_NAME":"Suarez",
    "SAL_SECOND":0.0167
  },
  "sacha.sykora": {
    "FIRST_NAME":"Sacha",
    "LAST_NAME":"Sykora",
    "SAL_SECOND":0.0167
  },
  "joe.apodaca": {
    "FIRST_NAME":"Joe",
    "LAST_NAME":"Apodaca",
    "SAL_SECOND":0.0167
  },
  "lidia.trejo": {
    "FIRST_NAME":"Lidia",
    "LAST_NAME":"Trejo",
    "SAL_SECOND":0.0167
  },
  "jesus.hernandez": {
    "FIRST_NAME":"Jesus",
    "LAST_NAME":"Hernandez",
    "SAL_SECOND":0.0153
  },
  "holly.chase": {
    "FIRST_NAME":"Holly",
    "LAST_NAME":"Chase",
    "SAL_SECOND":0.0167
  },
  "vicki.viloria": {
    "FIRST_NAME":"Vicki",
    "LAST_NAME":"Viloria",
    "SAL_SECOND":0.0167
  },
  "adam.ekins": {
    "FIRST_NAME":"Adam",
    "LAST_NAME":"Ekins",
    "SAL_SECOND":0.0167
  },
  "kaylene.elliott": {
    "FIRST_NAME":"Kaylene",
    "LAST_NAME":"Elliott",
    "SAL_SECOND":0.0167
  },
  "oscar.cervantes": {
    "FIRST_NAME":"Oscar",
    "LAST_NAME":"Cervantes Marmolejo",
    "SAL_SECOND":0.0167
  },
  "obed.flores": {
    "FIRST_NAME":"Obed",
    "LAST_NAME":"Flores",
    "SAL_SECOND":0.0167
  },
  "david.martinez": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Martinez",
    "SAL_SECOND":0.0167
  },
  "mohammad.ahrar": {
    "FIRST_NAME":"Mohammad",
    "LAST_NAME":"Ahrar",
    "SAL_SECOND":0.0167
  },
  "jennifer.castro": {
    "FIRST_NAME":"Jennifer",
    "LAST_NAME":"Castro",
    "SAL_SECOND":0.0167
  },
  "renee.owens": {
    "FIRST_NAME":"Renee",
    "LAST_NAME":"Owens",
    "SAL_SECOND":0.0167
  },
  "monica.ketchum": {
    "FIRST_NAME":"Monica",
    "LAST_NAME":"Ketchum",
    "SAL_SECOND":0.0167
  },
  "ronald.griffen": {
    "FIRST_NAME":"Ron",
    "LAST_NAME":"Griffen",
    "SAL_SECOND":0.0167
  },
  "john.fahim": {
    "FIRST_NAME":"John",
    "LAST_NAME":"Fahim",
    "SAL_SECOND":0.0167
  },
  "thomas.jones": {
    "FIRST_NAME":"Thomas",
    "LAST_NAME":"Jones",
    "SAL_SECOND":0.0167
  },
  "katarina.olea": {
    "FIRST_NAME":"Katarina",
    "LAST_NAME":"Olea",
    "SAL_SECOND":0.0167
  },
  "robert.herbert": {
    "FIRST_NAME":"Robert",
    "LAST_NAME":"Herbert",
    "SAL_SECOND":0.0167
  },
  "jack.staton": {
    "FIRST_NAME":"Jack",
    "LAST_NAME":"Staton",
    "SAL_SECOND":0.0167
  },
  "renee.baker": {
    "FIRST_NAME":"Renee",
    "LAST_NAME":"Baker",
    "SAL_SECOND":0.0167
  },
  "lillian.finnell": {
    "FIRST_NAME":"Lillian",
    "LAST_NAME":"Finnell",
    "SAL_SECOND":0.0167
  },
  "evangelina.lapena": {
    "FIRST_NAME":"Evangelina",
    "LAST_NAME":"Lapena",
    "SAL_SECOND":0.0165
  },
  "pendley": {
    "FIRST_NAME":"Jimmy",
    "LAST_NAME":"Pendley",
    "SAL_SECOND":0.0167
  },
  "gilberto.reyes": {
    "FIRST_NAME":"Gilberto",
    "LAST_NAME":"Reyes",
    "SAL_SECOND":0.0167
  },
  "norma.villicana": {
    "FIRST_NAME":"Norma",
    "LAST_NAME":"Villicana",
    "SAL_SECOND":0.0167
  },
  "tony.sanchez": {
    "FIRST_NAME":"Tony",
    "LAST_NAME":"Sanchez",
    "SAL_SECOND":0.0167
  },
  "claudia.macias": {
    "FIRST_NAME":"Claudia",
    "LAST_NAME":"Saldana",
    "SAL_SECOND":0.0167
  },
  "javier.jimenez": {
    "FIRST_NAME":"Javier",
    "LAST_NAME":"Jimenez",
    "SAL_SECOND":0.0167
  },
  "alfredo.estradajr": {
    "FIRST_NAME":"Alfredo",
    "LAST_NAME":"Estrada Jr.",
    "SAL_SECOND":0.0167
  },
  "baldev.singh": {
    "FIRST_NAME":"Baldev",
    "LAST_NAME":"Singh",
    "SAL_SECOND":0.0167
  },
  "aziz.abdin": {
    "FIRST_NAME":"Aziz",
    "LAST_NAME":"Abdin",
    "SAL_SECOND":0.0167
  },
  "kori.ryerson": {
    "FIRST_NAME":"Kori",
    "LAST_NAME":"Ryerson",
    "SAL_SECOND":0.0167
  },
  "marilu.fletes": {
    "FIRST_NAME":"Marilu",
    "LAST_NAME":"Fletes",
    "SAL_SECOND":0.0167
  },
  "alejandro.garcia": {
    "FIRST_NAME":"Alejandro",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "jose.perez": {
    "FIRST_NAME":"Jose",
    "LAST_NAME":"Perez",
    "SAL_SECOND":0.0167
  },
  "reyna.gutierrez": {
    "FIRST_NAME":"Reyna",
    "LAST_NAME":"Gutierrez",
    "SAL_SECOND":0.0167
  },
  "margie.garcia": {
    "FIRST_NAME":"Margarita",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "sandra.castro": {
    "FIRST_NAME":"Sandra",
    "LAST_NAME":"Castro",
    "SAL_SECOND":0.0167
  },
  "james.castle": {
    "FIRST_NAME":"James",
    "LAST_NAME":"Castle",
    "SAL_SECOND":null
  },
  "jason.hobbs": {
    "FIRST_NAME":"Jason",
    "LAST_NAME":"Hobbs",
    "SAL_SECOND":0.0167
  },
  "enola.berker": {
    "FIRST_NAME":"Enola",
    "LAST_NAME":"Berker",
    "SAL_SECOND":0.0167
  },
  "yolanda.paz-gilbert": {
    "FIRST_NAME":"Yolanda",
    "LAST_NAME":"Paz-Gilbert",
    "SAL_SECOND":0.0167
  },
  "ascencion.felix": {
    "FIRST_NAME":"Ascencion",
    "LAST_NAME":"Felix",
    "SAL_SECOND":0.0167
  },
  "felix.deleon": {
    "FIRST_NAME":"Felix",
    "LAST_NAME":"De Leon",
    "SAL_SECOND":0.0167
  },
  "javier.bernal": {
    "FIRST_NAME":"Javier",
    "LAST_NAME":"Bernal",
    "SAL_SECOND":0.0167
  },
  "kimberly.walther": {
    "FIRST_NAME":"Kimberly",
    "LAST_NAME":"Walther",
    "SAL_SECOND":0.0167
  },
  "judy.cruz": {
    "FIRST_NAME":"Judy",
    "LAST_NAME":"Cruz",
    "SAL_SECOND":null
  },
  "elaine.hackett": {
    "FIRST_NAME":"Elaine",
    "LAST_NAME":"Hackett",
    "SAL_SECOND":null
  },
  "frank.fernandez": {
    "FIRST_NAME":"Frank",
    "LAST_NAME":"Fernandez",
    "SAL_SECOND":0.0167
  },
  "abril.diaz": {
    "FIRST_NAME":"Abril",
    "LAST_NAME":"Diaz",
    "SAL_SECOND":0.0167
  },
  "ramiro.salas": {
    "FIRST_NAME":"Ramiro",
    "LAST_NAME":"Salas",
    "SAL_SECOND":0.0167
  },
  "ronette.gray": {
    "FIRST_NAME":"Ronette",
    "LAST_NAME":"Gray",
    "SAL_SECOND":0.0167
  },
  "sylvia.lemus": {
    "FIRST_NAME":"Sylvia",
    "LAST_NAME":"Lemus",
    "SAL_SECOND":0.0167
  },
  "steven.williams": {
    "FIRST_NAME":"Steven",
    "LAST_NAME":"Williams",
    "SAL_SECOND":0.0167
  },
  "david.mcbride": {
    "FIRST_NAME":"David",
    "LAST_NAME":"McBride",
    "SAL_SECOND":0.0167
  },
  "jami.myles": {
    "FIRST_NAME":"Jami",
    "LAST_NAME":"Myles-Wells",
    "SAL_SECOND":0.0167
  },
  "julie.yi": {
    "FIRST_NAME":"Julie",
    "LAST_NAME":"Yi",
    "SAL_SECOND":0.0167
  },
  "barbara.reyes": {
    "FIRST_NAME":"Barbara",
    "LAST_NAME":"Reyes",
    "SAL_SECOND":0.0167
  },
  "oli.bachie": {
    "FIRST_NAME":"Oli",
    "LAST_NAME":"Bachie",
    "SAL_SECOND":0.0167
  },
  "paul.rodriguez": {
    "FIRST_NAME":"Paul",
    "LAST_NAME":"Rodriguez",
    "SAL_SECOND":0.0167
  },
  "gary.redfern": {
    "FIRST_NAME":"Gary",
    "LAST_NAME":"Redfern",
    "SAL_SECOND":0.0167
  },
  "brooke.kofford": {
    "FIRST_NAME":"Brooke",
    "LAST_NAME":"Kofford",
    "SAL_SECOND":0.0167
  },
  "timothy.hutchinson": {
    "FIRST_NAME":"Timothy",
    "LAST_NAME":"Hutchinson",
    "SAL_SECOND":0.0167
  },
  "eddie.madueno": {
    "FIRST_NAME":"Eddie",
    "LAST_NAME":"Madueno",
    "SAL_SECOND":0.0167
  },
  "ronnie.garrie": {
    "FIRST_NAME":"Ronnie",
    "LAST_NAME":"Garrie",
    "SAL_SECOND":0.0167
  },
  "tim.druihet": {
    "FIRST_NAME":"Timothy",
    "LAST_NAME":"Rolland-Druihet",
    "SAL_SECOND":0.0167
  },
  "audelia.canez": {
    "FIRST_NAME":"Audelia",
    "LAST_NAME":"Canez",
    "SAL_SECOND":0.0167
  },
  "aida.valdez": {
    "FIRST_NAME":"Aida",
    "LAST_NAME":"Valdez",
    "SAL_SECOND":0.0167
  },
  "david.bradshaw": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Bradshaw",
    "SAL_SECOND":0.0167
  },
  "anabelle.alvarez": {
    "FIRST_NAME":"Anabelle",
    "LAST_NAME":"Alvarez",
    "SAL_SECOND":0.0167
  },
  "anthony.escalera": {
    "FIRST_NAME":"Anthony",
    "LAST_NAME":"Escalera",
    "SAL_SECOND":0.0167
  },
  "maricruz.cabrera": {
    "FIRST_NAME":"Maricruz",
    "LAST_NAME":"Cabrera",
    "SAL_SECOND":0.0167
  },
  "robert.malek": {
    "FIRST_NAME":"Robert",
    "LAST_NAME":"Malek",
    "SAL_SECOND":0.0164
  },
  "lizbeth.pena": {
    "FIRST_NAME":"Lizbeth",
    "LAST_NAME":"Pena",
    "SAL_SECOND":0.0167
  },
  "crystal.mcsee": {
    "FIRST_NAME":"Crystal",
    "LAST_NAME":"McSee",
    "SAL_SECOND":null
  },
  "shawn.angulo": {
    "FIRST_NAME":"Shawn",
    "LAST_NAME":"Angulo",
    "SAL_SECOND":0.0167
  },
  "enrique.lechuga": {
    "FIRST_NAME":"Enrique",
    "LAST_NAME":"Lechuga Jr.",
    "SAL_SECOND":0.0528
  },
  "leslie.knappIV": {
    "FIRST_NAME":"Leslie",
    "LAST_NAME":"Knapp IV",
    "SAL_SECOND":0.0167
  },
  "lois.weinstein": {
    "FIRST_NAME":"Lois",
    "LAST_NAME":"Weinstein",
    "SAL_SECOND":0.0167
  },
  "omar.mandujano": {
    "FIRST_NAME":"Omar",
    "LAST_NAME":"Mandujano",
    "SAL_SECOND":0.0167
  },
  "carlos.romero": {
    "FIRST_NAME":"Carlos",
    "LAST_NAME":"Romero",
    "SAL_SECOND":0.0167
  },
  "aaron.messick": {
    "FIRST_NAME":"Aaron",
    "LAST_NAME":"Messick",
    "SAL_SECOND":0.0167
  },
  "alejandro.ochoa": {
    "FIRST_NAME":"Alejandro",
    "LAST_NAME":"Ochoa",
    "SAL_SECOND":0.0167
  },
  "paula.dolf": {
    "FIRST_NAME":"Paula",
    "LAST_NAME":"Dolf",
    "SAL_SECOND":0.0167
  },
  "rebecca.agundez": {
    "FIRST_NAME":"Rebecca",
    "LAST_NAME":"Agundez",
    "SAL_SECOND":0.0167
  },
  "ralph.fernandez": {
    "FIRST_NAME":"Ralph",
    "LAST_NAME":"Fernandez Sr.",
    "SAL_SECOND":0.0167
  },
  "brad.chapin": {
    "FIRST_NAME":"Brad",
    "LAST_NAME":"Chapin",
    "SAL_SECOND":0.0167
  },
  "robert.zimmer": {
    "FIRST_NAME":"Robert",
    "LAST_NAME":"Zimmer",
    "SAL_SECOND":0.0167
  },
  "alejandra.villegas": {
    "FIRST_NAME":"Alejandra",
    "LAST_NAME":"Villegas",
    "SAL_SECOND":0.0167
  },
  "wes.knowlton": {
    "FIRST_NAME":"Wes",
    "LAST_NAME":"Knowlton",
    "SAL_SECOND":0.0167
  },
  "david.creiglow": {
    "FIRST_NAME":"David",
    "LAST_NAME":"Creiglow",
    "SAL_SECOND":0.0167
  },
  "brandon.walls": {
    "FIRST_NAME":"Brandon",
    "LAST_NAME":"Walls",
    "SAL_SECOND":0.0167
  },
  "cory.vandriessche": {
    "FIRST_NAME":"Cory",
    "LAST_NAME":"Van Driessche",
    "SAL_SECOND":0.0167
  },
  "oscarm.garcia": {
    "FIRST_NAME":"Oscar",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "elizabeth.trevino": {
    "FIRST_NAME":"Elizabeth",
    "LAST_NAME":"Trevino",
    "SAL_SECOND":0.0167
  },
  "rosario.garcia": {
    "FIRST_NAME":"Maria Del Rosario",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "kristina.bailey": {
    "FIRST_NAME":"Kristina",
    "LAST_NAME":"Bailey",
    "SAL_SECOND":0.0167
  },
  "helena.quintana": {
    "FIRST_NAME":"Helena",
    "LAST_NAME":"Quintana",
    "SAL_SECOND":0.0167
  },
  "erik.hiraoka": {
    "FIRST_NAME":"Erik",
    "LAST_NAME":"Hiraoka",
    "SAL_SECOND":0.0167
  },
  "guillermo.garcia": {
    "FIRST_NAME":"Guillermo",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0167
  },
  "sal.flores": {
    "FIRST_NAME":"Salvador",
    "LAST_NAME":"Flores",
    "SAL_SECOND":0.0167
  },
  "adrian.celaya": {
    "FIRST_NAME":"Adrian",
    "LAST_NAME":"Celaya",
    "SAL_SECOND":0.0167
  },
  "wayne.spears": {
    "FIRST_NAME":"Wayne",
    "LAST_NAME":"Spears",
    "SAL_SECOND":0.0167
  },
  "danny.lopez": {
    "FIRST_NAME":"Danny",
    "LAST_NAME":"Lopez",
    "SAL_SECOND":0.0167
  },
  "alfonso.ruiz": {
    "FIRST_NAME":"Alfonso",
    "LAST_NAME":"Ruiz",
    "SAL_SECOND":0.0128
  },
  "pat.urena": {
    "FIRST_NAME":"Patricia",
    "LAST_NAME":"Urena",
    "SAL_SECOND":0.0128
  },
  "susana.montano": {
    "FIRST_NAME":"Susana",
    "LAST_NAME":"Montano",
    "SAL_SECOND":0.0128
  },
  "monica.castro": {
    "FIRST_NAME":"Monica",
    "LAST_NAME":"Castro",
    "SAL_SECOND":0.0128
  },
  "rosalinda.ramirez-do": {
    "FIRST_NAME":"Rosalinda",
    "LAST_NAME":"Ramirez-Dominguez",
    "SAL_SECOND":0.0128
  },
  "dennis.lang": {
    "FIRST_NAME":"Dennis",
    "LAST_NAME":"Lang",
    "SAL_SECOND":0.0128
  },
  "cesar.guzman": {
    "FIRST_NAME":"Cesar",
    "LAST_NAME":"Guzman",
    "SAL_SECOND":0.0128
  },
  "rick.macken": {
    "FIRST_NAME":"Ricky",
    "LAST_NAME":"Macken",
    "SAL_SECOND":0.0083
  },
  "javier.guerrero": {
    "FIRST_NAME":"Javier",
    "LAST_NAME":"Guerrero Sr.",
    "SAL_SECOND":0.0069
  },
  "diana.sandoval": {
    "FIRST_NAME":"Diana",
    "LAST_NAME":"Sandoval",
    "SAL_SECOND":0.0064
  },
  "elda.nunez": {
    "FIRST_NAME":"Elda",
    "LAST_NAME":"Nunez",
    "SAL_SECOND":0.0064
  },
  "analise.espinoza": {
    "FIRST_NAME":"Analise",
    "LAST_NAME":"Espinoza",
    "SAL_SECOND":0.0061
  },
  "karina.cortez": {
    "FIRST_NAME":"Karina",
    "LAST_NAME":"Cortez",
    "SAL_SECOND":0.0061
  },
  "bernadette.marcuson": {
    "FIRST_NAME":"Bernadette",
    "LAST_NAME":"Marcuson",
    "SAL_SECOND":0.0061
  },
  "mayra.duarte": {
    "FIRST_NAME":"Mayra",
    "LAST_NAME":"Duarte",
    "SAL_SECOND":0.0061
  },
  "rosa.garcia": {
    "FIRST_NAME":"Rosa",
    "LAST_NAME":"Garcia",
    "SAL_SECOND":0.0058
  },
  "karin.salazar": {
    "FIRST_NAME":"Karin",
    "LAST_NAME":"Salazar",
    "SAL_SECOND":0.0056
  },
  "marisol.luna": {
    "FIRST_NAME":"Marisol",
    "LAST_NAME":"Luna",
    "SAL_SECOND":0.0056
  },
  "rene.gonzalez": {
    "FIRST_NAME":"Rene",
    "LAST_NAME":"Gonzalez",
    "SAL_SECOND":0.0049
  },
  "cristian.redondo": {
    "FIRST_NAME":"Cristian",
    "LAST_NAME":"Redondo",
    "SAL_SECOND":0.0049
  },
  "margarita.ramirez": {
    "FIRST_NAME":"Margarita",
    "LAST_NAME":"Ramirez",
    "SAL_SECOND":0.0048
  },
  "cinthya.perez": {
    "FIRST_NAME":"Cinthya",
    "LAST_NAME":"Perez",
    "SAL_SECOND":0.0043
  },
  "oliver.zambrano": {
    "FIRST_NAME":"Oliver",
    "LAST_NAME":"Zambrano",
    "SAL_SECOND":0.0038
  },
  "dana.pauley": {
    "FIRST_NAME":"Dana",
    "LAST_NAME":"Pauley",
    "SAL_SECOND":0.0036
  },
  "blanca.martija": {
    "FIRST_NAME":"Blanca",
    "LAST_NAME":"Martija",
    "SAL_SECOND":0.0031
  },
  "chelsea.barraza": {
    "FIRST_NAME":"Chelsea",
    "LAST_NAME":"Barraza",
    "SAL_SECOND":0.0031
  },
  "diego.briseno": {
    "FIRST_NAME":"Diego",
    "LAST_NAME":"Briseno",
    "SAL_SECOND":0.0031
  }
}
	';
	
	$jsonArray = json_decode($json, true);
	$jsonKeys = array_keys($jsonArray);
	$i = 0;
	
	$password = "password";
	
	foreach($jsonArray as $j){
		
		if($j["SAL_SECOND"] == null || $j["SAL_SECOND"] == "null"){
			$j["SAL_SECOND"] = 0;
		}
		
		$user = $app->user->create([
			'first_name' => $j["FIRST_NAME"],
			'last_name' => $j["LAST_NAME"],
			'username' => $jsonKeys[$i],
			'password' => $app->hash->password($password),
			'wage' => $j["SAL_SECOND"],
		]);
		
		$i++;
	}
	
	exit();
	
})->name('meeting.makeList');