create table mst_csr_artikel (
	id bigint not null PRIMARY key AUTO_INCREMENT,
    pretty_url text,
    judul varchar(300),
    content text,
    content_device text,
    short_content text,
    is_show tinyint unsigned DEFAULT 1 comment '1 : show, 0 : hide ',
    meta_desc text,
    meta_keys text,
    created_date datetime,
    updated_date datetime
);

ALTER TABLE mst_csr
ADD COLUMN artikel_csr_id bigint;


CREATE OR REPLACE VIEW view_article_csr AS
SELECT
	id ,
	pretty_url,
	type,
	title,
	short_content,
	full_content,
	date,
	image_thumb,
    image_url,
    meta_desc,
    meta_keys
FROM
	dtb_article
WHERE
	is_show = 1
	and status = 1
UNION

SELECT
	msa.id,
	msa.pretty_url,
	'csr' as type,
	msa.judul,
	msa.short_content,
	msa.content,
	DATE(mc.created_date) as date,
	(select image_slider from trs_csr_slider tcs where tcs.csr_id = mc.id and is_show = 1 order by ordering asc limit 1) as image_landing_small,
	(select image_slider from trs_csr_slider tcs where tcs.csr_id = mc.id and is_show = 1 order by ordering asc limit 1) as image_landing_big,
    meta_desc,
    meta_keys
FROM
	mst_csr mc
	LEFT JOIN mst_csr_artikel msa ON msa.id = mc.artikel_csr_id
WHERE
	mc.is_show = 1
