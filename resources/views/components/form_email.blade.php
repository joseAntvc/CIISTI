<div class="d-flex justify-content-center align-items-center m-0 p-0">
    <div class="container-fluid py-3 m-2 p-0">
        <h5 class="custom-title mb-4">Envío de correos</h5>
        <form action="{{ route('email') }}" method="POST" id="emailForm">
            @csrf
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="title" class="form-control-label">Título</label>
                    <input class="form-control form-control-user-add" type="text" placeholder="Titulo" id="title"
                        name="title" value="{{ old('title') }}">
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="description" class="form-control-label">Descripción</label>
                    <textarea class="form-control form-control-user-add" type="textarea" placeholder="..." id="description"
                        name="description">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="addressee" class="form-control-label">Destinatarios</label>
                    <select class="form-control form-control-user-add" id="addressee" name="addressee">
                        <option value="">Selecciona un destinatario</option>
                        <optgroup label="Generales">
                            <option value="todos">Todos los usuarios</option>
                            <option value="staff">Todo el staff</option>
                            <option value="moderadores">Todos los moderadores</option>
                        </optgroup>
                        <optgroup label="Staff">
                            @foreach ($staff as $st)
                                <option value="{{ $st->id }}"> {{ $st->name }} {{ $st->last_name }} </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Moderadores">
                            @foreach ($moderation as $mode)
                                <option value="{{ $mode->id }}"> {{ $mode->name }} {{ $mode->last_name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <input type="hidden" id="selectA" name="selectA">
            <div class="col-md-9 mb-3 mx-auto">
                <div id="selectedAddressees" class="d-flex flex-wrap gap-2"></div>
            </div>

            <div class="d-flex justify-content-center">
                <button id="submitEmailForm" type="submit" style="background-color: rgb(4, 163, 86)"
                    class="btn btn-md mt-3 mb-2 text-white">Enviar</button>
            </div>
        </form>
    </div>
</div>

<script>
    addresseeSelect = document.getElementById('addressee');
    selectedAddresseesContainer = document.getElementById('selectedAddressees');
    selectedAddressees = [];

    addresseeSelect.addEventListener('change', function() {
        const selectedOption = addresseeSelect.options[addresseeSelect.selectedIndex];
        const selectedId = selectedOption.value;
        const selectedName = selectedOption.text;

        if (selectedId === 'todos') {
            disableGroup('Staff');
            disableGroup('Moderadores');
            disableOption('staff');
            disableOption('moderadores');
        } else if (selectedId === 'staff') {
            disableGroup('Staff');
            disableOption('todos');
        } else if (selectedId === 'moderadores') {
            disableGroup('Moderadores');
            disableOption('todos');
        }

        if (selectedId && !selectedAddressees.some(addr => addr.id === selectedId)) {
            selectedAddressees.push({
                id: selectedId,
                name: selectedName
            });
            updateSelectedAddressees();
        }

        addresseeSelect.selectedIndex = 0;
    });

    function updateSelectedAddressees() {
        let addresseesHtml = selectedAddressees.map((addressee, index) => `
            <div class="badge tag d-flex align-items-center gap-1">
                <span>${addressee.name}</span>
                <a onclick="removeAddressee(${index})"><i class="fas fa-times" style="color: black"></i></a>
            </div>
        `).join('');
        selectedAddresseesContainer.innerHTML = addresseesHtml;
    }

    function removeAddressee(index) {
        const removedAddressee = selectedAddressees[index];
        selectedAddressees.splice(index, 1);

        if (removedAddressee.id === 'todos') {
            enableGroup('Staff');
            enableGroup('Moderadores');
            enableOption('staff');
            enableOption('moderadores');
        } else if (removedAddressee.id === 'staff') {
            enableGroup('Staff');
            const isModeradoresSelected = selectedAddressees.some(addr => addr.id === 'moderadores');
            if (!isModeradoresSelected) {

                enableOption('todos');
            }
        } else if (removedAddressee.id === 'moderadores') {
            enableGroup('Moderadores');
            const isStaffSelected = selectedAddressees.some(addr => addr.id === 'staff');
            if (!isStaffSelected) {
                enableOption('todos');
            }
        }
        updateSelectedAddressees();
    }

    function disableGroup(groupLabel) {
        [...addresseeSelect.options].forEach(option => {
            if (option.parentNode.label === groupLabel) {
                option.disabled = true;
            }
        });
    }

    function enableGroup(groupLabel) {
        [...addresseeSelect.options].forEach(option => {
            if (option.parentNode.label === groupLabel) {
                option.disabled = false;
            }
        });
    }

    function disableOption(optionValue) {
        const option = [...addresseeSelect.options].find(opt => opt.value === optionValue);
        if (option) option.disabled = true;
    }

    function enableOption(optionValue) {
        const option = [...addresseeSelect.options].find(opt => opt.value === optionValue);
        if (option) option.disabled = false;
    }

    form = document.getElementById('emailForm');
    form.addEventListener('submit', function(event) {
        const selectA = document.getElementById('selectA');
        if (selectedAddressees.length !== 0) {
            selectA.value = JSON.stringify(selectedAddressees);

        }
    });
</script>
