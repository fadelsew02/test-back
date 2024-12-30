<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Affiche la liste des produits.
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return view('products.index', compact('products'));
    }


    /**
     * Enregistre un produit dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
            'quantite' => 'required|integer',
        ]);
        
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
        $validated['user_id'] = auth()->id();
        Product::create($validated);
        

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }


    /**
     * Met à jour un produit dans la base de données.
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // L'image est facultative
            'quantite' => 'required|integer',

        ]);

        // Récupérer le produit à mettre à jour
        $product = Product::findOrFail($id);

        // Mise à jour des champs texte
        $product->title = $validated['title'];
        $product->description = $validated['description'];
        $product->prix = $validated['prix'];
        $product->quantite = $validated['quantite'];

        // Gestion de l'image (si une nouvelle image est uploadée)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            // Enregistrer la nouvelle image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Enregistrer les modifications
        $product->save();

        // Redirection avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }


    /**
     * Supprime un produit.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
