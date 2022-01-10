-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 12:05 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emading`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kode_admin` char(5) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `email_admin` varchar(35) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `status_admin` enum('Master','Branch') NOT NULL DEFAULT 'Branch',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_admin`, `nama_admin`, `email_admin`, `password_admin`, `status_admin`, `created_at`, `updated_at`) VALUES
('ADM01', 'Admin Master', 'AdminMaster@gmail.com', '$2y$10$mKv0gcOosydD8OFaqq.OdeuDhB36fWP/itJFe68/eTos1lAOhP3HW', 'Master', NULL, '2021-07-04 22:41:14'),
('ADM02', 'Kakashi Hatake', 'kakashi@gmail.com', '$2y$10$IPexJJdJk1tnZxKVuVISEeHDpJ/PjrKI0hglVk3cCf3nYfsdKUdOu', 'Master', '2021-07-11 13:19:37', '2021-07-11 16:17:00'),
('ADM03', 'Sakata Gintoki', 'sakatagin@gmail.com', '$2y$10$reUAaLUs3Y4N9oFHOvegqO00ADSv7KoNKcHv98zXA3XWDujaWlibS', 'Branch', '2021-07-11 16:09:19', '2021-07-11 16:16:26'),
('ADM04', 'Gojou Satoru', 'gojotoru@gmail.com', '$2y$10$FVHN/xSEOi.pR30ox7zyTeqOvUOHWTDMYG5jAIbO9W5CDH/ErNbou', 'Branch', '2021-07-11 16:25:06', '2021-07-17 02:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `karya_tulis`
--

CREATE TABLE `karya_tulis` (
  `id_karya_tulis` int(4) NOT NULL,
  `judul_karya` varchar(100) NOT NULL,
  `gambar_karya` varchar(40) NOT NULL DEFAULT 'karya.png',
  `isi_karya` text NOT NULL,
  `tag` varchar(30) NOT NULL,
  `kode_user` char(6) NOT NULL,
  `kode_admin` char(5) NOT NULL,
  `direkomendasikan` tinyint(1) NOT NULL DEFAULT 0,
  `terkonfirmasi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karya_tulis`
--

INSERT INTO `karya_tulis` (`id_karya_tulis`, `judul_karya`, `gambar_karya`, `isi_karya`, `tag`, `kode_user`, `kode_admin`, `direkomendasikan`, `terkonfirmasi`, `created_at`, `updated_at`) VALUES
(4, 'Kasus Korupsi Yang Dilakukan Presiden Ke-10 Filipina', '1626043326_1796fcc2573b16878ea0.jpg', '<p>Jika di Indonesia kita memiliki Suharto, seorang Presiden yang melakukan korupsi terbesar di Indonesia bahkan dunia. Filipina pun memiliki seorang koruptor yang serupa, sama-sama Presiden dan sama-sama memimpin lebih dari dua dekade, yaitu Ferdinand Edraline Marcos. Filipina dipimpin di bawah kepemimpinan pemerintahan otoriter Marcos terhitung sejak tanggal 30 Desember 1965 sampai dengan tanggal 25 Februari 1986, atau 21 tahun lamanya (Hadi, 2019).</p>\r\n\r\n<p>Menurut Kawilarang &ldquo;Dengan UU Darurat, Marcos hendak memperpanjang masa jabatan presidennya yang seharusnya mesti berakhir pada 1975&rdquo; (Hadi, 2019). Ada beberapa penyalahgunaan kekuasaan yang dilakukan Marcos pada masa jabatannya (Hadi, 2019), yaitu:</p>\r\n\r\n<ol>\r\n	<li>Korupsi yang merajalela dalam pemerintahan. Diduga uang yang telah digelapkan oleh Marcos sebanyak 5-10 milyar dollar yang jika dikonversikan ke dalam nilai rupiah saat ini yaitu sekitar 72-145 triliun rupiah, ini membuatnya menjadi pemimpin dengan kasus korupsi terbesar ke-2 di dunia setelah Suharto (Sandbrook, 2016).</li>\r\n	<li>Militer memainkan peran kunci dalam pemerintahan Marcos</li>\r\n	<li>Terjadinya penangkapan, pembunuhan, dan penculikan terhadap pihak oposisi yang dicurigai mengancam pemerintahan. Sejak tahun 1972 di mana UU Darurat Militer dan Darurat Perang diberlakukan sampai dengan kejatuhan Marcos tahun 1986 diperkirakan 3000 orang hilang dan dibunuh.</li>\r\n	<li>Pemerintahan Marcos didukung oleh Amerika Serikat yang saat itu di bawah kepemimpinan Ronal Reagan. Ini terjadi karena Marcos mengijinkan pembangunan dua pangkalan militer Amerika Serikat, yakni Pangkalan Udara di Clark dan Pangkalan Angkatan Laut di Teluk Subic. Marcos juga menerima US$ 900 juta sebagai bentuk kompensasi.</li>\r\n	<li>Filipina mengalami krisis luar biasa sebagai akibat korupsi dan pengelolaan pemerintahan yang buruk. Berdasarkan Kawilarang akibat atau dampak yang ditimbulkan (Hadi, 2019), di antaranya:</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>Bank-bank asing mulai tutup dan menolak memberikan pinjaman.</li>\r\n	<li>Larinya anggaran sebesar US$ 200 juta untuk penanaman modal hanya dalam jangka satu bulan.</li>\r\n	<li>Terjadinya defisit anggaran negara sekitar US$ 600 juta &ndash; US$ 800 juta.</li>\r\n	<li>Pemerintah memiliki hutang sebesar US$ 13 milyar untuk proyek jangka panjang dan US$ 4,5 milyar untuk proyek jangka pendek.</li>\r\n	<li>Ekonomi negara mengalami kelumpuhan secara keseluruhan.</li>\r\n</ol>\r\n\r\n<p>Tidak hanya lima poin di atas, selama 21 tahun Marcos berkuasa, Filipina menjadi salah satu negara dengan hutang terbesar di Asia yang bertambah dari $360 juta (tahun 1962) menjadi $28 milyar (tahun 1982), upah turun sekitar sepertiga, dan angka kemiskinan meningkat hampir dua kali lipat dari 18 juta menjadi 35 juta (Sandbrook, 2016).</p>\r\n\r\n<p>Marcos ditumbangkan dengan kekuatan rakyat yang kemudian peristiwa itu dikenal sebagai Revolusi EDSA (Epifano de los Santos Avenue, sebuah jalan di Metro Manila) (Abdillah, 2018). Adapun hukuman yang diberikan kepada Marcos adalah diasingkan ke Honolulu sampai akhir hayatnya (Hadi, 2019). Seluruh keluarga Marcos dijemput dengan helikopter oleh tentara Amerika atas perintah Reagan pada tanggal 25 Februari 1986, tanpa membawa apa-apa meninggalkan ribuan barang mewah yang saat ini oleh rakyat Filipina dimasukkan ke dalam Museum (Hadi, 2019).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sumber:</p>\r\n\r\n<p>Abdillah, F. (2018). <em>Latar Belakang Lahirnya Revolusi EDSA, Gerakan People Power Filipina | Sejarah Kelas 12</em>. Ruangguru.Com. https://www.ruangguru.com/blog/sejarah-kelas-12-latar-belakang-lahirnya-revolusi-edsa-gerakan-people-power-filipina</p>\r\n\r\n<p>Hadi, K. (2019). Perbandingan Penegakan Demokrasi di Indonesia Pasca-Rezim Suharto dan Filipina Pasca-Rezim Marcos. <em>Insignia: Journal of International Relations</em>, <em>6</em>(1), 13&ndash;29. https://doi.org/10.20884/1.ins.2019.6.1.1246</p>\r\n\r\n<p>Sandbrook, J. (2016). <em>The 10 Most Corrupt World Leaders of Recent History</em>. Integritas360.Org. https://integritas360.org/2016/07/10-most-corrupt-world-leaders/</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Pengetahuan Umum', 'USR001', 'ADM02', 1, 1, '2021-07-11 15:37:54', '2021-07-11 15:42:06'),
(6, 'Pentingnya Pajak Bagi Pembangunan Suatu Negara', '1626043664_98a24976f4cfd5519f46.jpg', '<p>Pajak merupakan suatu hal yang penting dalam kehidupan manusia dalam bernegara, karena pajak merupakan salah satu sumber pemasukan negara untuk bisa melakukan pembangunan. Pada tahun 2019, sebanyak 82,50% dana APBN bersumber dari pajak (Jaya, 2019). Dana ini lah yang digunakan oleh Pemerintah dalam segala upaya memajukan dan membangun negeri serta mensejahterakan rakyat.</p>\r\n\r\n<p>Menurut Rochmat Sumitro &ldquo;Pajak adalah iuran rakyat pada kas Negara berdasarkan Undang-Undang (yang dapat dipaksakan) dengan tidak mendapat jasa timbal (kontra prestasi) yang langsung dapat ditunjukkan dan yang digunakan untuk membayar pengeluaran umum&rdquo; (Rukmini, 2016). Berdasarkan definisi pajak tersebut, ada beberapa poin yang perlu diperhatikan, yaitu &ldquo;dapat dipaksakan&rdquo;, &ldquo;tidak mendapat jasa timbal yang langsung&rdquo;, dan &ldquo;digunakan untuk membayar pengeluaran umum&rdquo;.</p>\r\n\r\n<p>Poin pertama yaitu &ldquo;dapat dipaksakan&rdquo;, memperingatkan bahwa membayar pajak adalah sesuatu yang wajib dilakukan atau mutlak hukumnya sehingga dapat dipaksakan. Jika seseorang tidak membayar pajak, maka negara memiliki hak untuk memberikan hukuman atas kelalaiannya tersebut.</p>\r\n\r\n<p>Poin kedua yaitu &ldquo;tidak mendapat jasa timbal yang langsung&rdquo;, hanya karena seorang individu rajin atau aktif dalam membayar pajak, bukan berarti dia memiliki hak untuk menuntut atau meminta fasilitas khusus dari negara. Karena pajak tidak tidak diperuntukan bagi individu melainkan bagi masyarakat umum. Sehingga tidak benar menuntut jasa timbal atau imbalan secara langsung.</p>\r\n\r\n<p>Sedangkan poin ketiga yaitu &ldquo;digunakan untuk membayar pengeluaran umum&rdquo;, memiliki inti yang sama dengan poin kedua, bahwa pajak digunakan untuk kepentingan masyarakat umum bukan pribadi/individu atau kelompok. Dana dari proyek-proyek pemerintah itu berasal dari APBN (Anggaran Pendapatan dan Belanja Negara) yang sebagian besar berasal dari pajak.</p>\r\n\r\n<p>Terlepas dari kasus korupsi yang sering dilakukan, membayar pajak adalah hal penting dilakukan, karena dengan masyarakat aktif membayar pajak, maka masyarakat tersebut telah membantu Pemerintah dalam memajukan dan membangun negeri serta menjaga kesejahteraan bersama.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sumber:</p>\r\n\r\n<p>Jaya, I. M. L. M. (2019). Realita Kesadaran Pajak di Kalangan Generasi Muda (Mahasiswa) Yogyakarta dan Surabaya. <em>JIA (Jurnal Ilmiah Akuntansi)</em>, <em>4</em>(2), 161&ndash;183.</p>\r\n\r\n<p>Rukmini, B. S. (2016). Peranan Pajak Dalam Meningkatkan Pembangunan di Kabupaten Trenggalek. <em>Dewantara</em>, <em>2</em>(2), 204&ndash;219.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Pengetahuan Umum', 'USR001', 'ADM02', 1, 1, '2021-07-11 15:47:44', '2021-07-11 15:47:44'),
(7, '5 Anime Series Terbaik Menurutku', '1626221512_d1b0d66935259811767e.jpg', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Officiis&nbsp;quas&nbsp;ducimus&nbsp;dolorum&nbsp;incidunt&nbsp;atque&nbsp;dolore,&nbsp;neque&nbsp;modi&nbsp;eveniet&nbsp;non&nbsp;eligendi&nbsp;vel&nbsp;nihil&nbsp;nam&nbsp;natus&nbsp;iure&nbsp;dicta&nbsp;necessitatibus&nbsp;explicabo?&nbsp;Incidunt&nbsp;quasi&nbsp;velit,&nbsp;id&nbsp;ad,&nbsp;ut&nbsp;dolorum&nbsp;quam&nbsp;consequatur&nbsp;ea&nbsp;repellendus&nbsp;ipsam&nbsp;nobis&nbsp;officiis&nbsp;dolorem.&nbsp;Hic&nbsp;soluta&nbsp;saepe&nbsp;ratione,&nbsp;pariatur&nbsp;fugit&nbsp;eos&nbsp;inventore&nbsp;eveniet,&nbsp;ad&nbsp;vero&nbsp;aperiam&nbsp;reiciendis&nbsp;voluptas&nbsp;nulla&nbsp;possimus&nbsp;cumque&nbsp;eaque&nbsp;quos&nbsp;modi&nbsp;corporis&nbsp;eum?&nbsp;Nam,&nbsp;ratione&nbsp;vitae.&nbsp;Veniam&nbsp;officiis&nbsp;corrupti&nbsp;illum&nbsp;atque&nbsp;dolorem&nbsp;porro&nbsp;provident&nbsp;et!&nbsp;Nostrum&nbsp;nulla&nbsp;rem&nbsp;pariatur&nbsp;illum,&nbsp;corporis&nbsp;laboriosam&nbsp;et&nbsp;dolorem&nbsp;labore&nbsp;repudiandae&nbsp;fugiat&nbsp;eaque&nbsp;sequi&nbsp;quasi&nbsp;nesciunt&nbsp;non&nbsp;sed&nbsp;incidunt&nbsp;quo&nbsp;vel&nbsp;dignissimos&nbsp;quam!</p>\r\n', 'Anime', 'USR009', 'ADM01', 0, 0, '2021-07-13 17:11:09', '2021-07-13 17:11:52'),
(8, 'Kisah Cinta Antara Si Pengidap Social Anxiety dan Si Tunarungu', '1626222987_6a34eadc01cbae15be40.jpg', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit,&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Quia&nbsp;delectus&nbsp;beatae&nbsp;laborum&nbsp;eos&nbsp;recusandae,&nbsp;pariatur&nbsp;omnis&nbsp;ut&nbsp;provident&nbsp;sit&nbsp;corporis&nbsp;explicabo&nbsp;sequi&nbsp;voluptatibus&nbsp;veniam&nbsp;laboriosam&nbsp;quo,&nbsp;obcaecati&nbsp;doloremque&nbsp;eaque&nbsp;maxime&nbsp;quas&nbsp;rerum&nbsp;optio?&nbsp;Maxime&nbsp;iste,&nbsp;consectetur&nbsp;molestias&nbsp;aspernatur&nbsp;id,&nbsp;animi&nbsp;expedita&nbsp;fugit&nbsp;voluptatem&nbsp;quasi&nbsp;esse&nbsp;quisquam&nbsp;commodi&nbsp;possimus&nbsp;quibusdam?&nbsp;Repellat&nbsp;vel&nbsp;pariatur&nbsp;ut&nbsp;ab&nbsp;facere&nbsp;sapiente,&nbsp;debitis&nbsp;alias&nbsp;eaque&nbsp;asperiores&nbsp;quis&nbsp;fugit&nbsp;rerum&nbsp;ipsam&nbsp;dolore&nbsp;reiciendis&nbsp;neque,&nbsp;officiis&nbsp;magni&nbsp;delectus&nbsp;recusandae&nbsp;enim&nbsp;sint&nbsp;eius&nbsp;minima!&nbsp;Quisquam&nbsp;tempora&nbsp;ipsum,&nbsp;suscipit&nbsp;quae&nbsp;alias&nbsp;ex&nbsp;nesciunt?&nbsp;Totam&nbsp;dicta&nbsp;nisi&nbsp;error&nbsp;a&nbsp;ratione&nbsp;minima&nbsp;aperiam,&nbsp;expedita&nbsp;repudiandae&nbsp;omnis&nbsp;odio&nbsp;fugit&nbsp;velit&nbsp;cupiditate&nbsp;eos&nbsp;accusamus&nbsp;illo&nbsp;aut&nbsp;officiis&nbsp;unde&nbsp;saepe!&nbsp;Debitis&nbsp;deserunt&nbsp;asperiores&nbsp;mollitia&nbsp;iusto&nbsp;corporis,&nbsp;eos&nbsp;numquam&nbsp;ab&nbsp;esse&nbsp;nihil&nbsp;ducimus&nbsp;aliquid&nbsp;facere&nbsp;ullam&nbsp;laudantium&nbsp;pariatur&nbsp;neque&nbsp;architecto&nbsp;nam&nbsp;earum&nbsp;laborum&nbsp;nesciunt.&nbsp;Quo&nbsp;tenetur&nbsp;incidunt&nbsp;quod.&nbsp;Voluptate&nbsp;optio&nbsp;incidunt,&nbsp;veniam&nbsp;quas&nbsp;eius&nbsp;hic&nbsp;nihil.&nbsp;Nostrum&nbsp;ipsa,&nbsp;obcaecati&nbsp;tempora&nbsp;eum&nbsp;reiciendis&nbsp;voluptas,&nbsp;quibusdam&nbsp;aut&nbsp;delectus&nbsp;maxime&nbsp;laudantium&nbsp;earum&nbsp;magnam&nbsp;dolore&nbsp;perspiciatis&nbsp;quae&nbsp;quam&nbsp;cupiditate&nbsp;accusantium.&nbsp;Natus&nbsp;officiis&nbsp;ad&nbsp;earum&nbsp;odio&nbsp;consectetur&nbsp;sit&nbsp;sequi,&nbsp;nulla&nbsp;hic&nbsp;veniam,&nbsp;quibusdam&nbsp;mollitia,&nbsp;saepe&nbsp;maxime&nbsp;accusamus&nbsp;exercitationem.&nbsp;Unde&nbsp;commodi&nbsp;illum&nbsp;ipsam&nbsp;nesciunt&nbsp;reprehenderit&nbsp;recusandae&nbsp;illo&nbsp;consectetur,&nbsp;iusto&nbsp;maiores&nbsp;cum&nbsp;nam&nbsp;laborum&nbsp;architecto&nbsp;necessitatibus&nbsp;quasi&nbsp;minus&nbsp;molestias&nbsp;eum.&nbsp;At,&nbsp;fugiat&nbsp;iste&nbsp;beatae&nbsp;vel,&nbsp;blanditiis&nbsp;dolorem&nbsp;tempora&nbsp;aliquam&nbsp;cupiditate&nbsp;minima&nbsp;quia&nbsp;unde&nbsp;nam&nbsp;eaque&nbsp;est&nbsp;dignissimos.&nbsp;Iure&nbsp;ipsum&nbsp;consectetur,&nbsp;velit&nbsp;non&nbsp;dignissimos,&nbsp;nostrum&nbsp;atque&nbsp;voluptatum,&nbsp;quod&nbsp;quis&nbsp;deleniti&nbsp;dicta.&nbsp;Illo&nbsp;mollitia&nbsp;veritatis,&nbsp;non,&nbsp;cupiditate&nbsp;quidem&nbsp;sequi&nbsp;ipsa&nbsp;eveniet&nbsp;rerum&nbsp;sunt&nbsp;porro&nbsp;amet&nbsp;labore&nbsp;magni&nbsp;facere,&nbsp;necessitatibus&nbsp;modi&nbsp;officiis.&nbsp;Perspiciatis&nbsp;cumque&nbsp;doloribus&nbsp;accusamus&nbsp;nesciunt&nbsp;optio&nbsp;necessitatibus&nbsp;modi&nbsp;officia&nbsp;laudantium&nbsp;maxime&nbsp;est,&nbsp;deserunt&nbsp;similique&nbsp;rerum,&nbsp;illo&nbsp;voluptatem&nbsp;molestiae&nbsp;debitis&nbsp;natus&nbsp;dolorem?&nbsp;Vitae&nbsp;totam&nbsp;illo&nbsp;velit&nbsp;incidunt&nbsp;eligendi&nbsp;impedit&nbsp;iusto,&nbsp;aspernatur&nbsp;dolore&nbsp;doloribus&nbsp;eum&nbsp;tenetur&nbsp;in&nbsp;fugit&nbsp;provident&nbsp;molestias&nbsp;quisquam,&nbsp;perspiciatis&nbsp;pariatur&nbsp;amet&nbsp;deleniti.&nbsp;Ipsam&nbsp;reprehenderit&nbsp;accusamus&nbsp;minus&nbsp;eaque,&nbsp;harum&nbsp;molestiae&nbsp;voluptatum&nbsp;consequuntur&nbsp;dolor&nbsp;atque.</p>\r\n', 'Anime', 'USR009', 'ADM01', 0, 0, '2021-07-13 17:36:27', '2021-07-13 17:38:08'),
(9, 'Grave Of The Fireflies, Anime Yang Bisa Membuatmu Menangis', '1626224029_67444b64ebe0dd01e4bf.jpg', '<p>Grave of The Fireflies&nbsp;(Hotaru no Haka) sering mendapatkan julukan sebagai anime tersedih sepanjang masa. Ini tidaklah berlebihan, karena jika kamu menonton anime ini, kamu akan menangis dibuatnya.&nbsp;</p>\r\n\r\n<p>Anime ini berlatar belakangkan perang dunia ke-2, di mana kala itu Jepang diluluhlantakkan oleh ratusan ribu&nbsp;bom atom, membuat sepasang kakak beradik harus kehilangan orangtuanya. Mereka pun dirawat oleh saudara dari keluarga namun mendapatkan perlakuan yang kurang baik yang membuat mereka memilih untuk kabur dan tinggal sendiri. Mereka memutuskan untuk tinggal di sebuah goa didekat danau. Seita dan Setsuko adalah nama dari sepasang kakak beradik tersebut.</p>\r\n\r\n<p>Dalam anime ini, kita akan disuguhkan dengan banyak sekali adegan yang menyayat hati dan membuat air mata mengalir. Ada banyak pesan moral dalam anime ini&nbsp;yang dapat membuatmu bersyukur atas kehidupan yang kamu miliki.&nbsp;</p>\r\n\r\n<p>Penulis tidak akan menjabarkan anime ini secara merinci karena tidak ingin membuat pembaca terkena spoiler. Bukankah tidak seru kalau menonton film namun sudah tahu arah ceritanya. Jika kalian penasaran, silahkan cari dan tonton sendiri! hehe... :D</p>\r\n', 'Anime', 'USR009', 'ADM01', 1, 1, '2021-07-13 17:53:49', '2021-07-13 21:13:59'),
(10, 'Fakta Tentang BTS Yang Wajib Diketahui Army', '1626236922_c2a2c9a24db3d222a355.jpg', '<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur,&nbsp;adipisicing&nbsp;elit.&nbsp;Ratione&nbsp;suscipit&nbsp;provident&nbsp;sit&nbsp;sed&nbsp;magnam&nbsp;dicta&nbsp;laborum&nbsp;maxime&nbsp;numquam&nbsp;ipsa&nbsp;quis,&nbsp;dignissimos&nbsp;sapiente&nbsp;iste&nbsp;facere&nbsp;quod&nbsp;quaerat,&nbsp;enim&nbsp;deleniti&nbsp;mollitia&nbsp;voluptatem&nbsp;assumenda&nbsp;laboriosam&nbsp;temporibus!&nbsp;Et&nbsp;similique&nbsp;sapiente&nbsp;provident&nbsp;officia&nbsp;numquam.&nbsp;Velit,&nbsp;quos&nbsp;temporibus?&nbsp;Sed&nbsp;iure&nbsp;quam&nbsp;voluptate&nbsp;saepe&nbsp;maxime&nbsp;esse&nbsp;sit&nbsp;molestiae&nbsp;dolore&nbsp;suscipit&nbsp;quis&nbsp;animi&nbsp;incidunt&nbsp;odit&nbsp;dolorem,&nbsp;rem&nbsp;porro.&nbsp;Dolorum&nbsp;illo,&nbsp;quos&nbsp;explicabo&nbsp;rem&nbsp;vel&nbsp;quia&nbsp;praesentium&nbsp;dolor&nbsp;quibusdam,&nbsp;veritatis&nbsp;pariatur&nbsp;dicta&nbsp;nihil,&nbsp;fuga&nbsp;optio.&nbsp;Dicta&nbsp;soluta&nbsp;delectus&nbsp;aut&nbsp;modi&nbsp;fugit&nbsp;dolor&nbsp;voluptatibus,&nbsp;corrupti&nbsp;porro&nbsp;ipsum&nbsp;sed&nbsp;quam&nbsp;ipsa&nbsp;eius&nbsp;libero&nbsp;reprehenderit&nbsp;nisi&nbsp;praesentium&nbsp;inventore&nbsp;repellendus&nbsp;ex,&nbsp;a&nbsp;assumenda&nbsp;maiores&nbsp;odit&nbsp;quod.&nbsp;Explicabo&nbsp;velit&nbsp;qui&nbsp;non&nbsp;asperiores&nbsp;repudiandae&nbsp;architecto&nbsp;aut&nbsp;blanditiis&nbsp;incidunt?&nbsp;Corporis&nbsp;magnam&nbsp;nisi&nbsp;exercitationem&nbsp;libero&nbsp;earum&nbsp;beatae&nbsp;facilis&nbsp;</p>\r\n\r\n<p>nemo&nbsp;accusantium&nbsp;asperiores&nbsp;veniam&nbsp;ea&nbsp;fugiat&nbsp;odio&nbsp;ex&nbsp;enim&nbsp;consequatur&nbsp;provident&nbsp;distinctio,&nbsp;saepe&nbsp;cumque&nbsp;ad&nbsp;laborum&nbsp;rerum&nbsp;animi&nbsp;laboriosam?&nbsp;Similique&nbsp;iusto,&nbsp;ab,&nbsp;alias&nbsp;voluptatibus&nbsp;dolores&nbsp;soluta&nbsp;commodi&nbsp;pariatur,&nbsp;laboriosam&nbsp;ipsam&nbsp;eligendi&nbsp;deleniti&nbsp;velit&nbsp;ullam?&nbsp;Doloribus&nbsp;enim&nbsp;hic&nbsp;officiis&nbsp;suscipit&nbsp;modi,&nbsp;nam&nbsp;sint&nbsp;quasi!&nbsp;Quae&nbsp;dolore&nbsp;animi&nbsp;est&nbsp;vero&nbsp;unde&nbsp;modi&nbsp;eveniet&nbsp;ut&nbsp;praesentium&nbsp;architecto&nbsp;consequatur,&nbsp;earum&nbsp;porro&nbsp;commodi&nbsp;vel&nbsp;et.&nbsp;Delectus&nbsp;voluptas,&nbsp;placeat&nbsp;saepe&nbsp;repellat&nbsp;est&nbsp;nostrum&nbsp;reiciendis&nbsp;possimus&nbsp;cum&nbsp;molestias,&nbsp;magni&nbsp;fugiat&nbsp;labore,&nbsp;modi&nbsp;dignissimos?&nbsp;Recusandae&nbsp;facere&nbsp;perspiciatis&nbsp;explicabo&nbsp;soluta&nbsp;animi&nbsp;temporibus&nbsp;laborum&nbsp;pariatur&nbsp;quasi&nbsp;rem&nbsp;excepturi&nbsp;in&nbsp;labore,&nbsp;minima&nbsp;eaque&nbsp;sed,&nbsp;voluptate&nbsp;fugit&nbsp;qui&nbsp;nemo&nbsp;nulla&nbsp;modi.&nbsp;Corrupti,&nbsp;doloribus.&nbsp;Velit&nbsp;similique&nbsp;architecto&nbsp;esse&nbsp;asperiores&nbsp;officiis!&nbsp;Facere&nbsp;assumenda&nbsp;laudantium&nbsp;eaque&nbsp;aliquam&nbsp;perferendis&nbsp;ab&nbsp;quasi,&nbsp;accusamus&nbsp;odit,&nbsp;ratione&nbsp;dolore&nbsp;totam,&nbsp;facilis&nbsp;libero&nbsp;inventore!&nbsp;Error&nbsp;eveniet&nbsp;dolorem&nbsp;unde&nbsp;at&nbsp;tempora&nbsp;doloremque&nbsp;totam&nbsp;ducimus&nbsp;molestiae&nbsp;inventore&nbsp;architecto&nbsp;aut&nbsp;repellendus&nbsp;officiis&nbsp;distinctio&nbsp;fugit&nbsp;ratione&nbsp;quo,&nbsp;alias&nbsp;illum&nbsp;vero&nbsp;velit&nbsp;quis&nbsp;necessitatibus&nbsp;molestias.&nbsp;Fuga&nbsp;similique&nbsp;atque&nbsp;excepturi&nbsp;iste&nbsp;alias&nbsp;perferendis&nbsp;laboriosam&nbsp;sequi,&nbsp;vitae&nbsp;accusamus&nbsp;minus?&nbsp;Eligendi&nbsp;quasi&nbsp;a&nbsp;labore&nbsp;recusandae&nbsp;veniam&nbsp;eos&nbsp;earum&nbsp;quaerat&nbsp;tempore!&nbsp;Similique&nbsp;voluptates&nbsp;accusamus&nbsp;sunt&nbsp;ex&nbsp;deleniti&nbsp;maxime&nbsp;voluptate?&nbsp;Omnis&nbsp;voluptate&nbsp;quaerat,&nbsp;beatae&nbsp;temporibus&nbsp;perspiciatis&nbsp;explicabo&nbsp;et&nbsp;eum&nbsp;obcaecati&nbsp;debitis.&nbsp;Modi&nbsp;magni&nbsp;assumenda&nbsp;eius&nbsp;ducimus&nbsp;molestias&nbsp;maxime&nbsp;voluptatum&nbsp;facilis&nbsp;a&nbsp;maiores&nbsp;suscipit,&nbsp;necessitatibus&nbsp;excepturi&nbsp;consequatur&nbsp;dolorum&nbsp;cum&nbsp;nam&nbsp;voluptate.&nbsp;Numquam&nbsp;quae&nbsp;quam&nbsp;incidunt&nbsp;omnis&nbsp;sapiente&nbsp;saepe,&nbsp;voluptatibus&nbsp;assumenda&nbsp;quas&nbsp;perspiciatis!&nbsp;Illum&nbsp;earum&nbsp;mollitia&nbsp;quod,&nbsp;veniam&nbsp;delectus&nbsp;a&nbsp;facilis&nbsp;magnam?&nbsp;Molestias&nbsp;debitis&nbsp;fuga&nbsp;sapiente&nbsp;sit&nbsp;et&nbsp;nulla&nbsp;numquam&nbsp;cupiditate&nbsp;iusto&nbsp;sed&nbsp;enim&nbsp;ullam&nbsp;inventore&nbsp;vitae&nbsp;iste&nbsp;nobis&nbsp;blanditiis&nbsp;dignissimos&nbsp;quidem&nbsp;beatae&nbsp;error&nbsp;itaque,&nbsp;quisquam&nbsp;ipsum!&nbsp;Laborum&nbsp;esse&nbsp;reiciendis&nbsp;possimus&nbsp;quasi,&nbsp;voluptates&nbsp;maxime&nbsp;aperiam&nbsp;magnam&nbsp;vitae&nbsp;obcaecati?&nbsp;Sint&nbsp;quidem&nbsp;beatae&nbsp;obcaecati&nbsp;odit&nbsp;sequi&nbsp;cumque&nbsp;accusantium&nbsp;delectus!&nbsp;Labore&nbsp;in&nbsp;porro&nbsp;nihil&nbsp;quam?&nbsp;Sed&nbsp;eius&nbsp;pariatur&nbsp;earum&nbsp;explicabo&nbsp;quasi&nbsp;sapiente&nbsp;facilis&nbsp;enim&nbsp;veniam,&nbsp;accusamus&nbsp;eligendi&nbsp;ratione,&nbsp;asperiores&nbsp;nihil&nbsp;ad&nbsp;consequatur&nbsp;culpa&nbsp;vitae?&nbsp;Praesentium,&nbsp;beatae&nbsp;illum&nbsp;cumque&nbsp;modi&nbsp;consectetur&nbsp;laudantium&nbsp;perferendis&nbsp;facilis&nbsp;culpa&nbsp;temporibus!&nbsp;Dolores&nbsp;aliquam&nbsp;fuga&nbsp;eum&nbsp;provident&nbsp;dolorem&nbsp;deserunt&nbsp;modi&nbsp;perferendis&nbsp;enim&nbsp;consequatur&nbsp;omnis&nbsp;voluptate&nbsp;eveniet&nbsp;optio,&nbsp;placeat&nbsp;odio&nbsp;nobis&nbsp;eaque&nbsp;exercitationem&nbsp;necessitatibus&nbsp;laudantium?&nbsp;Officiis&nbsp;laudantium&nbsp;voluptate&nbsp;hic&nbsp;omnis&nbsp;doloremque&nbsp;harum&nbsp;voluptates?&nbsp;Quis&nbsp;corporis&nbsp;fuga&nbsp;nihil&nbsp;neque&nbsp;dicta&nbsp;ipsum&nbsp;sint&nbsp;quasi&nbsp;ab&nbsp;quibusdam&nbsp;quisquam&nbsp;ratione&nbsp;nam&nbsp;minus&nbsp;dolorem,&nbsp;necessitatibus&nbsp;mollitia!&nbsp;Ipsa&nbsp;maxime&nbsp;fuga,&nbsp;rem&nbsp;ut&nbsp;animi,&nbsp;architecto&nbsp;atque&nbsp;voluptate&nbsp;aliquam&nbsp;eveniet&nbsp;quae&nbsp;porro&nbsp;veniam&nbsp;excepturi&nbsp;numquam&nbsp;inventore,&nbsp;tenetur&nbsp;cupiditate&nbsp;asperiores&nbsp;velit&nbsp;officiis.&nbsp;Error&nbsp;saepe&nbsp;excepturi&nbsp;nam&nbsp;aliquam&nbsp;quaerat&nbsp;explicabo&nbsp;alias,&nbsp;voluptates&nbsp;ipsa&nbsp;ratione&nbsp;possimus&nbsp;et&nbsp;nihil,&nbsp;modi&nbsp;consequuntur&nbsp;esse,&nbsp;voluptate&nbsp;eligendi&nbsp;quasi&nbsp;est&nbsp;illum&nbsp;incidunt&nbsp;dolorum?&nbsp;Sunt&nbsp;possimus&nbsp;quas&nbsp;eius&nbsp;perspiciatis&nbsp;animi&nbsp;quod&nbsp;temporibus&nbsp;sint&nbsp;esse&nbsp;quibusdam&nbsp;excepturi&nbsp;facere&nbsp;maiores&nbsp;porro&nbsp;eum&nbsp;itaque&nbsp;aspernatur,&nbsp;est&nbsp;totam,&nbsp;consequatur&nbsp;iste&nbsp;voluptate&nbsp;fuga?&nbsp;Sint&nbsp;corporis&nbsp;quasi&nbsp;blanditiis&nbsp;quidem&nbsp;eum&nbsp;veritatis&nbsp;natus,&nbsp;similique&nbsp;tempore&nbsp;architecto&nbsp;alias&nbsp;pariatur&nbsp;perferendis&nbsp;esse&nbsp;ea&nbsp;ratione,&nbsp;fugit&nbsp;reiciendis&nbsp;commodi&nbsp;autem!&nbsp;Asperiores&nbsp;rerum&nbsp;ad&nbsp;id&nbsp;quis,&nbsp;quod&nbsp;architecto&nbsp;similique&nbsp;nam.&nbsp;Minima,&nbsp;quibusdam&nbsp;temporibus.&nbsp;Harum,&nbsp;magni&nbsp;susci</p>\r\n\r\n<p>pit&nbsp;nemo&nbsp;amet&nbsp;odio&nbsp;neque&nbsp;beatae&nbsp;fugiat&nbsp;exercitationem&nbsp;voluptatibus&nbsp;vitae&nbsp;asperiores&nbsp;in&nbsp;doloremque&nbsp;ratione&nbsp;voluptates&nbsp;hic&nbsp;debitis&nbsp;molestiae&nbsp;similique&nbsp;eius&nbsp;voluptate,&nbsp;blanditiis&nbsp;a!&nbsp;Consectetur&nbsp;dignissimos,&nbsp;nesciunt&nbsp;eum,&nbsp;amet&nbsp;adipisci&nbsp;atque&nbsp;impedit&nbsp;quis&nbsp;quos&nbsp;similique&nbsp;omnis&nbsp;debitis&nbsp;asperiores,&nbsp;nisi&nbsp;vitae&nbsp;reprehenderit?&nbsp;Quasi&nbsp;ullam&nbsp;saepe&nbsp;temporibus&nbsp;impedit&nbsp;minus&nbsp;error&nbsp;architecto,&nbsp;voluptatibus&nbsp;ab&nbsp;sed&nbsp;sequi.&nbsp;Alias&nbsp;quos&nbsp;corporis&nbsp;cumque&nbsp;sapiente&nbsp;nostrum&nbsp;consequuntur&nbsp;commodi&nbsp;doloremque&nbsp;aperiam&nbsp;nam&nbsp;veniam.&nbsp;Iusto&nbsp;sapiente&nbsp;voluptatibus,&nbsp;eveniet&nbsp;facere&nbsp;eum&nbsp;alias&nbsp;non&nbsp;quibusdam&nbsp;voluptas.&nbsp;Corporis&nbsp;corrupti&nbsp;officiis,&nbsp;earum&nbsp;nihil&nbsp;molestiae&nbsp;similique&nbsp;a&nbsp;consequatur&nbsp;perferendis&nbsp;fugiat&nbsp;magnam&nbsp;blanditiis&nbsp;mollitia&nbsp;eveniet.&nbsp;Voluptatibus&nbsp;quod&nbsp;odit&nbsp;optio&nbsp;nisi&nbsp;ratione&nbsp;modi&nbsp;inventore&nbsp;harum&nbsp;aspernatur&nbsp;fuga&nbsp;velit&nbsp;ea&nbsp;animi&nbsp;iure&nbsp;illum&nbsp;necessitatibus&nbsp;totam&nbsp;nostrum,&nbsp;commodi&nbsp;deserunt&nbsp;voluptatem&nbsp;mollitia&nbsp;adipisci&nbsp;quibusdam&nbsp;at&nbsp;vero&nbsp;suscipit&nbsp;nemo.&nbsp;Accusamus&nbsp;harum&nbsp;amet&nbsp;asperiores.&nbsp;Dicta&nbsp;aliquam&nbsp;sint&nbsp;fugit,&nbsp;ad&nbsp;doloremque&nbsp;incidunt&nbsp;eius&nbsp;iste&nbsp;impedit&nbsp;eum&nbsp;optio&nbsp;distinctio&nbsp;co</p>\r\n\r\n<p>nsequatur&nbsp;similique&nbsp;aliquid&nbsp;minima&nbsp;quasi?&nbsp;Ad&nbsp;quae&nbsp;voluptas&nbsp;corporis&nbsp;voluptate&nbsp;ut&nbsp;quam&nbsp;alias&nbsp;explicabo&nbsp;reiciendis?&nbsp;Molestias&nbsp;reprehenderit&nbsp;numquam&nbsp;voluptas&nbsp;in&nbsp;laborum&nbsp;minima&nbsp;non&nbsp;autem,&nbsp;illo&nbsp;sint&nbsp;officiis&nbsp;eligendi&nbsp;voluptates&nbsp;nulla.&nbsp;Consequatur&nbsp;pariatur&nbsp;sint&nbsp;neque&nbsp;quod&nbsp;architecto&nbsp;libero&nbsp;voluptatibus&nbsp;molestias.&nbsp;Sunt&nbsp;quas&nbsp;reiciendis&nbsp;illo&nbsp;explicabo&nbsp;porro,&nbsp;ex&nbsp;repellendus&nbsp;praesentium&nbsp;quam?&nbsp;Reiciendis,&nbsp;magnam?&nbsp;Voluptas,&nbsp;iste&nbsp;accusantium&nbsp;quod&nbsp;quam&nbsp;mollitia,&nbsp;sunt&nbsp;officia&nbsp;debitis&nbsp;quae&nbsp;vero&nbsp;magnam&nbsp;doloribus&nbsp;quaerat&nbsp;id&nbsp;pariatur&nbsp;ullam&nbsp;sit&nbsp;eligendi&nbsp;nihil&nbsp;eaque&nbsp;totam.&nbsp;Dolorem&nbsp;perferendis&nbsp;quod&nbsp;mollitia&nbsp;ad&nbsp;delectus,&nbsp;minus&nbsp;animi&nbsp;aliquam&nbsp;tenetur&nbsp;voluptates&nbsp;ipsam&nbsp;illo,&nbsp;est&nbsp;veniam&nbsp;cupiditate.&nbsp;Corporis&nbsp;aliquam&nbsp;quis&nbsp;at&nbsp;eaque&nbsp;impedit&nbsp;quo&nbsp;qui&nbsp;temporibus,&nbsp;laboriosam&nbsp;iure&nbsp;dignissimos&nbsp;sunt&nbsp;dolore&nbsp;quae,&nbsp;earum&nbsp;nesciunt.&nbsp;Distinctio&nbsp;eveniet&nbsp;consectetur&nbsp;quidem&nbsp;illum&nbsp;praesentium!&nbsp;Maiores&nbsp;illo&nbsp;assumenda&nbsp;tenetur.&nbsp;Sunt&nbsp;obcaecati&nbsp;nisi&nbsp;autem&nbsp;labore&nbsp;iste&nbsp;minima&nbsp;rem&nbsp;necessitatibus&nbsp;provident&nbsp;quibusdam&nbsp;repellat&nbsp;natus&nbsp;laborum&nbsp;nemo&nbsp;culpa&nbsp;illo&nbsp;officiis&nbsp;pariatur,&nbsp;ullam&nbsp;in&nbsp;esse&nbsp;ipsa&nbsp;consectetur.&nbsp;Modi&nbsp;quod,&nbsp;similique&nbsp;perferendis&nbsp;autem&nbsp;beatae&nbsp;velit&nbsp;dolor&nbsp;necessitatibus&nbsp;sunt&nbsp;totam&nbsp;ducimus&nbsp;corporis,&nbsp;deleniti&nbsp;at&nbsp;exercitationem&nbsp;nesciu</p>\r\n', 'K-Pop', 'USR014', 'ADM01', 0, 0, '2021-07-13 21:28:42', '2021-07-13 21:29:47'),
(11, 'Top 10 Artis K-Pop Terganteng', '1626237108_5519b4e4731a7373eed3.jpg', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', 'K-Pop', 'USR014', 'ADM01', 0, 0, '2021-07-13 21:31:48', '2021-07-13 21:38:10'),
(12, 'Ratusan Purnama', '1626237937_0285692a729e9c1424a5.jpg', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', 'Puisi', 'USR015', 'ADM01', 1, 1, '2021-07-13 21:45:37', '2021-07-13 21:45:37'),
(13, 'Senja Yang Dingin', '1626238066_a791567de1713fc75ca2.jpg', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', 'Puisi', 'USR015', 'ADM01', 0, 1, '2021-07-13 21:47:25', '2021-07-13 21:47:46'),
(15, 'Tips Menjadi Programmer', 'karya.png', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n', 'Programmer, IT', 'USR001', 'ADM01', 0, 0, '2021-07-30 21:39:06', '2021-07-30 21:39:06'),
(18, 'Ada Apa Dengan Cinta?', '1628459698_be76d4779c1da0bb081e.jpg', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n', 'Cerpen, Romance, Cinta', 'USR016', 'ADM01', 1, 1, '2021-08-08 14:54:58', '2021-08-08 14:54:58'),
(19, 'Belajar Laravel', '1629451110_c366317a2a30de789dbf.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the e</p>\r\n', 'Anime', 'USR017', 'ADM01', 0, 1, '2021-08-20 02:17:29', '2021-08-20 02:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(4) NOT NULL,
  `isi_komentar` text NOT NULL,
  `kode_user` char(6) NOT NULL,
  `id_karya_tulis` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `isi_komentar`, `kode_user`, `id_karya_tulis`, `created_at`, `updated_at`) VALUES
(11, 'bagus ceritanya', 'USR015', 9, '2021-07-17 04:26:42', '2021-07-17 04:26:42'),
(14, 'ceritanya bagus. semangat terus buat menulis. Ditunggu karya berikutnya', 'USR016', 12, '2021-08-08 15:07:01', '2021-08-08 15:07:01'),
(15, 'karya yang bagus', 'USR017', 18, '2021-08-20 02:23:23', '2021-08-20 02:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-05-25-201052', 'App\\Database\\Migrations\\Users', 'default', 'App', 1625200353, 1),
(2, '2021-05-26-220018', 'App\\Database\\Migrations\\Admins', 'default', 'App', 1625200353, 1),
(3, '2021-05-26-225032', 'App\\Database\\Migrations\\ProfilSekolah', 'default', 'App', 1625200353, 1),
(4, '2021-05-27-001204', 'App\\Database\\Migrations\\KaryaTulis', 'default', 'App', 1625200353, 1),
(5, '2021-05-27-010923', 'App\\Database\\Migrations\\Pelaporan', 'default', 'App', 1625200353, 1),
(6, '2021-05-27-014609', 'App\\Database\\Migrations\\Komentar', 'default', 'App', 1625200353, 1),
(7, '2021-05-27-015942', 'App\\Database\\Migrations\\PelaporanKomentar', 'default', 'App', 1625200353, 1),
(8, '2021-06-08-053805', 'App\\Database\\Migrations\\Pengumuman', 'default', 'App', 1625200353, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_laporan` int(4) NOT NULL,
  `isi_laporan` text NOT NULL,
  `kode_user` char(6) NOT NULL,
  `id_karya_tulis` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan_komentar`
--

CREATE TABLE `pelaporan_komentar` (
  `id_pelaporan_komentar` int(4) NOT NULL,
  `isi_laporan_komentar` text NOT NULL,
  `id_komentar` int(4) NOT NULL,
  `kode_user` char(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(4) NOT NULL,
  `judul_pengumuman` varchar(200) NOT NULL,
  `gambar_pengumuman` varchar(40) NOT NULL DEFAULT 'pengumuman.png',
  `isi_pengumuman` text NOT NULL,
  `kode_admin` char(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul_pengumuman`, `gambar_pengumuman`, `isi_pengumuman`, `kode_admin`, `created_at`, `updated_at`) VALUES
(8, 'Lomba Memperingati Hari Kemerdekaan', '1626039056_6072d51bef6ef2ab6d69.jpg', '<p>Tepat pada tanggal 17 Agustus 2021 besok, Indonesia akan merayakan hari kemerdekaan yang ke-76. Untuk memperingati hari kemerdekaan tersebut, SMAN 1 Pejuang mengadakan lomba-lomba bertemakan kemerdekaan untuk seluruh siswa-siswi di SMAN 1 PEJUANG. Lomba tersebut di antaranya:</p>\r\n\r\n<ol>\r\n	<li>Lomba tumpeng</li>\r\n	<li>Lomba baju adat</li>\r\n	<li>Lomba puisi</li>\r\n	<li>Lomba menggambar</li>\r\n	<li>Lomba Balap karung</li>\r\n	<li>Lomba Makan kerupuk, dll.</li>\r\n</ol>\r\n\r\n<p>Diharapkan setiap kelas memberikan perwakilan dalam tiap-tiap perlombaan. 3 Juara dalam setiap perlombaan akan mendapatkan hadiah menarik dari sekolah. Yuk daftar!</p>\r\n', 'ADM02', '2021-07-05 20:10:44', '2021-07-11 14:30:56'),
(9, 'Hari Libur Sekolah', '1626038918_905c6812b7da8e5b7903.jpg', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'ADM02', '2021-07-11 13:27:53', '2021-07-11 14:28:38'),
(10, 'Lomba Cerpen SMAN 1 Pejuang', '1629453792_ea085957546d9e83b399.jpg', '<p>Sekolah mengadakan lomba menulis cerpen yang akan digelar pada:</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Tanggal: 28 agustus 2021</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Tempat: SMAN 1 Pejuang</p>\r\n\r\n<p>pendaftaran tanpa dipungut biaya dan&nbsp; bebas diikuti setiap siswa-siswi SMAN 1 Pejuang.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'ADM01', '2021-08-20 03:03:12', '2021-08-20 03:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `kode_profil_sekolah` char(3) NOT NULL DEFAULT 'SKL',
  `nama_sekolah` varchar(40) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email_sekolah` varchar(35) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `logo` varchar(40) NOT NULL DEFAULT 'logo.png',
  `kode_admin` char(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`kode_profil_sekolah`, `nama_sekolah`, `alamat`, `telepon`, `email_sekolah`, `visi`, `misi`, `logo`, `kode_admin`, `created_at`, `updated_at`) VALUES
('SKL', 'SMAN 1 PEJUANG', 'Jl. Kosambi Klari, Duren, Kec. Klari, Kabupaten Karawang, Jawa Barat 41371', '+62 123 4567 8910', 'pejuang@gmail.com', '<p>&ldquo;Mewujudkan generasi muda yang tangguh, mandiri, terampil dan berakhlak mulia&rdquo;</p>\r\n', '<p>Sebagai upaya mencapai visi tersebut. maka misi sekolah kami adalah;</p>\r\n\r\n<ol>\r\n	<li>Mengadakan kegiatan-kegiatan belajar kelompok.</li>\r\n	<li>Aktif ekstrakulikuler.</li>\r\n	<li>Memberikan lingkungan yang nyaman dalam belajar.</li>\r\n	<li>Meningkatkan prestasi baik dalam bidang akademik maupun bidang&nbsp;lainnya.</li>\r\n	<li>Mempererat tali persaudaraan antar sesama siswa.</li>\r\n</ol>\r\n', 'logo.png', 'ADM02', '2021-07-05 06:24:45', '2021-07-05 06:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` char(6) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(35) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `bio` text NOT NULL DEFAULT 'Author belum mengisi bio',
  `foto` varchar(40) NOT NULL DEFAULT 'user.png',
  `kartu_pelajar` varchar(40) NOT NULL,
  `status` enum('Aktif','Non-aktif','Banned','Alumni') NOT NULL DEFAULT 'Non-aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `nama_user`, `email_user`, `password_user`, `jenis_kelamin`, `bio`, `foto`, `kartu_pelajar`, `status`, `created_at`, `updated_at`) VALUES
('USR001', 'Eko Budiyono', 'ekobudiyono@gmail.com', '$2y$10$N4l5G.zR2ULsJN1oyNRE7.JwujlPfB8Tw3JgH4N1Sj2K9jlIoE9wq', 'Laki-laki', 'Bismillah Lulus', '1626518375_467f6c2f1717be47f8c5.jpeg', '1625461655_62eee097ea55f114827a.png', 'Aktif', '2021-07-04 22:07:35', '2021-07-04 22:07:35'),
('USR002', 'Izuku Midoriya', 'izuku@gmail.com', '$2y$10$HIod3bYbGMylJXlZL.HXSO74ZewQX87MvDDnumzbuGKKfl.O9mfYi', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626040731_d6e10d3c1e67f797c5a8.png', 'Non-aktif', '2021-07-11 14:58:51', '2021-07-11 14:58:51'),
('USR003', 'Katsuki Bakugo', 'bakugo@gmail.com', '$2y$10$fmYPCalAATdHXHldtR89VuMODpxFerU.dHfAHYBUvZynjRvqS/rfm', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626040788_81a08ff004fed49ebd75.png', 'Banned', '2021-07-11 14:59:48', '2021-07-11 14:59:48'),
('USR004', 'Mikasa Ackermen', 'mikasa@gmail.com', '$2y$10$8tSX67JAAUU4YEkxYnzipeo8JPH5TfFeZFE5mYGn7SK0xxHcq/NWK', 'Perempuan', 'Author belum mengisi bio', 'user.png', '1626040872_f07a606a90cf2de4ba2c.png', 'Non-aktif', '2021-07-11 15:01:12', '2021-07-11 15:01:12'),
('USR005', 'Saiki Kusuo', 'kusuo@gmail.com', '$2y$10$corX/lxbC0pvMRmyNxTr9ulTivAeF3Hxe2O7vMytsGZ/uzrIIBrMe', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626040916_25796282a1b17e2dcd70.png', 'Banned', '2021-07-11 15:01:56', '2021-07-11 15:01:56'),
('USR006', 'Si Oyen', 'sioyen@gmail.com', '$2y$10$AcoL8c3QflJsdGLiIg3IVOjxOZYVBJ45itOQ6BSSX6Tt3vFFXundO', 'Laki-laki', 'Oyen menguasai dunia', '1626518513_b1ce4096a170e94793e3.jpg', '1626040971_740d14a2169aa69b3a32.png', 'Aktif', '2021-07-11 15:02:51', '2021-07-11 15:02:51'),
('USR007', 'Hikigaya Hachiman', 'hikiman@gmail.com', '$2y$10$SmFb7wIXBrwSGPXnX0.nPu9.D3ZbtjRXAJ0MnVp.eJ1cedKPAkB0O', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626041078_cc24bc59ab8e28fd1e82.png', 'Non-aktif', '2021-07-11 15:04:38', '2021-07-11 15:04:38'),
('USR008', 'Nobara Kugisaki', 'nobara@gmail.com', '$2y$10$S6v0HNLtdhfQ4YPxkjVg.u1bAddI56AwxbK6NBW4N/thFIqcvnLx.', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626041145_5ac6b59cd3ae19fa6cf0.png', 'Non-aktif', '2021-07-11 15:05:45', '2021-07-11 15:05:45'),
('USR009', 'Itadori Yuji', 'yujidori@gmail.com', '$2y$10$p3NCu3EA5f/3P043NfOw5eL7lQCkUjMdm8K7L6cRK6GtuD2m/6kj2', 'Laki-laki', 'My Team (Yuji, Fushiguro, and Nobara)', '1626220146_5c328afdc652e50b8ee6.jpg', '1626041212_d87eeaab3e8261770cc7.png', 'Aktif', '2021-07-11 15:06:52', '2021-07-11 15:06:52'),
('USR010', 'Naruto Uzumaki', 'naruto@gmail.com', '$2y$10$XvsOkd2nvMRll9QC2ZOT3OrIMS6VjTJKBsAfNSEfJX4eBiu5.Uv.S', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626041297_6b0bd97d2ae880245563.png', 'Non-aktif', '2021-07-11 15:08:17', '2021-07-11 15:08:17'),
('USR011', 'Natsume Takashi', 'natsume@gmail.com', '$2y$10$Wj24aF9po1MJZ/mmkYdXGeoTfByLzNkioozKhuzGFXyMUy68vAG9m', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1626041344_b62cab168551308d376f.png', 'Alumni', '2021-07-11 15:09:04', '2021-07-11 15:09:04'),
('USR012', 'L1nD4ChiCwxJut3x', 'lindajutek@gmail.com', '$2y$10$SbT48PyiiuLVVe7oAkHYx.b8QBGF4XS.Ig.y0NpD4qdEaQAzvJbjG', 'Perempuan', 'Author belum mengisi bio', 'user.png', '1626041545_574f2498052dda63ef2d.png', 'Non-aktif', '2021-07-11 15:12:25', '2021-07-11 15:12:25'),
('USR013', 'Lorem Ipsum is simply dummy te', 'lipsum@gmail.com', '$2y$10$aTRcQ9HeJnFNUfyO/pCgNuE394AdT5ri2mBAuKjMaD6KlaxThidqC', 'Perempuan', 'Author belum mengisi bio', 'user.png', '1626041825_460fc5d34ccf766bfaed.png', 'Non-aktif', '2021-07-11 15:17:05', '2021-07-11 15:17:05'),
('USR014', 'Istrinya Jungkook', 'jungkook@gmail.com', '$2y$10$5uax0/9ieHSGBnQ4Wzidzeeb.26MHLQeyxSbIo.S8G.GVrwn1PGO6', 'Perempuan', 'Army BTS', '1626236754_2ae95e2b2b5aa0a8b005.jpg', '1626236653_c41e17f2c95e36c08fa3.png', 'Aktif', '2021-07-13 21:24:13', '2021-07-13 21:24:13'),
('USR015', 'Maiden in Love', 'maiden@gmail.com', '$2y$10$5vnwe8C4UqFMlgOLlqXGlOWjcugJbw3h0//xzdzqzGWmUABNUD7He', 'Perempuan', 'All About Love', '1626237836_23e4490590383b6b5583.jpg', '1626237769_4dfe7522c1d1193dc5c7.png', 'Aktif', '2021-07-13 21:42:49', '2021-07-13 21:42:49'),
('USR016', 'Ariana', 'ariana@gmail.com', '$2y$10$bgb8EGewU8PsKLYSugzCIe4TTS0ysh3OJAIyVgfEhXf/cRojdjMkO', 'Perempuan', 'Perempuan yang mencintai suatu seni dalam menulis', '1628460239_8a123aed4cf0be9dadba.jpg', '1628459348_1b7a28bf18e6584d0533.png', 'Aktif', '2021-08-08 14:49:09', '2021-08-08 14:49:09'),
('USR017', 'Agus Haryanto', 'agusharyanto@gmail.com', '$2y$10$0rDv5qR9ArBJq.5cGh7VEel1nhl4g6HSD921JagoK4istxDAUqZeK', 'Laki-laki', 'Author belum mengisi bio', 'user.png', '1629450531_2d4d2ec8463cfcc8e64f.png', 'Aktif', '2021-08-20 02:08:51', '2021-08-20 02:08:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indexes for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  ADD PRIMARY KEY (`id_karya_tulis`),
  ADD KEY `karya_tulis_kode_admin_foreign` (`kode_admin`),
  ADD KEY `karya_tulis_kode_user_foreign` (`kode_user`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `komentar_kode_user_foreign` (`kode_user`),
  ADD KEY `komentar_id_karya_tulis_foreign` (`id_karya_tulis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `pelaporan_id_karya_tulis_foreign` (`id_karya_tulis`);

--
-- Indexes for table `pelaporan_komentar`
--
ALTER TABLE `pelaporan_komentar`
  ADD PRIMARY KEY (`id_pelaporan_komentar`),
  ADD KEY `pelaporan_komentar_id_komentar_foreign` (`id_komentar`),
  ADD KEY `pelaporan_komentar_kode_user_foreign` (`kode_user`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `pengumuman_kode_admin_foreign` (`kode_admin`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`kode_profil_sekolah`),
  ADD KEY `profil_sekolah_kode_admin_foreign` (`kode_admin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`),
  ADD UNIQUE KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  MODIFY `id_karya_tulis` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_laporan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelaporan_komentar`
--
ALTER TABLE `pelaporan_komentar`
  MODIFY `id_pelaporan_komentar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  ADD CONSTRAINT `karya_tulis_kode_admin_foreign` FOREIGN KEY (`kode_admin`) REFERENCES `admin` (`kode_admin`),
  ADD CONSTRAINT `karya_tulis_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_id_karya_tulis_foreign` FOREIGN KEY (`id_karya_tulis`) REFERENCES `karya_tulis` (`id_karya_tulis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `pelaporan_id_karya_tulis_foreign` FOREIGN KEY (`id_karya_tulis`) REFERENCES `karya_tulis` (`id_karya_tulis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelaporan_komentar`
--
ALTER TABLE `pelaporan_komentar`
  ADD CONSTRAINT `pelaporan_komentar_id_komentar_foreign` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelaporan_komentar_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_kode_admin_foreign` FOREIGN KEY (`kode_admin`) REFERENCES `admin` (`kode_admin`);

--
-- Constraints for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD CONSTRAINT `profil_sekolah_kode_admin_foreign` FOREIGN KEY (`kode_admin`) REFERENCES `admin` (`kode_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
