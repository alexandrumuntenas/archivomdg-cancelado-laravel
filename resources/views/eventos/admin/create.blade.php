  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
      id="crearevento" tabindex="-1" aria-labelledby="creareventoLabel" aria-modal="true" role="dialog">
      <form class="modal-dialog modal relative w-auto pointer-events-none" action="">
          @csrf
          <div
              class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
              <div
                  class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                  <h5 class="text-xl font-medium leading-normal text-gray-800" id="creareventoLabel">
                      Crear nuevo evento
                  </h5>
                  <button type="button"
                      class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                      data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body relative p-4">
                  <div class="mb-3">
                      <label for="nombreEvento" class="form-label inline-block mb-2 text-gray-700">Nombre</label>
                      <input type="text"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="nombreEvento" placeholder="Concierto Fin de Curso XXXX" />
                  </div>
                  <div class="mb-3">
                      <label for="ubicacionEvento" class="form-label inline-block mb-2 text-gray-700">Ubicación</label>
                      <input type="text"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="ubicacionEvento" placeholder="Concierto Fin de Curso XXXX" />
                  </div>
                  <div class="datepicker relative form-floating mb-3">
                      <input type="text"
                          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          placeholder="Select a date" id="fechaEvento" data-mdb-toggle="datepicker"/>
                      <label for="floatingInput" class="text-gray-700">Fecha</label>
                  </div>
              </div>
          </div>
      </form>
  </div>
