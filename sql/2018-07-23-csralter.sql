ALTER TABLE mst_csr
ADD COLUMN short_content text,
ADD COLUMN pretty_url text,
ADD COLUMN lokasi varchar(100),
ADD COLUMN type int,
ADD COLUMN latitude  decimal(19,15),
ADD COLUMN longitude decimal(19,15);
