{{-- resources/views/stock/etat.blade.php --}}
@extends('layouts.app')

@section('content')

        <div class="row">
			<div class="col-md-12">
				<div class="breadcromb-area">
					<div class="row">
						<div class="col-md-8">
							<div class="seipkon-breadcromb-left">
								<h3>État des Stocks</h3>
							</div>
						</div>
					</div>
				</div>

			</div>
    	</div>

	
	

		 <div class="row">
				<div class="col-md-12"> 
					<div class="page-box">
						<div class="datatables-example-heading"></div>
						<div class="table-responsive ">
							<table class="table display nowrap table-bordered facture_table_index">
								<thead>
									<tr>
										<th>Produit ID</th>
										<th>Nom du Produit</th>
										<th>Quantité Totale</th>
									</tr>
								</thead>
								<tbody>
									@foreach($stocks as $stock)
									<tr>
										<td>{{ $stock->catalogue_id }}</td>
										<td>{{ $stock->nom  }}</td>
										<td>{{ $stock->total_qte }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#stocksTable').DataTable();
    });
</script>
@endsection