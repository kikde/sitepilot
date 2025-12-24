  <!-- testimonial-style-three -->
  <section  class="testimonial-style-three sec-pad" id="testimonial">
    <div class="auto-container">
        <div class="sec-title text-left">
            <h6>Testimonials</h6>
            <h2>What peoples say about us</h2>
        </div>
        <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
            @foreach($testi as $list)
            <div class="testimonial-block-two">
                <div class="inner-box">
                    {{-- <figure class="image-box">
                        <img src="{{asset('backend/testimonial/'.$list->images)}}" alt="">
                        
                    </figure> --}}

                    <div class="icon-box"><i class="flaticon-quote"></i></div>
                    {{-- <h4>Local Upstanding & Reliable</h4> --}}
                    <ul class="rating-box clearfix">
                        @for ($i = 0; $i < $list->rating; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                            @endfor
                    </ul>

                    <p>
                        {!! \Illuminate\Support\Str::limit(strip_tags($list->description), 118) !!}

                        @if (strlen(strip_tags($list->description)) > 118)
                        <button  class="designation" href="#" onclick="openmodel('{{$list->description}}')">Read More</button>
                        @endif
                    </p>
                    
                    
                  
                     
                        {{-- {!! $list->description !!} --}}
                    <div class="author-info">
                        <h4>{{$list->name}}</h4>
                        <span class="designation">{{$list->desg}}</span>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span class="closemodel">&times;</span>
          <p id="modelid" >Some text in the Modal..</p>
        </div>
    </div>
    
    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("closemodel")[0];
        function openmodel(data) {
            console.log(data)
            modal.style.display = "block";
            document.getElementById("modelid").innerHTML = data;
          
        }
    
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
        


</section>
<!-- testimonial-style-three end -->