<div class="modal fade" id="show_practica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="ver_imagen_titulo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_practica_show">
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Clase Asociada</label>
              <br>
              <label for="" class="form-label" id="clase_id_practica"></label>
              </select>
            </div>
          </div>
        </di>
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Status</label>
              <div id="status_practica"></div>
            </div>
          </div>
        </di>

        <div class="container-fluid" style="display: none;" id="imagen_all">
            <div class="row justify-content-center">
              <div class="col-sm-8" id="imagen">
              </div>
          </div>
        </div>

        <div class="container-fluid" style="display: none;" id="video_all">
           <div class="row justify-content-center">
              <div id="video">
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
