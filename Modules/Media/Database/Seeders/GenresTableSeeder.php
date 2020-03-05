<?php


namespace Modules\Media\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Media\Models\Music\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            [
                "0",
                "Blues",
                "Блюз "
            ],
            [
                "1",
                "Classic rock",
                "Классический рок"
            ],
            [
                "2",
                "Country",
                "Кантри"
            ],
            [
                "3",
                "Dance",
                "Танцевальная"
            ],
            [
                "4",
                "Disco",
                "Диско"
            ],
            [
                "5",
                "Funk",
                "Фанк"
            ],
            [
                "6",
                "Grunge",
                "Гранж"
            ],
            [
                "7",
                "Hip-Hop",
                "Хип-хоп"
            ],
            [
                "8",
                "Jazz",
                "Джаз"
            ],
            [
                "9",
                "Metal",
                "Метал"
            ],
            [
                "10",
                "New Age",
                "Нью Эйдж"
            ],
            [
                "11",
                "Oldies",
                ""
            ],
            [
                "12",
                "Other",
                "Другое"
            ],
            [
                "13",
                "Pop",
                "Поп"
            ],
            [
                "14",
                "Rhythm and Blues",
                "R&B"
            ],
            [
                "15",
                "Rap",
                "Рэп"
            ],
            [
                "16",
                "Reggae",
                "Регги"
            ],
            [
                "17",
                "Rock",
                "Рок"
            ],
            [
                "18",
                "Techno",
                "Техно"
            ],
            [
                "19",
                "Industrial",
                "Индустриальная"
            ],
            [
                "20",
                "Alternative",
                "Альтернативная"
            ],
            [
                "21",
                "Ska",
                "Ска"
            ],
            [
                "22",
                "Death metal",
                ""
            ],
            [
                "23",
                "Pranks",
                ""
            ],
            [
                "24",
                "Soundtrack",
                "Саундтрек"
            ],
            [
                "25",
                "Euro-Techno",
                "Евро-Техно"
            ],
            [
                "26",
                "Ambient",
                ""
            ],
            [
                "27",
                "Trip-Hop",
                "Трип-Хоп"
            ],
            [
                "28",
                "Vocal",
                "Вокал"
            ],
            [
                "29",
                "Jazz & Funk",
                "Джаз и Панк"
            ],
            [
                "30",
                "Fusion",
                "Фюжин"
            ],
            [
                "31",
                "Trance",
                "Транс"
            ],
            [
                "32",
                "Classical",
                "Классчиская"
            ],
            [
                "33",
                "Instrumental",
                "Инструментальная"
            ],
            [
                "34",
                "Acid",
                ""
            ],
            [
                "35",
                "House",
                "Хаус"
            ],
            [
                "36",
                "Game",
                "Игровая"
            ],
            [
                "37",
                "Sound clip",
                ""
            ],
            [
                "38",
                "Gospel",
                ""
            ],
            [
                "39",
                "Noise",
                ""
            ],
            [
                "40",
                "Alternative Rock",
                "Альтернативный Рок"
            ],
            [
                "41",
                "Bass",
                "Бас"
            ],
            [
                "42",
                "Soul",
                "Сол"
            ],
            [
                "43",
                "Punk",
                "Панк"
            ],
            [
                "44",
                "Space",
                ""
            ],
            [
                "45",
                "Meditative",
                "Медитативная"
            ],
            [
                "46",
                "Instrumental Pop",
                "Инструментальный Поп"
            ],
            [
                "47",
                "Instrumental Rock",
                "Инструментальный Рок"
            ],
            [
                "48",
                "Ethnic",
                "Этническая"
            ],
            [
                "49",
                "Gothic",
                "Готическая"
            ],
            [
                "50",
                "Darkwave",
                ""
            ],
            [
                "51",
                "Techno-Industrial",
                ""
            ],
            [
                "52",
                "Electronic",
                "Электронная"
            ],
            [
                "53",
                "Pop-Folk",
                "Поп-фолк"
            ],
            [
                "54",
                "Eurodance",
                "Евродэнс"
            ],
            [
                "55",
                "Dream",
                ""
            ],
            [
                "56",
                "Southern Rock",
                "Южнй Рок"
            ],
            [
                "57",
                "Comedy",
                "Комедийная"
            ],
            [
                "58",
                "Cult",
                ""
            ],
            [
                "59",
                "Gangsta",
                "Гангста"
            ],
            [
                "60",
                "Top 40",
                "Топ 40"
            ],
            [
                "61",
                "Christian Rap",
                "Христианский Рэп"
            ],
            [
                "62",
                "Pop/Funk",
                "Поп/Фанк"
            ],
            [
                "63",
                "Jungle",
                "Джангл"
            ],
            [
                "64",
                "Native US",
                ""
            ],
            [
                "65",
                "Cabaret",
                "Кабарэ"
            ],
            [
                "66",
                "New Wave",
                "Новая Волна"
            ],
            [
                "67",
                "Psychedelic",
                "Психоделическая"
            ],
            [
                "68",
                "Rave",
                ""
            ],
            [
                "69",
                "Show tunes",
                ""
            ],
            [
                "70",
                "Trailer",
                ""
            ],
            [
                "71",
                "Lo-Fi",
                ""
            ],
            [
                "72",
                "Tribal",
                ""
            ],
            [
                "73",
                "Acid Punk",
                ""
            ],
            [
                "74",
                "Acid Jazz",
                ""
            ],
            [
                "75",
                "Polka",
                "Полька"
            ],
            [
                "76",
                "Retro",
                "Ретро"
            ],
            [
                "77",
                "Musical",
                "Музыкальная"
            ],
            [
                "78",
                "Rock ’n’ Roll",
                "Рок`н`ролл"
            ],
            [
                "79",
                "Hard Rock",
                "Тяжелый Рок"
            ],
            [
                "80",
                "Folk",
                "Фолк"
            ],
            [
                "81",
                "Folk-Rock",
                "Фолк-Рок"
            ],
            [
                "82",
                "National Folk",
                "Национальный Фолк"
            ],
            [
                "83",
                "Swing",
                ""
            ],
            [
                "84",
                "Fast Fusion",
                ""
            ],
            [
                "85",
                "Bebop",
                ""
            ],
            [
                "86",
                "Latin",
                "Латинская"
            ],
            [
                "87",
                "Revival",
                ""
            ],
            [
                "88",
                "Celtic",
                "Кельтская"
            ],
            [
                "89",
                "Bluegrass",
                ""
            ],
            [
                "90",
                "Avantgarde",
                ""
            ],
            [
                "91",
                "Gothic Rock",
                "Готический Рок"
            ],
            [
                "92",
                "Progressive Rock",
                "Прогрессивный Рок"
            ],
            [
                "93",
                "Psychedelic Rock",
                "Психоделический Рок"
            ],
            [
                "94",
                "Symphonic Rock",
                "Симфонический Рок"
            ],
            [
                "95",
                "Slow rock",
                ""
            ],
            [
                "96",
                "Big Band",
                ""
            ],
            [
                "97",
                "Chorus",
                "Хор"
            ],
            [
                "98",
                "Easy Listening",
                ""
            ],
            [
                "99",
                "Acoustic",
                "Акустическая"
            ],
            [
                "100",
                "Humour",
                "Юмористическая"
            ],
            [
                "101",
                "Speech",
                "Речь"
            ],
            [
                "102",
                "Chanson",
                "Шансон"
            ],
            [
                "103",
                "Opera",
                "Опера"
            ],
            [
                "104",
                "Chamber music",
                "Комнатная музыка"
            ],
            [
                "105",
                "Sonata",
                "Сонета"
            ],
            [
                "106",
                "Symphony",
                "Симфония"
            ],
            [
                "107",
                "Booty bass",
                ""
            ],
            [
                "108",
                "Primus",
                ""
            ],
            [
                "109",
                "Porn groove",
                ""
            ],
            [
                "110",
                "Satire",
                "Сатира"
            ],
            [
                "111",
                "Slow jam",
                ""
            ],
            [
                "112",
                "Club",
                "Клубная"
            ],
            [
                "113",
                "Tango",
                "Танго"
            ],
            [
                "114",
                "Samba",
                "Самба"
            ],
            [
                "115",
                "Folklore",
                "Фольклор"
            ],
            [
                "116",
                "Ballad",
                "Баллада"
            ],
            [
                "117",
                "Power ballad",
                ""
            ],
            [
                "118",
                "Rhythmic Soul",
                "Ритмческий сол"
            ],
            [
                "119",
                "Freestyle",
                "Фристайл"
            ],
            [
                "120",
                "Duet",
                "Дуэт"
            ],
            [
                "121",
                "Punk Rock",
                "Панк Рок"
            ],
            [
                "122",
                "Drum solo",
                "Драм Соло"
            ],
            [
                "123",
                "A cappella",
                "Акапелла"
            ],
            [
                "124",
                "Euro-House",
                "Евро-Хаус"
            ],
            [
                "125",
                "Dance Hall",
                ""
            ],
            [
                "126",
                "Goa",
                "Гоа"
            ],
            [
                "127",
                "Drum & Bass",
                ""
            ],
            [
                "128",
                "Club-House",
                ""
            ],
            [
                "129",
                "Hardcore Techno",
                ""
            ],
            [
                "130",
                "Terror",
                ""
            ],
            [
                "131",
                "Indie",
                "Инди"
            ],
            [
                "132",
                "BritPop",
                ""
            ],
            [
                "133",
                "Negerpunk",
                ""
            ],
            [
                "134",
                "Polsk Punk",
                ""
            ],
            [
                "135",
                "Beat",
                ""
            ],
            [
                "136",
                "Christian Gangsta Rap",
                ""
            ],
            [
                "137",
                "Heavy Metal",
                "Тяжелый Метал"
            ],
            [
                "138",
                "Black Metal",
                "Черный Метал"
            ],
            [
                "139",
                "Crossover",
                ""
            ],
            [
                "140",
                "Contemporary Christian",
                ""
            ],
            [
                "141",
                "Christian rock",
                ""
            ],
            [
                "142",
                "Merengue",
                ""
            ],
            [
                "143",
                "Salsa",
                "Сальса"
            ],
            [
                "144",
                "Thrash Metal",
                "Трэш Метал"
            ],
            [
                "145",
                "Anime",
                "Аниме"
            ],
            [
                "146",
                "Jpop",
                ""
            ],
            [
                "147",
                "Synthpop",
                ""
            ],
            [
                "148",
                "Abstract",
                "Абстрактная"
            ],
            [
                "149",
                "Art Rock",
                ""
            ],
            [
                "150",
                "Baroque",
                ""
            ],
            [
                "151",
                "Bhangra",
                ""
            ],
            [
                "152",
                "Big beat",
                ""
            ],
            [
                "153",
                "Breakbeat",
                ""
            ],
            [
                "154",
                "Chillout",
                ""
            ],
            [
                "155",
                "Downtempo",
                ""
            ],
            [
                "156",
                "Dub",
                ""
            ],
            [
                "157",
                "EBM",
                ""
            ],
            [
                "158",
                "Eclectic",
                ""
            ],
            [
                "159",
                "Electro",
                ""
            ],
            [
                "160",
                "Electroclash",
                ""
            ],
            [
                "161",
                "Emo",
                ""
            ],
            [
                "162",
                "Experimental",
                "Экспериментальная"
            ],
            [
                "163",
                "Garage",
                ""
            ],
            [
                "164",
                "Global",
                ""
            ],
            [
                "165",
                "IDM",
                ""
            ],
            [
                "166",
                "Illbient",
                ""
            ],
            [
                "167",
                "Industro-Goth",
                ""
            ],
            [
                "168",
                "Jam Band",
                ""
            ],
            [
                "169",
                "Krautrock",
                ""
            ],
            [
                "170",
                "Leftfield",
                ""
            ],
            [
                "171",
                "Lounge",
                "Лаундж"
            ],
            [
                "172",
                "Math Rock",
                ""
            ],
            [
                "173",
                "New Romantic",
                ""
            ],
            [
                "174",
                "Nu-Breakz",
                ""
            ],
            [
                "175",
                "Post-Punk",
                ""
            ],
            [
                "176",
                "Post-Rock",
                ""
            ],
            [
                "177",
                "Psytrance",
                ""
            ],
            [
                "178",
                "Shoegaze",
                ""
            ],
            [
                "179",
                "Space Rock",
                ""
            ],
            [
                "180",
                "Trop Rock",
                ""
            ],
            [
                "181",
                "World Music",
                ""
            ],
            [
                "182",
                "Neoclassical",
                ""
            ],
            [
                "183",
                "Audiobook",
                "Аудиокнига"
            ],
            [
                "184",
                "Audio theatre",
                ""
            ],
            [
                "185",
                "Neue Deutsche Welle",
                ""
            ],
            [
                "186",
                "Podcast",
                "Подкаст"
            ],
            [
                "187",
                "Indie-Rock",
                "Инди Рок"
            ],
            [
                "188",
                "G-Funk",
                ""
            ],
            [
                "189",
                "Dubstep",
                "Дабстеп"
            ],
            [
                "190",
                "Garage Rock",
                ""
            ],
            [
                "191",
                "Psybient",
                ""
            ]
        ];

        foreach ($genres as $data) {
            Genre::create([
                'code' => $data[0],
                'name' => $data[1],
                'local_name' => $data[2]
            ]);
        }
    }
}
