<?php

namespace Database\Seeders;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Enums\ProductTypeEnum;
use Botble\Ecommerce\Models\Order;
use Botble\Ecommerce\Models\OrderAddress;
use Botble\Ecommerce\Models\OrderHistory;
use Botble\Ecommerce\Models\OrderProduct;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductFile;
use Botble\Ecommerce\Models\ProductVariation;
use Botble\Ecommerce\Models\ProductVariationItem;
use Botble\Ecommerce\Models\Shipment;
use Botble\Ecommerce\Models\ShipmentHistory;
use Botble\Ecommerce\Models\Wishlist;
use Botble\Ecommerce\Services\Products\StoreProductService;
use Botble\Payment\Models\Payment;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('products');

        $products = [
            [
                'id' => 1,
                'name' => 'Smart Home Speaker',
                'price' => fake()->numberBetween(200, 500),
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'name' => 'Headphone Ultra Bass',
                'price' => fake()->numberBetween(200, 500),
                'sale_price' => fake()->numberBetween(150, 200),
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'name' => 'Boxed - Bluetooth Headphone',
                'price' => fake()->numberBetween(200, 500),
                'sale_price' => fake()->numberBetween(50, 60),
                'is_featured' => true,
            ],
            [
                'id' => 4,
                'name' => 'Chikie - Bluetooth Speaker',
                'price' => fake()->numberBetween(70, 90),
                'is_featured' => true,
            ],
            [
                'id' => 5,
                'name' => 'Camera Hikvision HK-35VS8',
                'price' => fake()->numberBetween(40, 50),
                'sale_price' => fake()->numberBetween(50, 60),
                'is_featured' => true,
            ],
            [
                'id' => 6,
                'name' => 'Camera Samsung SS-24',
                'price' => fake()->numberBetween(50, 60),
                'is_featured' => true,
            ],
            [
                'id' => 7,
                'name' => 'Leather Watch Band',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 8,
                'name' => 'Apple iPhone 13 Plus',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 9,
                'name' => 'Macbook Pro 2015',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 10,
                'name' => 'Macbook Air 12 inch',
                'price' => fake()->numberBetween(200, 500),
                'sale_price' => fake()->numberBetween(150, 200),
                'is_featured' => true,
            ],
            [
                'id' => 11,
                'name' => 'Apple Watch Serial 7',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 12,
                'name' => 'Macbook Pro 13 inch',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 13,
                'name' => 'Apple Keyboard',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 14,
                'name' => 'MacSafe 80W',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 15,
                'name' => 'Hand playstation',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 16,
                'name' => 'Apple Airpods Serial 3',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 17,
                'name' => 'Cool Smart Watches',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 18,
                'name' => 'Black Smart Watches',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 19,
                'name' => 'Leather Watch Band Serial 3',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 20,
                'name' => 'Macbook Pro 2015 13 inch',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 21,
                'name' => 'Historic Alarm Clock',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 22,
                'name' => 'Black Glasses',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 23,
                'name' => 'Phillips Mouse',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 24,
                'name' => 'Gaming Keyboard',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(90, 100),
                'is_featured' => true,
            ],
            [
                'id' => 25,
                'name' => 'Dual Camera 20MP',
                'price' => 80.25,
                'sale_price' => 55,
            ],
            [
                'id' => 26,
                'name' => 'Smart Watches',
                'price' => 40.5,
                'sale_price' => 35,
            ],
            [
                'id' => 27,
                'name' => 'Beat Headphone',
                'price' => 20,
                'sale_price' => 15,
            ],
            [
                'id' => 28,
                'name' => 'Red & Black Headphone',
                'price' => fake()->numberBetween(50, 60),
            ],
            [
                'id' => 29,
                'name' => 'Audio Equipment',
                'price' => fake()->numberBetween(50, 60),
            ],
            [
                'id' => 30,
                'name' => 'Smart Televisions',
                'price' => fake()->numberBetween(110, 130),
                'sale_price' => fake()->numberBetween(80, 100),
            ],
            [
                'id' => 31,
                'name' => 'Samsung Smart TV',
                'price' => fake()->numberBetween(50, 60),
            ],
        ];

        Product::query()->truncate();
        DB::table('ec_product_with_attribute_set')->truncate();
        DB::table('ec_product_variations')->truncate();
        DB::table('ec_product_variation_items')->truncate();
        DB::table('ec_product_collection_products')->truncate();
        DB::table('ec_product_label_products')->truncate();
        DB::table('ec_product_category_product')->truncate();
        DB::table('ec_product_related_relations')->truncate();
        Wishlist::query()->truncate();
        Order::query()->truncate();
        OrderAddress::query()->truncate();
        OrderProduct::query()->truncate();
        OrderHistory::query()->truncate();
        Shipment::query()->truncate();
        ShipmentHistory::query()->truncate();
        Payment::query()->truncate();

        ProductFile::query()->truncate();

        foreach ($products as $key => $item) {
            $item['description'] = '<p>Short Hooded Coat features a straight body, large pockets with button flaps, ventilation air holes, and a string detail along the hemline.</p>';
            $item['content'] = '<p>Short Hooded Coat features a straight body, large pockets with button flaps, ventilation air holes, and a string detail along the hemline. The style is completed with a drawstring hood, featuring Rains&rsquo; signature built-in cap. Made from waterproof, matte PU, this lightweight unisex rain jacket is an ode to nostalgia through its classic silhouette and utilitarian design details.</p>
                                <p>- Casual unisex fit</p>

                                <p>- 64% polyester, 36% polyurethane</p>

                                <p>- Water column pressure: 4000 mm</p>

                                <p>- Model is 187cm tall and wearing a size S / M</p>

                                <p>- Unisex fit</p>

                                <p>- Drawstring hood with built-in cap</p>

                                <p>- Front placket with snap buttons</p>

                                <p>- Ventilation under armpit</p>

                                <p>- Adjustable cuffs</p>

                                <p>- Double welted front pockets</p>

                                <p>- Adjustable elastic string at hempen</p>

                                <p>- Ultrasonically welded seams</p>

                                <p>This is a unisex item, please check our clothing &amp; footwear sizing guide for specific Rains jacket sizing information. RAINS comes from the rainy nation of Denmark at the edge of the European continent, close to the ocean and with prevailing westerly winds; all factors that contribute to an average of 121 rain days each year. Arising from these rainy weather conditions comes the attitude that a quick rain shower may be beautiful, as well as moody- but first and foremost requires the right outfit. Rains focus on the whole experience of going outside on rainy days, issuing an invitation to explore even in the most mercurial weather.</p>';
            $item['status'] = BaseStatusEnum::PUBLISHED;
            $item['sku'] = 'HS-' . fake()->numberBetween(100, 200);
            $item['brand_id'] = fake()->numberBetween(1, 7);
            $item['tax_id'] = 1;
            $item['views'] = fake()->numberBetween(1000, 200000);
            $item['quantity'] = fake()->numberBetween(10, 20);
            $item['length'] = fake()->numberBetween(10, 20);
            $item['wide'] = fake()->numberBetween(10, 20);
            $item['height'] = fake()->numberBetween(10, 20);
            $item['weight'] = fake()->numberBetween(500, 900);
            $item['with_storehouse_management'] = true;

            // Support Digital Product
            $productName = $item['name'];
            if ($key % 4 == 0) {
                $item['product_type'] = ProductTypeEnum::DIGITAL;
                $item['name'] .= ' (' . ProductTypeEnum::DIGITAL()->label() . ')';
            }

            $images = [
                'products/' . ($key + 1) . '.jpg',
            ];

            for ($i = 1; $i <= 10; $i++) {
                if (File::exists(database_path('seeders/files/products/' . ($key + 1) . '-' . $i . '.jpg'))) {
                    $images[] = 'products/' . ($key + 1) . '-' . $i . '.jpg';
                }
            }

            $item['images'] = json_encode($images);

            $product = Product::query()->create($item);

            $product->productCollections()->sync([fake()->numberBetween(1, 3)]);

            if ($product->id % 3 == 0) {
                $product->productLabels()->sync([fake()->numberBetween(1, 3)]);
            }

            $product->categories()->sync([
                fake()->numberBetween(1, 14),
            ]);

            $product->tags()->sync([
                fake()->numberBetween(1, 6),
                fake()->numberBetween(1, 6),
                fake()->numberBetween(1, 6),
            ]);

            Slug::query()->create([
                'reference_type' => Product::class,
                'reference_id' => $product->id,
                'key' => Str::slug($productName),
                'prefix' => SlugHelper::getPrefix(Product::class),
            ]);

            MetaBox::saveMetaBoxData(
                $product,
                'faq_schema_config',
                json_decode(
                    '[[{"key":"question","value":"What Shipping Methods Are Available?"},{"key":"answer","value":"Ex Portland Pitchfork irure mustache. Eutra fap before they sold out literally. Aliquip ugh bicycle rights actually mlkshk, seitan squid craft beer tempor."}],[{"key":"question","value":"Do You Ship Internationally?"},{"key":"answer","value":"Hoodie tote bag mixtape tofu. Typewriter jean shorts wolf quinoa, messenger bag organic freegan cray."}],[{"key":"question","value":"How Long Will It Take To Get My Package?"},{"key":"answer","value":"Swag slow-carb quinoa VHS typewriter pork belly brunch, paleo single-origin coffee Wes Anderson. Flexitarian Pitchfork forage, literally paleo fap pour-over. Wes Anderson Pinterest YOLO fanny pack meggings, deep v XOXO chambray sustainable slow-carb raw denim church-key fap chillwave Etsy. +1 typewriter kitsch, American Apparel tofu Banksy Vice."}],[{"key":"question","value":"What Payment Methods Are Accepted?"},{"key":"answer","value":"Fashion axe DIY jean shorts, swag kale chips meh polaroid kogi butcher Wes Anderson chambray next level semiotics gentrify yr. Voluptate photo booth fugiat Vice. Austin sed Williamsburg, ea labore raw denim voluptate cred proident mixtape excepteur mustache. Twee chia photo booth readymade food truck, hoodie roof party swag keytar PBR DIY."}],[{"key":"question","value":"Is Buying On-Line Safe?"},{"key":"answer","value":"Art party authentic freegan semiotics jean shorts chia cred. Neutra Austin roof party Brooklyn, synth Thundercats swag 8-bit photo booth. Plaid letterpress leggings craft beer meh ethical Pinterest."}]]',
                    true
                )
            );
        }

        $countProducts = count($products);

        foreach ($products as $key => $item) {
            $product = Product::query()->find($key + 1);
            if (! $product) {
                continue;
            }

            $product->productAttributeSets()->sync([1, 2]);

            $product->crossSales()->sync([
                $this->random(1, $countProducts, [$product->id]),
                $this->random(1, $countProducts, [$product->id]),
                $this->random(1, $countProducts, [$product->id]),
                $this->random(1, $countProducts, [$product->id]),
            ]);

            for ($j = 0; $j < fake()->numberBetween(1, 5); $j++) {
                $variation = Product::query()->create([
                    'name' => $product->name,
                    'status' => BaseStatusEnum::PUBLISHED,
                    'sku' => $product->sku . '-A' . $j,
                    'quantity' => $product->quantity,
                    'weight' => $product->weight,
                    'height' => $product->height,
                    'wide' => $product->wide,
                    'length' => $product->length,
                    'price' => $product->price,
                    'sale_price' => $product->id % 4 == 0 ? ($product->price - $product->price * fake()->numberBetween(
                        10,
                        30
                    ) / 100) : null,
                    'brand_id' => $product->brand_id,
                    'with_storehouse_management' => $product->with_storehouse_management,
                    'is_variation' => true,
                    'images' => json_encode([$product->images[$j] ?? Arr::first($product->images)]),
                    'product_type' => $product->product_type,
                ]);

                $productVariation = ProductVariation::query()->create([
                    'product_id' => $variation->id,
                    'configurable_product_id' => $product->id,
                    'is_default' => $j == 0,
                ]);

                if ($productVariation->is_default) {
                    $product->update([
                        'sku' => $variation->sku,
                        'sale_price' => $variation->sale_price,
                    ]);
                }

                ProductVariationItem::query()->create([
                    'attribute_id' => fake()->numberBetween(1, 5),
                    'variation_id' => $productVariation->id,
                ]);

                ProductVariationItem::query()->create([
                    'attribute_id' => fake()->numberBetween(6, 10),
                    'variation_id' => $productVariation->id,
                ]);

                if ($product->isTypeDigital()) {
                    foreach ($product->images as $img) {
                        $productFile = database_path('seeders/files/' . $img);

                        if (! File::isFile($productFile)) {
                            continue;
                        }

                        $fileUpload = new UploadedFile(
                            $productFile,
                            Str::replace('products/', '', $img),
                            'image/jpeg',
                            null,
                            true
                        );
                        $productFileData = app(StoreProductService::class)->saveProductFile($fileUpload);
                        $variation->productFiles()->create($productFileData);
                    }
                }
            }
        }
    }
}
