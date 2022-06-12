<section class="main__block">
<div class="container px-4 py-5" id="custom-cards">
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('unsplash-photo-1.jpg');">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?= $data['username'] ?></h2>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <?= $data['id'] ?>
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <?= $data['username'] ?>
                        </li>
                        <li class="d-flex align-items-center">
                            <?= $data['email'] ?>
                        </li>
                        <li><a href="/news-create">Создать статью</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
