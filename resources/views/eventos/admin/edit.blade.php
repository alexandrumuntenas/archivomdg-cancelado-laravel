  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
      id="editarevento" tabindex="-1" aria-labelledby="editareventoLabel" aria-modal="true" role="dialog">
      <form class="modal-dialog modal relative w-auto pointer-events-none" method="POST" id="formulario-editarevento">
          <div
              class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
              <div
                  class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                  <h5 class="text-xl font-medium leading-normal text-gray-800" id="editareventoLabel">
                      Editar evento
                  </h5>
                  <button type="button"
                      class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                      data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body relative p-4">
                  <div class="mb-3 form-floating">
                      <input type="text"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="nombreEvento" placeholder="Concierto Fin de Curso XXXX" />
                      <label for="floatingInput" class="form-label inline-block mb-2 text-gray-700 ">Nombre</label>
                  </div>
                  <div class="mb-3 form-floating">
                      <input type="text"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="ubicacionEvento" placeholder="Concierto Fin de Curso XXXX" />
                      <label for="floatingInput" class="form-label inline-block mb-2 text-gray-700 ">Ubicaci??n</label>
                  </div>
                  <div class="datepicker relative form-floating mb-3">
                      <input type="date"
                          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          placeholder="Select a date" id="fechaEvento" />
                      <label for="floatingInput" class="text-gray-700">Fecha</label>
                  </div>
                  <div class="mb-3 form-floating">
                      <input type="time"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="horaEvento" placeholder="00:00" />
                      <label for="floatingInput"
                          class="form-label inline-block mb-2 text-gray-700 form-floating ">Hora</label>
                  </div>
                  <div class="mb-3 form-floating">
                      <input type="text"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="participantesEvento" placeholder="@" />
                      <div class="text-sm text-gray-500 mt-1">??Usa @ para inclu??r a todos los componentes!</div>
                      <label for="floatingInput"
                          class="form-label inline-block mb-2 text-gray-700 form-floating ">Participantes</label>
                  </div>
                  <div class="mb-3 form-floating">
                      <input type="text" id="partiturasEvento"
                          class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded     transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"/>
                      <label for="floatingInput"
                          class="form-label inline-block mb-2 text-gray-700 form-floating ">Archivos</label>
                  </div>
                  <div class="flex justify-end">
                      <button type="submit"
                          class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Editar
                          evento</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
  <script>
      $('#formulario-editarevento').on('submit', function(e) {
          e.preventDefault();
          $.ajax({
              type: 'POST',
              url: '{{ route('editarEvento') }}',
              data: {
                  id: {{ $eventoID }},
                  nombre: $('#nombreEvento').val(),
                  lugar: $('#ubicacionEvento').val(),
                  fecha: $('#fechaEvento').val(),
                  hora: $('#horaEvento').val(),
                  participantes: $('#participantesEvento').val(),
                  partituras: $('#partiturasEvento').val(),
                  _token: '{{ csrf_token() }}'
              },
              success: function(data) {
                  window.location.href = `{{ route('verEvento') }}/${data.id}`;
              }
          });
      });
  </script>
