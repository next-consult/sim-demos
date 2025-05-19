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
                        <form method="post" action="{{ route('crm.update_store_file', ['id' => $file->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Changer le fichier:</label>
                                        <input type="file" class="form-control  @error('file') is-invalid @enderror"
                                            name="file">
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Montant: <span class="obligatoire">*</span> </label>
                                        <input type="number" placeholder="Enter montant"
                                            class="form-control  @error('montant') is-invalid @enderror" name="montant"
                                            value="{{ $file->montant }}">
                                        @error('montant')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Date: <span class="obligatoire">*</span> </label>
                                        <input type="date" class="form-control  @error('date') is-invalid @enderror"
                                            name="date" value="{{ $file->date }}">
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="{{ $file->type }}" />

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-layout-submit">
                                                    <button type="submit" class="btn btn-info">Modifier
                                                        le fichier</button>
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
