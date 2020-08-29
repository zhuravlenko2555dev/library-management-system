-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.22-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп данных таблицы library-management-system.languages: ~465 rows (приблизительно)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `name`, `full_name`) VALUES
	(1, 'doi', 'Dogri'),
	(2, 'syc', 'Syriac'),
	(3, 'amh', 'Amharic'),
	(4, 'bul', 'Bulgarian'),
	(5, 'cmc', 'Chamic languages'),
	(6, 'ibo', 'Igbo'),
	(7, 'ceb', 'Cebuano'),
	(8, 'mlt', 'Maltese'),
	(9, 'mul', 'Multiple languages'),
	(12, 'car', 'Carib'),
	(13, 'orm', 'Oromo'),
	(15, 'mad', 'Madurese'),
	(16, 'bua', 'Buriat'),
	(17, 'mao', 'Maori'),
	(19, 'umb', 'Umbundu'),
	(21, 'mkh', 'Mon-Khmer'),
	(22, 'gor', 'Gorontalo'),
	(23, 'arp', 'Arapaho'),
	(24, 'mon', 'Mongolian'),
	(25, 'eth', 'Ethiopic'),
	(26, 'tet', 'Tetum'),
	(27, 'und', 'Undetermined'),
	(28, 'mac', 'Macedonian'),
	(29, 'gem', 'Germanic'),
	(30, 'paa', 'Papuan'),
	(31, 'fao', 'Faroese'),
	(33, 'chr', 'Cherokee'),
	(34, 'man', 'Mandingo'),
	(35, 'pal', 'Pahlavi'),
	(36, 'kas', 'Kashmiri'),
	(37, 'hau', 'Hausa'),
	(38, 'cel', 'Celtic'),
	(39, 'btk', 'Batak'),
	(40, 'tgl', 'Tagalog'),
	(41, 'wak', 'Wakashan'),
	(42, 'tam', 'Tamil'),
	(43, 'new', 'Newari'),
	(44, 'ven', 'Venda'),
	(45, 'scc', 'Serbian'),
	(46, 'frs', 'East Frisian'),
	(47, 'sus', 'Susu'),
	(48, 'ful', 'Fula'),
	(49, 'snh', 'Sinhalese'),
	(50, 'nno', 'Nynorsk'),
	(51, 'rar', 'Rarotongan'),
	(52, 'may', 'Malay'),
	(53, 'ina', 'Interlingua'),
	(54, 'krl', 'Karelian'),
	(55, 'aus', 'Australian'),
	(56, 'kur', 'Kurdish'),
	(57, 'ijo', 'Ijo'),
	(58, 'hil', 'Hiligaynon'),
	(59, 'chg', 'Chagatai'),
	(60, 'vai', 'Vai'),
	(61, 'sot', 'Sotho'),
	(62, 'cor', 'Cornish'),
	(63, 'pol', 'Polish'),
	(64, 'kos', 'Kusaie'),
	(65, 'nor', 'Norwegian'),
	(66, 'ter', 'Terena'),
	(67, 'yor', 'Yoruba'),
	(68, 'krc', 'Karachay-Balkar'),
	(69, 'afr', 'Afrikaans'),
	(70, 'pro', 'Provençal (to 1500)'),
	(71, 'roh', 'Raeto-Romance'),
	(72, 'cpf', 'Creoles and Pidgins, French-based'),
	(73, 'haw', 'Hawaiian'),
	(74, 'sal', 'Salishan'),
	(75, 'epo', 'Esperanto'),
	(76, 'ava', 'Avaric'),
	(77, 'sco', 'Scots'),
	(78, 'kau', 'Kanuri'),
	(79, 'dak', 'Dakota'),
	(80, 'tut', 'Altaic'),
	(81, 'ace', 'Achinese'),
	(82, 'fan', 'Fang'),
	(83, 'srp', 'Serbian 2'),
	(84, 'ale', 'Aleut'),
	(85, 'yue', 'Cantonese'),
	(86, 'sme', 'Northern Sami'),
	(87, 'cop', 'Coptic'),
	(88, 'lam', 'Lamba (Zambia and Congo)'),
	(89, 'bho', 'Bhojpuri'),
	(90, 'mdf', 'Moksha'),
	(91, 'gsw', 'gsw'),
	(92, 'aze', 'Azerbaijani'),
	(93, 'swa', 'Swahili'),
	(94, 'est', 'Estonian'),
	(95, 'gag', 'Galician'),
	(96, 'pau', 'Palauan'),
	(97, 'goh', 'Old High German'),
	(98, 'iro', 'Iroquoian'),
	(99, 'ita', 'Italian'),
	(100, 'ath', 'Athapascan'),
	(101, 'awa', 'Awadhi'),
	(102, 'baq', 'Basque'),
	(103, 'sam', 'Samaritan Aramaic'),
	(104, 'slo', 'Slovak'),
	(105, 'fon', 'Fon'),
	(106, 'tli', 'Tlingit'),
	(107, 'nog', 'Nogai'),
	(108, 'rup', 'Aromanian'),
	(109, 'bre', 'Breton'),
	(110, 'mno', 'Manobo'),
	(111, 'bal', 'Baluchi'),
	(112, 'ber', 'Berber'),
	(113, 'uga', 'Ugaritic'),
	(114, 'snk', 'Soninke'),
	(115, 'rum', 'Romanian'),
	(116, 'hmo', 'Hiri Motu'),
	(117, 'gae', 'Scottish Gaelix'),
	(118, 'lan', 'Occitan (post 1500)'),
	(119, 'cpp', 'Creoles and Pidgins, Portuguese-based'),
	(120, 'zza', 'Zaza'),
	(121, 'ltz', 'Luxembourgish'),
	(122, 'nso', 'Northern Sotho'),
	(123, 'gil', 'Gilbertese'),
	(124, 'nds', 'Low German'),
	(125, 'ast', 'Asturian'),
	(126, 'ido', 'Ido'),
	(127, 'chy', 'Cheyenne'),
	(128, 'oji', 'Ojibwa'),
	(129, 'mal', 'Malayalam'),
	(130, 'cpe', 'Creoles and Pidgins, English-based'),
	(131, 'gle', 'Irish'),
	(132, 'enm', 'English, Middle (1100-1500)'),
	(133, 'smi', 'Sami 2'),
	(134, 'mla', 'Malagasy'),
	(135, 'lao', 'Lao'),
	(136, 'sio', 'Siouan'),
	(137, 'egy', 'Egyptian'),
	(138, 'tir', 'Tigrinya'),
	(139, 'ipk', 'Inupiaq'),
	(140, 'san', 'Sanskrit'),
	(141, 'ady', 'Adygei'),
	(142, 'cai', 'Central American Indian'),
	(143, 'lug', 'Ganda'),
	(144, 'lad', 'Ladino'),
	(145, 'int', 'Interlingua 2'),
	(146, 'mak', 'Makasar'),
	(147, 'oci', 'Occitan (post 1500) 2'),
	(148, 'tig', 'Tigré'),
	(149, 'nya', 'Nyanja'),
	(150, 'bnt', 'Bantu'),
	(151, 'esp', 'Esperanto 2'),
	(152, 'mun', 'Munda'),
	(153, 'raj', 'Rajasthani'),
	(154, 'hmn', 'Hmong'),
	(155, 'cat', 'Catalan'),
	(156, 'bam', 'Bambara'),
	(157, 'arg', 'Aragonese'),
	(158, 'cho', 'Choctaw'),
	(159, 'uzb', 'Uzbek'),
	(160, 'heb', 'Hebrew'),
	(161, 'crh', 'Crimean Tatar'),
	(162, 'got', 'Gothic'),
	(163, 'tum', 'Tumbuka'),
	(164, 'dyu', 'Dyula'),
	(165, 'phi', 'Philippine'),
	(166, 'aka', 'Akan'),
	(167, 'fij', 'Fijian'),
	(168, 'grb', 'Grebo'),
	(169, 'lin', 'Lingala'),
	(170, 'kab', 'Kabyle'),
	(171, 'gmh', 'German, Middle High (ca. 1050-1500)'),
	(172, 'ton', 'Tongan'),
	(173, 'pan', 'Panjabi'),
	(174, 'mnc', 'Manchu'),
	(175, 'shn', 'Shan'),
	(176, 'kik', 'Kikuyu'),
	(177, 'kum', 'Kumyk'),
	(178, 'ilo', 'Iloko'),
	(179, 'lap', 'Sami'),
	(180, 'xho', 'Xhosa'),
	(181, 'dra', 'Dravidian'),
	(182, 'men', 'Mende'),
	(183, 'sao', 'Samoan'),
	(184, 'alb', 'Albanian'),
	(185, 'bin', 'Edo'),
	(186, 'sad', 'Sandawe'),
	(187, 'fiu', 'Finno-Ugrian'),
	(188, 'lol', 'Mongo-Nkundu'),
	(189, 'cze', 'Czech'),
	(190, 'che', 'Chechen'),
	(191, 'run', 'Rundi'),
	(192, 'art', 'Artificial'),
	(193, 'por', 'Portuguese'),
	(194, 'taj', 'Tajik'),
	(195, 'inh', 'Ingush'),
	(196, 'ban', 'Balinese'),
	(197, 'sso', 'Sotho 2'),
	(198, 'mis', 'Miscellaneous'),
	(199, 'nic', 'Niger-Kordofanian'),
	(200, 'khi', 'Khoisan'),
	(201, 'kal', 'Kalâtdlisut'),
	(202, 'spa', 'Spanish'),
	(203, 'srd', 'Sardinian'),
	(204, 'per', 'Persian'),
	(205, 'lus', 'Lushai'),
	(206, 'ice', 'Icelandic'),
	(207, 'kaw', 'Kawi'),
	(208, 'kru', 'Kurukh'),
	(209, 'sid', 'Sidamo'),
	(210, 'jpn', 'Japanese'),
	(211, 'kor', 'Korean'),
	(212, 'tai', 'Tai'),
	(213, 'grc', 'Ancient Greek'),
	(214, 'sin', 'Sinhalese 2'),
	(215, 'pra', 'Prakrit'),
	(216, 'div', 'Maldivian'),
	(217, 'abk', 'Abkhaz'),
	(218, 'kaa', 'Kara-Kalpak'),
	(219, 'srn', 'Sranan'),
	(220, 'pam', 'Pampanga'),
	(221, 'tsi', 'Tsimshian'),
	(222, 'hat', 'Haitian French Creole'),
	(223, 'grn', 'Guarani'),
	(224, 'wal', 'Wolayta'),
	(225, 'oss', 'Ossetic'),
	(226, 'scr', 'Croatian'),
	(227, 'glg', 'Galician 2'),
	(228, 'tat', 'Tatar'),
	(229, 'akk', 'Akkadian'),
	(230, 'wel', 'Welsh'),
	(231, 'jav', 'Javanese'),
	(232, 'cha', 'Chamorro'),
	(233, 'kan', 'Kannada'),
	(234, 'ira', 'Iranian'),
	(235, 'crp', 'Creoles and Pidgins'),
	(236, 'sux', 'Sumerian'),
	(237, 'cre', 'Cree'),
	(238, 'pag', 'Pangasinan'),
	(239, 'tyv', 'Tuvinian'),
	(240, 'zul', 'Zulu'),
	(241, 'mos', 'Mooré'),
	(242, 'ave', 'Avestan'),
	(243, 'mai', 'Maithili'),
	(244, 'tkl', 'Tokelauan'),
	(245, 'bat', 'Baltic'),
	(246, 'urd', 'Urdu'),
	(247, 'elx', 'Elamite'),
	(248, 'kac', 'Kachin'),
	(249, 'fur', 'Friulian'),
	(250, 'lun', 'Lunda'),
	(251, 'dum', 'Dutch, Middle (ca. 1050-1350)'),
	(252, 'fry', 'Frisian 2'),
	(253, 'tpi', 'Tok Pisin'),
	(254, 'kom', 'Komi'),
	(255, 'kon', 'Kongo'),
	(256, 'khm', 'Khmer'),
	(257, 'sun', 'Sundanese'),
	(258, 'rom', 'Romani'),
	(259, 'luo', 'Luo (Kenya and Tanzania)'),
	(260, 'sho', 'Shona'),
	(261, 'vls', 'Flemish'),
	(262, 'swe', 'Swedish'),
	(263, 'kbd', 'Kabardian'),
	(264, 'tem', 'Temne'),
	(265, 'day', 'Dayak'),
	(266, 'bug', 'Bugis'),
	(267, 'gay', 'Gayo'),
	(268, 'fat', 'Fanti'),
	(269, 'bos', 'Bosnian'),
	(270, 'loz', 'Lozi'),
	(271, 'kam', 'Kamba'),
	(272, 'eka', 'Ekajuk'),
	(273, 'nyo', 'Nyoro'),
	(274, 'dan', 'Danish'),
	(275, 'bur', 'Burmese'),
	(276, 'slv', 'Slovenian'),
	(277, 'zap', 'Zapotec'),
	(278, 'vie', 'Vietnamese'),
	(279, 'tah', 'Tahitian'),
	(280, 'bra', 'Braj'),
	(281, 'gaa', 'Gã'),
	(282, 'cus', 'Cushitic'),
	(283, 'asm', 'Assamese'),
	(284, 'nyn', 'Nyankole'),
	(285, 'ssa', 'Nilo-Saharan'),
	(286, 'nob', 'Norwegian (Bokmål)'),
	(287, 'myn', 'Mayan'),
	(288, 'ndo', 'Ndonga'),
	(289, 'nbl', 'Ndebele (South Africa)'),
	(290, 'gre', 'Greek'),
	(291, 'tag', 'Tagalog 2'),
	(292, 'kpe', 'Kpelle'),
	(293, 'bak', 'Bashkir'),
	(294, 'ada', 'Adangme'),
	(295, 'tsw', 'Tswana'),
	(296, 'frm', 'French, Middle (ca. 1300-1600)'),
	(297, 'gon', 'Gondi'),
	(298, 'ara', 'Arabic'),
	(299, 'mas', 'Masai'),
	(300, 'gal', 'Oromo 2'),
	(301, 'son', 'Songhai'),
	(302, 'tar', 'Tatar 2'),
	(303, 'kin', 'Kinyarwanda'),
	(304, 'chm', 'Mari'),
	(305, 'ger', 'German / Deutsch'),
	(306, 'mah', 'Marshallese'),
	(307, 'sem', 'Semitic'),
	(308, 'ori', 'Oriya'),
	(309, 'kaz', 'Kazakh'),
	(310, 'nav', 'Navajo'),
	(311, 'hbs', 'Serbo-Croatian'),
	(312, 'nep', 'Nepali'),
	(313, 'fil', 'Filipino'),
	(314, 'tiv', 'Tiv'),
	(315, 'tel', 'Telugu'),
	(316, 'dua', 'Duala'),
	(317, 'cau', 'Caucasian'),
	(318, 'nde', 'Ndebele'),
	(319, 'wen', 'Sorbian'),
	(320, 'bik', 'Bikol'),
	(321, 'pap', 'Papiamento'),
	(322, 'sag', 'Sango'),
	(323, 'mar', 'Marathi'),
	(324, 'ssw', 'Swazi'),
	(325, 'sna', 'Shona 2'),
	(326, 'guj', 'Gujarati'),
	(327, 'kha', 'Khasi'),
	(328, 'chn', 'Chinook jargon'),
	(329, 'mag', 'Magahi'),
	(330, 'sel', 'Selkup'),
	(331, 'iba', 'Iban'),
	(332, 'lah', 'Lahndā'),
	(333, 'zun', 'Zuni'),
	(334, 'som', 'Somali'),
	(335, 'ota', 'Turkish, Ottoman'),
	(336, 'kua', 'Kuanyama'),
	(337, 'moh', 'Mohawk'),
	(338, 'tog', 'Tonga (Nyasa)'),
	(339, 'ine', 'Indo-European'),
	(340, 'kmb', 'Kimbundu'),
	(341, 'peo', 'Old Persian (ca. 600-400 B.C.)'),
	(342, 'din', 'Dinka'),
	(343, 'aar', 'Afar'),
	(344, 'hun', 'Hungarian'),
	(345, 'non', 'Old Norse'),
	(346, 'alt', 'Altai'),
	(347, 'kro', 'Kru'),
	(348, 'gba', 'Gbaya'),
	(349, 'ang', 'English, Old (ca. 450-1100)'),
	(350, 'sah', 'Yakut'),
	(351, 'ukr', 'Ukrainian'),
	(352, 'arm', 'Armenian'),
	(353, 'nzi', 'Nzima'),
	(354, 'lat', 'Latin'),
	(355, 'fin', 'Finnish'),
	(356, 'sog', 'Sogdian'),
	(357, 'sit', 'Sino-Tibetan'),
	(358, 'udm', 'Udmurt'),
	(359, 'far', 'Faroese 2'),
	(360, 'bla', 'Siksika'),
	(361, 'niu', 'Niuean'),
	(362, 'lez', 'Lezgian'),
	(363, 'sas', 'Sasak'),
	(364, 'inc', 'Indic'),
	(365, 'bem', 'Bemba'),
	(366, 'osa', 'Osage'),
	(367, 'bis', 'Bislama'),
	(368, 'xal', 'Oirat'),
	(369, 'hin', 'Hindi'),
	(370, 'hrv', 'Croatian 2'),
	(371, 'iri', 'Irish 2'),
	(372, 'chi', 'Chinese'),
	(373, 'ewe', 'Ewe'),
	(374, 'kir', 'Kyrgyz'),
	(375, 'mwr', 'Marwari'),
	(376, 'yao', 'Yao (Africa)'),
	(377, 'znd', 'Zande'),
	(378, 'pon', 'Ponape'),
	(379, 'jrb', 'Judeo-Arabic'),
	(380, 'nub', 'Nubian'),
	(381, 'afa', 'Afroasiatic'),
	(382, 'ind', 'Indonesian'),
	(383, 'fre', 'French / français'),
	(384, 'aym', 'Aymara'),
	(385, 'bel', 'Belarusian'),
	(386, 'iku', 'Inuktitut'),
	(387, 'nau', 'Nauru'),
	(388, 'glv', 'Manx'),
	(389, 'arw', 'Arawak'),
	(390, 'mus', 'Creek'),
	(391, 'hsb', 'Upper Sorbian'),
	(392, 'que', 'Quechua'),
	(393, 'srr', 'Serer'),
	(394, 'pus', 'Pushto'),
	(395, 'tur', 'Turkish'),
	(396, 'sai', 'South American Indian'),
	(397, 'lua', 'Luba-Lulua'),
	(398, 'mol', 'Moldavian'),
	(399, 'suk', 'Sukuma'),
	(400, 'eng', 'English'),
	(401, 'smo', 'Samoan 2'),
	(402, 'kok', 'Konkani'),
	(403, 'ewo', 'Ewondo'),
	(404, 'sat', 'Santali'),
	(405, 'nah', 'Nahuatl'),
	(406, 'ach', 'Acoli'),
	(407, 'her', 'Herero'),
	(408, 'oto', 'Otomian'),
	(409, 'myv', 'Erzya'),
	(410, 'geo', 'Georgian'),
	(411, 'ben', 'Bengali'),
	(412, 'map', 'Austronesian'),
	(413, 'syr', 'Syriac, Modern'),
	(414, 'gez', 'Ethiopic 2'),
	(415, 'kho', 'Khotanese'),
	(416, 'gua', 'Guarani 2'),
	(417, 'wol', 'Wolof'),
	(418, 'tha', 'Thai'),
	(419, 'lub', 'Luba-Katanga'),
	(420, 'gul', 'Gullah'),
	(421, 'him', 'Himachali'),
	(422, 'ypk', 'Yupik'),
	(423, 'yap', 'Yapese'),
	(424, 'chu', 'Church Slavic'),
	(425, 'tmh', 'Tamashek'),
	(426, 'pli', 'Pali'),
	(427, 'tso', 'Tsonga'),
	(428, 'mic', 'Micmac'),
	(429, 'swz', 'Swazi 2'),
	(430, 'sla', 'Slavic'),
	(431, 'war', 'Waray'),
	(432, 'esk', 'Eskimo'),
	(433, 'bas', 'Basa'),
	(434, 'ase', 'American Sign Language'),
	(435, 'gla', 'Scottish Gaelic'),
	(436, 'kar', 'Karen'),
	(437, 'tib', 'Tibetan'),
	(438, 'apa', 'Apache'),
	(439, 'chv', 'Chuvash'),
	(440, 'dut', 'Dutch'),
	(441, 'cam', 'Khmer 2'),
	(442, 'tsn', 'Tswana 2'),
	(443, 'twi', 'Twi'),
	(444, 'lit', 'Lithuanian'),
	(445, 'dzo', 'Dzongkha'),
	(446, 'cos', 'Corsican'),
	(447, 'mni', 'Manipuri'),
	(448, 'lav', 'Latvian'),
	(449, 'yid', 'Yiddish'),
	(450, 'rus', 'Russian'),
	(451, 'uig', 'Uighur'),
	(452, 'del', 'Delaware'),
	(453, 'min', 'Minangkabau'),
	(454, 'arc', 'Aramaic'),
	(455, 'bai', 'Bamileke'),
	(456, 'nai', 'North American Indian'),
	(457, 'fro', 'French, Old (ca. 842-1300)'),
	(458, 'alg', 'Algonquian'),
	(459, 'roa', 'Romance'),
	(460, 'snd', 'Sindhi'),
	(461, 'arn', 'Mapuche'),
	(462, 'chk', 'Chuukese'),
	(463, 'tgk', 'Tajik 2'),
	(464, 'mlg', 'Malagasy 2'),
	(465, 'dar', 'Dargwa');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
