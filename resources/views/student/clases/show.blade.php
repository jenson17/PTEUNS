<div class="modal fade" id="show_class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_class_show">
      <div class="modal-body">
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label" id="descripction"></label>
            </div>
          </div>
        </di>
      </div>
      <div class="row justify-content-center" id="galeria" style="display: none;">
        <div class="col-sm-8">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
              
            </div>
             <div id="prev">
               <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
               </a>
             </div>
          </div>
        </div>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div> 
      </form>
    </div>
  </div>
</div>

@push('js')
     @include('student.clases.js.index')  
@endpush

