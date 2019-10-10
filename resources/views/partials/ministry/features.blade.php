    <div class="container">
        <header class="section-title"><h2>How We Help</h2></header>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="feature-box ">
                    <figure class="icon"><i class="fa fa-database"></i></figure>
                    <aside class="description">
                        <header><h3>Wide Range of Ministries</h3></header>
                        <p>We are constantly maintaining and updating our list of ministries and their information, striving to attain the most accurate Ministry database.</p>

                    </aside>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="feature-box">
                    <figure class="icon"><i class="fa fa-search"></i></figure>
                    <aside class="description">
                        <header><h3>{{ config('app.name') }}</h3></header>
                        <p>We can help you find and connect with ministries that are near you, with the most accurate information and relevant data without any difficulty. </p>

                    </aside>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="feature-box ">
                    <figure class="icon"><i class="fa fa-youtube-play"></i></figure>
                    <aside class="description">
                        <header><h3>Quality Content For You</h3></header>
                        <p>We will provide access to quality media content daily through our blog section, articles and books, images, audio and videos that will inspire you greatly.</p>

                    </aside>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="feature-box">
                    <figure class="icon"><i class="fa fa-plus"></i></figure>
                    <aside class="description">
                        <header><h3>IT'S Easy To Add Your Ministry</h3></header>
                      <ul>
                          <li><a target="_blank" href="{{ route('register') }}">Register</a> or <a target="_blank" href="{{ route('login') }}">Login</a> to your Account</li>
                          <li>Click on <a target="_blank" href="{{ route('add_ministry') }}">Add Ministry</a></li>
                          <li>Fill the form and Save.</li>
                      </ul>

                    </aside>
                </div>
            </div>
        </div>
    </div>