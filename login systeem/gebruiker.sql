--database : 'fietsenmaker'


--tabelstructuur voor tabel 'gebruikers'

CREATE TABLE `gebruikers` (
    'id' int(5) NOT NULL,
    'username' varchar(255) NOT NULL,
    'password' varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--Gegevens worden geexporteert voor tabel 'gebruikers'
--admin.admin
INSERT INTO `gebruikers` (`id`, `username`, `password`) VALUES
(11,'admin', '$2y$10$DRwxvxqFC7m22YoNx4HAC.kXkh76nCohIh4vZ9IMtUEnZxfVGyFiO');