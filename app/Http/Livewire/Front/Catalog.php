<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Catalog extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    public $maxPrice;

    public $minPrice;

    public $category_id;

    public $subcategory_id;

    public $brand_id;

    public $sorting;

    public $filterProductCategories;
    public $filterProductBrands;
    public $filterProductSubcategories;

    protected $queryString = [
        'search'        => [
            'except' => '',
        ],
        'sortBy'        => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function filterProductCategories($category_id)
    {
        $this->category_id = $category_id;
        $this->resetPage();
    }

    public function filterProductSubcategories($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
        $this->resetPage();
    }

    public function filterProductBrands($brand_id)
    {
        $this->brand_id = $brand_id;
        $this->resetPage();
    }

      public function updatingSearch()
      {
          $this->resetPage();
      }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function getMinPriceProperty()
    {
    return Product::where('status', 1)->min('price');
    }

    public function getMaxPriceProperty()
    {
    return Product::where('status', 1)->max('price');
    }

    public function filterPriceRange($priceRange)
    {
    $this->minPrice = $priceRange[0];
    $this->maxPrice = $priceRange[1];
    }

    public function updated($field)
    {
    if ($field === 'minPrice' || $field === 'maxPrice') {
        $this->filteredPrice = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->paginate($this->perPage);
    }
    }
    public function mount()
    {
        $this->sorting = 'default';
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Product::where('status', 1)->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->sorting == 'name') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'name-desc') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price-desc') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date-desc') {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('created_at', 'desc')->paginate($this->perPage);
        } elseif ($this->brand_id) {
            $products = $query->whereBetween('price',[$this->minPrice,$this->maxPrice])->where('brand_id', $this->brand_id)->paginate($this->perPage);
        } elseif ($this->category_id) {
            $products = Product::where('status', 1)->whereBetween('price',[$this->minPrice,$this->maxPrice])->where('category_id', $this->category_id)->paginate($this->perPage);
        } elseif ($this->subcategory_id) {
            $products = Product::where('status', 1)->whereBetween('price',[$this->minPrice,$this->maxPrice])->where('subcategory_id', $this->subcategory_id)->paginate($this->perPage);
        } else {
            $products = Product::where('status', 1)->whereBetween('price',[$this->minPrice,$this->maxPrice])->paginate($this->perPage);
        }

        return view('livewire.front.catalog', compact('products'));
    }

    public function getCategoriesProperty()
    {
        return Category::where('status', 1)->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::where('status', 1)->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('id', 'name', 'image', 'featured_image')->get();
    }

   
}
