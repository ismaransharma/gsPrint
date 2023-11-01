@extends('template.template')
@section('content')

<div id="aboutUs">
    <div class="header">
        <h2>GS PRINT AND SUPPLIERS PVT LTD</h2>
    </div>
    <div class="info">
        <p>
            We are a noted Service & Product Provider of Digital Printing Services including Flex Print with 10ft.
            Printer, 2D/3D Board with Laser Cutting Machine, Led Signage, Offset Print, and Screen & Rubber Print.
        </p>
    </div>
    <div class="buttons-area">
        <button class="btn first">SHOP WITH US</button>
        <button class="btn second">CONTACT US</button>
    </div>

</div>

<section id="ourObjectives">
    <div class="container">

        <div class="row">
            <div class="col-md-7">
                <img src="{{ asset('site/images/printing.PNG') }}" alt="">
            </div>
            <div class="col-md-5">
                <div class="header">
                    <h1>OUR OBJECTIVES</h1>
                </div>
                <div class="info">
                    To provide our clients with the highest quality products and printing services to enhance their
                    utility, business, products, social involvement, and services through advanced printing techniques,
                    creative design, machinery, speedy computational works, online solution, skilled employee, and
                    education.
                    To support our employees, providing a safe, encouraging environment for their careers.
                    To care for our environment by minimizing waste, conserving energy, and emphasizing the
                    sustainability of natural resources.
                </div>
            </div>
        </div>
    </div>
</section>

<section id="ourServices">
    <div class="container">
        <div class="row">
            <div class="col-md-5 left">
                <!-- First -->
                <h1>DESIGN</h1>
                <p>Design, Customized printing, Posters</p>
                <!-- Second -->
                <h1>PROMOTIONAL ITEMS</h1>
                <p>T-Shirts, Pen, Shopping Bags, Caps, Bottle, Stress Ball, Mug, Ribbon, Office table Stationery, Card
                    Holder, Key Rings,Product Sticker/Labels</p>
                <!-- Third -->
                <h1>PAPER PRINTING</h1>
                <p>Visiting Cards, Invitations Cards, Letterheads, Wedding Cards</p>
            </div>
            <div class="col-md-2">
                <h5>OUR</h5>
                <h5>SERVICES</h5>
            </div>
            <div class="col-md-5">
                <!-- First -->
                <h1>TROPHY</h1>
                <p>Trophy, Awards & Medals, Token of loves </p>
                <!-- Second -->
                <h1>DISPLAY</h1>
                <p>Banners, 2D/3D boards, Wooden & Fiber Frames, Point of Sale Displays, Personalized Wallpaper,
                    Exhibition and Display Stands Hoardings</p>
                <!-- Third -->
                <h1>STATIONERY</h1>
                <p>Marketing Materials Direct Mail, Specialist books, Photo products.</p>
            </div>
        </div>
    </div>
</section>

@endsection