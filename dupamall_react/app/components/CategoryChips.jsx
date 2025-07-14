const CategoryChips = ({ categories }) => {
  return (
    <div className="flex flex-wrap gap-2">
      {categories.map((cat, i) => (
        <span key={i} className="px-3 py-1 bg-gray-200 rounded-full text-sm cursor-pointer hover:bg-gray-300">
          {cat}
        </span>
      ))}
    </div>
  );
};

export default CategoryChips;
