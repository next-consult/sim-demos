@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier l'entreprise</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <ul>
                                <a href="{{ route('entreprises.index') }} "> <button class="btn btn-warning"><i
                                            class="fa-solid fa-backward"></i>Retour</button></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->


    <!-- Form Layout Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="form-example">
                    <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="{{ route('entreprises.update_store', ['id' => $entreprise->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="nom"
                                            value="{{ $entreprise->nom }}">
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            value="{{ $entreprise->email }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Telephone: <span class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer telephone"
                                            class="form-control  @error('telephone') is-invalid @enderror" name="telephone"
                                            value="{{ $entreprise->telephone }}">
                                        @error('telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>







                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Web: </label>
                                        <input type="text" placeholder="Entrer matricule fiscal" class="form-control" 
                                            name="web" value="{{ $entreprise->web }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">RIB: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer RIB" 
                                            class="form-control @error('rib') is-invalid @enderror" 
                                            name="rib" value="{{ $entreprise->rib }}">
                                        @error('rib')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">IBAN: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer IBAN" 
                                            class="form-control @error('iban') is-invalid @enderror" 
                                            name="iban" value="{{ $entreprise->iban }}">
                                        @error('iban')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">RNE: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer RNE"
                                            class="form-control  @error('rne') is-invalid @enderror" name="rne"
                                            value="{{ $entreprise->rne }}">
                                        @error('rne')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">MF: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer matricule fiscal"
                                            class="form-control  @error('mf') is-invalid @enderror" name="mf"
                                            value="{{ $entreprise->mf }}">
                                        @error('mf')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="  border: 1px solid grey;">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Modifier le logo
                                        </label>
                                        <input type='file' class="form-control" id="file-input" name="photo" />
                                        @error('photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                        <div id='img_contain'>
                                            @if ($entreprise->photo != null)
                                                <img id="image-preview"
                                                    align='middle'src="{{ asset('assets/img/' . $entreprise->photo) }}"
                                                    alt="your image" title='' />
                                            @else
                                                <img id="image-preview"
                                                    align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png"
                                                    alt="your image" title='' />
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Addresse du l'entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <textarea placeholder="Entrer votre adresse" class="form-control  @error('adresse') is-invalid @enderror"
                                            name="adresse">{{ $entreprise->adresse }}</textarea>
                                        @error('adresse')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Condition de vente : <span
                                                class="obligatoire">*</span></label>
                                        <textarea class="form-control  @error('condition') is-invalid @enderror" name="condition">{{ $entreprise->condition }}</textarea>
                                        @error('condition')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Pied de la page par défaut: <span
                                                class="obligatoire">*</span></label>
                                        <textarea class="form-control  @error('footer') is-invalid @enderror" name="footer">{{ $entreprise->footer }}</textarea>
                                        @error('footer')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-layout-submit">
                                                    <button type="submit" class="btn btn-info">Modifier
                                                        l'entreprise</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form Layout Row -->
@endsection
