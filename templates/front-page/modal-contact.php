<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/8/2016
 * Time: 10:28 PM
 */
?>
<ul class="contact-info list-inline text-center">
    <li class="tel"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><br /> <a href="%2b0800123456.html">0800 123 4567</a></li>
    <li class="email"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><br /> <a href="#">hello@yourdevstudio.com</a></li>
</ul>
<form id="contact-form" class="contact-forms" method="post" action="#">
    <div class="row text-center">
        <div class="contact-form-inner">
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <label class="sr-only" for="cname">Your name</label>
                    <input type="text" class="form-control" id="cname" name="name" placeholder="Your name" minlength="2" required>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <label class="sr-only" for="cemail">Email address</label>
                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Your email address" required>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label class="sr-only" for="cmessage">Your message</label>
                    <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="12" required></textarea>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <button type="submit" class="btn btn-block btn-cta btn-cta-primary">Send Message</button>
                </div>
            </div><!--//row-->
        </div>
    </div><!--//row-->
    <div id="form-messages"></div>
</form><!--//contact-form-->