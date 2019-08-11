@extends('../layouts/default')

@section('content')
<div class="my-4 post">
    <h1 class="text-center">About Us</h1>
    <div class="post-body py-4">
      <div class="mb-4">
          <strong>Matrix Feed</strong> is a website that will provide you the best and most efficient articles about all the 
          topics you are eager to know about. Our motive is to share the information and knowledge to our greatest 
          extent. We have the best brains working for you and your queries.
      </div>
  
      
      <div class="mb-4">
          <h5 class="m-0"><strong>Why Matrix Feed?</strong></h5>
          We are providing the best results for you and the simplest articles and solutions for your queries. You don't 
          have to choose the correct or most reliable article from a huge sack of information, you will get what you looking at.
      </div>

      <h2 class="mb-4 text-center">
        Our Team
      </h2>
      <div class="row align-items-center justify-content-around">
        <div class="col-lg-4 col-sm-6 col-12 mb-4">
          <div class="row justify-content-center mb-2">
            <div class="avatar" style="background-image: url('/static images/Team/Raghib.jpeg')"></div>
          </div>
          <h4 class="text-center m-0">Raghib Sultan</h4>
          <div class="t-mute text-center">CEO</div>
          <h3 class="text-center">
            <a target="_blank" href="https://in.linkedin.com/in/raghib-sultan-65a591153"><i class="fab fa-linkedin"></i></a>
          </h3>
        </div>

        <div class="col-lg-4 col-sm-6 col-12 mb-4">
            <div class="row justify-content-center mb-2">
              <div class="avatar" style="background-image: url('/static images/Team/Raza.jpeg')"></div>
            </div>
            <h4 class="text-center m-0">Raza Ali</h4>
            <div class="t-mute text-center">CTO</div>
            <h3 class="text-center">
              <a target="_blank" href="https://twitter.com/RazaAli09542502?s=08" class="mr-2"><i class="fab fa-twitter"></i></a>
              <a target="_blank" href="https://www.linkedin.com/in/raza-ali-7a972b172"><i class="fab fa-linkedin"></i></a>
            </h3>
        </div>

        <div class="col-lg-4 col-sm-6 col-12 mb-4">
            <div class="row justify-content-center mb-2">
              <div class="avatar" style="background-image: url('/static images/Team/Irshad.jpeg')"></div>
            </div>
            <h4 class="text-center m-0">Irshad Ansari</h4>
            <div class="t-mute text-center">Senior Web Developer</div>
            <h3 class="text-center">
              <a target="_blank" href="https://twitter.com/irshadansari7" class="mr-2"><i class="fab fa-twitter"></i></a>
              <a target="_blank" href="https://www.linkedin.com/in/irshadjsr21/" class="mr-2"><i class="fab fa-linkedin"></i></a>
              <a target="_blank" href="https://imirshad.com"><i class="fas fa-link"></i></a>
            </h3>
        </div>
      </div>

      <h2 class="text-center mb-4">
        <div>Have Some More Questions?</div>
      </h2>

      <div class="text-center">
        <a href="mailto:studygoosefeed@gmail.com" class="btn btn-lg btn-primary">Contact Us</a>
      </div>
    </div>
  </div>
@endsection