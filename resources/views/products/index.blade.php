@extends('template')

@section('title')
    E-commerce
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mes Produits</h1>
        <div>
            <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#createProductModal">
                <i class="bi bi-cart4 mx-2"></i>Ajouter
            </button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produits</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-thumbnail" width="80">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->prix }} </td>
                                <td>{{ $product->quantite }} </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#updateProductModal{{ $product->id }}">Modifier</button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(this)">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Update Modal -->
                            <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1"
                                aria-labelledby="updateProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateProductModalLabel">Modifier le produit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Titre</label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ $product->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" rows="3" required>{{ $product->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prix" class="form-label">Prix (€)</label>
                                                    <input type="number" class="form-control" name="prix"
                                                        value="{{ $product->prix }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image (facultatif)</label>
                                                    <input type="file" class="form-control" name="image" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prix" class="form-label">Quantité</label>
                                                    <input type="number" class="form-control" name="quantite" value="{{ $product->quantite }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Ajouter un produit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (xof)</label>
                            <input type="number" class="form-control" name="prix" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Quantité</label>
                            <input type="number" class="form-control" name="quantite" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script de confirmation -->
    <script>
        function confirmDelete(button) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                button.closest('form').submit();
            }
        }
    </script>
@endsection
