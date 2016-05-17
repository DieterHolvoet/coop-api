<?php
/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 12:02
 */

// Requirements
define("WWW_ROOT", dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);    // Composer autoloader
require_once WWW_ROOT . "api" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';
include WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . "Autoload.php";

// Insert languages
LanguageDAO::addLanguage('nl', 'Nederlands');
LanguageDAO::addLanguage('fr', 'Français');
LanguageDAO::addLanguage('en', 'English');

// Insert media types
MediaDAO::addMediaType('Photo', 'photo');
MediaDAO::addMediaType('Audio', 'audio');
MediaDAO::addMediaType('Video', 'video');

// Insert themes
ThemeDAO::addTheme(array(
    'nl'=>array(
        'theme_name'=>'Bevolking'
    ),
    'en'=>array(
        'theme_name'=>'Population'
    ),
    'fr'=>array(
        'theme_name'=>'Population'
    )
), 'FFAB31');

ThemeDAO::addTheme(array(
    'nl'=>array(
        'theme_name'=>'Milieu'
    ),
    'en'=>array(
        'theme_name'=>'Environment'
    ),
    'fr'=>array(
        'theme_name'=>'Environnement'
    )
), '91DC5A');

ThemeDAO::addTheme(array(
    'nl'=>array(
        'theme_name'=>'Geschiedenis'
    ),
    'en'=>array(
        'theme_name'=>'History'
    ),
    'fr'=>array(
        'theme_name'=>'Histoire'
    )
), '9E1F63');

// Insert walks
$walk_1_id = WalkDAO::addWalk(
    array(
        'nl'=>array(
            'walk_title'=>'Wandeling 1',
            'walk_description'=>'Leuke wandeling jonge!'
        ),
        'en'=>array(
            'walk_title'=>'Walk 1',
            'walk_description'=>'Omg such nice walk!!!8!'
        ),
        'fr'=>array(
            'walk_title'=>'Balade 1',
            'walk_description'=>'Une balade très agréable.'
        )
    ),
    ThemeDAO::getThemeByName('nl', 'Milieu')['theme_id'],
    143,
    1150
    );

WalkDAO::addWaypoint(
    $walk_1_id,
    array(
        'nl'=>array(
            'waypoint_description'=>'Verlaat het belevingscentrum en wandel richting metrostation Kuregem.'
        ),
        'en'=>array(
            'waypoint_description'=>'Leave the experience center and start walking towards Cureghem metro station.'
        ),
        'fr'=>array(
            'waypoint_description'=>'Laissez le centre d\'expérience et commence à marcher vers la station de métro Cureghem.'
        )
    ),
    LocationDAO::addLocation(
        array(
            'nl'=>array(
                'location_street'=>'Fernand Demetskaai',
                'location_city'=>'Anderlecht'
            ),
            'en'=>array(
                'location_street'=>'Fernand Demetskaai',
                'location_city'=>'Anderlecht'
            ),
            'fr'=>array(
                'location_street'=>'Quai Fernand Demets',
                'location_city'=>'Anderlecht'
            )
        ),
        50.840364, 4.319390,
        26,
        1070
    ),
    MediaDAO::addMedia(
        array(),
        WaypointDAO::getMediaTypeID(),
        'walk1_1.jpeg'
    ));

WalkDAO::addWaypoint(
    $walk_1_id,
    array(
        'nl'=>array(
            'waypoint_description'=>'Steek de brug aan uw rechterkant over, en volg de Emile Carpentierstraat.'
        ),
        'en'=>array(
            'waypoint_description'=>'Leave the experience center and start walking towards Cureghem metro station.'
        ),
        'fr'=>array(
            'waypoint_description'=>'Traversez le pont sur votre droite et suivez Rue Emile Carpentier.'
        )
    ),
    LocationDAO::addLocation(
        array(
            'nl'=>array(
                'location_street'=>'Fernand Demetskaai',
                'location_city'=>'Anderlecht'
            ),
            'en'=>array(
                'location_street'=>'Fernand Demetskaai',
                'location_city'=>'Anderlecht'
            ),
            'fr'=>array(
                'location_street'=>'Quai Fernand Demets',
                'location_city'=>'Anderlecht'
            )
        ),
        50.838019, 4.317579,
        7,
        1070
    ),
    MediaDAO::addMedia(
        array(),
        WaypointDAO::getMediaTypeID(),
        'walk1_2.jpeg'
    )
);

WalkDAO::addWaypoint(
    $walk_1_id,
    array(
        'nl'=>array(
            'waypoint_description'=>'Aan het rond punt, neem de derde afslag naar de Rue Eloy.'
        ),
        'en'=>array(
            'waypoint_description'=>'At the roundabout, take the third exit onto Rue Eloy.'
        ),
        'fr'=>array(
            'waypoint_description'=>'Au rond-point, prenez la troisième sortie sur la rue Eloy.'
        )
    ),
    LocationDAO::addLocation(
        array(
            'nl'=>array(
                'location_street'=>'Emile Carpentierstraat',
                'location_city'=>'Anderlecht'
            ),
            'en'=>array(
                'location_street'=>'Emile Carpentier Street',
                'location_city'=>'Anderlecht'
            ),
            'fr'=>array(
                'location_street'=>'Rue Emile Carpentier',
                'location_city'=>'Anderlecht'
            )
        ),
        50.836121, 4.323871,
        2,
        1070
    ),
    MediaDAO::addMedia(
        array(),
        WaypointDAO::getMediaTypeID(),
        'walk1_3.jpeg'
    )
);

$poi_1_id = WalkDAO::addPoi(
    $walk_1_id,
    array(
        'nl'=>array(
            'poi_title'=>'Gemeentelijke jongensschool in de Eloystraat',
            'poi_description'=>'Gebouwd in 1902, was deze school zeker de belangrijkste van Cureghem. Zo\'n 20 jaar later, waren er 322 jongens in de school.'
        ),
        'en'=>array(
            'poi_title'=>'Municipal boys\' school in the Eloystraat',
            'poi_description'=>'Built in 1902, this school was certainly the most important of Cureghem. Some 20 years later, 322 boys went to the school.'
        ),
        'fr'=>array(
            'poi_title'=>'École Communale de garçons dans la Rue Eloy',
            'poi_description'=>'Construite en 1902, cette école fut certainement la plus importante de Cureghem. Quelque 20 ans plus tard, elle comptait 322 garçons.'
        )
    ),
    LocationDAO::addLocation(
        array(
            'nl'=>array(
                'location_street'=>'Eloystraat',
                'location_city'=>'Anderlecht'
            ),
            'en'=>array(
                'location_street'=>'Rue Eloystraat',
                'location_city'=>'Anderlecht'
            ),
            'fr'=>array(
                'location_street'=>'Rue Eloy',
                'location_city'=>'Anderlecht'
            )
        ),
        50.836099, 4.324622,
        114,
        1070
    )
);

PoiDAO::addMedia(
    $poi_1_id,
    array(
        'nl'=>array(
            'media_title'=>'',
            'media_description'=>''
        ),
        'en'=>array(
            'media_title'=>'',
            'media_description'=>''
        ),
        'fr'=>array(
            'media_title'=>'',
            'media_description'=>''
        )
    ),
    MediaDAO::getMediaTypeIDByName('Photo'),
    'walk1_4.jpeg'
);