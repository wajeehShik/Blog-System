<x-front-layout>
    <section class="wn__faq__area bg--white pt--80 pb--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn__accordeion__content">
                        <h2>Below are frequently asked questions, you may find the answer for yourself</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec id erat sagittis, faucibus metus malesuada, eleifend turpis. Mauris semper augue id nisl aliquet, a porta lectus mattis. Nulla at tortor augue. In eget enim diam. Donec gravida tortor sem, ac fermentum nibh rutrum sit amet. Nulla convallis mauris vitae congue consequat. Donec interdum nunc purus, vitae vulputate arcu fringilla quis. Vivamus iaculis euismod dui.</p>
                    </div>
                    <div id="accordion" class="wn_accordion" role="tablist">
                        @foreach ($faqs as $faq)
                            
                        <div class="card">
                            <div class="acc-header" role="tab" id="heading{{$loop->iteration}}">
                                  <h5>
                                    <a data-toggle="collapse" href="#collapse{{$loop->iteration}}" role="button" aria-expanded="{{$loop->iteration==1?true:false}}" aria-controls="collapse{{$loop->iteration}}">{{$faq->title}}</a>
                                  </h5>
                            </div>
                            <div id="collapse{{$loop->iteration}}" class="collapse {{$loop->iteration==1?'show':''}}" role="tabpanel" aria-labelledby="heading{{$loop->iteration}}" data-parent="#accordion">
                                <div class="card-body">{{$faq->body}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div> 
        </div> 
    </section>
</x-front-layout>