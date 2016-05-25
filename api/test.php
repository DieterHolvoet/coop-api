<?php
/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 17/05/2016
 * Time: 11:35
 */

// Requirements
define("WWW_ROOT", dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);    // Composer autoloader
require_once WWW_ROOT . "api" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';
include WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . "Autoload.php";

// Test
JsonSchemaValidator::check(json_decode("{
    \"translatiodns\": {
        \"nl\": {
            \"walk_title\": \"Wandeling 1\",
            \"walk_description\": \"Leuke wandeling jonge!\"
        },
        \"fr\": {
            \"walk_title\": \"Balade 1\",
            \"walk_description\": \"Une balade très agréable.\"
        },
        \"en\": {
            \"walk_title\": \"Walk 1\",
            \"walk_description\": \"Omg such nice walk!!!8!\"
        }
    },
    \"theme_id\": 1,
    \"walk_duration\": 143,
    \"walk_distance\": 1150,
    \"stops\": [{
        \"stop_typde\": \"waypoint\",
        \"media_filename\": \"walk1_1.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Verlaat het belevingscentrum en wandel richting **metrostation Kuregem**.\"
            },
            \"en\": {
                \"waypoint_description\": \"Leave the experience center and start walking towards **Cureghem metro station**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Laissez le centre d'expérience et commence à marcher vers la **station de métro Cureghem**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Fernand Demetskaai\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Quai Fernand Demets\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Quai Fernand Demets\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.840364,
            \"location_lon\": 4.319390,
            \"location_house_number\": 26,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_2.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Steek de brug aan uw rechterkant over, en volg de **Emile Carpentierstraat**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Traversez le pont sur votre droite et suivez la **Rue Emile Carpentier**.\"
            },
            \"en\": {
                \"waypoint_description\": \"Cross the bridge on your right and follow the **Rue Emile Carpentier**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Fernand Demetskaai\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Quai Fernand Demets\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Quai Fernand Demets\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.838019,
            \"location_lon\": 4.317579,
            \"location_house_number\": 7,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_3.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Aan het rond punt, neem de derde afslag naar de **Rue Eloy**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Au rond-point, prenez la troisième sortie sur la **Rue Eloy**.\"
            },
            \"en\": {
                \"waypoint_description\": \"At the roundabout, take the third exit onto **Rue Eloy**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Emile Carpentierstraat\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Rue Emile Carpentier\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Rue Emile Carpentier\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.836121,
            \"location_lon\": 4.323871,
            \"location_house_number\": 2,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"poi\",
        \"translations\": {
            \"nl\": {
                \"poi_title\": \"Gemeentelijke jongensschool in de Eloystraat\",
                \"poi_description\": \"Gebouwd in 1902, was deze school zeker de belangrijkste van Cureghem. Zo'n 20 jaar later, waren er 322 jongens in de school.\"
            },
            \"fr\": {
                \"poi_title\": \"École Communale de garçons dans la Rue Eloy\",
                \"poi_description\": \"Construite en 1902, cette école fut certainement la plus importante de Cureghem. Quelque 20 ans plus tard, elle comptait 322 garçons.\"
            },
            \"en\": {
                \"poi_title\": \"Municipal boys' school in the Eloystraat\",
                \"poi_description\": \"Built in 1902, this school was certainly the most important of Cureghem. Some 20 years later, 322 boys went to the school.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Eloystraat\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Rue Eloy\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Rue Eloy\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.836099,
            \"location_lon\": 4.324622,
            \"location_house_number\": 114,
            \"location_postal_code\": 1070
        },
        \"media\": [{
          \"translations\": {
              \"nl\": {
                  \"media_title\": \"Foto 1\",
                  \"media_description\": \"Mooie foto\"
              },
              \"fr\": {
                  \"media_title\": \"Photo 1\",
                  \"media_description\": \"Très belle\"
              },
              \"en\": {
                  \"media_title\": \"Photo 1\",
                  \"media_description\": \"Very nice\"
              }
          },
          \"media_type_name\": \"Photo\",
          \"media_filename\": \"walk1_4_1.jpg\"
        }]
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_5.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Ga aan het einde van de straat naar links in de **Barastraat**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"à la fin de la rue tourner à gauche dans la **Rue Bara**\"
            },
            \"en\": {
                \"waypoint_description\": \"At the end of the street to the left into the **Rue Bara**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Barastraat\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Rue Bara\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Rue Bara\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.836457,
            \"location_lon\": 4.332335,
            \"location_house_number\": 0,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_6.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Ga aan het einde van de straat naar rechts in de **Fienstraat**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"À la fin de la rue, tournez à gauche dans la **Rue de Fiennes**\"
            },
            \"en\": {
                \"waypoint_description\": \"At the end of the street, turn left into the **Rue Fiennes**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Fienstraat\",
                    \"location_city\": \"Bruxelles\"
                },
                \"fr\": {
                    \"location_street\": \"Rue de Fiennes\",
                    \"location_city\": \"Bruxelles\"
                },
                \"en\": {
                    \"location_street\": \"Rue de Fiennes\",
                    \"location_city\": \"Bruxelles\"
                }
            },
            \"location_lat\": 50.839036,
            \"location_lon\": 4.335666,
            \"location_house_number\": 0,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_7.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Blijf heel lang rechtdoor stappen. Je zal de straten **Jamarlaan**, **Stalingradlaan** en de **Zuidlaan** tegenkomen. Aan de 14de afslag ga je naar rechts in de **Kolenmarkt**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Continuez à marcher tout droit. Vous traversez les rues **Boulevard Jamar**, **Boulevard Stalingrad** et **Boulevard du Midi**. Le 14ième sortie, tournez à droite dans la **Rue du Marché au Charbon**.\"
            },
            \"en\": {
                \"waypoint_description\": \"Keep walking straight for a long time. You will encounter the streets **Boulevard Jamar**, **Boulevard Stalingrad** and **Boulevard du Midi**. On the 14th exit, turn right into the **Rue du Marché au Charbon**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Kolenmarkt\",
                    \"location_city\": \"Anderlecht\"
                },
                \"fr\": {
                    \"location_street\": \"Rue du Marché au Charbon\",
                    \"location_city\": \"Anderlecht\"
                },
                \"en\": {
                    \"location_street\": \"Rue du Marché au Charbon\",
                    \"location_city\": \"Anderlecht\"
                }
            },
            \"location_lat\": 50.846384,
            \"location_lon\": 4.349937,
            \"location_house_number\": 0,
            \"location_postal_code\": 1070
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_8.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Ga rechtdoor tot op de **Grote Markt**. Aan de overkant neem je de **Vlees-en-Broodstraat**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Marchez vers la **Grand-Place**. A l'autre côté, vous prenez la **Rue Chair et Pain**.\"
            },
            \"en\": {
                \"waypoint_description\": \"Go straight to the **Grand Place**. On the other side, take the **Rue Chair et Pain**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Vlees-en-Broodstraat\",
                    \"location_city\": \"Brussel\"
                },
                \"fr\": {
                    \"location_street\": \"Rue Chair et Pain\",
                    \"location_city\": \"Bruxelles\"
                },
                \"en\": {
                    \"location_street\": \"Rue Chair et Pain\",
                    \"location_city\": \"Brussels\"
                }
            },
            \"location_lat\": 50.847004,
            \"location_lon\": 4.352480,
            \"location_house_number\": 0,
            \"location_postal_code\": 1000
        }
    }, {
        \"stop_type\": \"waypoint\",
        \"media_filename\": \"walk1_9.png\",
        \"translations\": {
            \"nl\": {
                \"waypoint_description\": \"Ga rechtdoor tot op het einde van de **Korte Beenhouwersstraat** en sla rechtsaf in de **Beenhouwersstraat**.\"
            },
            \"fr\": {
                \"waypoint_description\": \"Continuez tout droit jusqu'à la fin de la **Petite Rue des Bouchers**, puis tournez à droite dans la **Rue des Bouchers**.\"
            },
            \"en\": {
                \"waypoint_description\": \"Go straight until the end of the **Petite Rue des Bouchers**, then turn right into the **Rue des Bouchers**.\"
            }
        },
        \"location\": {
            \"translations\": {
                \"nl\": {
                    \"location_street\": \"Beenhouwersstraat\",
                    \"location_city\": \"Brussel\"
                },
                \"fr\": {
                    \"location_street\": \"Rue des Bouchers\",
                    \"location_city\": \"Bruxelles\"
                },
                \"en\": {
                    \"location_street\": \"Rue des Bouchers\",
                    \"location_city\": \"Brussels\"
                }
            },
            \"location_lat\": 50.848119,
            \"location_lon\": 4.354032,
            \"location_house_number\": 0,
            \"location_postal_code\": 1000
        }
    }, {
  \"stop_type\": \"poi\",
  \"translations\": {
    \"nl\": {
      \"poi_title\": \"Gentsesteenweg (Bakkerij coop)\",
      \"poi_description\": \"16 mei 1881, in een context van economische crisis, vindt plaats in de herberg \"De Zwaan\" aan de Grote Markt in Brussel -Plaats bijeenkomst van socialistische, een vergadering met het oog op een coöperatieve bakkerij in Brussel op vormen Gent coöperatieve model \"Vooruit\". Onder de aanwezigen is Louis Bertrand, metselaar werknemer die de Gentse werken bijgewoond. Hij werd benoemd tot secretaris van de commissie om het bedrijf op te nemen. Zo werd opgericht de \"Brussels Bakkerij Cooperative\", dat tot doel heeft de financiële situatie van haar leden te verbeteren door het verstrekken van brood en, dankzij een hulpfonds, medische zorg. De eerste bakkerij verhuisd naar Sint-Jans-Molenbeek, in de achtertuin van een cabaret. 3 september 1882, worden de eerste broden verkocht aan de leden van honden karren. In september 1883 is de coöperatie aangesloten bij de Socialistische Partij; verenigingsleven vergaderingen blijven plaatsvinden in het Swan, en daarna, in 1886, in een oude synagoge straat Beieren: de eerste \"People's House\", bestaande uit een koffiekamer, een vergaderzaal, kantoor en een dorpshuis. Andere activiteiten worden geleidelijk toegevoegd aan de bakker als de verkoop van weefsels en eten en een slager. In 1891, wordt gemaakt onder de impuls van de arts en socialistische activist César De Paepe, medische en farmaceutische service. Voor een bescheiden bedrag, worden de samenwerkers vrijgelaten uit de medische kosten van de zorg. In 1891, ook de oprichter van de Art afdeling van de People's House, die lezingen, museumbezoek, concerten ... Onder leiding van Emile Vandervelde organiseert, zal gastheer vele kunstenaars . In 1892, de coöperatie neemt zeker de naam \"The People's House\" Company Brussel werken Cooperative . Bij ontgroeid zijn gebouwen in de straat in Beieren, besloot ze in 1895 naar een nieuw gebouw waarvan de uitvoering is toevertrouwd aan Victor Horta te bouwen . De huizen van de mensen van Brussels Molenbeek - Saint - Jean Gentsesteenweg 85 \"Kameraden van Molenbeek, het bijwonen van uw zondag Huis van het Volk; zul je met je gezin. Het is de plicht van elke goede socialist. De faro is uitstekend; de heerlijke lambiek; bruine verfrissend ... \"G . Abeels,\" Molenbeek in oude ansichten \"1977. Geopend 24 augustus 1895, werd het huis van de inwoners van Molenbeek in 1905 getransformeerd door architect Richard Pringiers . Het bevat dan ook een feestzaal die plaats biedt aan duizend mensen en een café beschouwd als \"de mooiste van de stad.\" Vandaag de dag herbergt het medisch centrum César De Paepe van de Socialistische Mutualiteit van Brabant . \"
    },
    \"fr\": {
      \"poi_title\": \"Ch de Gand (boulangerie coop)\",
      \"poi_description\": \"Le 16 mai 1881, dans un contexte de crise économique, se déroule à l’estaminet « Le Cygne » à la Grand Place de Bruxelles –lieu de rassemblement des socialistes–, une réunion dans le but de constituer à Bruxelles une boulangerie coopérative sur le modèle de la coopérative gantoise « Vooruit ». Parmi les personnes présentes se trouve Louis Bertrand, ouvrier marbrier, qui a assisté aux travaux gantois. Il sera nommé secrétaire du comité chargé de constituer la société. Ainsi est mise sur pied la « Boulangerie Coopérative de Bruxelles », dont le but est d’améliorer la situation matérielle de ses membres en fournissant du pain et, grâce à une caisse de secours, des soins médicaux. La première boulangerie s’installe à Molenbeek-Saint-Jean, dans l’arrière-cour d’un cabaret. Le 3 septembre 1882, les premiers pains sont vendus, distribués aux membres par des charrettes à chiens. En septembre 1883, la coopérative s’affilie au parti socialiste ; les réunions associatives continuent à se dérouler au Cygne, puis, dès 1886, dans une ancienne synagogue située rue de Bavière : c’est la première « Maison du Peuple », composée d’une salle de café, d’une salle de réunion, de bureaux et d’une salle des fêtes. D’autres activités s’ajoutent peu à peu à la boulangerie comme la vente de tissus et de denrées alimentaires et une boucherie. En 1891, est créé, sous l’impulsion du médecin et militant socialiste César De Paepe, un service médical et pharmaceutique. Pour une cotisation modeste, les coopérateurs sont libérés du souci des frais de maladie. En 1891, est également fondée la Section d’Art de la Maison du Peuple qui organise des conférences, des visites de musée, des concerts… Animée par Emile Vandervelde, elle accueillera de nombreux artistes. En 1892, la coopérative prend définitivement le nom « La Maison du Peuple », Société Coopérative ouvrière de Bruxelles. À l’étroit dans ses locaux de la rue de Bavière, elle décide en 1895 de construire un nouvel édifice dont la réalisation est confiée à Victor Horta. Les maisons du peuple bruxelloises Molenbeek-Saint-Jean- Chaussée de Gand 85 « Camarades de Molenbeek, fréquentez le dimanche votre Maison du Peuple ; vous y serez en famille. C’est le devoir de tout bon socialiste. Le faro est excellent ; la lambic délicieux ; la brune rafraichissante… » G. Abeels, « Molenbeek en cartes postales anciennes », 1977. Inaugurée le 24 août 1895, la maison du peuple de Molenbeek est transformée en 1905 par l’architecte Richard Pringiers. Elle comprend dès lors une salle de fêtes pouvant accueillir un millier de personnes et un café considéré comme « le plus beau de la commune ». Aujourd’hui, elle accueille le centre médical César De Paepe de la Mutualité socialiste du Brabant.\"
    },
    \"en\": {
      \"poi_title\": \"Ch de Gand (boulangerie coop)\",
      \"poi_description\": \"May 16, 1881, in a context of economic crisis, is taking place at the tavern \"The Swan\" at the Grand Place in Brussels -Place gathering of Socialist, a meeting in order to constitute a cooperative bakery in Brussels on Ghent cooperative model \"Vooruit\". Among those present is Louis Bertrand, mason worker who attended the Ghent works. He was appointed secretary of the committee to incorporate the company. Thus was established the \"Brussels Bakery Cooperative,\" which aims to improve the financial situation of its members by providing bread and, thanks to a relief fund, medical care. The first bakery moved to Sint-Jans-Molenbeek, in the backyard of a cabaret. September 3, 1882, the first loaves are sold, distributed to members by dogs carts. In September 1883, the cooperative is affiliated to the Socialist Party; associational meetings continue to take place at the Swan, and then, in 1886, in an old synagogue street Bavaria: the first \"People's House\", consisting of a coffee room, a meeting room, office and a village hall. Other activities are added gradually to the bakery as the sale of tissues and food and a butcher. In 1891, is created under the impulse of the doctor and socialist activist César De Paepe, medical and pharmaceutical service. For a modest fee, the cooperators are released from the medical costs of care. In 1891, also founded the Art Section of the People's House, which organizes lectures, museum visits, concerts ... Led by Emile Vandervelde, will host many artists . In 1892, the cooperative definitely takes the name \"The People's House\" Company Brussels working Cooperative . At outgrown its premises in the street in Bavaria, she decided in 1895 to build a new building whose implementation is entrusted to Victor Horta . The houses of the people of Brussels Molenbeek - Saint - Jean Gentsesteenweg 85 \"Comrades of Molenbeek, attending your Sunday House of the People; you will be with your family. It is the duty of every good socialist. The faro is excellent; the delicious lambic; brown refreshing ... \"G . Abeels,\" Molenbeek in old postcards \"1977. Opened August 24, 1895, the house of the people of Molenbeek was transformed in 1905 by architect Richard Pringiers . It therefore includes a party room that can accommodate a thousand people and a café considered \"the most beautiful of the town.\" Today it hosts the medical center César De Paepe of the Socialist Mutuality of Brabant . \"
    }
  },
  \"location\": {
    \"translations\": {
      \"nl\": {
        \"location_street\": \"Gentsesteenweg\",
        \"location_city\": \"Sint-Jans-Molenbeek\"
      },
      \"fr\": {
        \"location_street\": \"Chaussèe de Gand\",
        \"location_city\": \"Molenbeek-Saint-Jean\"
      },
      \"en\": {
        \"location_street\": \"Chaussèe de Gand\",
        \"location_city\": \"Molenbeek-Saint-Jean\"
      }
    },
    \"location_lat\": 50.859009,
    \"location_lon\": 4.311517,
    \"location_house_number\": 537,
    \"location_postal_code\": 1080
  },
  \"media\": [
    {
      \"media_id\": \"47\",
      \"media_title\": \"Placeholder\",
      \"media_description\": \"Mooie foto\",
      \"media_type_name\": \"Photo\",
      \"language_id\": \"1\",
      \"media_filename\": \"Placeholder.png\"
    }
  ]
}]
}
"));