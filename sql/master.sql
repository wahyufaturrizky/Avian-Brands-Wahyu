-- tambah untuk forgot password admin
ALTER TABLE `dtb_admin` ADD `unique_code` VARCHAR(15) NULL AFTER `email`, ADD `end_forgotpass_time` INT NULL AFTER `unique_code`;

-- tambahan untuk mtb_province
ALTER TABLE `mtb_province` ADD `is_show` tinyint unsigned DEFAULT 1 comment '1 : show , 0 : hide, kalau di delete, is_show nya jadi 0' AFTER `country_id`;
ALTER TABLE `mtb_province` ADD `version` bigint unsigned NOT NULL comment 'this data version number'  AFTER `is_show`;
ALTER TABLE `mtb_province` ADD `created_date` datetime  AFTER `version`;
ALTER TABLE `mtb_province` ADD `updated_date` datetime  AFTER `created_date`;

create or replace table dtb_store_v2 (
    customer_id	varchar (50) NOT NULL PRIMARY KEY	,
    kode_customer	varchar (20)		,
    nama_customer	varchar (100)		,
    alamat	text		,
    latitude	decimal (19,15)		,
    longitude	decimal (19,15)		,
    foto_toko_url	varchar (100)		,
    punya_mesin_tinting	tinyint NOT NULL DEFAULT 0 comment '1: punya , 0 : tidak'	,
    telepon VARCHAR(50) DEFAULT NULL,
	no_hp_1 VARCHAR(50) DEFAULT NULL,
	no_hp_2 VARCHAR(50) DEFAULT NULL,
	fax VARCHAR(50) DEFAULT NULL,
	website VARCHAR(50) DEFAULT NULL,
	email VARCHAR(50) DEFAULT NULL,
    version	bigint unsigned		,
    is_active	tinyint	NOT NULL DEFAULT 1,
    jual_pipa_power tinyint null,
    jual_pipa_power_max tinyint null,
    jual_fitting_power  tinyint null,
    jual_talang_power   tinyint null,
    jual_fitting_talang_power   tinyint null,
    jual_no_odor    tinyint null,
    jual_fres   tinyint null,
    jual_avitex_exterior    tinyint null,
    jual_boyo_plamir    tinyint null,
    jual_no_drop    tinyint null,
    jual_avitex tinyint null,
    jual_aries_gold tinyint null,
    jual_aries  tinyint null,
    jual_sunguard   tinyint null,
    jual_supersilk  tinyint null,
    jual_everglo    tinyint null,
    jual_aquamatt   tinyint null,
    jual_avitex_alkali_resisting_primer tinyint null,
    jual_no_drop_107    tinyint null,
    jual_no_drop_100    tinyint null,
    jual_no_drop_bitumen_black  tinyint null,
    jual_absolute   tinyint null,
    jual_avitex_roof    tinyint null,
    jual_belmas_roof    tinyint null,
    jual_yoko_roof  tinyint null,
    jual_lem_putih_vip_pvac tinyint null,
    jual_lem_putih_max_pvac tinyint null,
    jual_avian_road_line_paint  tinyint null,
    jual_wood_eco_woodstain tinyint null,
    jual_boyo_politur_vernis    tinyint null,
    jual_tan_politur    tinyint null,
    jual_avian_hammertone   tinyint null,
    jual_suzuka_lacquer tinyint null,
    jual_viplas tinyint null,
    jual_vip_paint_remover  tinyint null,
    jual_avian_anti_fouling tinyint null,
    jual_avian_lem_epoxy    tinyint null,
    jual_avian_non_sag_epoxy    tinyint null,
    jual_thinner_a_avia tinyint null,
    jual_lenkote_colorants  tinyint null,
    jual_giant_mortar_220   tinyint null,
    jual_giant_mortar_260   tinyint null,
    jual_giant_mortar_270   tinyint null,
    jual_giant_mortar_380   tinyint null,
    jual_giant_mortar_480   tinyint null,
    jual_platinum   tinyint null,
    jual_avian  tinyint null,
    jual_yoko   tinyint null,
    jual_belmas_zinchromate tinyint null,
    jual_avian_zinchromate  tinyint null,
    jual_yoko_loodmeni  tinyint null,
    jual_thinner_a_special_avia tinyint null,
    jual_yoko_yzermenie tinyint null,
    jual_glovin tinyint null,
    jual_no_odor_wall_putty tinyint null,
    jual_lenkote_alkali_resisting_primer    tinyint null,
    jual_no_lumut_solvent_based tinyint null,
    jual_no_drop_tinting    tinyint null,
    jual_avian_1kg tinyint null,
    rating_avianbrands	tinyint default 0
);

create or replace table mst_store_addon (
    kode_customer	varchar (20)	PRIMARY KEY	NOT NULL		,
    owner_member_id	bigint unsigned				,
    pretty_url	varchar (500)				,
    opening_hour	varchar (200)				,
    phone	varchar (100)				,
    fax	varchar (100)				,
    email	varchar (100)				,
    website	varchar (100)				,
    is_show	tinyint	DEFAULT 1	NOT NULL	comment '1:show , 0:hide'	,
    version	bigint unsigned				,
    meta_keys	text				,
    meta_desc	text				,
    nama_customer	varchar (100)				,
    alamat	text				,
    latitude	decimal (19,15)				,
    longitude	decimal (19,15)				,
    foto_toko_url	varchar (100)				,
    punya_mesin_tinting	tinyint				,
    created_date	datetime				,
    updated_date	datetime				,
    deleted_date	datetime
);

create or replace table trs_store_product (
    id	varchar (25)	NOT NULL PRIMARY KEY	,
    kode_customer	varchar (20)		,
    product_id	bigint unsigned		,
    additional_info	text
);

create or replace table trs_store_review (
    id	bigint unsigned	auto_increment primary key	NOT NULL	comment 'pk'	,
    foreign_key	varchar (20)		NOT NULL	comment 'fk, ke toko yang mana'	,
    review_datetime	datetime		NOT NULL	comment 'waktu kejadian'	,
    member_id	bigint unsigned		NOT NULL	comment 'fk, siapa yang review'	,
    rating_score	bigint unsigned	DEFAULT 0	NOT NULL	comment 'rating valuenya, 0 ~ 5, tidak bisa koma'	,
    review_title	text				,
    review_content	text				,
    status	tinyint unsigned	DEFAULT 0	NOT NULL	comment '0: belum di approve admin, 1: approved, 2: rejected, 3: edited.'	,
    reject_reason	text			comment 'alasan kalau di reject, optional'
);

create or replace table trs_store_discussion (
    id	bigint unsigned	auto_increment primary key	NOT NULL	comment 'pk'	,
    foreign_key	varchar (20)		NOT NULL	comment 'fk, ke toko yang mana'	,
    discuss_datetime	datetime		NOT NULL	comment 'waktu kejadian'	,
    member_id	bigint unsigned		NOT NULL	comment 'fk, siapa yang ngetik'	,
    type	tinyint unsigned	DEFAULT 1	NOT NULL	comment '1: discussion starter, 2: reply'	,
    discussion_topic_id	varchar (25)			comment 'kalau type = 2 (reply), ini harus ada valuenya, yakni untuk mengikat inputan ini itu untuk topik yg mana.'	,
    discussion_content	text			comment 'text diskusinya'	,
    is_from_store_owner	tinyint unsigned	DEFAULT 0	NOT NULL	comment '0: bukan dari store owner, 1: dari store owner.'	,
    status	tinyint unsigned	DEFAULT 0	NOT NULL	comment '0: belum di approve admin, 1: approved, 2: rejected.'	,
    reject_reason	text			comment 'alasan kalau di reject, optional'
);

create or replace table mst_promo (
    id  bigint unsigned auto_increment  not null    primary key ,
    judul   varchar(300) ,
    image_url   varchar(300) ,
    popup_image_url varchar(300),
    content text ,
    periode_start   date,
    periode_end date ,
    province_id bigint ,
    member_id   bigint unsigned ,
    is_from_avian   tinyint unsigned    DEFAULT 1       comment '1 : avian, 2 : bukan avian',
    is_show_as_popup    tinyint unsigned    DEFAULT 0       comment '1: yes, 0 : no'    ,
    is_show tinyint unsigned    DEFAULT 1       comment '1 : show , 0 : hide, kalau di delete, is_show nya jadi 0',
    version bigint unsigned ,
    created_date    datetime,
    updated_date    datetime
)
create or replace table mst_event (
    id bigint unsigned auto_increment NOT NULL primary key,
    judul varchar(300),
    image_url varchar(300) comment 'image url',
    popup_image_url varchar(300),
    alamat  text,
    content text,
    periode_start date,
    periode_end date,
    latitude float,
    longitude float,
    province_id bigint,
    member_id bigint unsigned,
    is_from_avian tinyint unsigned DEFAULT 1 comment '1 : avian, 2 : bukan avian',
    is_show_as_popup tinyint unsigned DEFAULT 0 comment '1: yes, 0 : no',
    is_show tinyint unsigned DEFAULT 1 comment '1 : show, 0 : hide ',
    version bigint unsigned,
    created_date datetime,
    updated_date datetime
);

create or replace table mst_csr (
    id bigint unsigned auto_increment NOT NULL primary key,
    judul varchar(300),
    content text,
    content_device text,
    is_show tinyint unsigned DEFAULT 1 comment '1 : show, 0 : hide ',
    image_landing varchar(300),
    version bigint unsigned,
    ordering int(11),
    created_date datetime,
    updated_date datetime
);

create or replace table trs_csr_slider (
    id bigint unsigned auto_increment NOT NULL primary key,
    csr_id varchar(20),
    image_slider varchar(300),
    ordering int(11),
    is_show tinyint unsigned DEFAULT 1 comment '1 : show, 0 : hide ',
    created_date datetime,
    updated_date datetime
);

create or replace table trs_product_review (
    id	bigint unsigned	auto_increment primary key	NOT NULL	comment 'pk'	,
    foreign_key	varchar (20)		NOT NULL	comment 'fk, ke product yang mana'	,
    review_datetime	datetime		NOT NULL	comment 'waktu kejadian'	,
    member_id	bigint unsigned		NOT NULL	comment 'fk, siapa yang review'	,
    rating_score	bigint unsigned	DEFAULT 0	NOT NULL	comment 'rating valuenya, 0 ~ 5, tidak bisa koma'	,
    review_title	text				,
    review_content	text				,
    status	tinyint unsigned	DEFAULT 0	NOT NULL	comment '0: belum di approve admin, 1: approved, 2: rejected, 3: edited.'	,
    reject_reason	text			comment 'alasan kalau di reject, optional'
);

create or replace table trs_product_discussion (
    id	bigint unsigned	auto_increment primary key	NOT NULL	comment 'pk'	,
    foreign_key	varchar (20)		NOT NULL	comment 'fk, ke product yang mana'	,
    discuss_datetime	datetime		NOT NULL	comment 'waktu kejadian'	,
    member_id	bigint unsigned		NOT NULL	comment 'fk, siapa yang ngetik'	,
    type	tinyint unsigned	DEFAULT 1	NOT NULL	comment '1: discussion starter, 2: reply'	,
    discussion_topic_id	varchar (25)			comment 'kalau type = 2 (reply), ini harus ada valuenya, yakni untuk mengikat inputan ini itu untuk topik yg mana.'	,
    discussion_content	text			comment 'text diskusinya'	,
    is_from_store_owner	tinyint unsigned	DEFAULT 0	NOT NULL	comment 'tidak digunakan di product'	,
    status	tinyint unsigned	DEFAULT 0	NOT NULL	comment '0: belum di approve admin, 1: approved, 2: rejected.'	,
    reject_reason	text			comment 'alasan kalau di reject, optional'
);

CREATE OR REPLACE view view_product_rating AS
SELECT foreign_key as product_id,
AVG(rating_score) as rating_avg,
COUNT(tpr.id) as total_reviews,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 5 and pr.foreign_key = tpr.foreign_key) as count_5_star,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 4 and pr.foreign_key = tpr.foreign_key) as count_4_star,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 3 and pr.foreign_key = tpr.foreign_key) as count_3_star,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 2 and pr.foreign_key = tpr.foreign_key) as count_2_star,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 1 and pr.foreign_key = tpr.foreign_key) as count_1_star,
(SELECT COUNT(id) FROM trs_product_review pr WHERE rating_score = 0 and pr.foreign_key = tpr.foreign_key) as count_0_star,
(select count(id) from trs_product_discussion tpd where type = 1 and status = 1 and tpd.foreign_key = tpr.foreign_key) as total_discussions
FROM trs_product_review tpr
GROUP BY foreign_key

create or replace table mst_palette_product (
    id bigint unsigned auto_increment NOT NULL primary key,
    palette_id bigint unsigned,
    product_id bigint unsigned
);

create or replace table mst_palette_color (
    id bigint unsigned auto_increment NOT NULL primary key,
    palette_id bigint unsigned,
    color_id bigint unsigned
);

create or replace view view_store_rating as
SELECT
tsr.foreign_key,
avg(tsr.rating_score) as rating_avg,
count(tsr.id) as total_reviews,
(select count(rating_score) from trs_store_review sr where rating_score = 5 and sr.foreign_key = tsr.foreign_key) as count_5_star,
(select count(rating_score) from trs_store_review sr where rating_score = 4 and sr.foreign_key = tsr.foreign_key) as count_4_star,
(select count(rating_score) from trs_store_review sr where rating_score = 3 and sr.foreign_key = tsr.foreign_key) as count_3_star,
(select count(rating_score) from trs_store_review sr where rating_score = 2 and sr.foreign_key = tsr.foreign_key) as count_2_star,
(select count(rating_score) from trs_store_review sr where rating_score = 1 and sr.foreign_key = tsr.foreign_key) as count_1_star,
(select count(rating_score) from trs_store_review sr where rating_score = 0 and sr.foreign_key = tsr.foreign_key) as count_0_star,
(select count(id) from trs_store_discussion srd where type = 1 and status = 1 and srd.foreign_key = tsr.foreign_key) as total_discussions
FROM trs_store_review tsr
WHERE status = 1
group by tsr.foreign_key;

CREATE TABLE `mtb_country` (
  `id` int(5) NOT NULL,
  `name` varchar(45) NOT NULL DEFAULT '',
  `is_show` tinyint(3) UNSIGNED DEFAULT '1' COMMENT '1 : show , 0 : hide, kalau di delete, is_show nya jadi 0',
  `version` bigint(20) UNSIGNED NOT NULL COMMENT 'this data version number',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create or replace table mst_merchant (
    id bigint unsigned auto_increment NOT NULL primary key,
    name varchar(100),
    email varchar(100),
    password varchar(50) comment 'hashed',
    forgot_pass_time datetime,
    unique_code varchar(20),
    verification_code varchar(30) comment 'a non hashed pin / password for merchant verification proccess',
    last_login_date datetime,
    logo_image varchar(100) comment 'the merchant logo image, must be 640 x 640',
    description text comment 'just some desc about the merchant',
    additional_info text comment 'additional info about the merchant',
    additional_link text comment 'a single link for the merchant, for anything',
    status tinyint(1) DEFAULT 1 comment '0: deleted, 1: not deleted',
    is_banned tinyint(1) DEFAULT 0 comment '0: not banned, 1: banned',
    created_date datetime,
    updated_date datetime
);

CREATE TABLE `mst_voucher` (
    id              bigint unsigned auto_increment  not null    primary key ,
    merchant_id     bigint unsigned     not null    comment 'fk to mst_merchant, who owned this voucher',
    title           varchar (300)comment 'this voucher title',
    price           int unsigned    DEFAULT 0       comment 'this voucher point price',
    image_url       varchar (300)           comment 'this voucher image',
    periode_start   date ,
    periode_end     date ,
    stok            int unsigned    DEFAULT 0   not null    comment 'this voucher stok' ,
    summary         text ,
    how_to          text ,
    terms           text,
    is_show       tinyint DEFAULT 1       comment '0: hidden, 1: showed'  ,
    status        tinyint DEFAULT 1       comment '0: deleted, 1: not deleted',
    version bigint unsigned     NOT NULL    comment 'this data version number',
    created_date    datetime,
    updated_date    datetime
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `trs_member_point` (
    id  bigint unsigned auto_increment  not null    primary key ,
    member_id   bigint unsigned         comment 'fk to dtb_member',
    point_mutation  int default 0   not null    comment 'point yang berubah',
    activity_code   varchar (20)            comment 'fk to mst_point_configuration',
    voucher_transaction_id  bigint unsigned         comment 'fk to trs_voucher_member',
    description text            comment 'note about this mutation'  ,
    created_date    datetime                ,
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `trs_voucher_member` (
    id  bigint unsigned auto_increment  not null    primary key ,
    member_id   bigint unsigned         comment 'fk to dtb_member'  ,
    voucher_id  bigint unsigned         comment 'fk to mst_voucher' ,
    status_claimed  tinyint unsigned    default 0   not null    comment '0: bought, 1: claimed' ,
    unique_code varchar (20)            comment 'kode unik saat claim'  ,
    bought_date datetime                ,
    claimed_date    datetime        ,
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mst_point_configuration` (
    activity_code   varchar (20)        not null    primary key ,
    description text ,               ,
    point   int unsigned    DEFAULT 0   not null
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO mst_point_configuration (activity_code, description, point) values('product_review', 'giving review to product, user can get point 1 time per product.', '7');
INSERT INTO mst_point_configuration (activity_code, description, point) values('sns_share', 'when user share something to sns, will get this point for each.', '4');


CREATE TABLE IF NOT EXISTS mst_store_product_search (
  store_column varchar(50) PRIMARY KEY NOT NULL,
  product_name varchar(128),
  product_id integer(128)
);

insert into mst_store_product_search values("jual_pipa_power", "Pipa Power", -1);
insert into mst_store_product_search values("jual_pipa_power_max", "Pipa Power Max", -1);
insert into mst_store_product_search values("jual_fitting_power", "Fitting Power", -1);
insert into mst_store_product_search values("jual_talang_power", "Talang Power", -1);
insert into mst_store_product_search values("jual_fitting_talang_power", "Fitting Talang Power", -1);
insert into mst_store_product_search values("jual_no_odor", "No Odor", 1);
insert into mst_store_product_search values("jual_fres", "Fres", 2);
insert into mst_store_product_search values("jual_avitex_exterior", "Avitex Exterior", 3);
insert into mst_store_product_search values("jual_boyo_plamir", "Boyo Plamir", 4);
insert into mst_store_product_search values("jual_no_drop", "No Drop", 5);
insert into mst_store_product_search values("jual_avitex", "Avitex", 6);
insert into mst_store_product_search values("jual_aries_gold", "Aries Gold", 9);
insert into mst_store_product_search values("jual_aries", "Aries", 10);
insert into mst_store_product_search values("jual_sunguard", "Sunguard", 11);
insert into mst_store_product_search values("jual_supersilk", "Supersilk", 12);
insert into mst_store_product_search values("jual_everglo", "Everglo", 13);
insert into mst_store_product_search values("jual_aquamatt", "Aquamatt", 14);
insert into mst_store_product_search values("jual_avitex_alkali_resisting_primer", "Avitex Alkali Resisting Primer", 15);
insert into mst_store_product_search values("jual_no_drop_107", "No Drop 107", 16);
insert into mst_store_product_search values("jual_no_drop_100", "No Drop 100", 17);
insert into mst_store_product_search values("jual_no_drop_bitumen_black", "No Drop Bitumen Black", 18);
insert into mst_store_product_search values("jual_absolute", "Absolute", 19);
insert into mst_store_product_search values("jual_avitex_roof", "Avitex Roof", 20);
insert into mst_store_product_search values("jual_belmas_roof", "Belmas Roof", 22);
insert into mst_store_product_search values("jual_yoko_roof", "Yoko Roof", 23);
insert into mst_store_product_search values("jual_lem_putih_vip_pvac", "Lem Putih VIP PVAc", 24);
insert into mst_store_product_search values("jual_lem_putih_max_pvac", "Lem Putih MAX PVAc", 25);
insert into mst_store_product_search values("jual_avian_road_line_paint", "Avian Road Line Paint", 26);
insert into mst_store_product_search values("jual_wood_eco_woodstain", "Wood Eco Woodstain", 27);
insert into mst_store_product_search values("jual_boyo_politur_vernis", "Boyo Politur Vernis", 28);
insert into mst_store_product_search values("jual_tan_politur", "Tan Politur", 29);
insert into mst_store_product_search values("jual_avian_hammertone", "Avian Hammertone", 30);
insert into mst_store_product_search values("jual_suzuka_lacquer", "Suzuka Lacquer", 32);
insert into mst_store_product_search values("jual_viplas", "Viplas", 33);
insert into mst_store_product_search values("jual_vip_paint_remover", "Vip Paint Remover", 37);
insert into mst_store_product_search values("jual_avian_anti_fouling", "Avian Anti Fouling", -1);
insert into mst_store_product_search values("jual_avian_lem_epoxy", "Avian Lem Epoxy", 39);
insert into mst_store_product_search values("jual_avian_non_sag_epoxy", "Avian Non-Sag Epoxy", 40);
insert into mst_store_product_search values("jual_thinner_a_avia", "Thinner A Avia", 42);
insert into mst_store_product_search values("jual_lenkote_colorants", "Lenkote colorants", 43);
insert into mst_store_product_search values("jual_giant_mortar_220", "Giant Mortar 220", 44);
insert into mst_store_product_search values("jual_giant_mortar_260", "Giant Mortar 260", 45);
insert into mst_store_product_search values("jual_giant_mortar_270", "Giant Mortar 270", 46);
insert into mst_store_product_search values("jual_giant_mortar_380", "Giant Mortar 380", 47);
insert into mst_store_product_search values("jual_giant_mortar_480", "Giant Mortar 480", 48);
insert into mst_store_product_search values("jual_platinum", "Platinum", 51);
insert into mst_store_product_search values("jual_avian", "Avian", 52);
insert into mst_store_product_search values("jual_yoko", "Yoko", 53);
insert into mst_store_product_search values("jual_belmas_zinchromate", "Belmas Zinchromate", 56);
insert into mst_store_product_search values("jual_avian_zinchromate", "Avian Zinchromate", 57);
insert into mst_store_product_search values("jual_yoko_loodmeni", "Yoko Loodmeni", 59);
insert into mst_store_product_search values("jual_thinner_a_special_avia", "Thinner A Special Avia", 65);
insert into mst_store_product_search values("jual_yoko_yzermenie", "Yoko Yzermenie", 66);
insert into mst_store_product_search values("jual_glovin", "Glovin", 67);
insert into mst_store_product_search values("jual_no_odor_wall_putty", "No Odor Wall Putty", 68);
insert into mst_store_product_search values("jual_lenkote_alkali_resisting_primer", "Lenkote Alkali Resisting Primer", 69);
insert into mst_store_product_search values("jual_no_lumut_solvent_based", "No Lumut Solvent Based", 70);
insert into mst_store_product_search values("jual_no_drop_tinting", "No Drop Tinting", 71);
insert into mst_store_product_search values("jual_avian_1kg", "Avian 1KG", -1);
