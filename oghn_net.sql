-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Şub 2015, 16:51:21
-- Sunucu sürümü: 5.6.13
-- PHP Sürümü: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `oghn_net`
--
CREATE DATABASE IF NOT EXISTS `oghn_net` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `oghn_net`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yarisma_cevaplar`
--

CREATE TABLE IF NOT EXISTS `yarisma_cevaplar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soru_id` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `cevap` varchar(1) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `puan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2073 ;

--
-- Tablo döküm verisi `yarisma_cevaplar`
--

INSERT INTO `yarisma_cevaplar` (`id`, `soru_id`, `grup_id`, `cevap`, `puan`) VALUES
(2068, 21, 2, 'D', 0),
(2069, 21, 1, 'A', 30),
(2070, 21, 3, 'C', 0),
(2071, 21, 4, 'A', 30),
(2072, 21, 5, 'B', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yarisma_grup`
--

CREATE TABLE IF NOT EXISTS `yarisma_grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `resim1` varchar(512) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `resim2` varchar(255) NOT NULL,
  `uye` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Tablo döküm verisi `yarisma_grup`
--

INSERT INTO `yarisma_grup` (`id`, `ad`, `resim1`, `resim2`, `uye`, `durum`) VALUES
(1, 'Grup Etlik', 'rsm/1.jpg', 'rsm/1k.jpg', '30,31,32,33', 0),
(30, 'Üzeyir', 'rsm/uzeyir.jpg', 'rsm/uzeyir_k.jpg', 'dadasaddas', 1),
(2, 'Grup Ayvalı', 'rsm/2.jpg', 'rsm/2k.jpg', '34,35,36,37,38', 0),
(3, 'Grup Pursaklar', 'rsm/3.jpg', 'rsm/2k.jpg', '39,40,41,42', 0),
(35, 'Kiracıoğlu', 'rsm/kiraci.jpg', 'rsm/kiraci_k.jpg', 'dadasaddas', 1),
(36, 'İsmail', 'rsm/ismail.jpg', 'rsm/ismail_k.jpg', 'dadasaddas', 1),
(37, 'Kılıçkaya', 'rsm/kilickaya.jpg', 'rsm/kilickaya_k.jpg', 'dadasaddas', 1),
(31, 'Emre', 'rsm/emre.jpg', 'rsm/emre_k.jpg', 'dadasaddas', 1),
(32, 'Emre', 'rsm/kadir.jpg', 'rsm/kadir_k.jpg', 'dadasaddas', 1),
(33, 'Uyanık', 'rsm/uyanik.jpg', 'rsm/uyanik_k.jpg', 'dadasaddas', 1),
(34, 'Taner', 'rsm/taner.jpg', 'rsm/taner_k.jpg', 'dadasaddas', 1),
(38, 'Hasan', 'rsm/hasan.jpg', 'rsm/hasan_k.jpg', 'dadasaddas', 1),
(39, 'Ramazan', 'rsm/ramazan.jpg', 'rsm/ramazan_k.jpg', 'dadasaddas', 1),
(40, 'Raşit', 'rsm/rasit.jpg', 'rsm/rasit_k.jpg', 'dadasaddas', 1),
(41, 'Mesut', 'rsm/mesut.jpg', 'rsm/mesut_k.jpg', 'dadasaddas', 1),
(42, 'Timur', 'rsm/timur.jpg', 'rsm/timur_k.jpg', 'dadasaddas', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yarisma_soru`
--

CREATE TABLE IF NOT EXISTS `yarisma_soru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `soruNo` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarih` datetime NOT NULL,
  `soru` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `a` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `b` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `c` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `d` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `cevap` varchar(1) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `onay` int(1) NOT NULL,
  `puan` int(11) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '0',
  `tur` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Tablo döküm verisi `yarisma_soru`
--

INSERT INTO `yarisma_soru` (`id`, `kategori_id`, `soruNo`, `user_id`, `tarih`, `soru`, `a`, `b`, `c`, `d`, `cevap`, `onay`, `puan`, `durum`, `tur`) VALUES
(99, 7, 0, 16, '2015-02-10 23:39:24', 'l.Önermenin doğru olması koşulu ile mantığa dayalı kanıt getirmek caizdir<br>ll.Tevil, kelamcıların ilk belirgin özellikleridir<br>lll.Kelamcılar metotlarında,kanıtlar getirirken mantıki esas yerine hissi esasa dayanmaktadır<br><br>Bu ifadelerden hangisi yada hangileri yanlıştır ?', 'Yanlız l', 'l ve lll', 'll ve lll', 'Yalnız lll', 'd', 1, 7, 2, 1),
(141, 7, 7, 1, '2015-02-11 08:58:38', 'Kelamcıların esinlendikleri felsefi fikir akımlarının eşleştirilmeleri hangisinde doğru verilmiştir?', 'Cebriye - Epikurusçular', 'Mutezile - Revakçılar', 'Ehli Sünnet - Revakçılar', 'Mutezile - Epikurusçular', 'd', 1, 8, 1, 1),
(103, 7, 1, 16, '2015-02-10 23:52:25', 'Müslümanlar arasında ortaya çıkan ilk Müslüman filozof kimdir ?', 'Farabi', 'Yakup el-Kindi', 'İbn-i Sina', 'Ebi Huzeyl el-Allaf', 'b', 1, 6, 2, 2),
(106, 7, 3, 22, '2015-02-10 23:50:04', 'Müslüman bir kimsenin islam akidesini benimsedigi halde asagıdaki davranış bozukluklarından hangisini  göstermesi kendisinde islami bir sahsiyetin olmadıgını gösterir ?', 'Mefhumlarını akidesi ile bağlamama gafletine düşmesi. ', 'Şeytanın ona musallat olmasıyla amellerinin bazılarında kalbi islam akidesine karşı katılaşıp akideye ters düşen işler yapması. ', 'İslam akidesini düşünme ve meyiller için esas almayıp bazı davranışlarında fıska düşmesi. ', 'Dinine bağlı müslümanın sıfatlarıyla çelişen yada Allahın emir ve yasaklarına zıt olan hareketler yapması. ', 'c', 1, 8, 2, 1),
(113, 7, 0, 12, '2015-02-10 23:15:28', 'kelamcılar metodlarına kanıtlar getirirken bu kanıtları neye dayandırdılar?', 'akıl - his', 'mantık-felsefe', 'his-filozoflar', 'mantık-his', 'b', 1, 7, 2, 1),
(114, 7, 2, 12, '2015-02-10 23:12:00', 'kaza ve kader meselesi ne zaman ve nasıl ortaya çıktı?', 'tabiin döneminde, devletin topraklarının genişlemesiyle', 'tebei tabiin döneminde felsefi akımlarla', 'hicri birinci yüzyılda, toprakların genişlemesiyle', 'hicri birinci yüzyılda mutezilenin görüşüyle ', 'd', 1, 8, 2, 2),
(116, 7, 4, 12, '2015-02-11 00:03:35', 'rızık sahibi yalnızca Allahtır. yeryüzündeki bütün rızkı Allah c.c tayin eder. Buna göre aşağıdakilerden hangisi doğrudur?', 'malı çalınan kişinin rızkı çalınmıştır.', 'kişi ne kadar çalışırsa rızkı o kadar artar.', 'kişi rızkı elde etmek için çalışması emredilmiştir.', 'rızkın çalışmadan elde edilmesi rızkın sebeplerindendir.', 'c', 1, 6, 2, 1),
(123, 7, 5, 11, '2015-02-10 23:10:35', 'İslami Şahsiyetin oluşturulmasında aşağıda verilen maddelerin kronolojik sıralması hangi şıkta doğru verilmiştir?\n1-islam akidesi üzerine düşünmek ve meyilleri oturtmak\n2-islam akidesini yerleştirmek\n3-itaatleri yerine getirmek ve fikirler ile kültürlenmeye çaba harcamak.\n', '1-3-2\n\n', '2-3-1\n', '2-1-3\n', '3-1-2', 'c', 1, 10, 2, 1),
(127, 7, 6, 22, '2015-02-10 23:36:22', 'Kur-an ayetlerinin toplanması ve kitap haline getirilmesi  işini yapan kimdir ?', 'Zeyd bin Sabit ', 'Hz Ebubekir', 'Hz Ömer', 'Hz Osman', 'a', 1, 6, 2, 1),
(158, 7, 0, 22, '2015-02-11 14:45:10', 'Aşağıdakilerden hangisi kelamcıların metodu ile müslüman felsefecilerin metodu arasındaki farklardan değildir ? ', 'Kelamcılar inandıkları iman kaideleriyle ilgili , felsefeciler ise soyut meseleleri araştırırlar.', 'Kelamcıların metodunun temelinde mutlak varlık , felsefecilerin metodunun temelinde ise hissedilebilen nesneler üzerinde araştırmalar vardır.', 'Kelamcılar akideyi savunmaya dayalı konularda , felsefeciler ise birtakım hakikatlerin kabullenilmesi ve ispatlanması konusunda uğramışlardır.', 'Kelamcıların araştırmaları islami araştırmalar, felsefecilerin araştırmaları ise islam dışı araştırmalardır.', 'b', 1, 6, 0, 1),
(171, 7, 1, 1, '2015-02-10 23:39:24', 'Aşağıdakilerin hangisi Mutezilenin felsefi görüşlerini ıspatlamak için temel aldığı unsurdur?', 'Allahın kudreti', 'Allahın her şeyi yaratması', 'Allahın adaleti', 'Allahın herşeyi önceden bilmesi', 'c', 1, 7, 2, 1),
(143, 7, 3, 1, '2015-02-11 09:07:00', 'Hangi eşleştirme yanlıştır?', 'Epikuroscular: insanın dilediğini yapmada  hür iradesi vardır.', 'Cebriye : İnsan, irade hürriyeti ve fiilleri yaratma gücü olmayan, mecburen hareket eden bir varlıktır.', 'Ehli sünnet : Kul iradesinde hür değildir, ancak fiillerini kendisi yaratır.', 'Mutezile : Kulların fiilleri, kendileri tarafından yaratılmıştır.', 'c', 1, 7, 0, 1),
(144, 7, 8, 1, '2015-02-11 10:39:43', 'Aşağıda verilenlerden hangisi yanlıştır?', 'Bir takım amellerinde ve davranışlarda bozukluklar bulunan bir kişide düşünme ve meyilleri için İslâm akidesini esas alsa da islam şahsiyeti oluşmaz', 'İslâm akidesine inanmakla birlikte, düşünme ve meyilleri için İslâm akidesini esas almayan bir kişide islami şahsiyet oluşmaz', 'Müslüman bir kişide davranış bozukluklarının varlığı onu İslâmî bir şahsiyet olmaktan çıkarmaz', 'Sözle veya amelle İslâm akidesine olan bağlılığını terk etmedikçe Müslüman İslâmdan çıkmaz', 'a', 1, 7, 0, 1),
(146, 7, 4, 1, '2015-02-11 11:16:41', 'Allahın sıfatları için söylenen görüşlerden hangisi yanlış verilmiştir?', 'Mutezile: Allah Subhenehû ve Tealanın zatı ve sıfatı tek bir şeydir', 'Ehli Sünnet: Sıfatlar, ne Allah Subhenehû ve Tealadır ne de Allah Subhenehû ve Tealadan başkadır', 'Mutezile: Allah âlimdir fakat Onun ilmi yoktur, O kadirdir fakat Onun gücü yoktur ', 'Mutezile: Allahın ilmi sınırsızdır. Vakıa ortaya çıkınca Allahın ilmide ortaya çıkar', 'd', 1, 9, 0, 2),
(148, 7, 0, 1, '2015-02-11 11:39:47', 'Aşağıdakilerden hangisi sünnetin vahyolunması yollarından değildir?', 'İlham', 'Cebrailin Rasulullahla konuşması', 'Rasullulahın peygamber olarak düşünmesiyle', 'Kalbe ikta', 'c', 1, 5, 0, 1),
(150, 7, 0, 23, '2015-02-11 13:00:46', 'Aşağıdakilerden hangisi Ömer Bin Abdulazizin emriyle ilk defa Hadis tenvin eden kişilerden biri değildir?                                                                                                       ', 'Muhammed ibn_u Muslim                                                                                                                                                                                                                               ', 'Sihab ez_zuhri                                                                                                                                                                                                                                              ', 'Müslim Bin el_Haccac ', 'ibn_u Ubeydullah', 'c', 1, 5, 0, 1),
(151, 7, 0, 23, '2015-02-11 13:02:55', 'Asağıdakilerden hangisi yanlıştır?                                                                                                                                                                                                            ', 'Açıklayıcı hükümler Kuranla gelmiştir                                                                                                                                                                                                              ', 'Kaza ve kaderin delili aklidir                                                                                                                                                                                                                            ', 'Sünnette Kuran gibi Şer-i delildir                                                                                                                                                                                                                       ', 'Sünneti terk edip Kuranla yetinmek açık bir küfürdür', 'a', 1, 6, 0, 1),
(154, 7, 0, 23, '2015-02-11 13:08:15', 'Aşağıdakilerden hangisi yanlıştır?', 'Sözle veye amelle İslam akidesini benimsemeyi terk etmedikçe Müslüman İslamdan çıkamaz', 'Müslümanda davranış bozukluklarının varlığı onu İslami bir şahsiyet sahibi olmaktan çıkarmaz', 'Kişi, sadece isyan ettiği amelinden dolayı asi müslüman sayılır ve o suçundan dolayı cezalandırılır ', 'Bir müslümanın akidesinin bozuk,davranışlarının İslami hükümlere uygun olması kişiyi İslamdan çıkarmaz  ', 'd', 1, 5, 0, 1),
(156, 7, 0, 23, '2015-02-11 13:10:37', 'Aşağıdakilerden hangisi yanlıştır?', 'Haber-i Ahad, sahih veya hasen olduğu zaman şerri hükümlerin tamamında delil olarak kullanılmaz', 'Haber-i Ahad ile delil getirmek haktır ', 'Haber-i Ahad şer-an sabittir bu konuda sahabenin icmai vardır  ', 'Haber-i Ahad ile amel etmek gerekir   ', 'a', 1, 6, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
