
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- issue
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `issue`;

CREATE TABLE `issue`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `number` INTEGER NOT NULL,
    `date_publication` DATE,
    `cover` VARCHAR(255) DEFAULT '',
    `publication_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FK_Publication_id` (`publication_id`),
    CONSTRAINT `FK_Publication_id`
        FOREIGN KEY (`publication_id`)
        REFERENCES `publication` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- publication
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `publication`;

CREATE TABLE `publication`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
