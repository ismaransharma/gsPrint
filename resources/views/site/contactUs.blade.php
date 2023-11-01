@extends('template.template')
@section('content')

<div id="locationInMap">
    <iframe class="gsMap"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3515.5852402432965!2d83.98307117548578!3d28.219911275892596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39959511482589b3%3A0xbb6a8493f322bd09!2sGS%20Print%20%26%20Suppliers%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1696955369964!5m2!1sen!2snp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<div id="informationAboutUs">
    <div class="header">
        <h5>Information About Us</h5>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident quaerat, facilis nobis quisquam
            repellendus laudantium vitae ipsum aliquam eligendi suscipit sequi impedit, perspiciatis ab inventore ut
            temporibus dignissimos magnam quis! Doloremque harum, labore animi quam eveniet, aliquam placeat natus saepe
            maiores, aliquid ducimus ea eius enim laborum ab quae nemo. Laborum, animi quisquam! Laboriosam aliquam
            deserunt explicabo eum id, nesciunt quia fugit, quae, nobis earum nam commodi amet eligendi ratione possimus
            ex reiciendis assumenda ducimus aspernatur labore velit? Sit provident, porro nisi in veniam doloribus
            corrupti laboriosam, sapiente ullam cum suscipit totam hic reiciendis debitis, blanditiis pariatur accusamus
            excepturi tempore consequatur natus id dignissimos! Dolor, unde at? Ab distinctio temporibus quia quaerat
            sint deleniti, eius necessitatibus labore maiores sed. Voluptas tenetur quis odit iusto omnis architecto
            excepturi, vel, error, assumenda reiciendis laborum fugiat magni mollitia! Necessitatibus, quasi, quisquam
            esse, ut minus reiciendis impedit quod perspiciatis cum enim dolorem accusantium vitae?
        </p>
    </div>
</div>

<div id="contactus">
    <div class="header">
        <h4>Contact Us</h4>
    </div>
    <div class="contactUsBody">
        <div class="row">
            <div class="col-md-6">
                <div class="first">
                    <span class="decoration">
                        <i class="fa-solid fa-paper-plane"></i>
                    </span>
                    <span>Tel: (061)525561</span>
                    <p>
                        <span>
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>
                                E-mail: shop@gsprintnepal.com
                            </span>
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="second">
                    <span class="decoration">
                        <i class="fa-solid fa-paper-plane"></i>
                    </span>
                    <span>Address: Sangam Marg, Newroad, Pokhara, 33700 </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection