<div class="container">
    <div class="section section-crumb">
        <div class="section_content">
            <div class="breadcrumbs">
                <a href="/">BERANDA</a>
                <span>CSR</span>
            </div>
            <div class="articlepage">

                <div class="article">
                    <div class="article-type"><?= Dynamic_model::$tipe_csr[$csr['type']] ?></div>
                    <div class="article-title"><h2><?= $csr['judul'] ?></h2></div>
                    <!-- <div class="article-subtitle">By Mr. McAuthor</div> -->

                    <!-- share with plugin -->
                    <div class="addthis_inline_share_toolbox"></div>

                    <div class="article-contents">
                        <img src="<?= $csr['image_landing_big'] ?>" width="100%" alt="<?= $csr['judul'] ?>" />
                        <?= html_entity_decode($csr['content']) ?>
                    </div>
                </div>
                <div class="article-sidebar">
                    <div class="article-sidebar-title">CSR LAINNYA</div>
                    <div class="article-sidebar-list">
                        <?php if(count($r_csr) > 0): foreach($r_csr as $art): ?>
                        <a href="/csr/<?= $art['pretty_url'] ?>" class="article-sidebar-item">
                            <span class="article-sidebar-item-pic"><img src="<?= $art['image_landing'] ?>" /></span>
                            <span class="article-sidebar-item-name"><?= $art['judul'] ?></span>
                        </a>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="lead"></div>
            </div>
        </div>
    </div>
</div>
