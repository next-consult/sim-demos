@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter l'entreprise</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <ul>
                                <a href="{{ url()->previous() }} "> <button class="btn btn-warning"><i
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
                        <form method="post" action="{{ route('entreprises.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nom de l'entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="nom">
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Telephone: <span class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer telephone"
                                            class="form-control  @error('telephone') is-invalid @enderror" name="telephone">
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
                                        <input type="text" placeholder="Entrer matricule fiscal" class="form-control" name="web">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">RIB: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer RIB" 
                                            class="form-control @error('rib') is-invalid @enderror" name="rib">
                                        @error('rib')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">IBAN: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer IBAN" 
                                            class="form-control @error('iban') is-invalid @enderror" name="iban">
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
                                            class="form-control  @error('rne') is-invalid @enderror" name="rne">
                                        @error('rne')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">MF: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer matricule fiscal"
                                            class="form-control  @error('mf') is-invalid @enderror" name="mf">
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
                                        <label for="first">Choisir le logo
                                        </label>
                                        <input type='file' class="form-control" id="file-input" name="photo" />
                                        @error('photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                        <div id='img_contain'>
                                            <img id="image-preview"
                                                align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png"
                                                alt="your image" title='' />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Addresse de l'entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse"></textarea>
                                        @error('adresse')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Conditions de vente </label>
                                        <textarea class="form-control  @error('conditon') is-invalid @enderror" name="condition"></textarea>
                                        @error('conditon')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Pied de la page par défaut</label>
                                        <textarea class="form-control  @error('footer') is-invalid @enderror" name="footer"></textarea>
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
                                                    <button type="submit" class="btn btn-info">Ajouter
                                                        l'entreprise</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Layout Row -->
@endsection
