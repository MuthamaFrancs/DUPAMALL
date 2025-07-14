// type ProductProps = {
//   name: string;
//   price: string;
//   image: string;
// };


const ProductCard = ({ name, price, image }) => {
  return (
    <div className="min-w-[150px] bg-white shadow rounded-md p-2">
      <img src={image} alt={name} className="w-full h-28 object-cover rounded-md" />
      <h4 className="text-sm font-medium mt-2">{name}</h4>
      <p className="text-sm text-gray-500">{price}</p>
    </div>
  );
};

export default ProductCard;
