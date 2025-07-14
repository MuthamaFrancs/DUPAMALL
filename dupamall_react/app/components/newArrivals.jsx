import ProductCard from "./ProductCard";

const newArrivals = [
    {id: 1, name: 'Top', image: '/top.jpeg', price: 'Kes 199.00'},
    {id: 2, name: 'Braids', image: '/globe.svg', price: 'Kes 500.00'},
    {id: 3, name: 'Wig', image: '/globe.svg', price: 'Kes 1,500.00'},
    {id: 4, name: 'Scones', image: '/globe.svg', price: 'Kes 20.00'},
];

const NewArrivals = () => {
    return (
        <section className="new-arrivals">
            <h2>New Arrivals</h2>
            <div className="product-lists">
                {newArrivals.map(product => (
                    <ProductCard key={product.id} product={product}></ProductCard>
                ))}

            </div>
        </section>
    );
};

export default NewArrivals;