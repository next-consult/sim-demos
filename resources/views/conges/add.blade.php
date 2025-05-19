@extends('layouts.app')

@section('content')
<div class="leave-request-container">
    <!-- Modern Glass-effect Header -->
    <div class="header-card">
        <div class="header-content">
            <div>
                <h1>Demande de congé</h1>
                @php
                    $current_year = date('Y');
                    $user = auth()->user();
                    $jours = floor($user->solde_conge);
                    $heures = round(($user->solde_conge - $jours) * 8);
                @endphp
                <div class="balance-chip">
                    <i class="fas fa-calendar-check"></i>
                    <span>{{ $jours }} Jour(s) @if($heures > 0) + {{ $heures }}h @endif</span>
                </div>
            </div>
            <div class="action-buttons">
                <button type="button" class="btn-save" onclick="saveconge()">
                    <i class="fa fa-check"></i>
                    <span>Enregistrer</span>
                </button>
                <a href="{{ route('conges.index') }}" class="btn-cancel">
                    <i class="fa-solid fa-backward"></i>
                    <span>Retour</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Modern Form Card -->
    <div class="form-card">
        <form class="needs-validation" novalidate>
            <!-- Type Selection with Icons -->
            <div class="form-section">
                <div class="type-selector">
                    <input type="radio" id="type-annual" name="type" value="annuel" checked>
                    <label for="type-annual">
                        <i class="fas fa-umbrella-beach"></i>
                        <span>Congé annuel</span>
                    </label>

                    <input type="radio" id="type-sick" name="type" value="maladie">
                    <label for="type-sick">
                        <i class="fas fa-hospital"></i>
                        <span>Arrêt maladie</span>
                    </label>

                    <input type="radio" id="type-auth" name="type" value="autorisation">
                    <label for="type-auth">
                        <i class="fas fa-clock"></i>
                        <span>Autorisation</span>
                    </label>
                </div>
            </div>

            <!-- Duration Selector -->
            <div class="form-section" id="div_dure">
                <div class="duration-selector">
                    <input type="radio" id="one_journe" name="dure" value="one_journe" checked>
                    <label for="one_journe">
                        <i class="fas fa-sun"></i>
                        <span>Journée</span>
                    </label>

                    <input type="radio" id="many_journes" name="dure" value="many_journes">
                    <label for="many_journes">
                        <i class="fas fa-calendar-week"></i>
                        <span>Période</span>
                    </label>

                    <input type="radio" id="heures" name="dure" value="heures">
                    <label for="heures">
                        <i class="fas fa-clock"></i>
                        <span>Heures</span>
                    </label>
                </div>
            </div>

            <!-- Autorisation Hours -->
            <div class="form-section" id="autorisation-hours-container" style="display:none">
                <div class="select-wrapper">
                    <select class="modern-select" id="autorisation-hours" name="autorisation_hours">
                        <option value="1">1 heure</option>
                        <option value="2">2 heures</option>
                    </select>
                </div>
            </div>

            <!-- Dynamic Date/Time Fields -->
            <div class="form-section dates-container">
                <div id="single-date" class="date-input">
                    <input type="date" name="date_jour" class="modern-input">
                </div>

                <div id="date-range" class="date-range" style="display:none">
                    <div class="date-input">
                        <input type="date" name="date_debut" class="modern-input">
                        <i class="fas fa-arrow-right"></i>
                        <input type="date" name="date_fin" class="modern-input">
                    </div>
                </div>

                <div id="hours-select" class="hours-select" style="display:none">
                    <div class="time-select-wrapper">
                        <select class="modern-select" name="nb_heures" id="nb_heures">
                            @for($i = 1; $i <= 7; $i++)
                                <option value="{{ $i }}">{{ $i }} heure{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            <!-- Reason Text Area -->
            <div class="form-section">
                <textarea name="raison" class="modern-textarea" placeholder="Motif de la demande..."></textarea>
            </div>
        </form>
    </div>
</div>

<style>
.leave-request-container {
    width: 100%;
    padding: 2rem;
    margin: 0;
}

.header-card,
.form-card {
    width: 100%;
    margin: 0 auto;
}

.header-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.8), rgba(255,255,255,0.4));
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h1 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #1a1a1a;
}

.balance-chip {
    display: inline-flex;
    align-items: center;
    background: #00a191;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    gap: 0.5rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.btn-save, .btn-cancel {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.btn-save {
    background: #00a191;
    color: white;
}

.btn-save:hover {
    background: #008577;
}

.btn-cancel {
    background: #282e3f;
    color: white;
}

.btn-cancel:hover {
    background: #1f2431;
}

.form-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.form-section {
    margin-bottom: 2rem;
}

.type-selector, .duration-selector {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.type-selector label, .duration-selector label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.type-selector input[type="radio"], .duration-selector input[type="radio"] {
    display: none;
}

.type-selector input[type="radio"]:checked + label,
.duration-selector input[type="radio"]:checked + label {
    background: #00a191;
    color: white;
}

.modern-input, .modern-textarea {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.modern-textarea {
    min-height: 120px;
    resize: vertical;
}

.modern-input:focus, .modern-textarea:focus {
    border-color: #00a191;
    outline: none;
    box-shadow: 0 0 0 4px rgba(0, 161, 145, 0.1);
}

.date-range {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
    width: 100%;
}

.date-range .date-input {
    flex: 1;
    min-width: 200px;
}

.date-range i {
    margin: 0 1rem;
}

.dates-container {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 12px;
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.date-input,
#hours-select,
#autorisation-hours-container {
    flex: 1;
    min-width: 200px;
    max-width: 300px;
}

.text-danger {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.select-wrapper {
    position: relative;
    width: 100%;
    max-width: 300px;
}

.select-wrapper::after {
    content: '';
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    width: 0.8rem;
    height: 0.8rem;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    pointer-events: none;
}

.modern-select {
    appearance: none;
    width: 100%;
    padding: 0.75rem 1rem;
    padding-right: 2.5rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #1f2937;
    background-color: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.modern-select:hover {
    border-color: #d1d5db;
}

.modern-select:focus {
    outline: none;
    border-color: #00a191;
    box-shadow: 0 0 0 4px rgba(0, 161, 145, 0.1);
}

.modern-select option {
    padding: 0.75rem;
    background-color: white;
    color: #1f2937;
}

.time-select-wrapper {
    position: relative;
    width: 200px;
}

.time-select-wrapper .fas {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
}

.time-select-wrapper .modern-select {
    padding-left: 2.5rem;
    height: 48px;
    background-color: white;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
}

.time-select-wrapper .modern-select:hover {
    border-color: #00a191;
}

.time-select-wrapper .modern-select:focus {
    border-color: #00a191;
    box-shadow: 0 0 0 4px rgba(0, 161, 145, 0.1);
    outline: none;
}

.time-select-wrapper::after {
    content: '';
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    width: 0.8rem;
    height: 0.8rem;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    pointer-events: none;
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
    }

    .action-buttons {
        width: 100%;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
    }

    .btn-save, .btn-cancel {
        width: 100%;
        justify-content: center;
    }

    .type-selector, .duration-selector {
        grid-template-columns: 1fr;  /* Stack items vertically */
    }

    .date-range {
        flex-direction: column;
        gap: 1rem;
    }

    .date-range i {
        display: none;  /* Hide arrow on mobile */
    }

    .leave-request-container {
        padding: 0.5rem;
    }

    .header-card,
    .form-card {
        padding: 1rem;
    }

    .dates-container {
        padding: 1rem;
        flex-direction: column;
        gap: 1rem;
    }

    /* Make all inputs full width on mobile */
    .date-input,
    #hours-select,
    #autorisation-hours-container,
    .select-wrapper,
    .time-select-wrapper,
    .modern-input,
    .modern-select {
        max-width: 100%;
        width: 100%;
    }

    /* Adjust text sizes for better readability */
    .header-content h1 {
        font-size: 1.5rem;
    }

    .balance-chip {
        font-size: 0.85rem;
    }
}

/* Add new medium breakpoint */
@media (min-width: 769px) and (max-width: 1024px) {
    .type-selector, .duration-selector {
        grid-template-columns: repeat(2, 1fr);
    }

    .leave-request-container {
        padding: 1rem;
    }

    .dates-container {
        flex-wrap: wrap;
    }
}

/* Add new small breakpoint for very tiny screens */
@media (max-width: 360px) {
    .header-card,
    .form-card {
        padding: 0.75rem;
    }

    .balance-chip {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }

    .btn-save, .btn-cancel {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
}

/* Add some general improvements */
.type-selector label, .duration-selector label {
    min-height: 80px;
    justify-content: center;
    text-align: center;
    word-break: break-word;
    hyphens: auto;
}

.modern-textarea {
    min-height: 100px;
    max-height: 300px;
}

.dates-container {
    flex-wrap: wrap;
}

/* Improve touch targets on mobile */
@media (max-width: 768px) {
    .type-selector label,
    .duration-selector label,
    .modern-select,
    .btn-save,
    .btn-cancel {
        min-height: 44px; /* Minimum touch target size */
    }

    .modern-input,
    .modern-select {
        font-size: 16px; /* Prevent zoom on iOS */
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
    // Duration radio button handler
    $('input[name="dure"]').change(function() {
        $('#single-date, #date-range, #hours-select').hide();

        switch(this.value) {
            case 'one_journe':
                $('#single-date').show();
                break;
            case 'many_journes':
                $('#date-range').show();
                break;
            case 'heures':
                $('#single-date, #hours-select').show();
                break;
        }
    });

    // Type radio button handler
    $('input[name="type"]').change(function() {
        if (this.value === 'autorisation') {
            $('#autorisation-hours-container').show();
            $('#div_dure').hide();
            $('#single-date').show();
            $('#date-range, #hours-select').hide();
        } else {
            $('#autorisation-hours-container').hide();
            $('#div_dure').show();
            $('input[name="dure"]:checked').trigger('change');
        }
    });
});

function saveconge() {
    $('.text-danger').remove();

    const type = $('input[name="type"]:checked').val();
    const dure = $('input[name="dure"]:checked').val();
    const date_jour = $("input[name='date_jour']").val();
    const date_debut = $("input[name='date_debut']").val();
    const date_fin = $("input[name='date_fin']").val();
    const nb_heures = $("#nb_heures").val();
    const raison = $("textarea[name='raison']").val();
    const nb_heures_autorisation = $("#autorisation-hours").val();

    const form = new FormData();
    form.append('type', type);
    form.append('dure', dure);
    form.append('raison', raison);
    form.append('nb_heures_autorisation', nb_heures_autorisation);
    form.append('_token', '{{ csrf_token() }}');

    if (type === 'autorisation') {
        form.append('date_jour', date_jour);
    } else if (dure === "one_journe") {
        form.append('date_jour', date_jour);
    } else if (dure === "many_journes") {
        form.append('date_debut', date_debut);
        form.append('date_fin', date_fin);
    } else if (dure === "heures") {
        form.append('date_jour', date_jour);
        form.append('nb_heures', nb_heures);
    }

    $.ajax({
        url: "{{ url('/storeconges') }}",
        method: 'POST',
        data: form,
        processData: false,
        contentType: false,
        success: function(result) {
            if (result.errors) {
                Object.keys(result.errors).forEach(key => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: result.errors[key][0],
                        confirmButtonColor: '#00a191'
                    });
                });
            } else if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'Demande de congé ajoutée avec succès',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = "{{ url('/conges') }}";
                });
            }
        },
        error: function(xhr) {
            if (xhr.status === 422 || xhr.status === 400) {
                const errors = xhr.responseJSON.errors || xhr.responseJSON;
                Object.keys(errors).forEach(key => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        text: errors[key][0],
                        confirmButtonColor: '#00a191'
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur inattendue est survenue',
                    confirmButtonColor: '#00a191'
                });
            }
        }
    });
}
</script>
@endsection
