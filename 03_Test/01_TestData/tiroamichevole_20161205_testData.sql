-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 05, 2016 alle 07:19
-- Versione del server: 10.1.10-MariaDB
-- Versione PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiroamichevole`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bersagli`
--

CREATE TABLE `bersagli` (
  `idBersaglio` int(11) NOT NULL,
  `codice` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `maxPti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `bersagli`
--

INSERT INTO `bersagli` (`idBersaglio`, `codice`, `tipo`, `maxPti`) VALUES
(1, 'A10', 'A', 10),
(2, 'A100', 'A', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoriaarmi`
--

CREATE TABLE `categoriaarmi` (
  `idCategoria` int(11) NOT NULL,
  `codiceCat` varchar(45) DEFAULT NULL,
  `descrizione` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categoriaarmi`
--

INSERT INTO `categoriaarmi` (`idCategoria`, `codiceCat`, `descrizione`) VALUES
(1, 'A', 'Sport'),
(2, 'B', 'Ordinanza 02'),
(3, 'C', 'Ordinanza');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoriaeta`
--

CREATE TABLE `categoriaeta` (
  `idCategoriaEta` int(11) NOT NULL,
  `descrizione` varchar(45) DEFAULT NULL,
  `codice` varchar(45) DEFAULT NULL,
  `etaMin` bigint(20) DEFAULT NULL,
  `etaMax` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categoriaeta`
--

INSERT INTO `categoriaeta` (`idCategoriaEta`, `descrizione`, `codice`, `etaMin`, `etaMax`) VALUES
(1, 'Adolescenti', 'JJ', 10, 16),
(2, 'Juniores', 'J', 17, 20),
(3, 'Elite', 'E', 0, 200),
(4, 'Seniores', 'S', 46, 59),
(5, 'Veterani', 'V', 60, 69),
(6, 'Vetrani senior', 'SV', 70, 200);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria_serie_premio`
--

CREATE TABLE `categoria_serie_premio` (
  `Serie_idSerie` int(11) NOT NULL,
  `CategoriaArmi_idCategoria` int(11) NOT NULL,
  `CategoriaEta_idCategoriaEta` int(11) NOT NULL,
  `minPti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categoria_serie_premio`
--

INSERT INTO `categoria_serie_premio` (`Serie_idSerie`, `CategoriaArmi_idCategoria`, `CategoriaEta_idCategoriaEta`, `minPti`) VALUES
(3, 1, 1, 89),
(4, 1, 1, 60),
(3, 1, 2, 90),
(4, 1, 2, 60),
(3, 1, 3, 92),
(4, 1, 3, 60),
(3, 1, 4, 92),
(4, 1, 4, 60),
(3, 1, 5, 90),
(4, 1, 5, 60),
(3, 1, 6, 89),
(4, 1, 6, 60),
(3, 2, 1, 78),
(4, 2, 1, 60),
(3, 2, 2, 79),
(4, 2, 2, 60),
(3, 2, 3, 81),
(4, 2, 3, 60),
(3, 2, 4, 81),
(4, 2, 4, 60),
(3, 2, 5, 79),
(4, 2, 5, 60),
(3, 2, 6, 78),
(4, 2, 6, 60),
(3, 3, 1, 81),
(4, 3, 1, 60),
(3, 3, 2, 82),
(4, 3, 2, 60),
(3, 3, 3, 84),
(4, 3, 3, 60),
(3, 3, 4, 84),
(4, 3, 4, 60),
(3, 3, 5, 82),
(4, 3, 5, 60),
(3, 3, 6, 81),
(4, 3, 6, 60);

-- --------------------------------------------------------

--
-- Struttura della tabella `colpiti`
--

CREATE TABLE `colpiti` (
  `idColpito` int(11) NOT NULL,
  `colpito` int(11) DEFAULT NULL,
  `Inscrizioni_Licenze_idLicenza` int(11) NOT NULL,
  `Serie_idSerie` int(11) NOT NULL,
  `Programmi_idProgramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

CREATE TABLE `gruppi` (
  `idGruppo` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `CategoriaArmi_idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi_has_inscrizioni`
--

CREATE TABLE `gruppi_has_inscrizioni` (
  `Gruppi_idGruppo` int(11) NOT NULL,
  `Inscrizioni_Licenze_idLicenza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `inscrizioni`
--

CREATE TABLE `inscrizioni` (
  `Licenze_idLicenza` int(11) NOT NULL,
  `CategoriaArmi_idCategoria` int(11) NOT NULL,
  `CategoriaEta_idCategoriaEta` int(11) NOT NULL,
  `Societa_idSocieta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `inscrizioni_has_serie`
--

CREATE TABLE `inscrizioni_has_serie` (
  `Inscrizioni_Licenze_idLicenza` int(11) NOT NULL,
  `Serie_idSerie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `licenze`
--

CREATE TABLE `licenze` (
  `idLicenza` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `Cognome` varchar(45) DEFAULT NULL,
  `Via` varchar(255) DEFAULT NULL,
  `ViaNo` varchar(45) DEFAULT NULL,
  `CAP` varchar(45) DEFAULT NULL,
  `Luogo` varchar(45) DEFAULT NULL,
  `DataNascita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `licenze`
--

INSERT INTO `licenze` (`idLicenza`, `Nome`, `Cognome`, `Via`, `ViaNo`, `CAP`, `Luogo`, `DataNascita`) VALUES
(999798, 'Nome201', 'Cognome201', 'Via Abc', '201', '6201', 'Località 201', '2004-01-01'),
(999799, 'Nome200', 'Cognome200', 'Via Abc', '200', '6200', 'Località 200', '2005-01-01'),
(999800, 'Nome199', 'Cognome199', 'Via Abc', '199', '6199', 'Località 199', '1940-01-01'),
(999801, 'Nome198', 'Cognome198', 'Via Abc', '198', '6198', 'Località 198', '1941-01-01'),
(999802, 'Nome197', 'Cognome197', 'Via Abc', '197', '6197', 'Località 197', '1942-01-01'),
(999803, 'Nome196', 'Cognome196', 'Via Abc', '196', '6196', 'Località 196', '1943-01-01'),
(999804, 'Nome195', 'Cognome195', 'Via Abc', '195', '6195', 'Località 195', '1944-01-01'),
(999805, 'Nome194', 'Cognome194', 'Via Abc', '194', '6194', 'Località 194', '1945-01-01'),
(999806, 'Nome193', 'Cognome193', 'Via Abc', '193', '6193', 'Località 193', '1946-01-01'),
(999807, 'Nome192', 'Cognome192', 'Via Abc', '192', '6192', 'Località 192', '1947-01-01'),
(999808, 'Nome191', 'Cognome191', 'Via Abc', '191', '6191', 'Località 191', '1948-01-01'),
(999809, 'Nome190', 'Cognome190', 'Via Abc', '190', '6190', 'Località 190', '1949-01-01'),
(999810, 'Nome189', 'Cognome189', 'Via Abc', '189', '6189', 'Località 189', '1950-01-01'),
(999811, 'Nome188', 'Cognome188', 'Via Abc', '188', '6188', 'Località 188', '1951-01-01'),
(999812, 'Nome187', 'Cognome187', 'Via Abc', '187', '6187', 'Località 187', '1952-01-01'),
(999813, 'Nome186', 'Cognome186', 'Via Abc', '186', '6186', 'Località 186', '1953-01-01'),
(999814, 'Nome185', 'Cognome185', 'Via Abc', '185', '6185', 'Località 185', '1954-01-01'),
(999815, 'Nome184', 'Cognome184', 'Via Abc', '184', '6184', 'Località 184', '1955-01-01'),
(999816, 'Nome183', 'Cognome183', 'Via Abc', '183', '6183', 'Località 183', '1956-01-01'),
(999817, 'Nome182', 'Cognome182', 'Via Abc', '182', '6182', 'Località 182', '1957-01-01'),
(999818, 'Nome181', 'Cognome181', 'Via Abc', '181', '6181', 'Località 181', '1958-01-01'),
(999819, 'Nome180', 'Cognome180', 'Via Abc', '180', '6180', 'Località 180', '1959-01-01'),
(999820, 'Nome179', 'Cognome179', 'Via Abc', '179', '6179', 'Località 179', '1960-01-01'),
(999821, 'Nome178', 'Cognome178', 'Via Abc', '178', '6178', 'Località 178', '1961-01-01'),
(999822, 'Nome177', 'Cognome177', 'Via Abc', '177', '6177', 'Località 177', '1962-01-01'),
(999823, 'Nome176', 'Cognome176', 'Via Abc', '176', '6176', 'Località 176', '1963-01-01'),
(999824, 'Nome175', 'Cognome175', 'Via Abc', '175', '6175', 'Località 175', '1964-01-01'),
(999825, 'Nome174', 'Cognome174', 'Via Abc', '174', '6174', 'Località 174', '1965-01-01'),
(999826, 'Nome173', 'Cognome173', 'Via Abc', '173', '6173', 'Località 173', '1966-01-01'),
(999827, 'Nome172', 'Cognome172', 'Via Abc', '172', '6172', 'Località 172', '1967-01-01'),
(999828, 'Nome171', 'Cognome171', 'Via Abc', '171', '6171', 'Località 171', '1968-01-01'),
(999829, 'Nome170', 'Cognome170', 'Via Abc', '170', '6170', 'Località 170', '1969-01-01'),
(999830, 'Nome169', 'Cognome169', 'Via Abc', '169', '6169', 'Località 169', '1970-01-01'),
(999831, 'Nome168', 'Cognome168', 'Via Abc', '168', '6168', 'Località 168', '1971-01-01'),
(999832, 'Nome167', 'Cognome167', 'Via Abc', '167', '6167', 'Località 167', '1972-01-01'),
(999833, 'Nome166', 'Cognome166', 'Via Abc', '166', '6166', 'Località 166', '1973-01-01'),
(999834, 'Nome165', 'Cognome165', 'Via Abc', '165', '6165', 'Località 165', '1974-01-01'),
(999835, 'Nome164', 'Cognome164', 'Via Abc', '164', '6164', 'Località 164', '1975-01-01'),
(999836, 'Nome163', 'Cognome163', 'Via Abc', '163', '6163', 'Località 163', '1976-01-01'),
(999837, 'Nome162', 'Cognome162', 'Via Abc', '162', '6162', 'Località 162', '1977-01-01'),
(999838, 'Nome161', 'Cognome161', 'Via Abc', '161', '6161', 'Località 161', '1978-01-01'),
(999839, 'Nome160', 'Cognome160', 'Via Abc', '160', '6160', 'Località 160', '1979-01-01'),
(999840, 'Nome159', 'Cognome159', 'Via Abc', '159', '6159', 'Località 159', '1980-01-01'),
(999841, 'Nome158', 'Cognome158', 'Via Abc', '158', '6158', 'Località 158', '1981-01-01'),
(999842, 'Nome157', 'Cognome157', 'Via Abc', '157', '6157', 'Località 157', '1982-01-01'),
(999843, 'Nome156', 'Cognome156', 'Via Abc', '156', '6156', 'Località 156', '1983-01-01'),
(999844, 'Nome155', 'Cognome155', 'Via Abc', '155', '6155', 'Località 155', '1984-01-01'),
(999845, 'Nome154', 'Cognome154', 'Via Abc', '154', '6154', 'Località 154', '1985-01-01'),
(999846, 'Nome153', 'Cognome153', 'Via Abc', '153', '6153', 'Località 153', '1986-01-01'),
(999847, 'Nome152', 'Cognome152', 'Via Abc', '152', '6152', 'Località 152', '1987-01-01'),
(999848, 'Nome151', 'Cognome151', 'Via Abc', '151', '6151', 'Località 151', '1988-01-01'),
(999849, 'Nome150', 'Cognome150', 'Via Abc', '150', '6150', 'Località 150', '1989-01-01'),
(999850, 'Nome149', 'Cognome149', 'Via Abc', '149', '6149', 'Località 149', '1990-01-01'),
(999851, 'Nome148', 'Cognome148', 'Via Abc', '148', '6148', 'Località 148', '1991-01-01'),
(999852, 'Nome147', 'Cognome147', 'Via Abc', '147', '6147', 'Località 147', '1992-01-01'),
(999853, 'Nome146', 'Cognome146', 'Via Abc', '146', '6146', 'Località 146', '1993-01-01'),
(999854, 'Nome145', 'Cognome145', 'Via Abc', '145', '6145', 'Località 145', '1994-01-01'),
(999855, 'Nome144', 'Cognome144', 'Via Abc', '144', '6144', 'Località 144', '1995-01-01'),
(999856, 'Nome143', 'Cognome143', 'Via Abc', '143', '6143', 'Località 143', '1996-01-01'),
(999857, 'Nome142', 'Cognome142', 'Via Abc', '142', '6142', 'Località 142', '1997-01-01'),
(999858, 'Nome141', 'Cognome141', 'Via Abc', '141', '6141', 'Località 141', '1998-01-01'),
(999859, 'Nome140', 'Cognome140', 'Via Abc', '140', '6140', 'Località 140', '1999-01-01'),
(999860, 'Nome139', 'Cognome139', 'Via Abc', '139', '6139', 'Località 139', '2000-01-01'),
(999861, 'Nome138', 'Cognome138', 'Via Abc', '138', '6138', 'Località 138', '2001-01-01'),
(999862, 'Nome137', 'Cognome137', 'Via Abc', '137', '6137', 'Località 137', '2002-01-01'),
(999863, 'Nome136', 'Cognome136', 'Via Abc', '136', '6136', 'Località 136', '2003-01-01'),
(999864, 'Nome135', 'Cognome135', 'Via Abc', '135', '6135', 'Località 135', '2004-01-01'),
(999865, 'Nome134', 'Cognome134', 'Via Abc', '134', '6134', 'Località 134', '2005-01-01'),
(999866, 'Nome133', 'Cognome133', 'Via Abc', '133', '6133', 'Località 133', '1940-01-01'),
(999867, 'Nome132', 'Cognome132', 'Via Abc', '132', '6132', 'Località 132', '1941-01-01'),
(999868, 'Nome131', 'Cognome131', 'Via Abc', '131', '6131', 'Località 131', '1942-01-01'),
(999869, 'Nome130', 'Cognome130', 'Via Abc', '130', '6130', 'Località 130', '1943-01-01'),
(999870, 'Nome129', 'Cognome129', 'Via Abc', '129', '6129', 'Località 129', '1944-01-01'),
(999871, 'Nome128', 'Cognome128', 'Via Abc', '128', '6128', 'Località 128', '1945-01-01'),
(999872, 'Nome127', 'Cognome127', 'Via Abc', '127', '6127', 'Località 127', '1946-01-01'),
(999873, 'Nome126', 'Cognome126', 'Via Abc', '126', '6126', 'Località 126', '1947-01-01'),
(999874, 'Nome125', 'Cognome125', 'Via Abc', '125', '6125', 'Località 125', '1948-01-01'),
(999875, 'Nome124', 'Cognome124', 'Via Abc', '124', '6124', 'Località 124', '1949-01-01'),
(999876, 'Nome123', 'Cognome123', 'Via Abc', '123', '6123', 'Località 123', '1950-01-01'),
(999877, 'Nome122', 'Cognome122', 'Via Abc', '122', '6122', 'Località 122', '1951-01-01'),
(999878, 'Nome121', 'Cognome121', 'Via Abc', '121', '6121', 'Località 121', '1952-01-01'),
(999879, 'Nome120', 'Cognome120', 'Via Abc', '120', '6120', 'Località 120', '1953-01-01'),
(999880, 'Nome119', 'Cognome119', 'Via Abc', '119', '6119', 'Località 119', '1954-01-01'),
(999881, 'Nome118', 'Cognome118', 'Via Abc', '118', '6118', 'Località 118', '1955-01-01'),
(999882, 'Nome117', 'Cognome117', 'Via Abc', '117', '6117', 'Località 117', '1956-01-01'),
(999883, 'Nome116', 'Cognome116', 'Via Abc', '116', '6116', 'Località 116', '1957-01-01'),
(999884, 'Nome115', 'Cognome115', 'Via Abc', '115', '6115', 'Località 115', '1958-01-01'),
(999885, 'Nome114', 'Cognome114', 'Via Abc', '114', '6114', 'Località 114', '1959-01-01'),
(999886, 'Nome113', 'Cognome113', 'Via Abc', '113', '6113', 'Località 113', '1960-01-01'),
(999887, 'Nome112', 'Cognome112', 'Via Abc', '112', '6112', 'Località 112', '1961-01-01'),
(999888, 'Nome111', 'Cognome111', 'Via Abc', '111', '6111', 'Località 111', '1962-01-01'),
(999889, 'Nome110', 'Cognome110', 'Via Abc', '110', '6110', 'Località 110', '1963-01-01'),
(999890, 'Nome109', 'Cognome109', 'Via Abc', '109', '6109', 'Località 109', '1964-01-01'),
(999891, 'Nome108', 'Cognome108', 'Via Abc', '108', '6108', 'Località 108', '1965-01-01'),
(999892, 'Nome107', 'Cognome107', 'Via Abc', '107', '6107', 'Località 107', '1966-01-01'),
(999893, 'Nome106', 'Cognome106', 'Via Abc', '106', '6106', 'Località 106', '1967-01-01'),
(999894, 'Nome105', 'Cognome105', 'Via Abc', '105', '6105', 'Località 105', '1968-01-01'),
(999895, 'Nome104', 'Cognome104', 'Via Abc', '104', '6104', 'Località 104', '1969-01-01'),
(999896, 'Nome103', 'Cognome103', 'Via Abc', '103', '6103', 'Località 103', '1970-01-01'),
(999897, 'Nome102', 'Cognome102', 'Via Abc', '102', '6102', 'Località 102', '1971-01-01'),
(999898, 'Nome101', 'Cognome101', 'Via Abc', '101', '6101', 'Località 101', '1972-01-01'),
(999899, 'Nome100', 'Cognome100', 'Via Abc', '100', '6100', 'Località 100', '1973-01-01'),
(999900, 'Nome99', 'Cognome99', 'Via Abc', '99', '6099', 'Località 99', '1974-01-01'),
(999901, 'Nome98', 'Cognome98', 'Via Abc', '98', '6098', 'Località 98', '1975-01-01'),
(999902, 'Nome97', 'Cognome97', 'Via Abc', '97', '6097', 'Località 97', '1976-01-01'),
(999903, 'Nome96', 'Cognome96', 'Via Abc', '96', '6096', 'Località 96', '1977-01-01'),
(999904, 'Nome95', 'Cognome95', 'Via Abc', '95', '6095', 'Località 95', '1978-01-01'),
(999905, 'Nome94', 'Cognome94', 'Via Abc', '94', '6094', 'Località 94', '1979-01-01'),
(999906, 'Nome93', 'Cognome93', 'Via Abc', '93', '6093', 'Località 93', '1980-01-01'),
(999907, 'Nome92', 'Cognome92', 'Via Abc', '92', '6092', 'Località 92', '1981-01-01'),
(999908, 'Nome91', 'Cognome91', 'Via Abc', '91', '6091', 'Località 91', '1982-01-01'),
(999909, 'Nome90', 'Cognome90', 'Via Abc', '90', '6090', 'Località 90', '1983-01-01'),
(999910, 'Nome89', 'Cognome89', 'Via Abc', '89', '6089', 'Località 89', '1984-01-01'),
(999911, 'Nome88', 'Cognome88', 'Via Abc', '88', '6088', 'Località 88', '1985-01-01'),
(999912, 'Nome87', 'Cognome87', 'Via Abc', '87', '6087', 'Località 87', '1986-01-01'),
(999913, 'Nome86', 'Cognome86', 'Via Abc', '86', '6086', 'Località 86', '1987-01-01'),
(999914, 'Nome85', 'Cognome85', 'Via Abc', '85', '6085', 'Località 85', '1988-01-01'),
(999915, 'Nome84', 'Cognome84', 'Via Abc', '84', '6084', 'Località 84', '1989-01-01'),
(999916, 'Nome83', 'Cognome83', 'Via Abc', '83', '6083', 'Località 83', '1990-01-01'),
(999917, 'Nome82', 'Cognome82', 'Via Abc', '82', '6082', 'Località 82', '1991-01-01'),
(999918, 'Nome81', 'Cognome81', 'Via Abc', '81', '6081', 'Località 81', '1992-01-01'),
(999919, 'Nome80', 'Cognome80', 'Via Abc', '80', '6080', 'Località 80', '1993-01-01'),
(999920, 'Nome79', 'Cognome79', 'Via Abc', '79', '6079', 'Località 79', '1994-01-01'),
(999921, 'Nome78', 'Cognome78', 'Via Abc', '78', '6078', 'Località 78', '1995-01-01'),
(999922, 'Nome77', 'Cognome77', 'Via Abc', '77', '6077', 'Località 77', '1996-01-01'),
(999923, 'Nome76', 'Cognome76', 'Via Abc', '76', '6076', 'Località 76', '1997-01-01'),
(999924, 'Nome75', 'Cognome75', 'Via Abc', '75', '6075', 'Località 75', '1998-01-01'),
(999925, 'Nome74', 'Cognome74', 'Via Abc', '74', '6074', 'Località 74', '1999-01-01'),
(999926, 'Nome73', 'Cognome73', 'Via Abc', '73', '6073', 'Località 73', '2000-01-01'),
(999927, 'Nome72', 'Cognome72', 'Via Abc', '72', '6072', 'Località 72', '2001-01-01'),
(999928, 'Nome71', 'Cognome71', 'Via Abc', '71', '6071', 'Località 71', '2002-01-01'),
(999929, 'Nome70', 'Cognome70', 'Via Abc', '70', '6070', 'Località 70', '2003-01-01'),
(999930, 'Nome69', 'Cognome69', 'Via Abc', '69', '6069', 'Località 69', '2004-01-01'),
(999931, 'Nome68', 'Cognome68', 'Via Abc', '68', '6068', 'Località 68', '2005-01-01'),
(999932, 'Nome67', 'Cognome67', 'Via Abc', '67', '6067', 'Località 67', '1940-01-01'),
(999933, 'Nome66', 'Cognome66', 'Via Abc', '66', '6066', 'Località 66', '1941-01-01'),
(999934, 'Nome65', 'Cognome65', 'Via Abc', '65', '6065', 'Località 65', '1942-01-01'),
(999935, 'Nome64', 'Cognome64', 'Via Abc', '64', '6064', 'Località 64', '1943-01-01'),
(999936, 'Nome63', 'Cognome63', 'Via Abc', '63', '6063', 'Località 63', '1944-01-01'),
(999937, 'Nome62', 'Cognome62', 'Via Abc', '62', '6062', 'Località 62', '1945-01-01'),
(999938, 'Nome61', 'Cognome61', 'Via Abc', '61', '6061', 'Località 61', '1946-01-01'),
(999939, 'Nome60', 'Cognome60', 'Via Abc', '60', '6060', 'Località 60', '1947-01-01'),
(999940, 'Nome59', 'Cognome59', 'Via Abc', '59', '6059', 'Località 59', '1948-01-01'),
(999941, 'Nome58', 'Cognome58', 'Via Abc', '58', '6058', 'Località 58', '1949-01-01'),
(999942, 'Nome57', 'Cognome57', 'Via Abc', '57', '6057', 'Località 57', '1950-01-01'),
(999943, 'Nome56', 'Cognome56', 'Via Abc', '56', '6056', 'Località 56', '1951-01-01'),
(999944, 'Nome55', 'Cognome55', 'Via Abc', '55', '6055', 'Località 55', '1952-01-01'),
(999945, 'Nome54', 'Cognome54', 'Via Abc', '54', '6054', 'Località 54', '1953-01-01'),
(999946, 'Nome53', 'Cognome53', 'Via Abc', '53', '6053', 'Località 53', '1954-01-01'),
(999947, 'Nome52', 'Cognome52', 'Via Abc', '52', '6052', 'Località 52', '1955-01-01'),
(999948, 'Nome51', 'Cognome51', 'Via Abc', '51', '6051', 'Località 51', '1956-01-01'),
(999949, 'Nome50', 'Cognome50', 'Via Abc', '50', '6050', 'Località 50', '1957-01-01'),
(999950, 'Nome49', 'Cognome49', 'Via Abc', '49', '6049', 'Località 49', '1958-01-01'),
(999951, 'Nome48', 'Cognome48', 'Via Abc', '48', '6048', 'Località 48', '1959-01-01'),
(999952, 'Nome47', 'Cognome47', 'Via Abc', '47', '6047', 'Località 47', '1960-01-01'),
(999953, 'Nome46', 'Cognome46', 'Via Abc', '46', '6046', 'Località 46', '1961-01-01'),
(999954, 'Nome45', 'Cognome45', 'Via Abc', '45', '6045', 'Località 45', '1962-01-01'),
(999955, 'Nome44', 'Cognome44', 'Via Abc', '44', '6044', 'Località 44', '1963-01-01'),
(999956, 'Nome43', 'Cognome43', 'Via Abc', '43', '6043', 'Località 43', '1964-01-01'),
(999957, 'Nome42', 'Cognome42', 'Via Abc', '42', '6042', 'Località 42', '1965-01-01'),
(999958, 'Nome41', 'Cognome41', 'Via Abc', '41', '6041', 'Località 41', '1966-01-01'),
(999959, 'Nome40', 'Cognome40', 'Via Abc', '40', '6040', 'Località 40', '1967-01-01'),
(999960, 'Nome39', 'Cognome39', 'Via Abc', '39', '6039', 'Località 39', '1968-01-01'),
(999961, 'Nome38', 'Cognome38', 'Via Abc', '38', '6038', 'Località 38', '1969-01-01'),
(999962, 'Nome37', 'Cognome37', 'Via Abc', '37', '6037', 'Località 37', '1970-01-01'),
(999963, 'Nome36', 'Cognome36', 'Via Abc', '36', '6036', 'Località 36', '1971-01-01'),
(999964, 'Nome35', 'Cognome35', 'Via Abc', '35', '6035', 'Località 35', '1972-01-01'),
(999965, 'Nome34', 'Cognome34', 'Via Abc', '34', '6034', 'Località 34', '1973-01-01'),
(999966, 'Nome33', 'Cognome33', 'Via Abc', '33', '6033', 'Località 33', '1974-01-01'),
(999967, 'Nome32', 'Cognome32', 'Via Abc', '32', '6032', 'Località 32', '1975-01-01'),
(999968, 'Nome31', 'Cognome31', 'Via Abc', '31', '6031', 'Località 31', '1976-01-01'),
(999969, 'Nome30', 'Cognome30', 'Via Abc', '30', '6030', 'Località 30', '1977-01-01'),
(999970, 'Nome29', 'Cognome29', 'Via Abc', '29', '6029', 'Località 29', '1978-01-01'),
(999971, 'Nome28', 'Cognome28', 'Via Abc', '28', '6028', 'Località 28', '1979-01-01'),
(999972, 'Nome27', 'Cognome27', 'Via Abc', '27', '6027', 'Località 27', '1980-01-01'),
(999973, 'Nome26', 'Cognome26', 'Via Abc', '26', '6026', 'Località 26', '1981-01-01'),
(999974, 'Nome25', 'Cognome25', 'Via Abc', '25', '6025', 'Località 25', '1982-01-01'),
(999975, 'Nome24', 'Cognome24', 'Via Abc', '24', '6024', 'Località 24', '1983-01-01'),
(999976, 'Nome23', 'Cognome23', 'Via Abc', '23', '6023', 'Località 23', '1984-01-01'),
(999977, 'Nome22', 'Cognome22', 'Via Abc', '22', '6022', 'Località 22', '1985-01-01'),
(999978, 'Nome21', 'Cognome21', 'Via Abc', '21', '6021', 'Località 21', '1986-01-01'),
(999979, 'Nome20', 'Cognome20', 'Via Abc', '20', '6020', 'Località 20', '1987-01-01'),
(999980, 'Nome19', 'Cognome19', 'Via Abc', '19', '6019', 'Località 19', '1988-01-01'),
(999981, 'Nome18', 'Cognome18', 'Via Abc', '18', '6018', 'Località 18', '1989-01-01'),
(999982, 'Nome17', 'Cognome17', 'Via Abc', '17', '6017', 'Località 17', '1990-01-01'),
(999983, 'Nome16', 'Cognome16', 'Via Abc', '16', '6016', 'Località 16', '1991-01-01'),
(999984, 'Nome15', 'Cognome15', 'Via Abc', '15', '6015', 'Località 15', '1992-01-01'),
(999985, 'Nome14', 'Cognome14', 'Via Abc', '14', '6014', 'Località 14', '1993-01-01'),
(999986, 'Nome13', 'Cognome13', 'Via Abc', '13', '6013', 'Località 13', '1994-01-01'),
(999987, 'Nome12', 'Cognome12', 'Via Abc', '12', '6012', 'Località 12', '1995-01-01'),
(999988, 'Nome11', 'Cognome11', 'Via Abc', '11', '6011', 'Località 11', '1996-01-01'),
(999989, 'Nome10', 'Cognome10', 'Via Abc', '10', '6010', 'Località 10', '1997-01-01'),
(999990, 'Nome9', 'Cognome9', 'Via Abc', '9', '6009', 'Località 9', '1998-01-01'),
(999991, 'Nome8', 'Cognome8', 'Via Abc', '8', '6008', 'Località 8', '1999-01-01'),
(999992, 'Nome7', 'Cognome7', 'Via Abc', '7', '6007', 'Località 7', '2000-01-01'),
(999993, 'Nome6', 'Cognome6', 'Via Abc', '6', '6006', 'Località 6', '2001-01-01'),
(999994, 'Nome5', 'Cognome5', 'Via Abc', '5', '6005', 'Località 5', '2002-01-01'),
(999995, 'Nome4', 'Cognome4', 'Via Abc', '4', '6004', 'Località 4', '2003-01-01'),
(999996, 'Nome3', 'Cognome3', 'Via Abc', '3', '6003', 'Località 3', '2004-01-01'),
(999997, 'Nome2', 'Cognome2', 'Via Abc', '2', '6002', 'Località 2', '2005-01-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `licenze_has_societa`
--

CREATE TABLE `licenze_has_societa` (
  `Licenze_idLicenza` int(11) NOT NULL,
  `Societa_idSocieta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `licenze_has_societa`
--

INSERT INTO `licenze_has_societa` (`Licenze_idLicenza`, `Societa_idSocieta`) VALUES
(999798, 1),
(999799, 2),
(999800, 3),
(999801, 4),
(999802, 5),
(999803, 6),
(999804, 7),
(999805, 8),
(999806, 9),
(999807, 10),
(999808, 1),
(999809, 2),
(999810, 3),
(999811, 4),
(999812, 5),
(999813, 6),
(999814, 7),
(999815, 8),
(999816, 9),
(999817, 10),
(999818, 1),
(999819, 2),
(999820, 3),
(999821, 4),
(999822, 5),
(999823, 6),
(999824, 7),
(999825, 8),
(999826, 9),
(999827, 10),
(999828, 1),
(999829, 2),
(999830, 3),
(999831, 4),
(999832, 5),
(999833, 6),
(999834, 7),
(999835, 8),
(999836, 9),
(999837, 10),
(999838, 1),
(999839, 2),
(999840, 3),
(999841, 4),
(999842, 5),
(999843, 6),
(999844, 7),
(999845, 8),
(999846, 9),
(999847, 10),
(999848, 1),
(999849, 2),
(999850, 3),
(999851, 4),
(999852, 5),
(999853, 6),
(999854, 7),
(999855, 8),
(999856, 9),
(999857, 10),
(999858, 1),
(999859, 2),
(999860, 3),
(999861, 4),
(999862, 5),
(999863, 6),
(999864, 7),
(999865, 8),
(999866, 9),
(999867, 10),
(999868, 1),
(999869, 2),
(999870, 3),
(999871, 4),
(999872, 5),
(999873, 6),
(999874, 7),
(999875, 8),
(999876, 9),
(999877, 10),
(999878, 1),
(999879, 2),
(999880, 3),
(999881, 4),
(999882, 5),
(999883, 6),
(999884, 7),
(999885, 8),
(999886, 9),
(999887, 10),
(999888, 1),
(999889, 2),
(999890, 3),
(999891, 4),
(999892, 5),
(999893, 6),
(999894, 7),
(999895, 8),
(999896, 9),
(999897, 10),
(999898, 1),
(999899, 2),
(999900, 3),
(999901, 4),
(999902, 5),
(999903, 6),
(999904, 7),
(999905, 8),
(999906, 9),
(999907, 10),
(999908, 1),
(999909, 2),
(999910, 3),
(999911, 4),
(999912, 5),
(999913, 6),
(999914, 7),
(999915, 8),
(999916, 9),
(999917, 10),
(999918, 1),
(999919, 2),
(999920, 3),
(999921, 4),
(999922, 5),
(999923, 6),
(999924, 7),
(999925, 8),
(999926, 9),
(999927, 10),
(999928, 1),
(999929, 2),
(999930, 3),
(999931, 4),
(999932, 5),
(999933, 6),
(999934, 7),
(999935, 8),
(999936, 9),
(999937, 10),
(999938, 1),
(999939, 2),
(999940, 3),
(999941, 4),
(999942, 5),
(999943, 6),
(999944, 7),
(999945, 8),
(999946, 9),
(999947, 10),
(999948, 1),
(999949, 2),
(999950, 3),
(999951, 4),
(999952, 5),
(999953, 6),
(999954, 7),
(999955, 8),
(999956, 9),
(999957, 10),
(999958, 1),
(999959, 2),
(999960, 3),
(999961, 4),
(999962, 5),
(999963, 6),
(999964, 7),
(999965, 8),
(999966, 9),
(999967, 10),
(999968, 1),
(999969, 2),
(999970, 3),
(999971, 4),
(999972, 5),
(999973, 6),
(999974, 7),
(999975, 8),
(999976, 9),
(999977, 10),
(999978, 1),
(999979, 2),
(999980, 3),
(999981, 4),
(999982, 5),
(999983, 6),
(999984, 7),
(999985, 8),
(999986, 9),
(999987, 10),
(999988, 1),
(999989, 2),
(999990, 3),
(999991, 4),
(999992, 5),
(999993, 6),
(999994, 7),
(999995, 8),
(999996, 9),
(999997, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `opzionipremio`
--

CREATE TABLE `opzionipremio` (
  `Categoria_Serie_Premio_Serie_idSerie` int(11) NOT NULL,
  `Categoria_Serie_Premio_CategoriaArmi_idCategoria` int(11) NOT NULL,
  `Categoria_Serie_Premio_CategoriaEta_idCategoriaEta` int(11) NOT NULL,
  `Premi_idPremio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `opzionipremio`
--

INSERT INTO `opzionipremio` (`Categoria_Serie_Premio_Serie_idSerie`, `Categoria_Serie_Premio_CategoriaArmi_idCategoria`, `Categoria_Serie_Premio_CategoriaEta_idCategoriaEta`, `Premi_idPremio`) VALUES
(3, 1, 1, 1),
(3, 1, 1, 2),
(3, 1, 1, 3),
(3, 1, 2, 1),
(3, 1, 2, 2),
(3, 1, 2, 3),
(3, 1, 3, 1),
(3, 1, 3, 2),
(3, 1, 3, 3),
(3, 1, 4, 1),
(3, 1, 4, 2),
(3, 1, 4, 3),
(3, 1, 5, 1),
(3, 1, 5, 2),
(3, 1, 5, 3),
(3, 1, 6, 1),
(3, 1, 6, 2),
(3, 1, 6, 3),
(3, 2, 1, 1),
(3, 2, 1, 2),
(3, 2, 1, 3),
(3, 2, 2, 1),
(3, 2, 2, 2),
(3, 2, 2, 3),
(3, 2, 3, 1),
(3, 2, 3, 2),
(3, 2, 3, 3),
(3, 2, 4, 1),
(3, 2, 4, 2),
(3, 2, 4, 3),
(3, 2, 5, 1),
(3, 2, 5, 2),
(3, 2, 5, 3),
(3, 2, 6, 1),
(3, 2, 6, 2),
(3, 2, 6, 3),
(3, 3, 1, 1),
(3, 3, 1, 2),
(3, 3, 1, 3),
(3, 3, 2, 1),
(3, 3, 2, 2),
(3, 3, 2, 3),
(3, 3, 3, 1),
(3, 3, 3, 2),
(3, 3, 3, 3),
(3, 3, 4, 1),
(3, 3, 4, 2),
(3, 3, 4, 3),
(3, 3, 5, 1),
(3, 3, 5, 2),
(3, 3, 5, 3),
(3, 3, 6, 1),
(3, 3, 6, 2),
(3, 3, 6, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `premi`
--

CREATE TABLE `premi` (
  `idPremio` int(11) NOT NULL,
  `descrizione` varchar(45) DEFAULT NULL,
  `codice` varchar(45) DEFAULT NULL,
  `valore` double DEFAULT NULL,
  `costo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `premi`
--

INSERT INTO `premi` (`idPremio`, `descrizione`, `codice`, `valore`, `costo`) VALUES
(1, 'Corona', 'C', 10, 10),
(2, 'Carta Corona 10', 'CC10', 10, 10),
(3, 'Natura fr. 10.-', 'N10', 10, 10),
(4, 'Carta Corona 12', 'CC12', 12, 12),
(5, 'Contanti fr. 5.-', 'FR5', 5, 5),
(6, 'Contanti fr. 8.-', 'FR8', 8, 8),
(7, 'Contanti fr. 10.-', 'FR10', 10, 10),
(8, 'Contanti fr. 12.-', 'FR12', 12, 12),
(9, 'Contanti fr. 15.-', 'FR15', 15, 15),
(10, 'Contanti fr. 35.-', 'FR35', 35, 35),
(11, 'Contanti fr. 40.-', 'FR40', 40, 40),
(12, 'Contanti fr. 60.-', 'FR60', 60, 60),
(13, 'Contanti fr. 80.-', 'FR80', 80, 80),
(14, 'Contanti fr. 90.-', 'FR90', 90, 90),
(15, 'Contanti fr. 150.-', 'FR150', 150, 150);

-- --------------------------------------------------------

--
-- Struttura della tabella `serie`
--

CREATE TABLE `serie` (
  `idSerie` int(11) NOT NULL,
  `codice` int(11) DEFAULT NULL,
  `descrizione` varchar(45) DEFAULT NULL,
  `Bersagli_idBersaglio` int(11) NOT NULL,
  `noColpi` int(11) DEFAULT NULL,
  `fattore` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `serie`
--

INSERT INTO `serie` (`idSerie`, `codice`, `descrizione`, `Bersagli_idBersaglio`, `noColpi`, `fattore`) VALUES
(1, 0, 'Esercizio 1', 1, 4, 1),
(2, 0, 'Esercizio 2', 1, 4, 1),
(3, 1, 'Gruppo', 1, 10, 1),
(4, 2, 'Rimborso', 2, 6, 0.1);

-- --------------------------------------------------------

--
-- Struttura della tabella `societa`
--

CREATE TABLE `societa` (
  `idSocieta` int(11) NOT NULL,
  `codiceSocieta` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `via` varchar(255) DEFAULT NULL,
  `viaNo` varchar(45) DEFAULT NULL,
  `CAP` varchar(45) DEFAULT NULL,
  `luogo` varchar(45) DEFAULT NULL,
  `responsabile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `societa`
--

INSERT INTO `societa` (`idSocieta`, `codiceSocieta`, `nome`, `via`, `viaNo`, `CAP`, `luogo`, `responsabile`) VALUES
(1, '9.99.99.99', 'Societa test 1', 'Via abc', '1a', '6000', 'Località 1', 'Resp 1'),
(2, '9.99.99.98', 'Societa test 2', 'Via abc', '2', '6901', 'Località 2', 'Resp 2'),
(3, '9.99.99.97', 'Societa test 3', 'Via abc', '3', '6902', 'Località 3', 'Resp 3'),
(4, '9.99.99.96', 'Societa test 4', 'Via abc', '4', '6903', 'Località 4', 'Resp 4'),
(5, '9.99.99.95', 'Societa test 5', 'Via abc', '5', '6904', 'Località 5', 'Resp 5'),
(6, '9.99.99.94', 'Societa test 6', 'Via abc', '6', '6905', 'Località 6', 'Resp 6'),
(7, '9.99.99.93', 'Societa test 7', 'Via abc', '7', '6906', 'Località 7', 'Resp 7'),
(8, '9.99.99.92', 'Societa test 8', 'Via abc', '8', '6907', 'Località 8', 'Resp 8'),
(9, '9.99.99.91', 'Societa test 9', 'Via abc', '9', '6908', 'Località 9', 'Resp 9'),
(10, '9.99.99.90', 'Societa test 10', 'Via abc', '10', '6909', 'Località 10', 'Resp 10');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bersagli`
--
ALTER TABLE `bersagli`
  ADD PRIMARY KEY (`idBersaglio`);

--
-- Indici per le tabelle `categoriaarmi`
--
ALTER TABLE `categoriaarmi`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indici per le tabelle `categoriaeta`
--
ALTER TABLE `categoriaeta`
  ADD PRIMARY KEY (`idCategoriaEta`);

--
-- Indici per le tabelle `categoria_serie_premio`
--
ALTER TABLE `categoria_serie_premio`
  ADD PRIMARY KEY (`CategoriaArmi_idCategoria`,`CategoriaEta_idCategoriaEta`,`Serie_idSerie`),
  ADD KEY `fk_Categoria_Serie_Premio_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria`),
  ADD KEY `fk_Categoria_Serie_Premio_CategoriaEta1_idx` (`CategoriaEta_idCategoriaEta`),
  ADD KEY `fk_Categoria_Serie_Premio_Serie1_idx` (`Serie_idSerie`);

--
-- Indici per le tabelle `colpiti`
--
ALTER TABLE `colpiti`
  ADD PRIMARY KEY (`idColpito`),
  ADD KEY `fk_Risultati_Inscrizioni1_idx` (`Inscrizioni_Licenze_idLicenza`),
  ADD KEY `fk_Colpiti_Serie1_idx` (`Serie_idSerie`);

--
-- Indici per le tabelle `gruppi`
--
ALTER TABLE `gruppi`
  ADD PRIMARY KEY (`idGruppo`),
  ADD KEY `fk_Gruppi_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria`);

--
-- Indici per le tabelle `gruppi_has_inscrizioni`
--
ALTER TABLE `gruppi_has_inscrizioni`
  ADD PRIMARY KEY (`Gruppi_idGruppo`,`Inscrizioni_Licenze_idLicenza`),
  ADD KEY `fk_Gruppi_has_Inscrizioni_Inscrizioni1_idx` (`Inscrizioni_Licenze_idLicenza`),
  ADD KEY `fk_Gruppi_has_Inscrizioni_Gruppi1_idx` (`Gruppi_idGruppo`);

--
-- Indici per le tabelle `inscrizioni`
--
ALTER TABLE `inscrizioni`
  ADD PRIMARY KEY (`Licenze_idLicenza`),
  ADD KEY `fk_Inscrizioni_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria`),
  ADD KEY `fk_Inscrizioni_CategoriaEta1_idx` (`CategoriaEta_idCategoriaEta`),
  ADD KEY `fk_Inscrizioni_Societa1_idx` (`Societa_idSocieta`);

--
-- Indici per le tabelle `inscrizioni_has_serie`
--
ALTER TABLE `inscrizioni_has_serie`
  ADD PRIMARY KEY (`Inscrizioni_Licenze_idLicenza`,`Serie_idSerie`),
  ADD KEY `fk_Inscrizioni_has_Serie_Serie1_idx` (`Serie_idSerie`),
  ADD KEY `fk_Inscrizioni_has_Serie_Inscrizioni1_idx` (`Inscrizioni_Licenze_idLicenza`);

--
-- Indici per le tabelle `licenze`
--
ALTER TABLE `licenze`
  ADD PRIMARY KEY (`idLicenza`),
  ADD UNIQUE KEY `idLicenze_UNIQUE` (`idLicenza`);

--
-- Indici per le tabelle `licenze_has_societa`
--
ALTER TABLE `licenze_has_societa`
  ADD PRIMARY KEY (`Licenze_idLicenza`,`Societa_idSocieta`),
  ADD KEY `fk_Licenze_has_Societa_Societa1_idx` (`Societa_idSocieta`),
  ADD KEY `fk_Licenze_has_Societa_Licenze1_idx` (`Licenze_idLicenza`);

--
-- Indici per le tabelle `opzionipremio`
--
ALTER TABLE `opzionipremio`
  ADD PRIMARY KEY (`Categoria_Serie_Premio_Serie_idSerie`,`Categoria_Serie_Premio_CategoriaArmi_idCategoria`,`Categoria_Serie_Premio_CategoriaEta_idCategoriaEta`,`Premi_idPremio`),
  ADD KEY `fk_OpzioniPremio_Premi1_idx` (`Premi_idPremio`),
  ADD KEY `fk_OpzioniPremio_Categoria_Serie_Premio1_idx` (`Categoria_Serie_Premio_CategoriaArmi_idCategoria`,`Categoria_Serie_Premio_CategoriaEta_idCategoriaEta`,`Categoria_Serie_Premio_Serie_idSerie`);

--
-- Indici per le tabelle `premi`
--
ALTER TABLE `premi`
  ADD PRIMARY KEY (`idPremio`);

--
-- Indici per le tabelle `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`idSerie`),
  ADD KEY `fk_Serie_Bersagli1_idx` (`Bersagli_idBersaglio`);

--
-- Indici per le tabelle `societa`
--
ALTER TABLE `societa`
  ADD PRIMARY KEY (`idSocieta`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `categoria_serie_premio`
--
ALTER TABLE `categoria_serie_premio`
  ADD CONSTRAINT `fk_Categoria_Serie_Premio_CategoriaArmi1` FOREIGN KEY (`CategoriaArmi_idCategoria`) REFERENCES `categoriaarmi` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categoria_Serie_Premio_CategoriaEta1` FOREIGN KEY (`CategoriaEta_idCategoriaEta`) REFERENCES `categoriaeta` (`idCategoriaEta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categoria_Serie_Premio_Serie1` FOREIGN KEY (`Serie_idSerie`) REFERENCES `serie` (`idSerie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `colpiti`
--
ALTER TABLE `colpiti`
  ADD CONSTRAINT `fk_Colpiti_Serie1` FOREIGN KEY (`Serie_idSerie`) REFERENCES `serie` (`idSerie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Risultati_Inscrizioni1` FOREIGN KEY (`Inscrizioni_Licenze_idLicenza`) REFERENCES `inscrizioni` (`Licenze_idLicenza`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  ADD CONSTRAINT `fk_Gruppi_CategoriaArmi1` FOREIGN KEY (`CategoriaArmi_idCategoria`) REFERENCES `categoriaarmi` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `gruppi_has_inscrizioni`
--
ALTER TABLE `gruppi_has_inscrizioni`
  ADD CONSTRAINT `fk_Gruppi_has_Inscrizioni_Gruppi1` FOREIGN KEY (`Gruppi_idGruppo`) REFERENCES `gruppi` (`idGruppo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Gruppi_has_Inscrizioni_Inscrizioni1` FOREIGN KEY (`Inscrizioni_Licenze_idLicenza`) REFERENCES `inscrizioni` (`Licenze_idLicenza`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `inscrizioni`
--
ALTER TABLE `inscrizioni`
  ADD CONSTRAINT `fk_Inscrizioni_CategoriaArmi1` FOREIGN KEY (`CategoriaArmi_idCategoria`) REFERENCES `categoriaarmi` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscrizioni_CategoriaEta1` FOREIGN KEY (`CategoriaEta_idCategoriaEta`) REFERENCES `categoriaeta` (`idCategoriaEta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscrizioni_Licenze1` FOREIGN KEY (`Licenze_idLicenza`) REFERENCES `licenze` (`idLicenza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscrizioni_Societa1` FOREIGN KEY (`Societa_idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `inscrizioni_has_serie`
--
ALTER TABLE `inscrizioni_has_serie`
  ADD CONSTRAINT `fk_Inscrizioni_has_Serie_Inscrizioni1` FOREIGN KEY (`Inscrizioni_Licenze_idLicenza`) REFERENCES `inscrizioni` (`Licenze_idLicenza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscrizioni_has_Serie_Serie1` FOREIGN KEY (`Serie_idSerie`) REFERENCES `serie` (`idSerie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `licenze_has_societa`
--
ALTER TABLE `licenze_has_societa`
  ADD CONSTRAINT `fk_Licenze_has_Societa_Licenze1` FOREIGN KEY (`Licenze_idLicenza`) REFERENCES `licenze` (`idLicenza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Licenze_has_Societa_Societa1` FOREIGN KEY (`Societa_idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `opzionipremio`
--
ALTER TABLE `opzionipremio`
  ADD CONSTRAINT `fk_OpzioniPremio_Categoria_Serie_Premio1` FOREIGN KEY (`Categoria_Serie_Premio_CategoriaArmi_idCategoria`,`Categoria_Serie_Premio_CategoriaEta_idCategoriaEta`,`Categoria_Serie_Premio_Serie_idSerie`) REFERENCES `categoria_serie_premio` (`CategoriaArmi_idCategoria`, `CategoriaEta_idCategoriaEta`, `Serie_idSerie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OpzioniPremio_Premi1` FOREIGN KEY (`Premi_idPremio`) REFERENCES `premi` (`idPremio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `fk_Serie_Bersagli1` FOREIGN KEY (`Bersagli_idBersaglio`) REFERENCES `bersagli` (`idBersaglio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
