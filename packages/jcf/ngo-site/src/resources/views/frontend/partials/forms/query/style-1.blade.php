     <div class="single-column">
            <div class="content_block_6">
                <div class="content-box">
                    <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-4.png')}});"></div>
                    <div class="sec-title text-left">
                        <h6>For Query</h6>
                        <h2>Get a Free Estimation</h2>
                    </div>
                    <form action="{{url('/')}}" method="post" class="estimate-form">
                        <div class="inner-box">
                            <div class="form-group">
                                <input type="text" name="text" placeholder="Your Name" required="">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Phone" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" placeholder="Address" required="">
                            </div>
                            <div class="form-group">
                                <select class="wide">
                                    <option data-display="Select a Subject">Select a Subject</option>
                                    <option value="1">Join</option>
                                    <option value="2">Feedback</option>
                                    <option value="3">Education</option>
                                    <option value="4">Vocational Training</option>
                                    <option value="4">Youth Leadership</option>
                                    <option value="4">Share Your Problem</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="message" placeholder="Message" required="">
                                </div>
                            </div>
                        </div>
                        <div class="message-btn">
                            <button type="submit">Submit Your Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
