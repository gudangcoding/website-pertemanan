-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2017 at 04:27 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbjejaring`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `idkomentar` int(11) NOT NULL AUTO_INCREMENT,
  `komentar` varchar(200) DEFAULT NULL,
  `idstatus_fk` int(11) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `dibuat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idkomentar`),
  KEY `msg_id_fk` (`idstatus_fk`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idkomentar`, `komentar`, `idstatus_fk`, `uid_fk`, `ip`, `dibuat`) VALUES
(1, 'Nice Picture...', 3, 14, '127.0.0.1', 1329223344),
(3, 'Halo jug Akhmad Dharma...', 1, 12, '127.0.0.1', 1329223496),
(6, 'keren euy videonya..', 31, 2, '127.0.0.1', 1331642221),
(7, 'balas dong john', 33, 2, '127.0.0.1', 1331898117),
(8, 'Halo..', 32, 2, '127.0.0.1', 1332412919),
(12, 'halo juga andik..', 29, 14, '127.0.0.1', 1332495416),
(11, 'helo Jony...pa kabar bro...', 13, 14, '127.0.0.1', 1332494946),
(13, 'Baguss..', 3, 2, '127.0.0.1', 1334227716),
(14, 'Indah..', 3, 3, '127.0.0.1', 1334227758),
(15, 'Nice Movie...', 49, 3, '127.0.0.1', 1334230062),
(16, 'Kerenn...', 49, 13, '127.0.0.1', 1334401162),
(17, 'silahkan mbak..', 48, 13, '127.0.0.1', 1334401173),
(18, 'Animasinya oke banget, film yang menghibur', 53, 2, '127.0.0.1', 1346680707),
(19, 'Kereeeen ...', 53, 3, '127.0.0.1', 1346680815),
(20, 'Nice Movie', 53, 12, '127.0.0.1', 1346680974),
(21, 'Videonya oke juga', 47, 3, '127.0.0.1', 1346725375);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_teman`
--

CREATE TABLE IF NOT EXISTS `permintaan_teman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mem1` int(11) NOT NULL,
  `mem2` int(11) NOT NULL,
  `timedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `permintaan_teman`
--

INSERT INTO `permintaan_teman` (`id`, `mem1`, `mem2`, `timedate`) VALUES
(15, 14, 12, '2012-09-04 23:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL,
  `dibuka` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `id_pengirim`, `id_penerima`, `tgl`, `subject`, `pesan`, `dibuka`) VALUES
(3, 12, 3, '2012-01-11', 'sdsada', 'sdfsf', '0'),
(36, 2, 3, '2012-02-17', 'Re: hay rani...', 'apa kabar joni...????', '0'),
(6, 3, 2, '2012-01-16', 'hay ran..', '2 minggu lagi yakss..', '0'),
(30, 14, 1, '2012-01-18', 'whats up bro..', 'whats upp', '0'),
(8, 14, 2, '2012-01-16', 'Tes PM Ya Rani...', 'tes PM ya ran, ora iso iki..', '0'),
(9, 2, 14, '2012-01-16', 'Puisi nih..', 'Aku dan makna\n\nAku mengukir garis lengkung di bibirku\nIsyaratkan rona2 hati merah mudaâ€¦\nBegitu lembut membelai jantungku..\nSeperti ketika kehidupan berikan nyaman di waktuku..\n\nAku mengukir tanya di benakku..\nIsyaratkan pikir yang menuntut kepastian..\nMendesak hebat menyesakkan dadaku\nSeperti ketika awan gelap curahkan hujanâ€¦\n\nWahai kau sebuah makna..\nBerikan aku setitik terang tuk langkahkuâ€¦\nKetika ku ingin menggapaimu..\nDan berbisik..aku mencintaimu tanpa syarat', '0'),
(12, 3, 12, '2012-01-17', 'Re: sdsada', 'mark, sudah aku email ya....', '0'),
(26, 3, 1, '2012-01-18', 'Hayy dharma', 'tess2', '0'),
(27, 3, 1, '2012-01-18', 'inget gakk..???', 'halo hayy', '0'),
(28, 2, 1, '2012-01-18', 'ini Rani..!!', 'haloo ma,,gw rani', '0'),
(22, 12, 1, '2012-01-18', 'tes 4', 'tes 4', '0'),
(18, 12, 1, '2012-01-17', 'Hay.. salam kenal', 'tesss', '0'),
(31, 3, 1, '2012-01-18', 'gimana??', 'gimana sob...??', '0'),
(32, 1, 12, '2012-01-18', 'Re: Hay.. salam kenal', 'Salam kenal juga...!!!!', '0'),
(34, 2, 14, '2012-01-21', 'Ngabarin..!', 'Selamet siang bos,,ada kabar gembira nih..project jebil,tapi musti dikelarin 1 bulan,,ente sanggup gak bos????', '0'),
(35, 2, 14, '2012-02-07', 'Re: Tes PM Ya Rani...', 'wis iso ora son..??', '0'),
(37, 3, 12, '2012-02-23', 'Re: sdsada', 'halo...', '1'),
(38, 15, 2, '2012-03-23', 'Halo Rani.. Apa Kabar..??', 'Rani,,coba kirim private message ya...', '0'),
(39, 2, 15, '2012-03-23', 'Re: Halo Rani.. Apa Kabar..??', 'Baik android..private message berhasil masuk...siplah sob..', '0'),
(40, 3, 2, '2012-04-13', 'Halo rani..', 'Halo Rani ,,apa kabar..??', '0'),
(41, 2, 3, '2012-04-13', 'Re: Halo rani..', 'Baik Joni,,dirimu apa kabar...??', '1'),
(42, 2, 3, '2012-09-05', 'Halo Jony', 'Halo Jony, Apa kabar?', '1');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `id_dinding` int(11) NOT NULL,
  `foto` text NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `dibuat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idstatus`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`idstatus`, `status`, `uid_fk`, `id_dinding`, `foto`, `ip`, `dibuat`) VALUES
(1, 'Halo.. Mark...', 1, 12, 'undefined', '127.0.0.1', 1329222594),
(52, 'Haloo..nama saya Abimanyu...', 17, 17, 'undefined', '127.0.0.1', 1334509626),
(3, 'Pemandangan Indah...', 1, 1, '1329222703.jpg', '127.0.0.1', 1329222717),
(6, 'Happi Valentine Day...', 2, 2, '1329222840.jpg', '127.0.0.1', 1329222842),
(7, 'Apa Kabar semua...', 2, 2, 'undefined', '127.0.0.1', 1329222855),
(8, 'Hay jhon..numpang tulis status yak...', 2, 14, 'undefined', '127.0.0.1', 1329222875),
(10, 'Happy Monday Dharma...', 2, 1, 'undefined', '127.0.0.1', 1329222991),
(11, 'Please Share this link...', 3, 3, 'undefined', '127.0.0.1', 1329223021),
(12, 'Glasses on The Sands..', 3, 3, '1329223082.jpg', '127.0.0.1', 1329223094),
(13, 'Hay Jhon long time no see...', 3, 14, 'undefined', '127.0.0.1', 1329223123),
(15, 'Andik...', 3, 2, 'undefined', '127.0.0.1', 1329223184),
(16, 'Please Visit and buy all  the great books at htttp://www.bukulokomedia.com/', 14, 2, 'undefined', '127.0.0.1', 1329223291),
(17, 'Salam Kenal Dharma...', 14, 1, 'undefined', '127.0.0.1', 1329223325),
(18, 'Halo My Name is Mike...see this picture at http://flicker.com', 13, 13, '1329223413.jpg', '127.0.0.1', 1329223433),
(19, 'Please see my profile...', 12, 12, 'undefined', '127.0.0.1', 1329223512),
(20, 'My Picture...', 12, 12, '1329223755rberg1.jpg', '127.0.0.1', 1329223763),
(22, 'Halo..isi status di hari Kamis...', 1, 1, 'undefined', '127.0.0.1', 1329399279),
(23, 'Halo.dapatkan aplikasi android terbaru...', 15, 15, '1329399386id-market.jpg', '127.0.0.1', 1329399388),
(24, 'Cekk..', 15, 15, 'undefined', '127.0.0.1', 1329399500),
(25, 'Lenovo Think Pad For Student..Grab It Fast', 3, 3, '1329477263o-thinkpad-x130e-8.jpg', '127.0.0.1', 1329477281),
(32, 'https://www.youtube.com/watch?v=qnkuBUAwfe0', 2, 2, 'undefined', '127.0.0.1', 1331642100),
(28, 'watch this video clip:\n\nhttp://www.youtube.com/watch?v=1xICZAQ7GBQ', 2, 14, 'undefined', '127.0.0.1', 1331583983),
(29, 'halo jhon...', 2, 14, 'undefined', '127.0.0.1', 1331584034),
(33, 'Hay Johnnn', 2, 3, 'undefined', '127.0.0.1', 1331898106),
(31, 'watch this guys...http://vimeo.com/32678224', 3, 3, 'undefined', '127.0.0.1', 1331588586),
(36, 'Foto Kresna Abimanyu...', 14, 14, '1332495493.jpg', '127.0.0.1', 1332495513),
(35, 'Halo Andik apa kabar juga...', 14, 2, 'undefined', '127.0.0.1', 1332494735),
(37, 'Halo...', 2, 14, 'undefined', '127.0.0.1', 1332827430),
(38, 'Cekkk', 2, 2, 'undefined', '127.0.0.1', 1332827507),
(39, 'Halo.. Apa Kabar,,,???', 1, 2, 'undefined', '127.0.0.1', 1332827546),
(42, 'Halo...', 2, 2, 'undefined', '127.0.0.1', 1332828055),
(43, 'New Movie &quot;The Lorax&quot; 2012 March...', 2, 2, '13328288761440x900.jpg', '127.0.0.1', 1332828896),
(45, 'Lorax Movie', 2, 2, '1332829668TPIB_00007.jpg', '127.0.0.1', 1332829675),
(47, 'http://www.youtube.com/watch?v=KQ6zr6kCPj8', 15, 15, 'undefined', '127.0.0.1', 1332831071),
(48, 'Tes Update status dulu yah....!\n', 2, 2, 'undefined', '127.0.0.1', 1334215271),
(49, 'Film The Lorax , Maret 2012', 2, 2, '133421535829757440x900.jpg', '127.0.0.1', 1334215961),
(50, 'Halo semua...', 3, 3, 'undefined', '127.0.0.1', 1334398357),
(51, 'Update status di hari sabtu..', 13, 13, 'undefined', '127.0.0.1', 1334401154),
(53, 'Film The Lorax, Maret 2012', 14, 14, '1346645578.jpg', '127.0.0.1', 1346645714);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(70) NOT NULL,
  `gambar_profil` varchar(200) NOT NULL,
  `gambar_profil_kecil` varchar(200) NOT NULL,
  `array_teman` varchar(200) NOT NULL,
  `permintaan_teman` int(10) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `password`, `nama`, `tgl_lahir`, `gender`, `email`, `gambar_profil`, `gambar_profil_kecil`, `array_teman`, `permintaan_teman`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Zein El Barak', '0000-00-00', 'lakia-Laki', 'zein@gmail.com', '1484186535127161229.jpg', 'profile1.jpg', '12,3,14,15,2,13', 0),
(2, 'b9f81618db3b0d7a8be8fd904cca8b6a', 'Rani Ayu', '1987-09-03', 'Perempuan', 'rani@abc.com', '13205495919_1798383818871_1818047691_1218862_486665453_n.jpg', 'profile2.jpg', '3,1,14,15,13', 0),
(3, '1281d0ac7a74eb91550ff52a02862cda', 'Jony Van Heulsing', '1988-09-03', 'Laki-Laki', 'joni@abc.com', '13205484648_1797192149080_1818047691_1218333_1809640032_n.jpg', 'profile3.jpg', '12,2,14,1', 0),
(12, 'ea82410c7a9991816b5eeeebe195e20a', 'Mark Tremonti', '1989-09-03', 'Laki-Laki', 'mark@abc.com', '1326808679rberg1.jpg', 'profile12.jpg', '3,1,15', 0),
(13, '9ba0009aa81e794e628a04b51eaf7d7f', 'Mike Mangini', '0000-00-00', '', 'mike@abc.com', '1334400378.jpg', 'profile13.jpg', '1,2', 0),
(14, '527bd5b5d689e2c32ae974c6229ff785', 'John Petruci', '1990-09-04', 'Laki-Laki', 'john@abc.com', '1346716280n.jpg', 'profile14.jpg', '3,1,2', 0),
(15, 'c31b32364ce19ca8fcd150a417ecce58', 'Android Addict', '1989-09-04', 'Laki-Laki', 'android@abc.com', '1346773114.jpg', 'profile15.jpg', '1,2,12', 0),
(17, 'ae2b1fca515949e5d54fb22b8ed95575', 'Kresna Abimanyu', '2012-01-19', 'Laki-Laki', 'abim@abc.com', '1334509584301-20120216-1118-r.jpg', 'profile17.jpg', '', 0),
(19, 'c85b5738485dae80d7d85efe9b3f2efc', 'Akhmad Dharma', '1987-01-10', 'Laki-Laki', 'akhmad_dharma@gmail.com', '', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
