import Header from "./components/Header";
import Carousel from "./components/Carousel";
import ProductCard from "./components/ProductCard";
import CategoryChips from "./components/CategoryChips";
import BottomNav from "./components/BottomNav";

export default function Home() {
  const products = [
    { name: "Sneakers", price: "$245.00", image: "/sneakers.png" },
    { name: "Tote Bag", price: "$195.00", image: "/bag.png" },
    { name: "T-Shirt", price: "$125.00", image: "/shirt.png" },
    { name: "Oversized Tee", price: "$110.00", image: "/oversized.png" },
  ];

  const categories = ["Shoes", "Totes", "Services", "Hair", "Laundry"];

  return (
    <div className="flex flex-col min-h-screen">
      
      <Carousel />
      <section className="px-4 py-3">
        <div className="flex justify-between items-center mb-2">
          <h3 className="text-lg font-semibold">New Arrivals</h3>
          <span className="text-sm text-blue-500 cursor-pointer">View All</span>
        </div>
        <div className="flex space-x-4 overflow-x-auto">
          {products.map((product, index) => (
            <ProductCard key={index} {...product} />
          ))}
        </div>
      </section>
      <section className="px-4 py-2">
        <h3 className="text-lg font-semibold mb-2">Categories</h3>
        <CategoryChips categories={categories} />
      </section>
      <div className="px-4 py-4">
        <button className="w-full bg-black text-white py-3 rounded-lg font-semibold">
          Post a Product / Book a Service
        </button>
      </div>
      <BottomNav />
    </div>
  );
}
