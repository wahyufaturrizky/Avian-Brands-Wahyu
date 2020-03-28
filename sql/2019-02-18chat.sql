create table trs_chat_room (
	id bigint not null AUTO_INCREMENT PRIMARY KEY,
    member_id bigint,
    admin_id bigint,
    version bigint not null,
	created_date datetime
);

create table trs_chat_detail (
	id bigint not null AUTO_INCREMENT PRIMARY KEY,
	chat_room_id bigint not null,
	member_id bigint,
    admin_id bigint,
    message text,
    tanggal datetime,
    version bigint not null
);

create table mst_layout (
	id bigint not null AUTO_INCREMENT PRIMARY KEY,
	header text,
	footer text
);

alter table trs_chat_room
add column updated_date datetime,
add column is_read tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: read , 1: unread';

alter table trs_chat_detail
add column is_read tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: read , 1: unread';


--alter untuk lokasi user
alter table dtb_push_device
add column lokasi varchar(100),
add column province_id bigint(20);

-- add colum status di event
alter table mst_event
add column status tinyint(1) not null default 1;
