CREATE TABLE dtb_polling (
    id_polling bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start_date date DEFAULT NULL,
    end_date date DEFAULT NULL,
    question text NOT NULL,
    is_show tinyint NOT NULL DEFAULT 1 COMMENT '0: hide, 1: show'
);

create table dtb_polling_answer (
    id_polling_answer bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_polling bigint UNSIGNED NOT NULL,
    answer text NOT NULL,
    score bigint UNSIGNED DEFAULT 0,
    CONSTRAINT id_polling_fk
		FOREIGN KEY (id_polling) REFERENCES dtb_polling(id_polling)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table dtb_polling_device (
    id_polling bigint UNSIGNED NOT NULL,
    device_identifier VARCHAR(100) NOT NULL,
    CONSTRAINT dtb_polling_device_pk PRIMARY KEY (id_polling, device_identifier),
    CONSTRAINT id_polling_device_fk
		FOREIGN KEY (id_polling) REFERENCES dtb_polling(id_polling)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);
