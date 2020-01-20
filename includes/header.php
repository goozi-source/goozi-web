<?php if($_SERVER['REQUEST_URI'] == '/index' || $_SERVER['REQUEST_URI'] == '/'):?>



  <!--/.Carousel Wrapper-->
  <?php elseif($_SERVER['REQUEST_URI'] == '/news'): ?>
  <section class="card dusty-grass-gradient mt-3 wow fadeIn" id="intro">

        <!-- Content -->
    <div class="card-body text-white text-center py-5 px-5 my-5">

      <h1 class="mb-4">
        <strong class="text-white">News</strong>
      </h1>
      <p>
        <strong class="text-white">Stay up to date with the most recent and well curated news about the educational sector</strong>
      </p>
      

    </div>
    <!-- Content -->
  </section>
  <?php elseif($_SERVER['REQUEST_URI'] == '/about'): ?>
  <section class="card dusty-grass-gradient mt-3 wow fadeIn" id="intro">

        <!-- Content -->
    <div class="card-body text-white text-center py-5 px-5 my-5">

      <h1 class="mb-4">
        <strong class="text-white">About Us</strong>
      </h1>
      <p>
        <strong class="text-white">This is an INTERNET COMMUNITY for ALL schools in the public sector as well as the private sector in Lagos State. <br>This is a collaborative project between The Government of Lagos State, through the Ministry of Education and the Ministry of Science & Technology with Global Education Media (Nig.) Limited as part of the modernisation effort in the education sector.</strong>
      </p>
      

    </div>
    <!-- Content -->
  </section>
  <?php elseif($_SERVER['REQUEST_URI'] == '/publications'): ?>
  <section class="card dusty-grass-gradient mt-3 wow fadeIn" id="intro">

        <!-- Content -->
    <div class="card-body text-white text-center py-5 px-5 my-5">

      <h1 class="mb-4">
        <strong class="text-white">Publications</strong>
      </h1>
      <p>
        <strong class="text-white">Download files and documents that helps you gain insight into the educational industry</strong>
      </p>
      

    </div>
    <!-- Content -->
  </section>
  <?php endif ?>